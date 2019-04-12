<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
    *  Handles registration Request
    *  @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function dummy(){
        return response()->json(['message'=>'Dummy Success']);
    }

    public function register(Request $request){
      $this->validate($request,[
        'name'=>'required|min:3',
        'password'=>'required|min:6',
        'email'=>'required|email|unique:users',
      ]);

      $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
      ]);

      $token = $user->createToken('TutsForWeb')->accessToken;
      return response()->json(['token'=>$token],200);

    }

    public function login(Request $request){
      $credentials = [
        'email'=>$request->email,
        'password'=>$request->password,
      ];

      if (auth()->attempt($credentials) ) {
         $token = auth()->user()->createToken('TutsForWeb')->accessToken;
         return response()->json(['token',$token],200);
      }else{
        return response()->json(['error'=>'Unauthorized'],401);
      }

    }

    public function logout(Request $request){

      $request->user()->token()->revoke();
      return response()->json([
        'message'=>'Successfully logged out',
      ]);
    }



    public function details(){
      return response()->json(['user'=>auth()->user()],200);
    }


}
