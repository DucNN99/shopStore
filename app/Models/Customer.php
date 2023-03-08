<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table    = "customer";

    protected $guarded  = [];

    protected $perPage  = 10;

    public function getCustomer($request = null, $is_perPage = null)
    {
        $customers = Customer::where('is_del', 0);
                        if ($request != null) {
                            $customers = $customers->where(function($query) use ($request){
                                                $query->where('name', 'LIKE', '%'.$request->search.'%')
                                                        ->orwhere('code', 'LIKE', '%'.$request->search.'%')
                                                        ->orwhere('phone', 'LIKE', '%'.$request->search.'%');
                                            });
                        }
                        $customers = $customers->orderBy('id', 'DESC');
                        if ($is_perPage != null) {
                            $customers = $customers->get();
                        } else {
                            $customers = $customers->paginate(optional($request)->perPage);
                        }
        return $customers;
    }

    public function storeCustomer($request)
    {
        $customers              = new Customer();
        $customers->code        = $request->code;
        $customers->name        = $request->name;
        $customers->type        = $request->type;
        $customers->phone       = $request->phone;
        $customers->email       = $request->email;
        $customers->address     = $request->address;
        $customers->description = $request->description;
        $customers->is_del      = 0;
        $customers->save();
        return $customers;
    }

    public function getCustomerById($id)
    {
        return Customer::find($id);
    }

    public  function updateCustomer($request, $id)
    {
        $customers              = Customer::find($id);
        $customers->code        = $request->code;
        $customers->name        = $request->name;
        $customers->type        = $request->type;
        $customers->phone       = $request->phone;
        $customers->email       = $request->email;
        $customers->address     = $request->address;
        $customers->description = $request->description;
        $customers->is_del      = 0;
        $customers->save();
        return $customers;
    }

    public function deleteCustomer($id)
    {
        $customers              = Customer::find($id);
        $customers->is_del      = 1;
        $customers->save();
        return $customers;
    }
}
