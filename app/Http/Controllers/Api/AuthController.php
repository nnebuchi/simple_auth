<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:8',
            'username'      => ['required', 'min:2'], 
        ]);

        if ($validator->fails()) {
            return returnValidationError($validator->errors(), 'Registration failed');
        }
        return AuthService::createUser(sanitize_input($request->email), sanitize_input($request->password), sanitize_input($request->username));
    }


    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'     => 'required|email',
            'password'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return returnValidationError($validator->errors(), 'Verification Failed'); 
        }
        return AuthService::login(sanitize_input($request->email), sanitize_input($request->password));
    }
    
}
