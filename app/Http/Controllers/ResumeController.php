<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Resume;
use Response;



class ResumeController extends Controller
{
    public function add_resume(){

        return view('admin.resume.add_resume');
    }

    public function resume_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'cv_url' => ['required'],
        ]);

        $data = new Resume;

        $data->title = $request->title;

        $data->slug = SlugService::createSlug(Resume::class, 'slug',$request->title);

        if ($request->hasFile('cv_url')) {

            $file = $request->file('cv_url');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            $file->move('backend/resume',$fileName);

            $data->cv_url = $fileName;


        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Resume Uploaded Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.resume')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Resume Does Not Uploaded Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_resume(){


        $all_resume = Resume::where('delete_status',0)->get();


        return view('admin.resume.all_resume',compact('all_resume'));
    }

    public function resume_details($slug){

        $resume = Resume::where('delete_status',0)->where('slug',$slug)->first();

        $file= public_path()."/backend/resume/".$resume->cv_url;

        $headers = array(
            
            'Content-Type: application/pdf',
        );

        return Response::download($file, $resume->cv_url, $headers);
    }

    public function resume_edit($id){

        $resume = Resume::find($id);

        return view('admin.resume.resume_edit',compact('resume'));
    }

    public function resume_update(Request $request){

        $request->validate([

            'id' => ['required'],
            'title' => ['required', 'string'],
        ]);

        $data = Resume::find($request->id);

        $data->title = $request->title;

        if ($request->hasFile('cv_url')) {

            $file = $request->file('cv_url');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            $file->move('backend/resume/',$fileName);

            if($data->cv_url!='')
            {
                $deletePhoto = "backend/resume/".$data->cv_url;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->cv_url = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Resume Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.resume')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Resume Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_publish_status ($id){

        $data = Resume::find($id);

        $published_data = Resume::where("published_status", 1)->where("delete_status", 0)->where('id','<>', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Published Multiple Resume At A Time",
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
                'message'=> "Resume Published Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.resume')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Resume Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_active_status ($id){

        $data = Resume::find($id);

        $published_data = Resume::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Resume Active Status",
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
                'message'=> "Resume Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.resume')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Resume Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function slider_delete ($id){

        $data = Resume::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Resume Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.resume')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Resume Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }
}
