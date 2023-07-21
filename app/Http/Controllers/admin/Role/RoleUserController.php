<?php

namespace App\Http\Controllers\admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Http\Requests\RoleUserRequest;

class RoleUserController extends Controller
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
        $roleUsers = RoleUser::orderby('role_user_id','desc')->with('role','user')->get();
        return view('admin.RoleUser.index',compact('roleUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::select('role_id','name')->pluck('name','role_id');
        $user = User::select('user_id','first_name')->pluck('first_name','user_id');
        return view('admin.RoleUser.create',compact('role','user'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleUserRequest $request)
    {
        RoleUser::create($request->only(['role_id','user_id']));
        return redirect()->route('role-user.index');
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
        $roleUserData = RoleUser::where('role_user_id',$id)->first();
        $role = Role::select('role_id','name')->pluck('name','role_id');
        $user = User::select('user_id','first_name')->pluck('first_name','user_id');
        return view('admin.RoleUser.edit',compact('roleUserData','role','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUserRequest $request, $id)
    {
        $roleUserData = RoleUser::where('role_user_id',$id)->update($request->only(['role_id','user_id']));

        if(empty($roleUserData)){

            return redirect()->route('role-user.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('role-user.index')->with('success','Role User Data is Updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roleUserData = RoleUser::where('role_user_id',$id)->delete();

        if(empty($roleData)){

            return redirect()->route('role-user.index')->with('error','The Data is not available !!');
        }

        return redirect()->route('role-user.index')->with('success','Role User Data is deleted successfully !!');
    }
}
