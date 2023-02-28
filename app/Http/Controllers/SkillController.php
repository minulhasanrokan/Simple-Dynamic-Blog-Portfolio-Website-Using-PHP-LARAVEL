<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Skill;
use Image;

class SkillController extends Controller
{
    
    public function add_skill(){

         return view('admin.skill.add_skill');
    }

    public function skill_store(Request $request){


        $request->validate([

            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'skill_persent' => ['required', 'integer'],
        ]);

        $data = new Skill;

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->skill_persent = $request->skill_persent;
        $data->slug = SlugService::createSlug(Skill::class, 'slug',$request->title);

        if ($request->hasFile('skill_img')) {

            $file = $request->file('skill_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(523,605)->save('backend/skill/'.$fileName);

            $data->skill_img = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Skill Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.skill')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Skill Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_skill(){

        $all_skill = Skill::where('delete_status',0)->get();


        return view('admin.skill.all_skill',compact('all_skill'));
    }

    public function skill_edit($id){

        $skill = Skill::find($id);

        return view('admin.skill.skill_edit',compact('skill'));
    }

    public function skill_update(Request $request){

        $request->validate([

            'id' => ['required'],
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'skill_persent' => ['required', 'integer'],
        ]);

        $data = Skill::find($request->id);

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->skill_persent = $request->skill_persent;

        if ($request->hasFile('skill_img')) {

            $file = $request->file('skill_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(623,605)->save('backend/skill/'.$fileName);

            if($data->skill_img!='')
            {
                $deletePhoto = "backend/skill/".$data->skill_img;
                unlink($deletePhoto);
            }

            $data->skill_img = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Skill Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.skill')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Skill Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_publish_status($id){

        $data = Skill::find($id);

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
                'message'=> " Skill Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.skill')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Skill Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_active_status($id){

        $data = Skill::find($id);

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
                'message'=> "Skill Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.skill')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Skill Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function skill_delete($id){

        $data = Skill::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Skill Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.skill')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Skill Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function skill_view($id){

        $skill = Skill::find($id);

        return view('admin.skill.skill_view',compact('skill'));
    }

    public function skill_details($slug){
        
    }

}
