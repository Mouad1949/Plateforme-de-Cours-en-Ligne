<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return $user;
    }

    public function register(StoreUserRequest $request){
      $user=User::create([
        "name"=>$request->name,
        "email"=>$request->email,
        "role"=>$request->role,
        "password"=>Hash::make($request->password)
      ]);
      return response()->json([
        "messsage"=>"register user successfuly",
        "user"=>$user
      ]);
    }

    public function login(Request $request){
      $request->validate([
        "email"=>"required|string|email",
        "password"=>"required|string"
      ]);
      if(!Auth::attempt($request->only('email','password')))
        return response()->json([
        "messsage"=>"invalid login",
      ]);

      $user = User::where('email',$request->email)->firstOrFail();
      $token = $user->createToken('auth_Token')->plainTextToken;
      return response()->json([
        "messsage"=>"Login successfuly",
        "User"=>$user,
        'Token'=>$token
      ]);
    }

    public function logout(Request $request){
      $request->user()->tokens()->delete();
      
      return response()->json([
        "messsage"=>"logout successfuly"]);
    }
    public function testToken(){
      return "Tsts Token";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) 
    {
      $newUser=User::create([
      "name"=>$request->name,
      "email"=>$request->email,
      "role"=>$request->role,
      "password"=>Hash::make($request->password)
      ]);
      return response()->json([
        "messsage"=>"register user successfuly",
        "user"=>$newUser
      ]);
        
        
        // return $cour;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if($user){
          return $user;
        }
        return "user not found";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password;
        $user->save();
        return response()->json([
        "messsage"=>"Update user successfuly",
        "user"=>$user
      ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user){
          $user->delete();
          return response()->json([
        "messsage"=>"Delete user successfuly",
        ]);
        }
        return "user not found";
    }
}
