<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Partners;
use Image;
use DB;

class PartnersController extends Controller
{

    public function admin_partners(){

        $data = Partners::where('delete_status',0)
            ->where('id',1)
            ->first();

        $title_data = array();
        if($data!=''){
            $title_data['title']=$data->title;
            $title_data['long_des']=$data->long_des;
            $title_data['conversion_url']=$data->conversion_url;
            $title_data['id']=$data->id;
        }
        else{
            $title_data['title']='';
            $title_data['long_des']='';
            $title_data['conversion_url']='';
            $title_data['id']='';
        }

        return view('admin.partners.partners',compact('title_data'));
    }

    public function partners_store(Request $request){

        $request->validate([

            'title' => ['required', 'string'],
            'long_des' => ['required', 'string'],
            'conversion_url' => ['required', 'string']
        ]);

        $data = Partners::where('delete_status',0)
            ->where('id',1)
            ->first();

        if($data==''){

            $data = new Partners;

            $data->slug = SlugService::createSlug(Partners::class, 'slug',$request->title);
        }

        $data->title = $request->title;
        $data->long_des = $request->long_des;
        $data->conversion_url = $request->conversion_url;

        $data->save();

        if($data==true){

            $notification = array(
                'message'=> "Partners Title Created Successfully",
                'alert-type'=>'info'
            );
        }
        else{

            $notification = array(
                'message'=> "Partners Title Does Not Created Successfully",
                'alert-type'=>'warning'
            );
        }

        return redirect()->back()->with($notification);
    }
     
}
