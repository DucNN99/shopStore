<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Product;
use App\Models\Customer;
use Carbon\Carbon;
use DB;

class PurchaseOrderController extends Controller
{
    public $order;
    public $product;
    public $customer;

    public function __construct(PurchaseOrder $order, Product $product, Customer $customer)
    {
        $this->order        = $order;
        $this->product      = $product;
        $this->customer     = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->getOrder();
        return view('purchase-order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers  = $this->customer->getCustomer();
        $products   = $this->product->getProduct();
        $order_code = 'DMH'.Carbon::now()->format('dmy_hms');
        return view('purchase-order.create', compact(['customers', 'products', 'order_code']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $order              = new PurchaseOrder();
            $order->order_code  = $request->code;
            $order->customer_id = $request->customer_id;
            $order->day_in      = $request->day_in;
            $order->total       = (double)(str_replace(',', '.',str_replace('.', '',$request->total_all)));
            $order->note        = $request->note;
            $order->is_del      = 0;
            $order->save();
            if (isset($request->product_id)) {
                foreach ($request->product_id as $key => $item) {
                    $detail                     = new PurchaseOrderDetail();
                    $detail->purchase_order_id  = $order->id;
                    $detail->product_id         = $request->product_id[$key];
                    $detail->quantity           = (double)(str_replace(',', '.',str_replace('.', '', $request->quantity[$key])));
                    $detail->cost               = (double)(str_replace(',', '.',str_replace('.', '', $request->cost[$key])));
                    $detail->total              = (double)(str_replace(',', '.',str_replace('.', '', $request->total[$key])));
                    $detail->manufacture        = $request->manufacture[$key];
                    $detail->expired            = $request->expired[$key];
                    $detail->save();
                }
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
