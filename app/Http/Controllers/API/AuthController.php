<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
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
        $credentials = Config::get('services.passport') +[
            'username' => $request->email,
            'password' => $request->password
        ];

        $res = Request::create('/oauth/token', 'POST', $credentials);
        return App::handle($res);
    }
}

?>