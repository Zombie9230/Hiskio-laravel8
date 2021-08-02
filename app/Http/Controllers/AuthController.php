<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request){
        $validatateData = $request->validated();

        $user = new User([
            'name' => $validatateData['name'],
            'email' => $validatateData['email'],
            'password' => bcrypt($validatateData['password']),
        ]);

        $user->save();
        return response('建立成功',201);
    }

    public function login(Request $request){

        $login = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if(!Auth::attempt($login)){
            return response('驗證失敗',401);
        }

        $user = $request->user();
        $userToken = $user->createToken('Token');
        $userToken->token->save();
        return response(['token' => $userToken->accessToken]);

        // dd($userToken);

    }
    public function user(Request $request){

        return response(
            $request->user()
        );

    }
    public function logout(Request $request){

        $request->user()->token()->revoke();

        return response(
            ['message' => '成功登出']
        );

    }
}
