
@extends('admin.admin_master')

@php

    $social_media = $user_data->social_media;

    $social_media_arr = explode("***",$social_media);


@endphp

@section('content')
<title>{!!$system_settings->name!!} - Profile - {{$user_data->name}}</title>
<div class="page-content">
    <div class="container-fluid">
         <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <center style="padding-top:20px ;">
                        <img class="rounded-circle avatar-xl" src="{{asset('backend/user/')}}/{{!empty(($user_data->profile_photo))? $user_data->profile_photo : 'No_image.jpg'}}" alt="User Profile Image">
                    </center>
                    
                    <div class="card-body">
                        <h4 class="card-title">Full Name  : {{$user_data->name}}</h4>
                        <hr>
                        <h4 class="card-title">User Email : {{$user_data->email}}</h4>
                        <hr>
                        <h4 class="card-title">User Name  : {{$user_data->user_name}}</h4>
                        <hr>
                        <a class="btn btn-info btn-rounded waves-effect waves-light" href="{{route('edit.profile')}}">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <center style="padding-top:20px ;">
                        <h2>Contact Information</h2>
                    </center>
                    
                    <div class="card-body">
                        <h4 class="card-title">Address  : {!!$user_data->address!!}</h4>
                        <h4 class="card-title">Mobile  : {!!$user_data->mobile!!}</h4>
                        <hr>
                        <h4 class="card-title">Social Media :
                            @if(count($social_media_arr)>0)
                                @foreach($social_media_arr as $data_arr)
                                    @php

                                        $data = explode("___",$data_arr);

                                        $social='';
                                        $icon='';

                                        if(isset($data[1])){

                                            $social = $data[1];
                                            $icon = $data[0];
                                        }
                                    @endphp
                                    <a target="_blank" href="http://{{$social}}"><i class="fab fa-{{$icon}}"></i></a>
                                @endforeach
                            @endif
                        </h4>
                        <hr>
                        <a class="btn btn-info btn-rounded waves-effect waves-light" href="{{route('edit.contact.information')}}">Edit Contact Information</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row --> 
    </div> <!-- container-fluid -->
</div>
@endsection