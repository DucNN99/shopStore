<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\PurchaseOrderDetail;

class PurchaseOrder extends Model
{
    protected $table    = "purchase_order";

    protected $guarded  = [];

    protected $perPage  = 10;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function detail()
    {
        return $this->hasMany(PurchaseOrderDetail::class, 'purchase_order_id');
    }

    public function getOrder($request = null)
    {
        $orders = PurchaseOrder::join('customer', 'customer.id', '=', 'purchase_order.customer_id')
                                ->where('purchase_order.is_del', 0);
            if ($request != null) {
                $orders = $orders->where(function($query) use ($request){
                                    $query->where('purchase_order.order_code', 'LIKE', '%'.$request->search.'%')
                                            ->orwhere('customer.name', 'LIKE', '%'.$request->search.'%');
                                });
            }
            $orders = $orders->select('purchase_order.*')
                            ->orderBy('id', 'DESC')
                            ->paginate(optional($request)->perPage);
        return $orders;
    }

    public function storeOrder($request)
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
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function updateOrder($request, $id)
    {
        DB::beginTransaction();
        try {
            $order              = PurchaseOrder::find($id);
            $order->order_code  = $request->code;
            $order->customer_id = $request->customer_id;
            $order->day_in      = $request->day_in;
            $order->total       = (double)(str_replace(',', '.',str_replace('.', '',$request->total_all)));
            $order->note        = $request->note;
            $order->is_del      = 0;
            $order->save();
            if (isset($request->product_id)) {
                PurchaseOrderDetail::where('purchase_order_id', $id)->delete();
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
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getOrderById($id)
    {
        return PurchaseOrder::find($id);
    }

    public function deleteOrder($id)
    {
        $order              = PurchaseOrder::find($id);
        $order->is_del      = 1;
        $order->save();
        return true;
    }
}
