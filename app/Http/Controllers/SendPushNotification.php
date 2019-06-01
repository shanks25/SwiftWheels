<?php

namespace App\Http\Controllers;

use App\ProviderDevice;
use App\User;
use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Exception;
use Illuminate\Http\Request;
use Log;
use Setting;

class SendPushNotification extends Controller
{
   /**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function RideAccepted($request){

       return $this->sendPushToUser($request->user_id, trans('api.push.request_accepted'));
    }

    /**
     * Driver Arrived at your location.
     *
     * @return void
     */
    public function user_schedule($user){

        return $this->sendPushToUser($user, trans('api.push.schedule_start'));
    }

    /**
     * New Incoming request
     *
     * @return void
     */
    public function provider_schedule($provider){

        return $this->sendPushToProvider($provider, trans('api.push.schedule_start'));

    }

    /**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function UserCancellRide($request){

        return $this->sendPushToProvider($request->provider_id, trans('api.push.user_cancelled'));
    }


    /**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function ProviderCancellRide($request){

        return $this->sendPushToUser($request->user_id, trans('api.push.provider_cancelled'));
    }

    /**
     * Driver Arrived at your location.
     *
     * @return void
     */
    public function Arrived($request){

        return $this->sendPushToUser($request->user_id, trans('api.push.arrived'));
    }

     /**
     * Driver Arrived at your location.
     *
     * @return void
     */
    public function Dropped($request){

        Log::info( trans('api.push.dropped').Setting::get('currency').$request->payment->total.' by '.$request->payment_mode);

        return $this->sendPushToUser($request->user_id, trans('api.push.dropped').Setting::get('currency').$request->payment->total.' by '.$request->payment_mode);
    }

    /**
     * Money added to user wallet.
     *
     * @return void
     */
    public function ProviderNotAvailable($user_id){

        return $this->sendPushToUser($user_id,trans('api.push.provider_not_available'));
    }

    /**
     * New Incoming request
     *
     * @return void
     */
    public function IncomingRequest($provider){

        return $this->sendPushToProvider($provider, trans('api.push.incoming_request'));

    }
    

    /**
     * Driver Documents verfied.
     *
     * @return void
     */
    public function DocumentsVerfied($provider_id){

        return $this->sendPushToProvider($provider_id, trans('api.push.document_verfied'));
    }


    /**
     * Money added to user wallet.
     *
     * @return void
     */
    public function WalletMoney($user_id, $money){

        return $this->sendPushToUser($user_id, $money.' '.trans('api.push.added_money_to_wallet'));
    }

    /**
     * Money charged from user wallet.
     *
     * @return void
     */
    public function ChargedWalletMoney($user_id, $money){

        return $this->sendPushToUser($user_id, $money.' '.trans('api.push.charged_from_wallet'));
    }

    /**
     * Sending Push to a user Device.
     *
     * @return void
     */
     public function sendPushToUser($user_id, $push_message)
    {

        try {

            $user = User::findOrFail($user_id);

            if ($user->device_token != "") {

                \Log::info('sending push for user : ' . $user->first_name);

                if ($user->device_type == 'ios') {

                    return \PushNotification::app('IOSUser')
                        ->to($user->device_token)
                        ->send($push_message);

                } elseif ($user->device_type == 'android') {

//                    return \PushNotification::app('AndroidUser')
//                        ->to($user->device_token)
//                        ->send($push_message);

                    define('API_ACCESS_KEY', ':AAAABJ4okew:APA91bGIP5waKujCxGyw19thxYRgeXf9n8GhblC6VO1c9gOfTOud4O0Gfpt9sACGd9zUYI3GT2EZYGnx0n3OeSPUxtVA5p249PpkVnFvqeEDB44ChWVAknkFn6PXbdWiMwnK-1Mg9RLe');

                    $data = array("to" => $user->device_token,
                        "notification" => array("title" => "Swift-Wheels Notification", "body" => $push_message, "priority" => 10));

                    $data_string = json_encode($data);

//                    echo "The Json Data : " . $data_string;

                    $headers = array
                    (
                        'Authorization: key=' . API_ACCESS_KEY,
                        'Content-Type: application/json'
                    );

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

                    $result = curl_exec($ch);

                    curl_close($ch);

                    \Log::info('provider push response : ' . $result);
                     

                     return $result;

                }
            }

        } catch (Exception $e) {
            return $e;
        }

    }



     public function sendPushToAllUser($push_message)
    {

        try {

            $providers = User::all()->pluck('device_token');

            define('API_ACCESS_KEY', 'AAAABJ4okew:APA91bGIP5waKujCxGyw19thxYRgeXf9n8GhblC6VO1c9gOfTOud4O0Gfpt9sACGd9zUYI3GT2EZYGnx0n3OeSPUxtVA5p249PpkVnFvqeEDB44ChWVAknkFn6PXbdWiMwnK-1Mg9RLe');

            $data = array("registration_ids" => $providers, "priority" => "high",
                "notification" => array("title" => "Swift-Wheels Notification", "body" => $push_message, "priority" => 10));

            $data_string = json_encode($data);

//                    echo "The Json Data : " . $data_string;

            $headers = array
            (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            $result = curl_exec($ch);

            curl_close($ch);

            return $result;


        } catch (Exception $e) {
            return $e;
        }

    }




 public function sendPushToAllProvider($push_message)
    {

        try {

            $providers = ProviderDevice::all()->pluck('token');

            define('API_ACCESS_KEY', 'AAAA8nnonnY:APA91bFa1ZOQYpATIuYD3TnI9uyHnuECDPTyRNDG7Yp70lJs1xPjdu1wFF0yiI9rMe-xsnAxF4HIkakIxQ_MOlyzQMwY8JJwEfHjSSSwt_-oBo6QNFI8Fmo0BvHfm5yDxNaIcO_IJNWT');

            $data = array("registration_ids" => $providers, "priority" => "high",
                "notification" => array("title" => "Swift-Wheels Notification", "body" => $push_message, "priority" => 10));

            $data_string = json_encode($data);

//                    echo "The Json Data : " . $data_string;

            $headers = array
            (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            $result = curl_exec($ch);

            curl_close($ch);

            return $result;


        } catch (Exception $e) {
            return $e;
        }

    }




    /**
     * Sending Push to a user Device.
     *
     * @return void
     */
    public function sendPushToProvider($provider_id, $push_message)
    {

        try {

            $provider = ProviderDevice::where('provider_id', $provider_id)->with('provider')->first();

            if ($provider->token != "") {

                \Log::info('sending push for provider : ' . $provider->provider->first_name);

//                $message = \PushNotification::Message($push_message, array(
//                    'badge' => 1,
//                ));

//                $push->adapter->setAdapterParameters(['sslverifypeer' => false]);

                if ($provider->type == 'ios') {

                    return PushNotification::app('IOSProvider')
                        ->to($provider->token)
                        ->send($push_message);

                } elseif ($provider->type == 'android') {

//                    $push = PushNotification::app('AndroidProvider')
//                        ->to($provider->token)
//                        ->send($push_message);

                    define('API_ACCESS_KEY', 'AAAA8nnonnY:APA91bFa1ZOQYpATIuYD3TnI9uyHnuECDPTyRNDG7Yp70lJs1xPjdu1wFF0yiI9rMe-xsnAxF4HIkakIxQ_MOlyzQMwY8JJwEfHjSSSwt_-oBo6QNFI8Fmo0BvHfm5yDxNaIcO_IJNWT');

                    $data = array("to" => $provider->token,
                        "notification" => array("title" => "Swift-Wheels Provider Notification", "body" => $push_message));

                    $data_string = json_encode($data);

//                    echo "The Json Data : " . $data_string;

                    $headers = array
                    (
                        'Authorization: key=' . API_ACCESS_KEY,
                        'Content-Type: application/json'
                    );

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);


 $result = curl_exec($ch);

                    curl_close($ch);

                    \Log::info('provider push response : ' . $result);

                    return $result;

                }
            }

        } catch (Exception $e) {
            return $e;
        }

    }

    function array_remove_null($item)
    {
        if (!is_array($item)) {
            return $item;
        }

        $newArray = [];

    }



}