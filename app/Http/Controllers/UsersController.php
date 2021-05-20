<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateUsersRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Give all users
     *
     * @return void
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Change the admin role
     *
     * @param User $user
     * @return void
     */
    public function makeAdmin(User $user)
    {
        if (!$user->isAdmin()) {
            $user->update(['role' => 'admin']);

            session()->flash('success', 'User make admin successfully!');

            return redirect(url('/users'));
        }
    }

    /**
     * Return the edit user value
     *
     * @return void
     */
    public function edit()
    {
        return view('users.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(UpdateUsersRequest $request)
    {
        Auth::user()->update([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        session()->flash('success', 'User updated successfully!');

        return redirect()->back();
    }

}
