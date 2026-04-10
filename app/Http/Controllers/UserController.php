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
            "users" => User::where('role', '!=', 'Admin')->get(),
        ]);
    }

    public function edit(Request $request)
    {
        $user = auth()->user();
        if ($user->role != 'Admin'){
            return redirect()->route('dashboard');
        }
        
        $validated = $request->validate([
            'id' => ['required', 'integer'],
            'role' => ['required', 'string', 'max:255'],
        ]);

        if (User::find($validated['id'])->role == "Admin"){
            return redirect()->route('dashboard');
        }

        User::find($validated['id'])->update([
            "role" => $validated['role'],
        ]);

        return redirect()->route('users');
    }
}
