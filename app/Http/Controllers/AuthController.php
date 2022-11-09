<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class AuthController extends Controller
{
    //
    // public function _construct(){
    //     $this->middleware('auth:api',['except' => ['login','register']]);
    // }
    public function register(Request $request){
            $validator = Validator::make($request->all(),[
                'name' => 'required' , 
                'email' => 'required|string|email|unique:users' ,
                'password' => 'required|string|confirmed|min:6' 
            ]);

            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
            $user = User::create(array_merge(
                        $validator->validated(),
                        ['password' => bcrypt($request->password)]
                    ));
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ], 201);


    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email' ,
            'password' => 'required|string|min:6' 
        ]); 
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),422);
        }
        if(!$token=auth()->attempt($validator->validate())){
            return response()->json(['error'=>'unauthorized'],401);
         }
        return $this->createNewToken($token); 
    }

    public function createNewToken($token){
        return response()->json([
            'message' => 'User successfully Login',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()*60,
            'user' => auth()->user()
        ]);
    }

    public function logout(){
        auth()->logout();
        return response()->json([
            'message' => 'User successfully signed out '
        ]);
    }

    public function profile(){
        return response()->json(auth()->user());
        // if(!$token=auth()->attempt($validator->validate())){
            // return response()->json(['error'=>'unauthorized'],401);
    // }
    }

    public function reset_password(Request $request)
    {
    	 $request->validate([
          'email' => 'required|email',
          'current_password' => 'required',
          'new_password' => 'required|string|min:6|same:confirm_password',
          'confirm_password' => 'required',
        ]);
        // $token = JWTAuth::getToken();
        // $user = JWTAuth::toUser($token);
        // Auth::setUser($user);
        // $user = JWTAuth::user();
        $user = User::where('email', '=', $request->email)->first();
        if (!$user) {
           return response()->json(['success'=>false, 'message' => 'Login Fail,please check again if the email is correct']);
        }
    	if (Hash::check($request->current_password, $user->password)) {
            // return back()->with('error', 'Current password does not match!');
                if (Hash::check($request->new_password, $user->password)) {
                    return response()->json([
                        'message' => 'old password cant be used anymore'
                    ],404);
                }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
            'message' => 'Password successfully changed!' ,
             'user' => $user
        ],201);

        }else {
            return response()->json([
                'message' => 'Current password does not match!'
            ],404);
        }

        //  return back()->with('success', 'Password successfully changed!');
        
    }

}
