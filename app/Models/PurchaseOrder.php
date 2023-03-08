<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table    = "purchase_order";

    protected $guarded  = [];

    protected $perPage  = 10;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id'); 
    }

    public function getOrder($request = null)
    {
        $orders = PurchaseOrder::where('is_del', 0);
            if ($request != null) {
                $orders = $orders->where(function($query) use ($request){
                                    $query->where('order_code', 'LIKE', '%'.$request->search.'%');
                                });
            }
            $orders = $orders->orderBy('id', 'DESC')
            ->paginate(optional($request)->perPage);
        return $orders;
    }
}
