<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\Product;

class ProductController extends Controller
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->getProduct();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' =>    [Rule::unique('product','code')->where(function ($query) {
                                $query->where('is_del',0);
                            }),
                        ],
            'name' =>    [Rule::unique('product','name')->where(function ($query) {
                                $query->where('is_del',0);
                            }),
                        ],
        ],
        [
            'code.unique'    => 'Mã sản phẩm đã tồn tại',
            'name.unique'    => 'Tên sản phẩm đã tồn tại',
        ]);
        $this->product->storeProduct($request);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $type)
    {
        switch ($type) {
            case 'search':
                    $products = $this->product->getProduct($request);
                    return view('product.table', compact('products'));
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->getProductById($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' =>    [Rule::unique('product','code')->where(function ($query) use ($id) {
                                $query->where('is_del',0)->where('id', '!=', $id);
                            }),
                        ],
            'name' =>    [Rule::unique('product','name')->where(function ($query) use ($id) {
                                $query->where('is_del',0)->where('id', '!=', $id);
                            }),
                        ],
        ],
        [
            'code.unique'    => 'Mã sản phẩm đã tồn tại',
            'name.unique'    => 'Tên sản phẩm đã tồn tại',
        ]);
        $this->product->updateProduct($request, $id);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product->deleteProduct($id);
        return response()->json(['success' => true]);
    }
}
