<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\WorkignProcessTitle;
use App\Models\WorkignProcess;
use Image;
use DB;

class WorkingProcessController extends Controller
{
    public function working_process_title (){

        $data = WorkignProcessTitle::where('delete_status',0)
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

        return view('admin.working_process.working_process_title',compact('title_data'));
    }

    public function working_process_title_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
        ]);

        $data = WorkignProcessTitle::where('delete_status',0)
            ->where('id',1)
            ->first();

        if($data==''){

            $data = new WorkignProcessTitle;
        }

        $data->title = $request->title;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Working Process Title Created Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Working Process Title Does Not Created Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function add_process(){

       return view('admin.working_process.add_process');
    }

    public function process_store(Request $request){

        $request->validate([
            'process_step' => ['required', 'string'],
            'title' => ['required', 'string'],
            'long_des' => ['required', 'string']
        ]);

        $data = new WorkignProcess;

        $data->process_step = $request->process_step;
        $data->title = $request->title;
        $data->long_des = $request->long_des;
        $data->slug = SlugService::createSlug(WorkignProcess::class, 'slug',$request->title);

        if ($request->hasFile('workign_processes_icon')) {

            $file = $request->file('workign_processes_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName2 = $title_name.'-icon-'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/workign_process/'.$fileName2);

            $data->workign_processes_icon = $fileName2;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Working Process Details Created Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Working Process Details Does Not Created Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function all_process(){

        $all_process = WorkignProcess::where('delete_status',0)
            ->where('delete_status',0)
            ->get();

       return view('admin.working_process.all_process',compact('all_process'));
    }

    public function process_edit($id){

        $process = WorkignProcess::where('delete_status',0)
            ->where('delete_status',0)
            ->where('id',$id)
            ->first();

        return view('admin.working_process.edit_process',compact('process'));
    }

    public function process_update(Request $request){

        $request->validate([
            'process_step' => ['required', 'string'],
            'title' => ['required', 'string'],
            'long_des' => ['required', 'string']
        ]);

        $data = WorkignProcess::find($request->id);

        $data->process_step = $request->process_step;
        $data->title = $request->title;
        $data->long_des = $request->long_des;

        if ($request->hasFile('workign_processes_icon')) {

            $file = $request->file('workign_processes_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','-',$request->title);

            $fileName2 = $title_name.'-icon-'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/workign_process/'.$fileName2);

            if($data->workign_processes_icon!='')
            {
                $deletePhoto = "backend/working_process/".$data->workign_processes_icon;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->workign_processes_icon = $fileName2;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Working Process Details Updated Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Working Process Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

        }

        return redirect()->back()->with($notification);
    }

    public function process_view($id){

    }

    public function change_process_publish_status($id){

        $data = WorkignProcess::find($id);

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
                'message'=> " Working Process Details Published Changed Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Working Process Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function change_process_active_status($id){

        $data = WorkignProcess::find($id);

        $published_data = WorkignProcess::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Working Process Details Active Status",
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
                'message'=> "Working Process Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Working Process Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function process_delete($id){

        $data = WorkignProcess::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Working Process Details Deleted Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Working Process Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }
}
