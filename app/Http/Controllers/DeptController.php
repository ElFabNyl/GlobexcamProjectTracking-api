<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\User;
use App\Models\Receipt;
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

       try {
            $validatedData = Validator::make($request->all(), [
                'amount_payed' => "required",
                'payment_method' => "required", 
                'phase' => 'required',
                'user_id' => "required",
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
                        return response()->json([ 'statut'=> 'false', 'message' => 'Only an accountant can do this action !']);
                    }
                   
                    $regiterpayment = Dept::where('projet_id', $request->projet_id)->first(); 

                    if($regiterpayment->amount_to_pay == 0 ){
                        
                        return response()->json(['statut'=> 'error', 'payment information'=> 'there is nothing left to pay']);
                    }
                    if($request->amount_payed > $regiterpayment->amount_to_pay ){
                        return response()->json(['statut'=> 'error', 'payment information'=> 'the amount entered is greater than the bill']);
                    }
                    $regiterpayment->amount_to_pay =($regiterpayment->amount_to_pay - $request->amount_payed);  
                    $regiterpayment->amount_payed = ($regiterpayment->amount_payed + $request->amount_payed );
                    $regiterpayment->user_id = $request->user_id;
                    $regiterpayment->projet_id = $request->projet_id;
                    $regiterpayment->receipt_id = $request->receipt_id; 
                    
                    $regiterpayment->save();
                    
                     if($regiterpayment->save()){
                         // let me just generate a receipt here 
                        $receiptGeneration = new Receipt;
                        $receiptGeneration->phase = $request->phase;
                        $receiptGeneration->amount_payed = $request->amount_payed;
                        $receiptGeneration->method_payment = $request->payment_method;
                        $receiptGeneration->save();
                     }else{
                        return response()->json(['statut'=> 'false' , 'message'=> 'a problem has occured during the payment registration, try again later !'],500);
                     }

                    if(!$receiptGeneration->save()){
                        return response()->json(['statut'=> 'false' , 'message'=> 'a problem has occured during the receipt generation, try again later !'],500);
                    }
                    
                    return response()->json(['statut'=> 'success' , 'message'=> [$regiterpayment], 'generated invoice' =>[$receiptGeneration]],200);
            }
        }catch(\Throwable $th){
            return response()->json(['statut'=> 'false', 'message'=> $th->getMessage(), 'data'=> [], 500]);
        }
       }

    

     
}
    

 
       
    

    