<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'user'], function () {

Route::post('/login', [LoginController::class, 'userLogin']);
Route::post('/register', [RegisterController::class, 'registerNewUser']);
Route::get('/get-user/{id}', [LoginController::class, 'getUserById']);
Route::put('/update', [LoginController::class, 'updateUserById']);
Route::post('/register-payment', [DeptController::class, 'registerPayment']);
Route::get('/invoices-details', [ReceiptController::class, 'invoicesDetails']);
Route::get('/logout',[LoginController::class, 'logout'] );



});

Route::group(['/projet'], function(){

    /**
     * Route Projet
     */

    Route::apiResource('projet',ProjetController::class);
});

