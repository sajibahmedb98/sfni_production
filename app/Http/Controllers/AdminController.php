<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\SfnibdImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\Token;
use Carbon\Carbon;

class AdminController extends Controller
{
    //


    public function editLandingPage(){

        $images = SfnibdImage::first();

        return view('admin.editLandingPage')->with('images', $images);
    }

    public function backgroundImgUpload(Request $req){

        $images = SfnibdImage::first();
        if($req->hasfile('background_1')){
            $destination1 = 'assets/img/background/'.$images->background_1;
            if(File::exists($destination1)){
                File::delete($destination1);
            }
            $file1 = $req->file('background_1');
            $extention1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$extention1;
            $file1->move('assets/img/background/',$filename1);
            $images->background_1 = $filename1;
        }

        if($req->hasfile('background_2')){
            $destination2 = 'assets/img/background/'.$images->background_2;
            if(File::exists($destination2)){
                File::delete($destination2);
            }
            $file2 = $req->file('background_2');
            $extention2 = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$extention2;
            $file2->move('assets/img/background/',$filename2);
            $images->background_2 = $filename2;
        }

        $images->update();
        return redirect()->back()->with('status','Background Image Updated Successfully');

    }

    public function aboutusImgUpload(Request $req){

        $images = SfnibdImage::first();
        if($req->hasfile('aboutus_1')){
            $destination1 = 'assets/img/aboutus/'.$images->aboutus_1;
            if(File::exists($destination1)){
                File::delete($destination1);
            }
            $file1 = $req->file('aboutus_1');
            $extention1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$extention1;
            $file1->move('assets/img/aboutus/',$filename1);
            $images->aboutus_1 = $filename1;
        }

        if($req->hasfile('aboutus_2')){
            $destination2 = 'assets/img/aboutus/'.$images->aboutus_2;
            if(File::exists($destination2)){
                File::delete($destination2);
            }
            $file2 = $req->file('aboutus_2');
            $extention2 = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$extention2;
            $file2->move('assets/img/aboutus/',$filename2);
            $images->aboutus_2 = $filename2;
        }

        $images->update();
        return redirect()->back()->with('status','AboutUs Image Updated Successfully');

    }


    public function message(Request $request){
        $token = $request->session()->get('token');
        $userToken = Token::where('value', md5($token))->first();
        $unseen_msgs = Notification::where('user_id', $userToken->user_id)->where('type', "message")->where('status', "unseen")->get();
        $seen_msgs = Notification::where('user_id', $userToken->user_id)->where('type', "message")->where('status', "seen")->get();
        $merged_msgs = $unseen_msgs->merge($seen_msgs);


        if(count($merged_msgs) > 0){
            foreach($merged_msgs as $mm){
                $mm->created_at = Carbon::parse($mm->created_at)->diffForHumans();
                if($mm->message != null){
                    $mm->message = json_decode($mm->message);
                }
            }
            
        }

        return response()->json(["msgs"=>$merged_msgs,"unseen_count"=> $unseen_msgs->count(), "unseen_msgs"=> $unseen_msgs, "seen_msgs"=> $seen_msgs],200);
    }

    public function messageseen(Request $request){
        $token = $request->session()->get('token');
        $userToken = Token::where('value', md5($token))->first();
        $unseen_msgs = Notification::where('user_id', $userToken->user_id)->where('type', "message")->where('status', "unseen")->get();
        foreach($unseen_msgs as $um){
            $um->status = "seen";
            $um->update();
        }
        

        return response()->json([
            'status' => 200,
            'message' => "all seen"
        ]);

    }


}
