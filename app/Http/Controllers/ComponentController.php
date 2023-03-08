<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;

class ComponentController extends Controller
{
    public function show(Request $request)
    {
    	if ($request->ajax()) {
            switch ($request->type) {
                case 'khachhang':
                    return $this::khachhang($request);
                    break;
                case 'sanpham':
                    return $this::sanpham($request);
                    break;
            }
        }
    }

    public function khachhang($request)
    {
       //check request
        $suggest   =   $request->suggest;
        $paginate  =   $suggest ? 5 : 20 ;
        $pass      =   $request->pass;
        //data
        $title     =    'Bảng khách hàng';
        $data_all  =    Customer::where('is_del',0)->get();
        $data      =    Customer::query();
        $data->where('is_del', 0);
        if ($request->search) {
            $data->where(function($q) use ($request){
                $q  ->where('code','like','%'.$request->search.'%')
                    ->orWhere('name','like','%'.$request->search.'%');
            });
        }

        $data   =   $data->select('id','code as ma', 'name as ten')->paginate($paginate);
        $response_data  =   [
            'title'     =>  $title,
            'data'      =>  $data,
            'action'    =>  ['modal_name' => '.modal-select-customer', 'route' => route('customer.store')],
            'data_all'  =>  ($pass == 'yes') ? $data_all : '',
        ];
        if ($suggest == 'yes') {
            return $this::getSuggest($response_data);
        }
        return $this::getTable($response_data);
    }

    public function sanpham($request)
    {
       //check request
        $suggest   =   $request->suggest;
        $paginate  =   $suggest ? 5 : 20 ;
        $pass      =   $request->pass;
        //data
        $title     =    'Bảng sản phẩm';
        $data_all  =    Product::where('is_del',0)->get();
        $data      =    Product::query();
        $data->where('is_del', 0);
        if ($request->search) {
            $data->where(function($q) use ($request){
                $q  ->where('code','like','%'.$request->search.'%')
                    ->orWhere('name','like','%'.$request->search.'%');
            });
        }

        $data   =   $data->select('id','code as ma', 'name as ten')->paginate($paginate);
        $response_data  =   [
            'title'     =>  $title,
            'data'      =>  $data,
            'action'    =>  ['modal_name' => '.modal-select-product', 'route' => route('product.store')],
            'data_all'  =>  ($pass == 'yes') ? $data_all : '',
        ];
        if ($suggest == 'yes') {
            return $this::getSuggest($response_data);
        }
        return $this::getTable($response_data);
    }

    //bang du lieu
    public function getTable($response_data, $is_vattu = false)
    {
		$content 	= '';
		foreach ($response_data['data'] as $key => $value) {
		$key += 1;
		$content .=
            '<tr>
			    <th scope="row" class="text-center">'.$key.'</th>
			    <td class="ma cursor" data-id="'.$value->id.'" data-name='.$value->ten.'">'.$value->ma.'</td>
			    <td>'.$value->ten.'</td>
			</tr>';
    	};
    	$table  	=
            '<table id="detail_table" class="table table-bordered table-hover">
				<thead class="bg-warning text-center">
                    <tr>
                        <th scope="col" class="stt-select-box">STT</th>
                        <th scope="col" class="ma-select-box">Mã</th>
                        <th scope="col" class="ten-select-box">Tên</th>
                    </tr>
				</thead>
				<tbody>
				    '.$content.'
				</tbody>
			</table>
    	';

    	$page = '<div class="float-right">' . $response_data['data']->onEachSide(1)->links() . '</div>';

        $response_data = [
            'title'     =>  $response_data['title'],
            'action'    =>  isset($response_data['action']) ? $response_data['action']: '',
            'table'     =>  $table,
            'page'      =>  $page,
            'data_all'  =>  $response_data['data_all'],
        ];
    	return Response()->json($response_data);
    }

    //goi y search ben ngoai
    public function getSuggest($response_data, $is_vattu = false)
    {
        $resurl_suggest = '';
        foreach ($response_data['data'] as $key => $value) {
            $resurl_suggest .=
            '<tr>
                <td class="ma cursor" data-id="'.$value->id.'" data-name='.$value->ten.'">'.$value->ma.'</td>
                <td class="ma cursor" data-id="'.$value->id.'" data-name='.$value->ten.'">'.$value->ten.'</td>
            </tr>';
        }

        $table      =
            '<div class="result-suggest">
                <table id="detail_table_search" class="table table-bordered table-hover">
                    <tbody>
                        '.$resurl_suggest.'
                    </tbody>
                </table>
            </div>
        ';

        $response_data = [
            'resurl_suggest' =>  $table,
            'data_all'       =>  $response_data['data_all'],
            'isset'          =>  $resurl_suggest != '' ? true : false
        ];
        return Response()->json($response_data);
    }
}
