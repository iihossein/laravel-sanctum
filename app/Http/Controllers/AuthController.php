<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;
    public function login(UserRequest $request){
        // $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('','شما لاگین نیستید',401);
        }

        $user = User::where('email',$request->email)->first();
        $token = $user->createToken('Api Token')->plainTextToken;
        return $this->success([
            'user' => $user,
            'token' => $token
        ]);
    }


    public function register(UserRequest $request){
        $request->validated($request->all);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = $user->createToken('Api Token')->plainTextToken;
        return $this->success([
            'user' => $user,
            'token' => $token
        ]);
    }
    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->success(['شما از حساب خود خارج شدید']);
    }
    public function show(){
        return 'method';
    }

}
