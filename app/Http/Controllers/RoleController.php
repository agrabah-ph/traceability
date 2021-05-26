<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('headoffice.admin.role.index');
    }

    public function show($id)
    {
//        $role = Role::whereNotIn('name', array('web-developer'))->find($id);
        $role = Role::find($id);
        $permissions = Permission::select('table_name', 'table_display_name')
            ->distinct('table_name')
            ->get();

        $default = DB::table('role_has_permissions')
            ->where('role_id',$role->id)
            ->pluck('permission_id')
            ->toArray();

        return view('headoffice.admin.role.show', compact('role','permissions','default'));
    }

    public function update(Request $request, $id)
    {
//        app()['cache']->forget('spatie.permission.cache');
        $ids = $request->input('permission',[]);
//        $permissions = Permission::whereIn('id', $ids)
//            ->pluck('name')
//            ->toArray();

        $role = Role::find($id);

        $role->syncPermissions($ids);

        return redirect()->back();
    }

    public function addRole(Request $request)
    {
        $category = Auth::user()->category;
        $data = Role::create(array(
            'name' => stringSlug($category.' '.$request->input('name')),
            'display_name' => $request->input('name'),
            'category' => $category
        ));
        return response()->json($data);
    }
}
