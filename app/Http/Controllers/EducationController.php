<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Education;
use Image; 

class EducationController extends Controller
{
    public function add_education(){

        return view('admin.education.add_education');
    }

    public function education_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'institute_name' => ['required', 'string'],
            'subject' => ['required', 'string'],
            'group' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
        ]);

        $data = new Education;

        if($request->continue_status!='on'){

            $request->validate([

                'end_date' => ['required', 'date'],
                'result' => ['required', 'string'],
                'out_of_result' => ['required', 'string'],
            ]);

            $data->end_date = $request->end_date;
            $data->result = $request->result;
            $data->continue_status = 0;
        }
        else{
            
            $data->continue_status = 1;
        }

        $data->title = $request->title;
        $data->institute_name = $request->institute_name;
        $data->subject = $request->subject;
        $data->group = $request->group;
        $data->start_date = $request->start_date;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->slug = SlugService::createSlug(Education::class, 'slug',$request->title);

        $multi_image_name='';

        if ($request->hasFile('edu_img')){
            
            $files = $request->file('edu_img');

            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'_'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/education/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->edu_img = $multi_image_name;

        if ($request->hasFile('edu_icon')) {

            $file = $request->file('edu_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_icon_'.time().'.'.$extension;

            Image::make($file)->resize(200,200)->save('backend/education/'.$fileName);

            $data->edu_icon = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Education Details Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.education')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Education Details Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }




    }

    public function all_education(){

        $all_education = Education::where('delete_status',0)->get();


        return view('admin.education.all_education',compact('all_education'));
    }

    public function education_edit($id){

        $education = Education::find($id);

        return view('admin.education.education_edit',compact('education'));
    }

    public function education_update(Request $request){

        $request->validate([

            'id' => ['required'],
            'title' => ['required', 'string'],
            'institute_name' => ['required', 'string'],
            'subject' => ['required', 'string'],
            'group' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
        ]);

        $data = Education::find($request->id);

        if($request->continue_status!='on'){

            $request->validate([

                'end_date' => ['required', 'date'],
                'result' => ['required', 'string'],
                'out_of_result' => ['required', 'string'],
            ]);

            $data->end_date = $request->end_date;
            $data->result = $request->result;
            $data->continue_status = 0;
        }
        else{
            
            $data->continue_status = 1;
        }

        $data->title = $request->title;
        $data->institute_name = $request->institute_name;
        $data->subject = $request->subject;
        $data->group = $request->group;
        $data->start_date = $request->start_date;
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

        $files = $request->file('edu_img');

        if($files!='')
        {
            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'_'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(220,220)->save('backend/education/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        if ($request->hasFile('edu_icon')) {

            $file = $request->file('edu_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_icon_'.time().'.'.$extension;

            Image::make($file)->resize(82,108)->save('backend/education/'.$fileName);

            if($data->edu_icon!='')
            {
                $deletePhoto = "backend/education/".$data->edu_icon;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->edu_icon = $fileName;
        }

        $data->edu_img = $multi_image_name;

        $data->save();

        if($data==true){

            if($delete_image_value!=''){

                $delete_image_value = explode("***",$delete_image_value);

                foreach($delete_image_value as $value){

                    $filename = 'backend/education/'.$value;

                    if(file_exists($filename))
                    {
                        $deletePhoto = "backend/education/".$value;
                        
                        if(file_exists($deletePhoto)){

                            unlink($deletePhoto);
                        }
                    }
                }
            }

            $notification = array(
                'message'=> "Education Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.education')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Education Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_publish_status($id){

        $data = Education::find($id);

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
                'message'=> " Education Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.education')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Education Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function change_active_status($id){

        $data = Education::find($id);

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
                'message'=> "Education Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.education')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Education Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }


    public function education_delete($id){

        $data = Education::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Education Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.education')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Education Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function education_view($id){

    }

    public function education_details($slug){
        
    }

}
