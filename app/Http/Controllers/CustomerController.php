<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customer->getCustomer();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = 'KHNCC'.Carbon::now()->format('dmy_hms');
        return view('customer.create' , compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate(
        //     [
        //         'code'  => [Rule::unique('customer','code')->where(function($query) use ($request) {
        //                             $query->where('is_del', 0); })
        //         ]
        //     ],
        //     [
        //         'code.unique'   => 'MÃ KH/NCC đã tồn tại !',
        //     ]
        // );
        $this->customer->storeCustomer($request);
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
                    $customers = $this->customer->getCustomer($request);
                    return view('customer.table', compact('customers'));
                break;
            case 'code':
                    $code = 'KHNCC'.Carbon::now()->format('dmy_hms');
                    return response()->json($code);
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
        $customer = $this->customer->getCustomerById($id);
        return view('customer.edit', compact('customer'));
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
        // $request->validate(
        //     [
        //         'code'  => [Rule::unique('customer','code')->where(function($query) use ($request) {
        //                             $query->where('is_del', 0); })
        //         ]
        //     ],
        //     [
        //         'code.unique'   => 'MÃ KH/NCC đã tồn tại !',
        //     ]
        // );
        $this->customer->updateCustomer($request, $id);
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
        $this->customer->deleteCustomer($id);
        return response()->json(['success' => true]);
    }
}
