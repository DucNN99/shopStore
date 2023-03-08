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
        $order_code = 'DMH'.Carbon::now()->format('dmy_hms');
        return view('purchase-order.create', compact(['order_code']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = $this->order->storeOrder($request);
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
                    $orders = $this->order->getOrder($request);
                    return view('purchase-order.table', compact('orders'));
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
        $order = $this->order->getOrderById($id);
        return view('purchase-order.edit', compact(['order']));
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
        $order = $this->order->updateOrder($request, $id);
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
        $this->order->deleteOrder($id);
        return response()->json(['success' => true]);
    }
}
