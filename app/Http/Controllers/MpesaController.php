<?php

namespace App\Http\Controllers;

use App\Models\TransactionMpesa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Auth;

class MpesaController extends Controller
{
    //
    /**Lipa Na MPESA password */

    public function getPassword()
    {
        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $BusinessShortCode = 174379;
        $password = base64_encode($BusinessShortCode.$passkey.$timestamp);
        return $password;
    }

    /** Lipa na MPESA STK Push method */
    public function stkPushRequest(Request $request)
    {
        $id = $request->logged;
        $order_no = $request->order_no;
        if(isset($request->payment_for) && !empty($request->payment_for))
        {
            
            $callbackurl = 'https://f69c-102-220-12-234.ngrok.io/api/callback/wallet/'.$id;
            $phone = $request->phone_no;
            $amount = $request->amount;
        }
        else
        {
            $callbackurl = 'https://f69c-102-220-12-234.ngrok.io/api/sendback/response/'.$id.'/'.$order_no;
            $phone = $request->phone_no_pay;
            $amount = $request->amount_pay;
        }
       
        $phone = (substr($phone,0,1) =="+") ? str_replace("+","",$phone) : $phone;
        $phone = (substr($phone,0,1) == "0") ? preg_replace("/^0/","254",$phone) : $phone;
        $phone = (substr($phone,0,1) =="7") ? "254{$phone}" : $phone;
       
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type:application/json',
        'Authorization:Bearer '.$this->generateAccessToken()));
         $curl_post_data = [
             'BusinessShortCode' => 174379,
             'Password' => $this->getPassword(),
             'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
             'TransactionType' => 'CustomerPayBillOnline',
             'Amount' => $amount,
             'PartyA' => $phone,
             'PartyB' => 174379,
             'PhoneNumber' => $phone,
             'CallBackURL' => $callbackurl,
             'AccountReference' => 'GLOBAL LOGISTICS',
             'TransactionDesc' => 'Testing stk push on sandbox'
         ];

         $data_string =json_encode($curl_post_data);
         curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
         curl_setopt($curl,CURLOPT_POST,true);
         curl_setopt($curl,CURLOPT_POSTFIELDS,$data_string);
         $curl_response = curl_exec($curl);
        //  redirect()->back();
        

    }

    public function generateAccessToken()
    {
        $consumer_key = "oLIWH2L4K7nJClaqYd8YBTkyu7Y6eVwu";
        $consumer_secret = "Tm81sza6vFVQRycO";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        $token = $access_token->access_token;
       return $token;

    }
    

    /**
     * Json Response To Mpesa API feedback - Success or Failure
     */

     public function createValidationResponse($result_code,$result_description)
    {
        $result = json_encode(["ResultCode"=>$result_code,"ResultDesc"=>$result_description]);
        $response = new Response();
        $response->headers->set("Content-Type","application/json; charset=utf-8");
        $response->setContent($result);
        return $response;
    }

    /**
     * MPESA VALIDATION METHOD
     * Safaricom will only call your validation if you have requested by writing an official letter to them
     */

     public function mpesaValidation(Request $request)
     {
         $result_code = "0";
         $result_description = "Accepted validation request";
         return $this->createValidationResponse($result_code,$result_description);
     }

    /**MPESA Transaction Confirmation Method ,we save the transaction in our databases */

    public function mpesaConfirmation(Request $request,$id,$order_no)
    {
        $response = $request->getContent();
        $response = json_decode($response,true);
        $value = $response['Body']['stkCallback']['CallbackMetadata']['Item'];
        if(count($value)==4)
        {
            $amount_paid = $value[0]['Value'];
            $mpesa_receipt_number = $value[1]['Value'];
            $date_transacted = $value[2]['Value'];
            $phone_number = $value[3]['Value'];
        }
        else if(count($value)==5)
        {
            $amount_paid = $value[0]['Value'];
            $mpesa_receipt_number = $value[1]['Value'];
            $date_transacted = $value[3]['Value'];
            $phone_number = $value[4]['Value'];
        }
        
        TransactionMpesa::create([
            'amount_paid' => $amount_paid,
            'mpesa_receipt_number' => $mpesa_receipt_number,
            'date_transacted' =>  $date_transacted,
            'phone_number' => $phone_number,
            'user_confirm_id' => $id,
            'order_no' => $order_no,
            'payment_for' => 'PURCHASE'
        ]);
  
    }

    /** GET LOGGED IN USER */
    public function getUser($id)
    {
        $user = auth()->id();
        if(!empty($id))
        {
            echo "id FOUND";
            echo $id;
        }
        else
        {
            echo "id NOT FOUND";
        }
        
    }

      /**MPESA Transaction Confirmation Method For Wallet,we save the transaction in our databases */

      public function mpesaConfirmationWallet(Request $request,$id)
      {
          $response = $request->getContent();
          $response = json_decode($response,true);
          $value = $response['Body']['stkCallback']['CallbackMetadata']['Item'];
          if(count($value)==4)
          {
              $amount_paid = $value[0]['Value'];
              $mpesa_receipt_number = $value[1]['Value'];
              $date_transacted = $value[2]['Value'];
              $phone_number = $value[3]['Value'];
          }
          else if(count($value)==5)
          {
              $amount_paid = $value[0]['Value'];
              $mpesa_receipt_number = $value[1]['Value'];
              $date_transacted = $value[3]['Value'];
              $phone_number = $value[4]['Value'];
          }
          $user_id = $user = auth()->id();
          TransactionMpesa::create([
              'amount_paid' => $amount_paid,
              'mpesa_receipt_number' => $mpesa_receipt_number,
              'date_transacted' =>  $date_transacted,
              'phone_number' => $phone_number,
              'user_confirm_id' => $id,
              'payment_for' => 'Wallet'
          ]);
    
      }

      /**Sum Logged User Wallet */

      public function walletSum(Request $request)
      {
          $id=$request->user_id;
          $sum = TransactionMpesa::where('user_confirm_id','=',$id)->where('payment_for','=','Wallet')->sum('amount_paid');
          return $sum;
      }

}
