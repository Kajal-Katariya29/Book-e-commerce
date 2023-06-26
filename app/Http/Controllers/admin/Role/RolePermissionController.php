<?php

namespace App\Http\Controllers\admin\Role;

use App\Http\Controllers\Controller;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use App\Http\Requests\RolePermissionRequest;
use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use App\Models\Post;

class RolePermissionController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolePermissions = RolePermission::orderby('role_permission_id','desc')->with('role','permission')->get();
        return view('admin.RolePermission.index',compact('rolePermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::select('role_id','name')->get()->pluck('name','role_id');
        $permission = Permission::select('permission_id','p_name')->get()->pluck('p_name','permission_id');
        return view('admin.RolePermission.create',compact('role','permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolePermissionRequest $request)
    {
        RolePermission::create($request->only(['role_id','permission_id']));
        return redirect()->route('role-permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rolePermissionData = RolePermission::where('role_permission_id',$id)->first();

        $role = Role::select('role_id','name')->get()->pluck('name','role_id');

        $permission = Permission::select('permission_id','p_name')->get()->pluck('p_name','permission_id');

        return view('admin.RolePermission.edit',compact('rolePermissionData','role','permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolePermissionRequest $request, $id)
    {

        $rolePermissionData = RolePermission::where('role_permission_id',$id)->update($request->only(['role_id','permission_id']));

        if(empty($rolePermissionData)){

            return redirect()->route('role-permission.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('role-permission.index')->with('success','Role Permission Data is Updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rolePermissionData = RolePermission::where('role_permission_id',$id)->delete();

        if(empty($rolePermissionData)){

            return redirect()->route('role-permission.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('role-permission.index')->with('success','Role Permisssion Data is deleted successfully !!');
    }
}
