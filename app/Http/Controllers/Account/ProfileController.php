<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{

    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $account = Auth::user();
        $activities = $this->repository->getAccessActivity($account->id, 2); // {number} limit
        $activities_count = $this->repository->getAccessActivityCount();
        return view('account.profile.index', compact('account', 'activities', 'activities_count'));
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:6|required_with:new_password_confirmation|same:new_password_confirmation',
            'new_password_confirmation' => 'min:6',
        ]);
        $id = Auth::id();
        if (!isset($id)) abort(403);
        $user = User::findOrFail($id);
        if(!password_verify($request->password, $user->password)) {
            return redirect()
                    ->route('account.profile')
                    ->with(['error' => 'Failed update password, old password does not match!']);
        }
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()
                    ->route('account.profile')
                    ->with('success','Password updated successfully!');
    }

    public function setBasicInfo(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);
        $id = Auth::id();
        if (!isset($id)) abort(403);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();
        return redirect()
                ->route('account.profile')
                ->with('success','Basic Information updated successfully!');
    }


}
