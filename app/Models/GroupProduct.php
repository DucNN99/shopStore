<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    protected $table    = "group_product";

    protected $guarded  = [];

    protected $perPage  = 10;

    public function getGroup($request = null)
    {
        $groups = GroupProduct::where('is_del', 0);
                        if ($request != null) {
                            $groups = $groups->where(function($query) use ($request){
                                                $query->where('name', 'LIKE', '%'.$request->search.'%')
                                                        ->orwhere('description', 'LIKE', '%'.$request->search.'%');
                                            });
                        }
                        $groups = $groups->orderBy('id', 'DESC')
                        ->paginate(optional($request)->perPage);
        return $groups;
    }

    public function storeGroup($request)
    {
        $group                  = new GroupProduct();
        $group->name            = $request->name;
        $group->description     = $request->description;
        $group->is_del          = 0;
        $group->save();
        return $group;
    }

    public function updateGroup($request, $id)
    {
        $group                  = GroupProduct::find($id);
        $group->name            = $request->name;
        $group->description     = $request->description;
        $group->is_del          = 0;
        $group->save();
        return $group;
    }

    public function getGroupById($id)
    {
        return GroupProduct::find($id);
    }

    public function deleteGroup($id)
    {
        $group                  = GroupProduct::find($id);
        $group->is_del          = 1;
        $group->save();
        return $group;
    }
}
