<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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

    public function makeAdmin(User $user)
    {
        if (!$user->isAdmin()) {
            $user->update(['role' => 'admin']);

            session()->flash('success', 'User make admin successfully!');

            return redirect(url('/users'));
        }
    }
}
