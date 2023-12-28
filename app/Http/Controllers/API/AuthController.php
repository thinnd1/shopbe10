<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function SignUp(Request $request)
    {
        $validated = Validator::make($request->json()->all(), [
            'name' => 'required|string|min:3|max:55',
            'email' => 'required|string|email|max:200|unique:user',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => $validated->errors(),
                'status' => 'validation-error'
            ], 404);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // add a cart id to user (personal)
        $cart = Cart::create([
            'user_id' => $user->id
        ]);
        // add a wishlist to user (personal)
        $wishlist = Wishlist::create([
            'user_id' => $user->id
        ]);

        return response()->json([
            'message' => 'User registrated Successfuly',
            'status' => 'ok',
            'user' => $user,
            'cart' => $cart,
            'wishlist' => $wishlist
        ], 201);
    }


    public function login(Request $request)
    {
        $validated_login = Validator::make($request->all(), [
            "email" => "required|string|email|max:200",
            "password" => "required|string"
        ]);

        if ($validated_login->fails()) {
            return response()->json([
                "message" => $validated_login->errors(),
                "status" => "login validation error"
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('User Token')->accessToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User logged in successfully',
                'user_id' => $user->id,
                'access_token' => $token
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }
    }
}

?>