
@extends('admin.admin_master')

@section('content')
<title>{!!$system_settings->name!!} - View Home Slide Details - {{$home_slide->title}}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">View Home Slide</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.home.slide')}}">Home Slider</a></li>
                            <li class="breadcrumb-item active">View Home Slide</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">{!!$home_slide->title!!}</h2>
                        <p class="card-title-desc">{!!$home_slide->short_des!!}</p>
                        <div class="">
                            <img src="{{asset('backend/slider/')}}/{{!empty(($home_slide->slide_img))? $home_slide->slide_img : 'banner_img.png'}}" class="img-fluid" alt="Responsive image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <iframe width="100%" height="345" src="{{$home_slide->video_url}}"></iframe>
                        </div>
                        <hr>
                        <div class="">
                            <p class="card-title-desc">{!!$home_slide->long_des!!}</p>
                        </div>
                        <a href="{{route('admin.slider.edit',$home_slide->id)}}" style="float: right;" class="btn btn-info">Edit Slider</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>

@endsection