<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\SystemSettings;
use Auth;
use Image;

class AdminController extends Controller
{
    

    public function admin_logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'=> "User logout Successfully",
            'alert-type'=>'success'
        );

        return redirect('/login')->with($notification);
    }

    public function admin_profile(){

        $id = Auth::user()->id;

        $user_data = User::find($id);

        return view('admin.admin_profile',compact('user_data'));
    }

    public function edit_profile(){

        $id = Auth::user()->id;

        $edit_user_data = User::find($id);

        return view('admin.edit_profile',compact('edit_user_data'));
    }

    public function update_profile (Request $request){

        $id = Auth::user()->id;

        $data = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'. $id .'id',
            'user_name' => 'required|string|unique:users,user_name,'. $id .'id',
        ]);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->user_name = $request->user_name;

        if ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');
            $extension = $file->getClientOriginalExtension();

            $fileName = $request->user_name.'_'.time().'.'.$extension;

            $file->move('backend/user',$fileName);

            $imageName=$fileName;

            if($data->profile_photo!='')
            {
                $deletePhoto = "backend/user/".$data->profile_photo;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }

            }

            $data->profile_photo = $imageName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Your Profile Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.profile')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Your Profile Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_password(){

        return view('admin.change_password');

    }

    public function update_password (Request $request){

        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', Rules\Password::defaults()],
        ]);

        $hash_password = Auth()->user()->password;

        if(Hash::check($request->current_password,$hash_password)){

            $users = User::find(Auth::id());

            $users->password = bcrypt($request->password);

            $users->save();

            if($users==true){

                $notification = array(
                    'message'=> "Your Password Change Successfully",
                    'alert-type'=>'success'
                );

                return redirect()->route('dashboard')->with($notification);
            }
            else{

                $notification = array(
                    'message'=> "Something Went Wrong Please Try Again Letter",
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

        }
        else{

            $notification = array(
                'message'=> "Your Current Password Does Not Match",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function edit_contact_information(){

        $id = Auth::user()->id;

        $edit_user_data = User::find($id);

        return view('admin.edit_contact_information',compact('edit_user_data'));

    }

    public function update_contact_information(Request $request){

        $id = Auth::user()->id;

        $data = User::find($id);

        $request->validate([
            'address' => ['required', 'string'],
            'mobile' => ['required', 'string'],
        ]);

        $data->address = $request->address;
        $data->mobile = $request->mobile;
        $total_row = $request->total_row;

        $social_media_data = '';

        for($i=1; $i<=$total_row; $i++){

            $icon_id = "socialMediaIcon_".$i;
            $social_id = "socialMedia_".$i;

            $icon= $request->$icon_id;
            $url= $request->$social_id;

            if($url!='' && $icon!=''){

                if($social_media_data!=''){

                    $social_media_data .="***";
                }

                $social_media_data .= $icon."___".$url;
            }   
        }

        $data->social_media = $social_media_data;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Your Contact Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.profile')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Your Contact Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function system_settings(){

        $data = SystemSettings::where('delete_status',0)
            ->where('id',1)
            ->first();

        $system_data = array();
        if($data!=''){

            $system_data['title']=$data->title;
            $system_data['email']=$data->email;
            $system_data['name']=$data->name;
            $system_data['mobile']=$data->mobile;
            $system_data['address']=$data->address;
            $system_data['country']=$data->country;
            $system_data['contuct_us_text']=$data->contuct_us_text;
            $system_data['social_link_text']=$data->social_link_text;
            $system_data['social_media']=$data->social_media;
            $system_data['copy_right_text']=$data->copy_right_text;
            $system_data['logo']=$data->logo;
            $system_data['icon']=$data->icon;
            $system_data['id']=$data->id;
            $system_data['location']=$data->location;
            $system_data['contact_link']=$data->contact_link;
        }
        else{
            $system_data['title']='';
            $system_data['email']='';
            $system_data['name']='';
            $system_data['mobile']='';
            $system_data['address']='';
            $system_data['country']='';
            $system_data['contuct_us_text']='';
            $system_data['social_link_text']='';
            $system_data['social_media']='';
            $system_data['copy_right_text']='';
            $system_data['logo']='';
            $system_data['icon']='';
            $system_data['id']='';
            $system_data['location']='';
            $system_data['contact_link']='';
        }

        return view('admin.system_settings.system_settings',compact('system_data'));
    }

    public function update_system_settings(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'email' => ['required', 'string'],
            'name' => ['required', 'string'],
            'mobile' => ['required', 'string'],
            'address' => ['required', 'string'],
            'country' => ['required', 'string'],
            'social_link_text' => ['required', 'string'],
            'contuct_us_text' => ['required', 'string'],
            'copy_right_text' => ['required', 'string'],
            'location' => ['required', 'string'],
            'contact_link' => ['required', 'string']
        ]);
        $data = SystemSettings::where('delete_status',0)
            ->where('id',1)
            ->first();

        if($data==''){

            $data = new SystemSettings;
        }

        $total_row = $request->total_row;
        $social_media_data = '';

        for($i=1; $i<=$total_row; $i++){

            $icon_id = "socialMediaIcon_".$i;
            $social_id = "socialMedia_".$i;

            $icon= $request->$icon_id;
            $url= $request->$social_id;

            if($url!='' && $icon!=''){

                if($social_media_data!=''){

                    $social_media_data .="***";
                }

                $social_media_data .= $icon."___".$url;
            }   
        }

        if ($request->hasFile('logo')) {

            $file = $request->file('logo');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_logo_'.time().'.'.$extension;

            Image::make($file)->resize(394,94)->save('backend/system/'.$fileName);

            if($data->logo!='')
            {
                $deletePhoto = "backend/system/".$data->logo;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->logo = $fileName;
        }

        if ($request->hasFile('icon')) {

            $file = $request->file('icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_icon_'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/system/'.$fileName);

            if($data->icon!='')
            {
                $deletePhoto = "backend/system/".$data->icon;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->icon = $fileName;
        }

        $data->social_media = $social_media_data;
        $data->title = $request->title;
        $data->email = $request->email;
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->country = $request->country;
        $data->contuct_us_text = $request->contuct_us_text;
        $data->social_link_text = $request->social_link_text;
        $data->copy_right_text = $request->copy_right_text;
        $data->location = $request->location;
        $data->contact_link = $request->contact_link;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "System Settings Created Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "System Settings Does Not Created Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }
}
