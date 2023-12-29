<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

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
        $credentials = Config::get('services.passport-admin') +[
            'username' => $request->email,
            'password' => $request->password
        ];

        $res = Request::create('/oauth/token', 'POST', $credentials);
        return App::handle($res);

    }
}
