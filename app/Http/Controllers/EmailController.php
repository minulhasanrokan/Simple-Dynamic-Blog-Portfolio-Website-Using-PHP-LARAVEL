<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function send_message(Request $request){

        if(isset($request->type1) && $request->type1==1){

            $request->validate([

                'name1' => ['required', 'string'],
                'title1' => ['required', 'string'],
                'mobile1' => ['required', 'string'],
                'email1' => ['required', 'email'],
                'message1' => ['required', 'string'],
            ]
            ,
            [
                'name1.required' => 'Name Field Is Required!',
                'title1.required' => 'Title Field Is Required!',
                'mobile1.required' => 'Mobile Field Is Required!',
                'email1.required' => 'Email Field Is Required!',
                'message1.required' => 'Message Field Is Required!',
            ]);

            $data = new Email;

            $data->name = $request->name1;
            $data->title = $request->title1;
            $data->mobile = $request->mobile1;
            $data->email = $request->email1;
            $data->message = $request->message1;
        }
        if(isset($request->type2) && $request->type2==2){

            $request->validate([

                'user_name' => ['required', 'string'],
                'm_subject' => ['required', 'string'],
                'm_mobile' => ['required', 'string'],
                'user_email' => ['required', 'email'],
                'm_message' => ['required', 'string'],
            ]
            ,
            [
                'user_name.required' => 'Name Field Is Required!',
                'm_subject.required' => 'Subject Field Is Required!',
                'm_mobile.required' => 'Mobile Field Is Required!',
                'user_email.required' => 'Email Field Is Required!',
                'm_message.required' => 'Message Field Is Required!',
            ]);

            $data = new Email;

            $data->name = $request->user_name;
            $data->title = $request->m_subject;
            $data->mobile = $request->m_mobile;
            $data->email = $request->user_email;
            $data->message = $request->m_message;
        }
        else{

            $request->validate([

                'name' => ['required', 'string'],
                'title' => ['required', 'string'],
                'mobile' => ['required', 'string'],
                'email' => ['required', 'email'],
                'message' => ['required', 'string'],
            ]
            ,
            [
                'name.required' => 'Name Field Is Required!',
                'title.required' => 'Title Field Is Required!',
                'mobile.required' => 'Mobile Field Is Required!',
                'email.required' => 'Eemail Field Is Required!',
                'message.required' => 'Message Field Is Required!',
            ]);


            $data = new Email;

            $data->name = $request->name;
            $data->title = $request->title;
            $data->mobile = $request->mobile;
            $data->email = $request->email;
            $data->message = $request->message;
        }


        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Your Message Send Successfully, Shortly We Will Replay Your Message",
                'alert-type'=>'info'
            );

            return redirect()->back()->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Your Message Does Not Send Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }
}
