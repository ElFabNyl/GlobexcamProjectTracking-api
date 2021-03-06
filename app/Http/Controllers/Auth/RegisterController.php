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

class RegisterController extends Controller
{

    /**
     * this function is for registering a new user in the data base
     * @param Request $request
     * @return JsonResponse
     */

    public function registerNewUser(Request $request){


        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => "required",
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validatedData->fails()) {
            $errors = json_decode(json_encode($validatedData->errors()), true);
            return  response()->json([
                'status' => false,
                'message' => 'validation error',
                'error' => $errors
            ],422);
        }

        $user = new User;
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();

        return  response()->json([
            'status' => true,
            'message' => 'Client registered successfully !',
        ],Response::HTTP_OK);

    }

}
