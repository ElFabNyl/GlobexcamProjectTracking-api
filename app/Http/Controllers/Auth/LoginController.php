<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */

     public function userLogin(Request $request){
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => "required"
        ]);
        if ($validatedData->fails()) {
            $errors = json_decode(json_encode($validatedData->errors()), true);
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'error' => $errors
            ],422);
        }
        $token = Auth::attempt($request->only('email', 'password'));
        if (!$token) {
            return  response()->json([
                'status' => false,
                'message' => 'Invalid credentials !'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $data = [
            'status' => true,
            'token' => $token,
            'user' => auth()->user()
        ];

        return  response()->json(['message'=> 'user is successfully logged in !', 'data' =>  $data], Response::HTTP_OK);

     }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return JsonResponse
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
        if (!is_null(User::where('id', $id)->first())){
            return User::where('id', $id)->first();
        }
        return response()->json(['message'=> 'invalid user id ! ']);
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
        }

            if (Auth::check()){

            $user =  User::find(Auth::user()->id);

            $user->name =  is_null( $request->name)? $user->name : $request->name;
            $user->last_name = is_null( $request->last_name)? $user->name :$request->last_name;
            $user->phone =  is_null($request->phone)? $user->name :$request->phone;
            $user->email =  is_null($request->email)? $user->email : $request->email;
            $user->password = is_null($request->password)? $user->password : Hash::make($request->password);
            $user->save();
            return response()->json($user);
        }



     } catch (\Throwable $th) {

        return response()->json(['statut'=> 'false', 'message'=> $th->getMessage(), 'data'=> [], 500]);
     }

  }
}
