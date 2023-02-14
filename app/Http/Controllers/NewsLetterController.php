<?php

namespace App\Http\Controllers;



use App\Models\Customer;
use App\Models\NewsLetter;
use App\Models\Seller;
use App\Notifications\SendPushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

class NewsLetterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        //
        $email = NewsLetter::chunk(50,function ($data){
            $this->dispatch(new \App\Jobs\newsletter($data));
        });
        return 'will send message in back';

    }
    public function updateToken(Request $request){
        try{
            auth('customer')->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
    public function notification(Request $request){
        $firebaseToken = Customer::whereNotNull('fcmToken')->pluck('fcmToken')->all();



        $SERVER_API_KEY = env('firebase_server_key');



        $data = [

            "registration_ids" => $firebaseToken,

            "notification" => [

                "title" => "Test",

                "body" => "Test Notification",

            ]

        ];

        $dataString = json_encode($data);



        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];



        $ch = curl_init();



        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);



        $response = curl_exec($ch);



        dd($response);

//
//        try{
//            $fcmTokens = Seller::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
//
//            Notification::send(null,new SendPushNotification("Test","Notification Test",$fcmTokens));
//
//            /* or */
//
//            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));
//
//            /* or */
//
//            Larafirebase::withTitle('Test')
//                ->withBody('Notification Test')
//                ->sendMessage($fcmTokens);
//
//            return redirect()->back()->with('success','Notification Sent Successfully!!');
//
//        }catch(\Exception $e){
//            report($e);
//            return redirect()->back()->with('error','Something goes wrong while sending notification.');
//        }
    }
}
