<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class AuthController extends JsonController
{
    /**
     * register endpoint the route is : api/v1/register
     * the request methode is POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
         $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
       $token= $user->createToken('auth-token-bagel-swap');
       $response = ['token'=>$token->plainTextToken,'user'=>$user];
      return $this->jsonSuccses('success',$response);
    }

    /**
     * login endpoint the route is : api/v1/login
     * the request methode is POST
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->authenticate();

        $token = $request->user()->createToken('auth-token-bagel-swap');
        $response = ['token'=>$token->plainTextToken,'user'=> $request->user(),];
        return $this->jsonSuccses('success login',$response,true);

    }

    /**
     * login endpoint the route is : api/v1/logout
     * the request methode is POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->tokens()->delete();
        $response = [];
        return $this->jsonSuccses('success disconnects',$response,true);

    }

}
