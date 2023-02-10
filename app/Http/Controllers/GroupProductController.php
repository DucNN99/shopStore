<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\GroupProduct;

class GroupProductController extends Controller
{
    public $group;

    public function __construct(GroupProduct $group)
    {
        $this->group = $group;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->group->getGroup();
        return view('group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'  => [Rule::unique('group_product','name')->where(function($query) use ($request) {
                                    $query->where('is_del', 0); })
                ]
            ],
            [
                'name.unique'   => 'Nhóm sản phẩm đã tồn tại !',
            ]
        );
        $this->group->storeGroup($request);
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
                    $groups = $this->group->getGroup($request);
                    return view('group.table', compact('groups'));
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
        $group = $this->group->getGroupById($id);
        return view('group.edit', compact('group'));
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
        $request->validate(
            [
                'name'  => [Rule::unique('group_product','name')->where(function($query) use ($request, $id) {
                                    $query->where('is_del', 0)->where('id', '!=', $id); })
                ]
            ],
            [
                'name.unique'   => 'Nhóm sản phẩm đã tồn tại !',
            ]
        );
        $this->group->updateGroup($request, $id);
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
        $this->group->deleteGroup($id);
        return response()->json(['success' => true]);
    }
}
