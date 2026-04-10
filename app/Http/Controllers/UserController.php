<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    //
    public function users()
    {
        $user = auth()->user();
        if ($user->role != 'Admin'){
            return redirect()->route('dashboard');
        }

        return view('users.users', [
            "users" => User::all(),
        ]);
    }
}
