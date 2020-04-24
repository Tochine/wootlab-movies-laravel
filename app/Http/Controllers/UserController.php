<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Hash;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Store a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique',
            'password' => 'required|min:4',
        ]);
   
        if($validator->fails()){
            return response()->json(['message' => $validation], 401);      
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
        ]);
        $token = $user->createToken('WootLabMovies')->accessToken;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('WootLabMovies')->accessToken; 
            $success['name'] =  $user->name;
 
        return response()->json([
            'token' => $token,
            'user' => $user,
            'success' => 'User registerd and logged in!'
        ], 201);
        }
   
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $userdetails = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($userdetails)){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('WootLabMovies')->accessToken; 
            $success['name'] =  $user->name;
            
            return response()->json(['token' => $success,
            'success' => 'User logged in successfully'], 200);;
        } 
        else{ 
            return response()->json(['error' => 'UnAuthorised'], 401);
        } 
    }

}
