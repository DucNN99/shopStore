<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DNS1D;

class Product extends Model
{
    protected $table    = "product";

    protected $guarded  = [];

    protected $perPage  = 10;

    public function getProduct($request = null)
    {
        $products = Product::where('is_del', 0);
            if ($request != null) {
                $products = $products->where(function($query) use ($request){
                                    $query->where('name', 'LIKE', '%'.$request->search.'%')
                                            ->orwhere('code', 'LIKE', '%'.$request->search.'%');
                                });
            }
            $products = $products->orderBy('id', 'DESC')
            ->paginate(optional($request)->perPage);
        return $products;
    }

    public function storeProduct($request)
    {
        $product                    = new Product();
        $product->code              = $request->code;
        $product->name              = $request->name;
        $product->barcode           = $request->barcode;
        $product->note              = $request->note;
        $barcode                    = $request->barcode != null ? $request->barcode : $request->code;
        $barcode_html               = '<img src="data:image/png;base64,'.DNS1D::getBarcodePNG($barcode, 'C128',1,33,array(0,0,0), true).'" alt="barcode" />';
        $product->barcode_img       = $barcode_html;
        $product->is_del            = 0;
        $product->save();
        return $product;
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function updateProduct($request, $id)
    {
        $product                    = Product::find($id);
        $product->code              = $request->code;
        $product->name              = $request->name;
        $product->barcode           = $request->barcode;
        $product->note              = $request->note;
        $barcode                    = $request->barcode != null ? $request->barcode : $request->code;
        $barcode_html               = '<img src="data:image/png;base64,'.DNS1D::getBarcodePNG($barcode, 'C128',1,33,array(0,0,0), true).'" alt="barcode" />';
        $product->barcode_img       = $barcode_html;
        $product->is_del            = 0;
        $product->save();
        return $product;
    }

    public function deleteProduct($id)
    {
        $product                    = Product::find($id);
        $product->is_del            = 1;
        $product->save();
        return $product;
    }
}
