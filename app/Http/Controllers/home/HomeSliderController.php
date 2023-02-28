<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;

class HomeSliderController extends Controller
{
    
    public function add_slider(){

        return view('admin.home_slide.add_slider');
    }

    public function slider_store (Request $request){

        $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'short_des' => ['required', 'string', 'max:255'],
            'long_des' => ['required', 'string'],
            'video_url' => ['required', 'string', 'max:255'],
        ]);

        $data = new HomeSlide;

        $data->title = $request->title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->video_url = $request->video_url;
        $data->slug = SlugService::createSlug(HomeSlide::class, 'slug',$request->title);

        if ($request->hasFile('slide_img')) {

            $file = $request->file('slide_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(636,852)->save('backend/slider/'.$fileName);

            $data->slide_img = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Home Slider Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.home.slide')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Home Slider Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function home_slider(){

        $home_slider = HomeSlide::where('delete_status',0)->get();


        return view('admin.home_slide.home_slider',compact('home_slider'));

    }

    public function slider_view($id){

        $home_slide = HomeSlide::find($id);

        return view('admin.home_slide.home_slide_view',compact('home_slide'));
    }

    public function slider_edit($id){

        $home_slide = HomeSlide::find($id);

        return view('admin.home_slide.home_slide_edit',compact('home_slide'));
    }

    public function slider_update(Request $request){

        $request->validate([
            'id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'short_des' => ['required', 'string', 'max:255'],
            'long_des' => ['required', 'string'],
            'video_url' => ['required', 'string', 'max:255'],
        ]);

        $data = HomeSlide::find($request->id);

        $data->title = $request->title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->video_url = $request->video_url;

        if ($request->hasFile('slide_img')) {

            $file = $request->file('slide_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(636,852)->save('backend/slider/'.$fileName);

            if($data->slide_img!='')
            {
                $deletePhoto = "backend/slider/".$data->slide_img;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->slide_img = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Home Slider Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.home.slide')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Home Slider Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_publish_status ($id){

        $data = HomeSlide::find($id);

        $published_data = HomeSlide::where("published_status", 1)->where("delete_status", 0)->where('id','<>', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Published Multiple Slider At A Time",
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
                'message'=> "Home Slider Published Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.home.slide')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Home Slider Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_active_status ($id){

        $data = HomeSlide::find($id);

        $published_data = HomeSlide::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Slider Active Status",
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
                'message'=> "Home Slider Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.home.slide')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Home Slider Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function slider_delete ($id){

        $data = HomeSlide::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Home Slider Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.home.slide')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Home Slider Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }
}
