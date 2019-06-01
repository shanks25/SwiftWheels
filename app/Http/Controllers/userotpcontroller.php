<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOtpRequest;
use App\Http\Requests\SendOtpRequest;
use App\PhoneOtp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use TextLocal;
use Twilio\Jwt\ClientToken;
use Twilio\Rest\Client;

class userotpcontroller extends Controller
{

    private $id ;

    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }


    public function sendOtp(Request $request)
    {  


        $this->validate($request, [
            'mobile' => 'required|max:10|min:7',     
        ]);
       $mobile ='+223'.$request->mobile;
        $user = User::where('mobile', $mobile)->first();
      if ($user) {
        return back()->withErrors('Mobile Number is already registered with us');
      }

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
            $phoneOtp->mobile = $request->country_code.$request->mobile;
            $phoneOtp->otp = $otp;
            $phoneOtp->save();
            session()->put('id',[

                'id' => $phoneOtp->id, 
                'phone_number' => $phoneOtp->mobile, 
                'otp'=>$otp
            ]);


            return redirect()->route('verifyotp');

        } else {

            return redirect()->back()->withErrors('Something went wrong');
        }

    }


    public function verifyOtp(CheckOtpRequest $request)
    {

        $phoneOtp = PhoneOtp::find($request->check_id);

        if ($phoneOtp) {

            if ($phoneOtp->otp == $request->otp) {
                session()->put('checked','true');
                return redirect()->route('registerdata');
            } else {
                return back()->withErrors('Invalid Otp');
            }

        } else {
           return redirect()->back()->withErrors('Something went wrong');
       }
   }

   public function verifyOtppage(){


       return view('user.auth.verifyotp');
   }

   public function registerdata(){

    if (session()->has('checked')) {
     return view('user.auth.registerdata');
 }
 return redirect()->back()->withErrors('Verify Mobile Number First');
}

public function resenduserotp(Request $request)
{

    $accountSid = 'AC138fa8932ffb6ea695107f97421fafd1';
    $authToken = '8b0492f68d2861f65046d1d15788ea40';
    $twilioNumber = '+12565026950';

    $client = new Client($accountSid, $authToken);

    $otp = session()->get('id')['otp'];
    $to=   session()->get('id')['phone_number'];
    $message = ("Thank you for registering with Swift-Wheels. Your verification code is " . $otp);

    try {
       $client->messages->create(
        $to,
        [
            "body" =>$message,
            "from" => $twilioNumber
                    //   On US phone numbers, you could send an image as well!
                    //  'mediaUrl' => $imageUrl
        ]
    );
       $response= ['status'=>'success'] ;
   } 

   catch (TwilioException $e) {
    Log::error(
        'Could not send SMS notification.' .
        ' Twilio replied with: ' . $e
    );
}


//dd($response);
        // Process your response here
if ($response['status'] == "success") {

    return redirect()->route('verifyotp')->with('message','Otp Resend Successfully');

} else {

    return redirect()->back()->withErrors('Something went wrong');
}

}



}
