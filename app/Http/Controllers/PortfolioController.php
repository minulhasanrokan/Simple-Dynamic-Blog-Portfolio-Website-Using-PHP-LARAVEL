<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\ProjectCetagory;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Image; 

class PortfolioController extends Controller
{
    public function add_cetagory(){

        return view('admin.portfolio.add_portfolio_cetagory');
    }

    public function portfolio_cetagory_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
        ]);

        $data = new ProjectCetagory;

        $data->title = $request->title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->slug = SlugService::createSlug(ProjectCetagory::class, 'slug',$request->title);

        if ($request->hasFile('cetagory_img')) {

            $file = $request->file('cetagory_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_cetagory_'.time().'.'.$extension;

            Image::make($file)->resize(615,648)->save('backend/portfolio/'.$fileName);

            $data->cetagory_img = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Portfolio Cetagory Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Portfolio Cetagory Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_cetagory(){

        $all_cetagory = ProjectCetagory::where('delete_status',0)->get();


        return view('admin.portfolio.all_portfolio_cetagory',compact('all_cetagory'));
    }

    public function portfolio_cetagory_edit($id){

        $cetagory = ProjectCetagory::find($id);

        return view('admin.portfolio.edit_portfolio_cetagory',compact('cetagory'));
    }

    public function portfolio_cetagory_update(Request $request){

        $request->validate([

            'id' => ['required'],
            'title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
        ]);

        $data = ProjectCetagory::find($request->id);

        $data->title = $request->title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;

        if ($request->hasFile('cetagory_img')) {

            $file = $request->file('cetagory_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_cetagory_'.time().'.'.$extension;

            Image::make($file)->resize(615,648)->save('backend/portfolio/'.$fileName);

            if($data->cetagory_img!='')
            {
                $deletePhoto = "backend/portfolio/".$data->cetagory_img;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->cetagory_img = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Portfolio Cetagory Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Portfolio Cetagory Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function change_publish_status($id){

        $data = ProjectCetagory::find($id);

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
                'message'=> " Project Cetagory Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Project Cetagory Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function change_active_status($id){

        $data = ProjectCetagory::find($id);

        $published_data = ProjectCetagory::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Project Cetagory Details Active Status",
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
                'message'=> "Project Cetagory Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Project Cetagory Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function portfolio_cetagory_delete($id){

        $data = ProjectCetagory::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Project Cetagory Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Project Cetagory Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function portfolio_cetagory_view($id){

        
    }


    public function add_portfolio(){

        return view('admin.portfolio.add_portfolio');
    }

    public function portfolio_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'cetagory_id' => ['required'],
            'project_date' => ['required'],
            'project_location' => ['required'],
            'project_client' => ['required'],
            'project_link' => ['required'],
        ]);

        $data = new Portfolio;

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->cetagory_id = $request->cetagory_id;
        $data->project_date = $request->project_date;
        $data->project_location = $request->project_location;
        $data->project_client = $request->project_client;
        $data->project_link = $request->project_link;
        $data->slug = SlugService::createSlug(Portfolio::class, 'slug',$request->title);


        if ($request->hasFile('portfolio_img')) {

            $file = $request->file('portfolio_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName1 = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(1020,519)->save('backend/portfolio/'.$fileName1);

            $data->portfolio_img = $fileName1;
        }

        $multi_image_name='';

        if ($request->hasFile('portfolio_multi_img')){
            
            $files = $request->file('portfolio_multi_img');

            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'_multi_img_'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/portfolio/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->portfolio_multi_img = $multi_image_name;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Portfolio Details Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Portfolio Details Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_portfolio(){

        $all_portfolio = Portfolio::where('delete_status',0)->get();

        return view('admin.portfolio.all_portfolio',compact('all_portfolio'));
    }

    public function portfolio_edit($id){

        $portfolio = Portfolio::find($id);

        return view('admin.portfolio.edit_portfolio',compact('portfolio'));
    }

    public function portfolio_update(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'id' => ['required'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'cetagory_id' => ['required'],
            'project_date' => ['required'],
            'project_location' => ['required'],
            'project_client' => ['required'],
            'project_link' => ['required'],
        ]);

        $data = Portfolio::find($request->id);

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->cetagory_id = $request->cetagory_id;
        $data->project_date = $request->project_date;
        $data->project_location = $request->project_location;
        $data->project_client = $request->project_client;
        $data->project_link = $request->project_link;

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

        $files = $request->file('portfolio_multi_img');

        if($files!='')
        {
            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'_multi_img_'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/portfolio/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->portfolio_multi_img = $multi_image_name;

        if ($request->hasFile('portfolio_img')) {

            $file = $request->file('portfolio_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName1 = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(1020,519)->save('backend/portfolio/'.$fileName1);

            if($data->portfolio_img!='')
            {
                $deletePhoto = "backend/portfolio/".$data->portfolio_img;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->portfolio_img = $fileName1;
        }

        $data->save();

        if($data==true){

            if($delete_image_value!=''){

                $delete_image_value = explode("***",$delete_image_value);

                foreach($delete_image_value as $value){

                    $filename = 'backend/portfolio/'.$value;

                    if(file_exists($filename))
                    {
                        $deletePhoto = "backend/portfolio/".$value;
                        
                        if(file_exists($deletePhoto)){

                            unlink($deletePhoto);
                        }
                    }
                }
            }

            $notification = array(
                'message'=> "Portfolio Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Portfolio Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function change_portfolio_publish_status($id){

        $data = Portfolio::find($id);

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
                'message'=> " Portfolio Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Portfolio Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }

    } 

    public function change_portfolio_active_status($id){

        $data = Portfolio::find($id);

        $published_data = Portfolio::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Portfolio Details Active Status",
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
                'message'=> "Portfolio Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Portfolio Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function portfolio_delete($id){

        $data = Portfolio::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Portfolio Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.portfolio')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Portfolio Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function portfolio_view($id){

        
    }

    public function portfolio_details($slug){

        $portfolio = DB::table('project_cetagories')
        ->join('portfolios', 'project_cetagories.id', '=', 'portfolios.cetagory_id')
        ->select('portfolios.*', 'project_cetagories.title as cat_title' , 'project_cetagories.slug as cat_slug')
        ->where("portfolios.published_status", 1)
        ->where("portfolios.slug", $slug)
        ->where('portfolios.delete_status',0)
        ->where("portfolios.status_active", 1)
        ->where("project_cetagories.published_status", 1)
        ->where('project_cetagories.delete_status',0)
        ->where("project_cetagories.status_active", 1)
        ->first();

        return view('frontend.portfolio_details',compact('portfolio'));
    }

    public function portfolio(){

        return view('frontend.portfolio');
    }

}
