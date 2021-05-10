<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

   /**
     * this function is to authenticate a User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    
     public function userLogin(Request $request){
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => "required"
        ]);
        if ($validatedData->fails()) {
            $errors = json_decode(json_encode($validatedData->errors()), true);
            return response()->json([
                'message' => 'validation error',
                'error' => $errors
            ],400);
        }
        $token = Auth::attempt($request->only('email', 'password'));
        if (!$token) {
            return  response()->json([
                'message' => 'Invalid credentials !'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $data = [
            'token' => $token,
            'user' => auth()->user()
        ];

        return  response()->json(['message'=> 'user is successfully logged in !',  $data], Response::HTTP_OK);

     }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //pour l'instant j'affiche dabord ca. plutard ca sera une redirection vers la page de login
        return  response()->json(['message'=> 'user is successfully logged out !'],Response::HTTP_OK);
    }
    
    /**
     * this function displays a particular user given  its ID
     */
    public  function getUserById($id){
        return User::where('id', $id)->first();
    }

    /**
     * this function updates a particular user given its ID
     */

    public function updateUserById(Request $request){
       
     try {
        $validatedData = Validator::make($request->all(), [
            'name' => 'nullable',
            'last_name' => "required",
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validatedData->fails()) {
            $errors = json_decode(json_encode($validatedData->errors()), true);
            return  response()->json([
                'error' => $errors
            ],400);
        }else{
        
            if (Auth::check()){
                
                $idUser = Auth::user()->id;
                $user =  User::find($idUser);
           
            $user->name =  is_null( $request->name)? $user->name : $request->name;                  
            $user->last_name = is_null( $request->last_name)? $user->name :$request->last_name;  
            $user->phone =  is_null($request->phone)? $user->name :$request->phone; 
            $user->email =  is_null($request->email)? $user->email : $request->email;
            $user->password = is_null($request->password)? $user->password : Hash::make($request->password);
            $user->save();
            return response()->json($user);
        }

        } 

     } catch (\Throwable $th) {
        
        return response()->json(['statut'=> 'false', 'message'=> $th->getMessage(), 'data'=> [], 500]);
     }
       
  }
}
