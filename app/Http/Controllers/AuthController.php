<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        // $fields = $request->validate(
        //     [
        //         'name' => 'required|string',
        //         'email' => 'required|string|unique:users,email',
        //         'password' => 'required|string|confirmed'
        //     ]
        // );

        $fields = $request->all();

        $validator = Validator::make($fields, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid',
                'errors' => $validator->errors()
        ]);
        } else {

            $user = User::create([
                'name' => ucwords($fields['name']),
                'email' => $fields['email'],
                'password' => bcrypt($fields['password']),
            ]);
        }

        // $user = new User();

        // $user->fill($fields);

        // $user->save();

        $token = $user->createToken('token')->plainTextToken;


        return response()->json(
            [
                'success' => true,
                'user' => $user,
                'token' => $token,
                'message' => 'Registered successfully'
            ],
            201
        );
    }

    public function login(Request $request)
    {

        $fields = $request->all();

        $validator = Validator::make($fields, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if ($validator->fails()) {
            return response()->json([
                'message' => 'You must fill in all the fields!',
                'errors' => $validator->errors()
            ]);
        }

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(
            [
                'success' => true,
                'user' => $user,
                'token' => $token,
                'message' => 'Logged in'
            ],
            201
        );
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(
            [
                'message' => 'Logged out.'
            ]
        );
    }
}
