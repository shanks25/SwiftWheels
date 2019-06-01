<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use App\Http\Requests\CheckOtpRequest;
use App\Http\Requests\SendOtpRequest;
use App\PhoneOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TextLocal;
use Twilio\Jwt\ClientToken;

 


class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $this->validate($request,[
            'mobile'=>'unique:users'

        ]);
 
    $baseurl = "https://sms.dtechghana.com/api/v1/send";
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
 
        $otp = mt_rand(100000, 999999);
        $to=   $request->country_code.$request->mobile;
        $message = ("Thank you for registering with Swift-Wheels. Your verification code is " . $otp);

        $params = array("from"=>"Swiftwheels", "to"=>$to, "content"=>$message, "id"=>"Swiftwheels", "secret"=>"bb43d2b319617402463ca0b6aac484b0");
        $params = "?" . http_build_query($params);

        $response = file_get_contents($baseurl.$params, false, stream_context_create($arrContextOptions));

        $response =  json_decode($response,TRUE);
        // Process your response here
        if ($response['MessageStatus'] == "Sent") {

            $phoneOtp = new PhoneOtp();
            $phoneOtp->mobile = $request->mobile;
            $phoneOtp->otp = $otp;
            $phoneOtp->save();
            
           return response()->json(['phone' => $phoneOtp->mobile, 'id' => $phoneOtp->id]);
        } else {
        
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }

    }


    public function sendOtpOld(SendOtpRequest $request)
    {

        // Message details
        $sender = urlencode('DIALME');

        $userName = "stepinbh@gmail.com";
        $password = "790178";
        $otp = mt_rand(100000, 999999);
        $message = rawurlencode($otp . ' is verification code.');

        $data =
            'UserEmail=' . $userName .
            '&Password=' . $password .
            '&MultipleNumber=' . $request->mobile .
            "&SenderID=" . $sender .
            "&Message=" . $message .
            "&UniCode=" . 1 .
            "&DndType=" . "DND" .
            "&FlashMessage=" . 0;

        // Send the POST request with cURL
        $ch = curl_init('http://74.124.24.74/api/Master/DirectProcess');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        $responseCurl = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responseCurl, true);

//        dd($response);

        // Process your response here
        if ($response['0']['Message'] == "SUCCESS") {

            $phoneOtp = new PhoneOtp();
            $phoneOtp->mobile = $request->mobile;
            $phoneOtp->otp = $otp;
            $phoneOtp->save();

            return response()->json(['phone' => $phoneOtp->mobile, 'id' => $phoneOtp->id]);
        } else {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }

    }

    public function verifyOtp(CheckOtpRequest $request)
    {

        $phoneOtp = PhoneOtp::find($request->check_id);

        if ($phoneOtp) {

            if ($phoneOtp->otp == $request->otp) {
                return response()->json(['success' => trans('OTP Verified successfully')], 200);
            } else {
                return response()->json(['error' => 'Otp did not match'], 500);
            }

        } else {
            return response()->json(['error' => 'Otp did not match'], 500);
        }
    }

    public function sendForgotOtp($email, $message)
    {

        // Message details
       // $sender = urlencode('KRISPT');

        $otp = mt_rand(100000, 999999);
        $message = rawurlencode($otp . ' is verification code.');

        return TextLocal::sendSms($mobile, $message);

    }

    public function sendForgotOtpOld($mobile, $message)
    {

        // Message details
        $sender = urlencode('DIALME');

        $userName = "stepinbh@gmail.com";
        $password = "790178";

        $data =
            'UserEmail=' . $userName .
            '&Password=' . $password .
            '&MultipleNumber=' . $mobile .
            "&SenderID=" . $sender .
            "&Message=" . $message .
            "&UniCode=" . 1 .
            "&DndType=" . "DND" .
            "&FlashMessage=" . 0;

        // Send the POST request with cURL
        $ch = curl_init('http://74.124.24.74/api/Master/DirectProcess');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        $responseCurl = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responseCurl, true);

        return $response;

    }

}
