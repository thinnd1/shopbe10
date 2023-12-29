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
      $user= User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=> md5($request-> password)
      ]);

      return response()->json([
          'message' => 'User registrated Successfuly',
          'status' => 'ok',
          'user'=> $user,
        ],201);
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