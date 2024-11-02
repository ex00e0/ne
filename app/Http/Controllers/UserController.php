<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login (Request $request) {
        $request->validate([
            "email"=>["required", "email"],
            "password"=>["required", Password::min(8)->letters()->numbers()]
        ]);
        $user = User::where('email', $request->email)->exists();
            if ($user != false) {
            $user = User::where('email', $request->email)->first();
            $pass = $user->password;
            $id = $user->id;
            $role = $user->role;

            if (Hash::check($request->password, $pass)) {
                Auth::login(User::find($id));
                return response()->json($id);
            } else {
                return response()->json('неверный пароль');
         }  
            }
           else {
            return response()->json('неверный логин');

        } 
    }
}