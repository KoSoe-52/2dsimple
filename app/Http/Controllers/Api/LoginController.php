<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string',
            ]);
            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'msg'  => 'Insufficient fields',
                    'data' => implode(",", $validate->messages()->all())
                ],200);
            }
            $username = filter_var($request->username,FILTER_SANITIZE_STRING);
            $password  = filter_var($request->password,FILTER_SANITIZE_STRING);
            $user = User::where("name",$username)->first();
            if($user)
            {
                // Revoke all existing tokens for the user
                if(Hash::check($password,$user->password))
                {
                    $token = $user->createToken('ReactApp')->plainTextToken;
                    return response()->json([
                        'status' => true,
                        'msg'  => 'Login successfully',
                        'data' => $user,
                        'token' => $token
                    ],200);
                }else
                {
                    return response()->json([
                        'status' => false,
                        'msg'  => 'Incorrect username and password',
                        'data' => []
                    ],200);
                }
            }else
            {
                return response()->json([
                    'status' => false,
                    'msg'  => 'Incorrect username and password',
                    'data' => []
                ],200);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => $th->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
