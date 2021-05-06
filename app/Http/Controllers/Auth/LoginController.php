<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //all of this is t=just to test my jwt-auth
    
   public function registration(Request $request){

    return $user = User::create([
       'name' => $request->input('name'),
       'last_name' => $request->input('prenom'),
       'email'=> $request->input('email@gmail.com'),
       'password'=> Hash::make($request->input('password123')),
       'role'=> $request->input('mon role'),
       'phone' => $request->input(2235152659),
    ]);

   }

    public function auth(){

        return 'user was successfully auth';
    }


}
