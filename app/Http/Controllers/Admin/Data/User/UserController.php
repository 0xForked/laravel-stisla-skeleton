<?php

namespace App\Http\Controllers\Admin\Data\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(10);
        if ($request->search) {
            $users = User::where(
                'name',
                'LIKE',
                "%$request->search%"
            )->paginate(10);
        }
        return view('admin.user-mgmt.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user-mgmt.users.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'phone' => 'required|unique:users,phone',
            'name' => 'required',
            'role' => 'required'
        ]);
        $input = $request->only('email', 'username', 'phone', 'name');
        $input['password'] = Hash::make('secret');
        $user = User::create($input);
        $role = $request->input('role');
        $user->assignRole($role);
        // send email to user for verify account
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User successfully added with default password is "rete".');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $user->roles->first();
        return view('admin.user-mgmt.users.edit', compact('user', 'roles', 'userRole'));
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
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
            'name' => 'required',
            'role' => 'required'
        ]);
        $input = $request->all();
        $user = User::findOrFail($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $role = $request->input('role');
        $user->assignRole($role);
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User successfully edited.');
    }

    public function status($status)
    {
        // on this function
        // we will validate user status 'Activate' or not
        // and every action will send notify to user via
        // email, phone or other . . . .
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()
            ->route('admin.users.index')
            ->with('success','User delete successfully');
    }

}
