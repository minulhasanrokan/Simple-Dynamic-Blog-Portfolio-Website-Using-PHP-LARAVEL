<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\ServiceTitle;
use App\Models\Service;
use Image;
use DB;

class ServiceController extends Controller
{
    public function service_title(){

        $data = ServiceTitle::where('delete_status',0)
            ->where('id',1)
            ->first();

        $title_data = array();
        if($data!=''){

            $title_data['title']=$data->title;
            $title_data['id']=$data->id;
        }
        else{

            $title_data['title']='';
            $title_data['id']='';
        }

       return view('admin.service.service_title',compact('title_data'));
    }


    public function service_title_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
        ]);

        $data = ServiceTitle::where('delete_status',0)
            ->where('id',1)
            ->first();

        if($data==''){

            $data = new ServiceTitle;
        }

        $data->title = $request->title;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Service Title Created Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Service Title Does Not Created Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }


    public function add_service(){

       return view('admin.service.add_service');
    }

    public function service_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string']
        ]);

        $data = new Service;

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->slug = SlugService::createSlug(Service::class, 'slug',$request->title);

        if ($request->hasFile('service_img')) {

            $file = $request->file('service_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName1 = $title_name.'-'.time().'.'.$extension;

            Image::make($file)->resize(1020,519)->save('backend/service/'.$fileName1);

            $data->service_img = $fileName1;
        }

        $multi_image_name='';

        if ($request->hasFile('service_multi_img')){
            
            $files = $request->file('service_multi_img');

            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'-multi-img-'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/service/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->service_multi_img = $multi_image_name;

        if ($request->hasFile('service_icon')) {

            $file = $request->file('service_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName2 = $title_name.'-icon-'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/service/'.$fileName2);

            $data->service_icon = $fileName2;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Service Details Created Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Service Details Does Not Created Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function all_service(){

        $service_data = Service::where('delete_status',0)
            ->get();

        return view('admin.service.service_all',compact('service_data'));
    }

    public function service_edit($id){

        $service = Service::find($id);

        return view('admin.service.edit_service',compact('service'));
    }

    public function service_update(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'id' => ['required'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string']
        ]);

        $data = Service::find($request->id);

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;

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

        $files = $request->file('service_multi_img');

        if($files!='')
        {
            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'-multi-img-'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/service/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->service_multi_img = $multi_image_name;

        if ($request->hasFile('service_img')) {

            $file = $request->file('service_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName1 = $title_name.'-'.time().'.'.$extension;

            Image::make($file)->resize(1020,519)->save('backend/service/'.$fileName1);

            if($data->blog_img!='')
            {
                $deletePhoto = "backend/service/".$data->service_img;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->service_img = $fileName1;
        }

        if ($request->hasFile('service_icon')) {

            $file = $request->file('service_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName2 = $title_name.'-icon-'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/service/'.$fileName2);

            if($data->service_icon!='')
            {
                $deletePhoto = "backend/service/".$data->service_icon;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->service_icon = $fileName2;
        }

        $data->save();

        if($data==true){

            if($delete_image_value!=''){

                $delete_image_value = explode("***",$delete_image_value);

                foreach($delete_image_value as $value){

                    $filename = 'backend/service/'.$value;

                    if(file_exists($filename))
                    {
                        $deletePhoto = "backend/service/".$value;
                        
                        if(file_exists($deletePhoto)){

                            unlink($deletePhoto);
                        }
                    }
                }
            }

            $notification = array(
                'message'=> "Service Details Updated Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Service Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

        }

        return redirect()->back()->with($notification);
    }

    public function change_service_publish_status($id){

        $data = Service::find($id);

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
                'message'=> " Service Details Published Changed Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Service Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function change_service_active_status($id){

        $data = Service::find($id);

        $published_data = Service::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Service Details Active Status",
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
                'message'=> "Service Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Service Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function service_delete($id){

        $data = Service::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Service Details Deleted Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Service Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function all_service_details(){

        $offset = 0;
        if(isset($_GET['ofset'])){
            
            $offset = $_GET['ofset'];
        }

        $all_blog = DB::table('services')
            ->select('services.*')
            ->where("services.published_status", 1)
            ->where('services.delete_status',0)
            ->where("services.status_active", 1)
            ->take(10)
            ->skip($offset)
            ->get();

            print_r($all_blog);
        /*
        if(isset($_GET['ofset'])){
            
            return view('frontend.home_all.all_blog',compact('all_blog'));
        }
        else{

            return view('frontend.all_blog',compact('all_blog'));
        }
        */
  
    }

    public function service_details($slug){

        $service = DB::table('services')
        ->select('services.*')
        ->where("services.published_status", 1)
        ->where("services.slug", $slug)
        ->where('services.delete_status',0)
        ->where("services.status_active", 1)
        ->first();

        return view('frontend.service_details',compact('service'));
    }

    public function all_services(){

        return view('frontend.service_data');
    }
}
 