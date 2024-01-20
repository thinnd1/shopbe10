<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    #signup admin action
    public function SignupAdmin(Request $request)
    {
        $validate = Validator::make($request->json()->all(), [
            'name' => 'required|string|min:3|max:55',
            'email' => 'required|string|email|max:200|unique:user',
            'password' => 'required|string|min:6'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors(),
                'status' => 'admin validation error'
            ], 404);
        }
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return response()->json([
            'message' => 'Admin account created Successfuly',
            'admin account' => $admin,
        ], 201);
    }

    # login admin action
    public function LoginAdmin(Request $request)
    {
        $user = Admin::where('email', $request->email)->first();
        if ($user) {
            if ($request->password == $user->password) {
                return response()->json([ 'status' => 'ok', 'data' => $user->id ], 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response()->json([ 'status' => 'fail', 'message'=> "Password mismatch"], 400);
            }
        } else {
            return response()->json([ 'status' => 'fail', 'message'=> 'User does not exist'], 200);
        }
    }
}
