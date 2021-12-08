<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function store(Request $request) 
    {
        $user = new User();
        $validate_rule = [
            'name' => 'required|max:50',
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|min:6',
        ];
        $this->validate($request, $validate_rule);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json(['user' => $user], 201);
    }
}
