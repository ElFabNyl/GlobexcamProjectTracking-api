<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param array $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ... $role)
    {
        //Exception Si l'utilisateur n'est pas connecte

        if(!Auth::check())
        {
            return Response::json([
                'status' => false,
                'message' => 'Vous devez vous authentifier pour accéder a cette page'
            ],403);
        }

        //Handle Access denied exception if the roles are not in roles array

        if(!in_array(Auth::user()->role, $role))
        {
            return Response::json([
                'status' => false,
                'message' => 'Vous n\' avez pas les droits d\'accès requis pour cette page'
            ],403);
        }

        //The request continue
        return $next($request);
    }
}
