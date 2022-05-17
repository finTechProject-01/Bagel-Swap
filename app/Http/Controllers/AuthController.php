<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class AuthController extends JsonController
{
    /**
     * register endpoint the route is : api/v1/register
     *the request methode is POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $schema = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        $user = User::create([
            'email' => $schema->email,
            'password' => Hash::make($schema->password)
        ]);
       $token= $user->createToken('auth-token-bagel-swap');
       $response = ['token'=>$token->plainTextToken,'user'=>$user];
       return $this->jsonSuccses('success',$response);
    }
}
