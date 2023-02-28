<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Comment;
use Image;
use DB;

class BlogController extends Controller
{
    
    public function add_cetagory(){

        return view('admin.blog.add_blog_category');
    }

    public function cetagory_store(Request $request){


        $request->validate([

            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'cat_img' => ['required'],
        ]);

        $data = new BlogCategory;

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->slug = SlugService::createSlug(BlogCategory::class, 'slug',$request->title);

        if ($request->hasFile('cat_img')) {

            $file = $request->file('cat_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_cat_img_'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/blog/'.$fileName);

            $data->cat_img = $fileName;
        }

        if ($request->hasFile('cat_icon')) {

            $file = $request->file('cat_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_cat_icon_'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/blog/'.$fileName);

            $data->cat_icon = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Blog Category Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Category Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_cetagory(){

        $all_cetagory = BlogCategory::where('delete_status',0)->get();

        return view('admin.blog.all_blog_cetagory',compact('all_cetagory'));
    }

    public function blog_cetagory_edit($id){

        $blog_cetagory = BlogCategory::find($id);

        return view('admin.blog.blog_cetagory_edit',compact('blog_cetagory'));
    }

    public function blog_cetagory_update(Request $request){

        $request->validate([

            'id' => ['required'],
            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
        ]);

        $data = BlogCategory::find($request->id);

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;

        if ($request->hasFile('cat_img')) {

            $file = $request->file('cat_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_cat_img_'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/blog/'.$fileName);

            if($data->cat_img!='')
            {
                $deletePhoto = "backend/blog/".$data->cat_img;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->cat_img = $fileName;
        }

        if ($request->hasFile('cat_icon')) {

            $file = $request->file('cat_icon');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName = $title_name.'_cat_icon_'.time().'.'.$extension;

            Image::make($file)->resize(500,500)->save('backend/blog/'.$fileName);

            if($data->cat_icon!='')
            {
                $deletePhoto = "backend/blog/".$data->cat_icon;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->cat_icon = $fileName;
        }

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Blog Category Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Category Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function blog_category_change_publish_status($id){

        $data = BlogCategory::find($id);

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
                'message'=> " Blog Category Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Category Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function blog_category_change_active_status($id){

        $data = BlogCategory::find($id);

        $published_data = BlogCategory::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Blog Category Details Active Status",
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
                'message'=> "Blog Category Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Category Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function blog_category_delete($id){

        $data = BlogCategory::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Blog Category Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog.cetagory')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Category Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function blog_category_view($id){

        
    }

    public function add_blog(){

        return view('admin.blog.add_blog');
    }

    public function blog_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'cetagory_id' => ['required']
        ]);

        $data = new Blog;

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->cetagory_id = $request->cetagory_id;
        $data->slug = SlugService::createSlug(Blog::class, 'slug',$request->title);

        if ($request->hasFile('blog_img')) {

            $file = $request->file('blog_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName1 = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(1020,519)->save('backend/blog/'.$fileName1);

            $data->blog_img = $fileName1;
        }

        $multi_image_name='';

        if ($request->hasFile('blog_multi_img')){
            
            $files = $request->file('blog_multi_img');

            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'_multi_img_'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/blog/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->blog_multi_img = $multi_image_name;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Blog Details Created Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Details Does Not Created Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function all_blog(){

        $all_blog = Blog::where('delete_status',0)->get();

        return view('admin.blog.all_blog',compact('all_blog'));
    }

    public function blog_edit($id){

        $blog = Blog::find($id);

        return view('admin.blog.edit_blog',compact('blog'));
    }

    public function blog_update(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'id' => ['required'],
            'short_title' => ['required', 'string'],
            'short_des' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'cetagory_id' => ['required']
        ]);

        $data = Blog::find($request->id);

        $data->title = $request->title;
        $data->short_title = $request->short_title;
        $data->short_des = $request->short_des;
        $data->long_des = $request->long_des;
        $data->cetagory_id = $request->cetagory_id;

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

        $files = $request->file('blog_multi_img');

        if($files!='')
        {
            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();

                $title_name = str_replace(' ','_',$request->title);

                $fileName = $title_name.'_multi_img_'.time().'_'.uniqid().'.'.$extension;

                Image::make($file)->resize(500,500)->save('backend/blog/'.$fileName);

                if($multi_image_name!=''){

                    $multi_image_name .="***";
                }

                $multi_image_name .= $fileName;
            }
        }

        $data->blog_multi_img = $multi_image_name;

        if ($request->hasFile('blog_img')) {

            $file = $request->file('blog_img');

            $extension = $file->getClientOriginalExtension();

            $title_name = str_replace(' ','_',$request->title);

            $fileName1 = $title_name.'_'.time().'.'.$extension;

            Image::make($file)->resize(1020,519)->save('backend/blog/'.$fileName1);

            if($data->blog_img!='')
            {
                $deletePhoto = "backend/blog/".$data->blog_img;
                
                if(file_exists($deletePhoto)){

                    unlink($deletePhoto);
                }
            }

            $data->blog_img = $fileName1;
        }

        $data->save();

        if($data==true){

            if($delete_image_value!=''){

                $delete_image_value = explode("***",$delete_image_value);

                foreach($delete_image_value as $value){

                    $filename = 'backend/blog/'.$value;

                    if(file_exists($filename))
                    {
                        $deletePhoto = "backend/blog/".$value;
                        
                        if(file_exists($deletePhoto)){

                            unlink($deletePhoto);
                        }
                    }
                }
            }

            $notification = array(
                'message'=> "Blog Details Updated Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Details Does Not Updated Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function blog_view($id){

        
    }

    public function change_blog_publish_status($id){

        $data = Blog::find($id);

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
                'message'=> " Blog Details Published Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function change_blog_active_status($id){

        $data = Blog::find($id);

        $published_data = Blog::where("published_status", 1)->where("delete_status", 0)->where('id', $id)->first();

        if($published_data==true){
            
            $notification = array(
                'message'=> "You Can Not Change Published Blog Details Active Status",
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
                'message'=> "Blog Details Active Status Changed Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Details Does Not Active Status Changed Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function blog_delete($id){

        $data = Blog::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Blog Details Deleted Successfully",
                'alert-type'=>'info'
            );

            return redirect()->route('admin.all.blog')->with($notification);
        }
        else{

            $notification = array(
                'message'=> "Blog Details Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function blog_details($slug){

        $blog = DB::table('blog_categories')
        ->join('blogs', 'blog_categories.id', '=', 'blogs.cetagory_id')
        ->select('blogs.*', 'blog_categories.title as cat_title' , 'blog_categories.slug as cat_slug')
        ->where("blogs.published_status", 1)
        ->where("blogs.slug", $slug)
        ->where('blogs.delete_status',0)
        ->where("blogs.status_active", 1)
        ->where("blog_categories.published_status", 1)
        ->where('blog_categories.delete_status',0)
        ->where("blog_categories.status_active", 1)
        ->first();

        return view('frontend.blog_details',compact('blog'));
    }

    public function add_comment(Request $request){

        $request->validate([

            'name' => ['required', 'string'],
            'email' => ['required','email'],
            'message' => ['required']
        ]);

        $data = new Comment;

        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->comments = $request->message;
        $data->website = $request->website;
        $data->blog_id = $request->blog_id;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Your Comment Submited Successfully, Please Wait For Confirmation",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Your Comment Does Not Submited Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function blog_comment(){

        $blog_comments = DB::table('comments')
        ->join('blogs', 'blogs.id', '=', 'comments.blog_id')
        ->select('blogs.*', 'comments.*' , 'comments.published_status as comments_published_status')
        ->where("blogs.published_status", 1)
        ->where('blogs.delete_status',0)
        ->where("blogs.status_active", 1)
        ->where('comments.delete_status',0)
        ->where("comments.status_active", 1)
        ->get();

        $all_blog = Blog::where('delete_status',0)->get();

        return view('admin.blog.all_blog_comment',compact('blog_comments'));
    }

    public function change_comment_publish_status($id){

        $data = Comment::find($id);

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
                'message'=> " Blog comments Details Published Changed Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Blog comments Details Does Not Published Successfully",
                'alert-type'=>'warning'
            );

        }

        return redirect()->back()->with($notification);

    }

    public function comment_delete($id){

        $data = Comment::find($id);

        $data->status_active = 0;
        $data->published_status = 0;
        $data->delete_status = 1;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Blog Comments Deleted Successfully",
                'alert-type'=>'info'
            );

        }
        else{

            $notification = array(
                'message'=> "Blog Comments Does Not Deleted Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function all_blog_details(){

        $offset = 0;
        if(isset($_GET['ofset'])){
            
            $offset = $_GET['ofset'];
        }

        $all_blog = DB::table('blog_categories')
            ->join('blogs', 'blog_categories.id', '=', 'blogs.cetagory_id')
            ->select('blogs.*', 'blog_categories.title as cat_title' , 'blog_categories.slug as cat_slug')
            ->where("blogs.published_status", 1)
            ->where('blogs.delete_status',0)
            ->where("blogs.status_active", 1)
            ->where("blog_categories.published_status", 1)
            ->where('blog_categories.delete_status',0)
            ->where("blog_categories.status_active", 1)
            ->take(10)
            ->skip($offset)
            ->get();

        if(isset($_GET['ofset'])){
            
            return view('frontend.home_all.all_blog',compact('all_blog'));
        }
        else{

            return view('frontend.all_blog',compact('all_blog'));
        }
  
    }

    public function blog_cetagory_details($slug){

        $offset = 0;
        if(isset($_GET['ofset'])){
            
            $offset = $_GET['ofset'];
        }

        $slug = $slug;
        
        $all_blog = DB::table('blog_categories')
            ->join('blogs', 'blog_categories.id', '=', 'blogs.cetagory_id')
            ->select('blogs.*', 'blog_categories.title as cat_title' , 'blog_categories.slug as cat_slug')
            ->where("blogs.published_status", 1)
            ->where('blogs.delete_status',0)
            ->where("blogs.status_active", 1)
            ->where("blog_categories.published_status", 1)
            ->where('blog_categories.delete_status',0)
            ->where("blog_categories.status_active", 1)
            ->where("blog_categories.slug", $slug)
            ->take(10)
            ->skip($offset)
            ->get();

        if(isset($_GET['ofset'])){
            
            return view('frontend.home_all.all_blog',compact('all_blog'));
        }
        else{

            return view('frontend.all_category_blog',compact('all_blog','slug'));
        }
  
    }
}
