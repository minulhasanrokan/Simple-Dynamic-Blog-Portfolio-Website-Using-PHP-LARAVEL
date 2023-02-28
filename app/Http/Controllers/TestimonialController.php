<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\TestimonialTitle;
use App\Models\Testimonial;
use App\Models\Service;
use Image;
use DB;
 
class TestimonialController extends Controller
{
    public function testimonial_title(){

        $data = TestimonialTitle::where('delete_status',0)
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

       return view('admin.testimonial.testimonial_title',compact('title_data'));
    }

    public function testimonial_title_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
        ]);

        $data = TestimonialTitle::where('delete_status',0)
            ->where('id',1)
            ->first();

        if($data==''){

            $data = new TestimonialTitle;
        }

        $data->title = $request->title;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Testimonial Title Created Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Testimonial Title Does Not Created Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function add_testimonial(){

       return view('admin.testimonial.add_testimonial');
    }

    public function testimonial_store(Request $request){

        $request->validate([

            'service_id' => ['required'],
            'buyer_name' => ['required', 'string'],
            'buyer_website' => ['required', 'string'],
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string']
        ]);

        $data = new Testimonial;

        $data->service_id = $request->service_id;
        $data->buyer_name = $request->buyer_name;
        $data->buyer_website = $request->buyer_website;
        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->slug = SlugService::createSlug(Testimonial::class, 'slug',$request->title);

        if ($request->hasFile('testimonial_img')) {

            $file = $request->file('testimonial_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName1 = $title_name.'-'.time().'.'.$extension;

            Image::make($file)->resize(1020,519)->save('backend/testimonial/'.$fileName1);

            $data->testimonial_img = $fileName1;
        }

        $multi_image_name='';

        if ($request->hasFile('testimonial_multi_img')){
            
            $files = $request->file('testimonial_multi_img');

            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'-multi-img-'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/testimonial/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->testimonial_multi_img = $multi_image_name;

        if ($request->hasFile('testimonial_icon')) {

            $file = $request->file('testimonial_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName2 = $title_name.'-icon-'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/testimonial/'.$fileName2);

            $data->testimonial_icon = $fileName2;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Testimonial Details Created Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Testimonial Details Does Not Created Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function all_testimonial(){

        $all_testimonial = DB::table('testimonials')
        ->join('services', 'services.id', '=', 'testimonials.service_id')
        ->select('testimonials.*', 'services.title as service_title' , 'services.slug as service_slug', 'services.service_img as service_img')
        ->where('testimonials.delete_status',0)
        ->where("services.published_status", 1)
        ->where('services.delete_status',0)
        ->where("services.status_active", 1)
        ->get();

       return view('admin.testimonial.all_testimonial',compact('all_testimonial'));
    }

    public function testimonial_edit($id){

        $testimonial = DB::table('testimonials')
        ->join('services', 'services.id', '=', 'testimonials.service_id')
        ->select('testimonials.*', 'services.title as service_title' , 'services.slug as service_slug', 'services.service_img as service_img')
        ->where('testimonials.id',$id)
        ->where('testimonials.delete_status',0)
        ->where("services.published_status", 1)
        ->where('services.delete_status',0)
        ->where("services.status_active", 1)
        ->first();

        return view('admin.testimonial.edit_testimonial',compact('testimonial'));
    }

    public function testimonial_update(Request $request){

        $request->validate([

            'service_id' => ['required'],
            'buyer_name' => ['required', 'string'],
            'buyer_website' => ['required', 'string'],
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string']
        ]);

        $data = Testimonial::find($request->id);

        $data->service_id = $request->service_id;
        $data->buyer_name = $request->buyer_name;
        $data->buyer_website = $request->buyer_website;
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

        $files = $request->file('testimonial_multi_img');

        if($files!='')
        {
            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'-multi-img-'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/testimonial/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->testimonial_multi_img = $multi_image_name;

        if ($request->hasFile('testimonial_img')) {

            $file = $request->file('testimonial_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName1 = $title_name.'-'.time().'.'.$extension;

            Image::make($file)->resize(1020,519)->save('backend/testimonial/'.$fileName1);

            if($data->blog_img!='')
            {
                $deletePhoto = "backend/testimonial/".$data->testimonial_img;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->testimonial_img = $fileName1;
        }

        if ($request->hasFile('testimonial_icon')) {

            $file = $request->file('testimonial_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName2 = $title_name.'-icon-'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/testimonial/'.$fileName2);

            if($data->testimonial_icon!='')
            {
                $deletePhoto = "backend/testimonial/".$data->testimonial_icon;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->testimonial_icon = $fileName2;
        }

        $data->save();

        if($data==true){

            if($delete_image_value!=''){

                $delete_image_value = explode("***",$delete_image_value);

                foreach($delete_image_value as $value){

                    $filename = 'backend/testimonial/'.$value;

                    if(file_exists($filename))
                    {
                        $deletePhoto = "backend/testimonial/".$value;
                        
                        if(file_exists($deletePhoto)){

                            unlink($deletePhoto);
                        }
                    }
                }
            }

            $notification = array(
                'message'=> "Testimonial Details Updated Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Testimonial Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

        }

        return redirect()->back()->with($notification);
    }

    public function change_testimonial_publish_status($id){

        $data = Testimonial::find($id);

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
                'message'=> " Testimonial Details Published Changed Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Testimonial Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function change_testimonial_active_status($id){

        $data = testimonial::find($id);

        $published_data = testimonial::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published testimonial Details Active Status",
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
                'message'=> "Testimonial Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Testimonial Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function testimonial_delete($id){

        $data = Testimonial::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Testimonial Details Deleted Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Testimonial Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function testimonial_details($slug){

        $testimonial = DB::table('testimonials')
        ->select('testimonials.*')
        ->where("testimonials.published_status", 1)
        ->where("testimonials.slug", $slug)
        ->where('testimonials.delete_status',0)
        ->where("testimonials.status_active", 1)
        ->first();

        return view('frontend.testimonial_details',compact('testimonial'));
    }
}
