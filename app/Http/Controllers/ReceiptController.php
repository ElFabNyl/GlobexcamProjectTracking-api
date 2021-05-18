<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\User;
use App\Models\Projet;
use App\Models\Receipt;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ReceiptController extends Controller
{
     /**
     * this function provides details for an invoice.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function invoicesDetails(Request $request){ 
        try {
            //code...  
            if(Auth::check()){
          
            $userID = auth()->user()->id;  
            $userInfos = User::where('id', $userID)->first(); 
            $projetfound = Projet::where('user_id', $userID)->first();
            $deptInfos = Dept::where('user_id', $userID)->first(); 
            $receiptInfos = Receipt::where('id', $deptInfos->receipt_id)->first();
            
            $details = array(
                
                [
                'name' => $userInfos->name, 
                'last_name' => $userInfos->last_name,
                'email' => $userInfos->email,
                'phone' => $userInfos->phone,
                ],
                [
                'project_title' => $projetfound->title,
                'project_description' => $projetfound->description,
                'total_amount' => $projetfound->general_price,
                'date' =>$deptInfos->created_at->format('m/d/Y')
                ],
                [
                'Amount_paid' => $deptInfos->amount_payed ,
                'Amount_left' => $deptInfos->amount_to_pay,
                'receipt_id' => $deptInfos->receipt_id,
                'payment_method' => $receiptInfos->method_payment
                ]
            );

          return response()->json(['statut'=> 'success', 'data'=> $details], 200);
        }

        return response()->json(['statut'=> 'false' , 'message'=> 'you first need to login !'],401);


    } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['statut'=> 'false', 'message'=> $th->getMessage(), 'data'=> [], 500]);
         
        }
    }
}
