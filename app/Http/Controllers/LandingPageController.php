<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\AppUser;
use App\Models\Notification;
use App\Models\SfnibdImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use stdClass;
use Datetime;

class LandingPageController extends Controller
{
    public function index()
    {
        $images = SfnibdImage::first();
        return view('main.index')->with('images', $images);
    }

    public function sendMessage(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ]

        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            $object = new stdClass;
            $object->name = $request->name;
            $object->email = $request->email;
            $object->sub = $request->subject;
            $object->message = $request->message;

            $appUsers = AppUser::all();
            foreach($appUsers as $au){
                $notification = new Notification();
                $notification->user_id = $au->id;
                $notification->type = "message";
                $notification->status = "unseen";
                $notification->client_email = $object->email;
                $notification->message = json_encode($object);
                $notification->created_at = new Datetime();
                $notification->save();
            }
    
            //$mail = new SendMail($object);
            //Mail::to('evansarwer1@gmail.com')->send($mail);
            //Mail::to('sajibahmed294@gmail.com')->send($mail);

            return response()->json([
                'status' => 200,
                'data' => $object,
                'message' => "Your message has been sent. Thank you!"
            ]);
        }

    }


    
}
