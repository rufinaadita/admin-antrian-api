<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $user = User::where('email', $request->json('email'))->first();
        $password = $request->json('password');

        if($user) {
            if(Hash::check($password, $user->password)) {
                return response()->json([
                    'data' => $user,
                    'message' => 'Login Berhasil'
                ]);
            }

            return response()->json([
                'message' => 'Passowrd Salah'
            ]);
        }

        return response()->json([
            'message' => 'Email tidak ditemukan'
        ]);
    }

    public function registerUser(Request $request)
    {
        $data = [
            'name' => $request->json('name'),
            'email' => $request->json('email'),
            'password' => Hash::make($request->json('password'))
        ];

        $user = User::create($data);

        if ($user)
        {
            return response()->json([
                'message' => 'Register User Berhasil !'
            ]);
        } else {
            return response()->json([
                'message' => 'Register Gagal'
            ], 400);
        }

    }

    public function dataUser()
    {
        return User::all();
    }

    public function show($id)
    {
        $data = User::find($id);

        if($data) {
            return response()->json([
                'data' => $data
            ]);
        }

        return response()->json([
            'message' => 'gagal'
        ]);
    }
}