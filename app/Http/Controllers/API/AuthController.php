<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

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
      $email_status = User::where("email", $request->email)->first();
      $password_status = User::where("email", $request->email)->where('password', md5($request->password))->first();

      if (empty($email_status)) {
        return response()->json(['status'=>'error', 'message'=>'wrong email address']);
      } elseif (empty($password_status)) {
        return response()->json(['status'=>'error', 'message'=>'wrong password']);
      } else {
        return response()->json([
          'status'=>'success','message'=>'User logged in successfuly',
          'user_id' => $password_status->id,
        ]);
      }
    }
}

?>
