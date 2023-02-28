<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Award;
use Image;

class AwardController extends Controller
{
    public function add_award(){

        return view('admin.award.add_award');
    }

    public function award_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
        ]);

        $data = new Award;

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->slug = SlugService::createSlug(Award::class, 'slug',$request->title);

        if ($request->hasFile('award_img')) {

            $file = $request->file('award_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(146,134)->save('backend/award/'.$fileName);

            $data->award_img = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Award Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.award')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Award Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_award(){

        $all_award = Award::where('delete_status',0)->get();

        return view('admin.award.all_award',compact('all_award'));
    }

    public function award_edit($id){

        $award = Award::find($id);

        return view('admin.award.award_edit',compact('award'));
    }

    public function award_update(Request $request){

        $request->validate([

            'id' => ['required'],
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
        ]);

        $data = Award::find($request->id);

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;

        if ($request->hasFile('award_img')) {

            $file = $request->file('award_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(146,143)->save('backend/award/'.$fileName);

            if($data->award_img!='')
            {
                $deletePhoto = "backend/award/".$data->award_img;
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
                
            }

            $data->award_img = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Award Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.award')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Award Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_publish_status($id){

        $data = Award::find($id);

        $published_status = $data->published_status;

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
                'message'=> " Award Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.award')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Award Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_active_status($id){

        $data = Award::find($id);

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
                'message'=> "Award Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.award')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Award Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function award_delete($id){

        $data = Award::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Award Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.award')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Award Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function award_details($slug){
        
    }
}
