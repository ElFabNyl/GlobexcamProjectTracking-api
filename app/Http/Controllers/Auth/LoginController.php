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
            ],);
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

        return  response()->json(['message'=> 'user is successfully logged in !',  $data]);

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
        return  response()->json(['message'=> 'user is successfully logged out !']);
    }

}
