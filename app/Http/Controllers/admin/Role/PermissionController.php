<?php

namespace App\Http\Controllers\admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $permissions = Permission::all();

        return view('admin.Permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        Permission::create($request->only('p_name'));

        return redirect()->route('permissions.index')->with('success','Permission Detail is created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissionData = Permission::where('permission_id',$id)->first();

        return view('admin.Permission.edit',compact('permissionData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissionData = Permission::where('permission_id',$id)->first();

        return view('admin.Permission.edit',compact('permissionData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permissionData = Permission::where('permission_id',$id)->update($request->only('p_name'));

        if(empty($permissionData)){

            return redirect()->route('permissions.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('permissions.index')->with('success','Permission Detail Updated successfully !!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissionData = Permission::where('role_id',$id)->delete();

        if(empty($permissionData)){

            return redirect()->route('roles.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('roles.index')->with('success','Permission Details deleted successfully !!');
    }
}
