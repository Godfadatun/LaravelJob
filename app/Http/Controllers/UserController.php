<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Balance;
// use App\Transaction;
use App\User;

class UserController extends Controller
{

    public function register(Request $request)
    {
        //

        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $user = User::create($input);
        $accessToken = $user->createToken('authToken')->accessToken ;
        // $user->save();

        $balance = new Balance;
        $balance->account_nr = $request->phone;
        $balance->amount = 0;
        $balance->user_id = $user->id;
        $balance->save();


        return response([
            'message'=> 'Valid Credentials',
            'status' => 'Authorized',
            'user'=>$user->load('balance'),
            'access_token'=> $accessToken
        ]);
    }

    public function login(Request $request)
    {
        //
        $loginData = $request->all();

        if (!auth()->attempt($loginData)) {
            return response([
                'message'=> 'Invalid Credentials',
                'status' => 'Unauthorized'
                ]);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'message'=> 'Logged In',
            'status' => 'Authorized',
            'user'=> auth()->user()->load('balance'),
            'access_token'=> $accessToken
            ]);
    }

}
