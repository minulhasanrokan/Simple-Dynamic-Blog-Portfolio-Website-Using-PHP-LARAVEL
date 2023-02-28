<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\About;
use App\Models\MultiImage;
use Image; 

class AboutController extends Controller
{
    
    public function add_about(){

        return view('admin.about.add_about');
    }

    public function about_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'display_status' => ['required'],
        ]);

        $data = new About;

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->display_status = $request->display_status;
        $data->slug = SlugService::createSlug(About::class, 'slug',$request->title);

        if ($request->hasFile('about_img')) {

            $file = $request->file('about_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(523,605)->save('backend/about/'.$fileName);

            $data->about_img = $fileName;
        }

        if ($request->hasFile('about_icon')) {

            $file = $request->file('about_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_icon_'.time().'.'.$extension;

            Image::make($file)->resize(82,108)->save('backend/about/'.$fileName);

            $data->about_icon = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "About Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.about')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "About Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_about(){


        $all_about = About::where('delete_status',0)->get();


        return view('admin.about.all_about',compact('all_about'));
    }

    public function slider_edit($id){

        $about = About::find($id);

        return view('admin.about.about_edit',compact('about'));
    }

    public function about_update(Request $request){

        $request->validate([

            'id' => ['required'],
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'display_status' => ['required'],
        ]);

        $data = About::find($request->id);

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->display_status = $request->display_status;

        if ($request->hasFile('about_img')) {

            $file = $request->file('about_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(623,605)->save('backend/about/'.$fileName);

            if($data->about_img!='')
            {
                $deletePhoto = "backend/about/".$data->about_img;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->about_img = $fileName;
        }

        if ($request->hasFile('about_icon')) {

            $file = $request->file('about_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_icon_'.time().'.'.$extension;

            Image::make($file)->resize(82,108)->save('backend/about/'.$fileName);

            if($data->about_icon!='')
            {
                $deletePhoto = "backend/about/".$data->about_icon;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->about_icon = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "About Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.about')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "About Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_publish_status($id){

        $data = About::find($id);

        $published_status = $data->published_status;
        $display_status = $data->display_status;

        $published_data = About::where("published_status", 1)->where("delete_status", 0)->where('id','<>', $id)->where('display_status', $display_status)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Published Multiple About Details Same Section At Same Time",
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);

            die;
        }

        $status = false;
        if ($data->published_status==1) {

            $data->published_status = 0;

            $data->save();
            $status = true;
        }
        elseif ($data->published_status==0) {
            
            $data->published_status = 1;
            $data->status_active = 1;

            $data->save();
            $status = true;
        }

        if($status==true){

            $notification = array(
                'message'=> " About Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.about')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "About Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function change_active_status($id){

        $data = About::find($id);

        $published_data = About::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published About Details Active Status",
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);

            die;
        }

        $status = false;
        if ($data->status_active==1) {

            $data->status_active = 0;

            $data->save();
            $status = true;
        }
        elseif ($data->status_active==0) {
            
            $data->status_active = 1;

            $data->save();
            $status = true;
        }

        if($status==true){

            $notification = array(
                'message'=> "About Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.about')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "About Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function about_delete($id){

        $data = About::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "About Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.about')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "About Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function about_view($id){

        $about = About::find($id);

        return view('admin.about.about_view',compact('about'));
    }

    public function about_me($slug){

        return view('frontend.about_me');
    }

    public function about_page(){

        return view('frontend.about_me');
    }

    // multi image....
    public function add_multi_image(){

        return view('admin.about.add_multi_image');
    }

    public function multi_image_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'multi_image' => ['required'],
        ]);

        $data = new MultiImage;

        $files = $request->file('multi_image');
        $data->title = $request->title;
        $data->display_status = $request->display_status;
        $data->slug = SlugService::createSlug(About::class, 'slug',$request->title);

        $multi_image_name='';

        foreach($files as $file){

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'_'.uniqid().'.'.$extension;

            Image::make($file)->resize(220,220)->save('backend/multi_image/'.$fileName);

            if($multi_image_name!=''){

                $multi_image_name .="***";
            }

            $multi_image_name .= $fileName;
        }

        $data->multi_image = $multi_image_name;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Multi Image Details Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.multi.image')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Multi Image Details Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_multi_image(){

        $all_multi_images = MultiImage::where('delete_status',0)->get();

        return view('admin.about.all_multi_image',compact('all_multi_images'));
    }

    public function edit_multi_image ($id){

        $multi_image = MultiImage::find($id);

        return view('admin.about.multi_image_edit',compact('multi_image'));
    }

    public function multi_image_update(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'id' => ['required'],
        ]);

        $data = MultiImage::find($request->id);

        $data->title = $request->title;
        $data->display_status = $request->display_status;

        $imagevalue = $request->imagevalue;
        $delete_image_value = $request->hidden_image;
        $hidden_all_image = $request->hidden_all_image;

        $multi_image_name='';

        if($delete_image_value!=''){

            if($imagevalue!='')
            {
                foreach($imagevalue as $file){
                    
                    if($multi_image_name!=''){

                        $multi_image_name .="***";
                    }

                    $multi_image_name .= $file;
                }
            }
        }
        else{

            $multi_image_name .=$hidden_all_image;
        }

        $files = $request->file('multi_image');

        if($files!='')
        {
            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'_'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(220,220)->save('backend/multi_image/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        if($multi_image_name==''){

            $notification = array(
                'message'=> "Please Updated Image First",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
        else{

            $data->multi_image = $multi_image_name;

            $data->save();

            if($data==true){

                if($delete_image_value!=''){

                    $delete_image_value = explode("***",$delete_image_value);

                    foreach($delete_image_value as $value){

                        $filename = 'backend/multi_image/'.$value;

                        if(file_exists($filename))
                        {
                            $deletePhoto = "backend/multi_image/".$value;
                            
                            if(file_exists($deletePhoto)){

                                unlink($deletePhoto);
                            }
                        }
                    }
                }

                $notification = array(
                    'message'=> "Multi Image Details Updated Successfully",
                    'alert-type'=>'info'
                );

                return redirect()->route('admin.all.multi.image')->with($notification);
            }
            else{

                $notification = array(
                    'message'=> "Multi Image Details Does Not Updated Successfully",
                    'alert-type'=>'warning'
                );

                return redirect()->back()->with($notification);
            }
        }

    }

    public function change_publish_status_multi_image($id){

        $data = MultiImage::find($id);

        $published_status = $data->published_status;
        $display_status = $data->display_status;

        $published_data = MultiImage::where("published_status", 1)->where("delete_status", 0)->where('id','<>', $id)->where('display_status', $display_status)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Published Multiple Multi Image Details Same Section At Same Time",
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);

            die;
        }

        $status = false;
        if ($data->published_status==1) {

            $data->published_status = 0;

            $data->save();
            $status = true;
        }
        elseif ($data->published_status==0) {
            
            $data->published_status = 1;
            $data->status_active = 1;

            $data->save();
            $status = true;
        }

        if($status==true){

            $notification = array(
                'message'=> " Multi Image Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.multi.image')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Multi Image Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_active_status_multi_image($id){

        $data = MultiImage::find($id);

        $published_data = MultiImage::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Multi Image Details Active Status",
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);

            die;
        }

        $status = false;
        if ($data->status_active==1) {

            $data->status_active = 0;

            $data->save();
            $status = true;
        }
        elseif ($data->status_active==0) {
            
            $data->status_active = 1;

            $data->save();
            $status = true;
        }

        if($status==true){

            $notification = array(
                'message'=> "Multi Image Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.multi.image')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Multi Image Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function delete_multi_image($id){

        $data = MultiImage::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Multi Image Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.multi.image')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Multi Image Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function contact_me(){

        return view('frontend.contact_me');
    }
}
