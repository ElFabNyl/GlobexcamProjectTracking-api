<?php


namespace App\Utils;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class Api
{
    public static function respond(ApiStatus $apiStatus,array $payload = [], int $httpStatus=200){
        return response()->json([
            "status" => $apiStatus->getCode(),
            "message" => $apiStatus->getMessage(),
            "data"=>$payload
        ],$httpStatus);
    }

    public static function respondUnauthorized(string $message="Unauthorized"){
        return self::respond(ApiStatus::err("unauthorized"),["errors"=>["authorization"=>$message]],401);
    }

    public static function respondSuccess($data = [],string $message="ok"){
        return self::respond(ApiStatus::ok($message),$data);
    }
 
   public static function respondFailed($data = [],string $message="error"){
    return self::respond(ApiStatus::err($message),$data);
    }

    public static function respondWithValidationErr(array $errors){
        return self::respond(
            ApiStatus::err(__("validation.error")),
            ["errors"=>$errors],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public static function respondWithToken(string $token,$data = []){
        return Api::respond(ApiStatus::ok(__("auth.login.successful")),array_merge([
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ],$data));
    }

    
   
}
