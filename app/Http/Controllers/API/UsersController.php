<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
  protected $user;
  public function __construct(User $user)
  {
    $this->user = $user;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
      $getUser = $this->user->getAllUser();
      return response()->json($getUser);
  }

public function show()
{
    $user = User::all();
    return response()->json($user);
}

public function create(Request $request)
{
  $validation = $request->validate([
   'name'=>'required|string|min:3|max:70',
   'email'=>'required|string|email|max:200|unique:user',
   'password'=>'required|string|min:6',
  ]);

  if(!$validation){
    return response()->json([
        'status'=>'error',
        'message'=>'error validation'
    ],404);
  }

  return response()->json([
    'status'=>'ok',
    'message'=>'user create successfuly !',
    'user'=>$user
  ], 201);
}

  public function register(Request $request) 
  {
    $request['password'] = Hash::make($request['password']);
    $user = User::create($request->toArray());

    return response()->json([
      'status'=>'ok',
      'message' => 'User create successfuly !',
      'user' => $user->id
    ], 201);
  }

  public function login(Request $request) 
  {
    $user = User::where('email', $request->email)->first();
    if ($user) {
        if (Hash::check($request->password, $user->password)) {
            Session::set('UserLogin', $user->id);
            return response()->json([ 'status'=>'ok' ], 200);
        } else {
            $response = ["message" => "Password mismatch"];
            return response()->json([ 'status'=>'ok', 'message'=> "Password mismatch"], 400);
        }
    } else {
        return response()->json([ 'status'=>'ok', 'message'=> 'User does not exist'], 200);
    }
  }
  public function logout()
  {
// Session::put('UserLogin', 11);
// session()->forget('UserLogin');
// Session::get('UserLogin')

    session()->forget('UserLogin');
    return response()->json([ 'status'=>'ok', 'message'=> 'User logout'], 200);
  }

public function update(Request $request, $id)
{
   $validation = $request->validate([
    'name'=>'string|min:3|max:55',
    'email'=>'string|email|max:200'
   ]);

   if(!$validation){
    return response()->json([
        'status'=>'error',
        'message'=>'error validation'
    ],404);
  }

    $user_valid = User::findOrFail($id);
    if(is_null($user_valid)){
     return response()->json([
      'status'=>'error',
      'message'=>'unvalid user']);
    }else{
      $user = User::where('id',$id)
      ->update([
        'name'=> $request->name,
        'email'=>$request->email
      ]);
      return response()->json([
        'status'=>'ok',
        'message'=>'user updated successfuly',
        'user'=>$user]);
      }
    }

    public function destroy($id)
    {
      $this->user->delete($id);
      return $this->responseSuccess(1);
    }
}
