<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dept;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DeptController extends Controller
{
    
    /**
     * this function is to register a new payment.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function registerPayment(Request $request){
      
        $validatedData = Validator::make($request->all(), [
            'amount_payed' => "required",
            'title' => "required",
            'projet_id' => "required",
            'receipt_id' => 'required'
        ]);
        if ($validatedData->fails()) {
            $errors = json_decode(json_encode($validatedData->errors()), true);
            return  response()->json([
                'error' => $errors
            ],400);
        }
            if(Auth::check()){
                $verifyAccountantRole = auth::user()->isAccountant();
                if(!$verifyAccountantRole){
                    return response()->json(['message' => 'Only an accountant can do this action !']);
                }

                $regiterpayment = new Dept;
                dd( $regiterpayment->amount_to_pay);
                $regiterpayment->amount_to_pay = $request->amount_to_pay;
               
            }
        }
        
       
       
     }

