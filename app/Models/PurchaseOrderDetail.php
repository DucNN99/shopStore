<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $table    = "purchase_order_detail";

    protected $guarded  = [];

    protected $perPage  = 10;
}
