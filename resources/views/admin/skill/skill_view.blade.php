
@extends('admin.admin_master')

@section('content')
<title>{!!$system_settings->name!!} - View Skill Details - {!!$skill->title!!}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">View About Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.all.about')}}">About</a></li>
                            <li class="breadcrumb-item active">View About Details</li>
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
                        <h2 class="card-title">{!!$skill->title!!}</h2>
                        <p class="card-title-desc">{!!$skill->short_title!!}</p>

                        <div class="">
                            <img src="{{asset('backend/skill/')}}/{{!empty(($skill->skill_img))? $skill->skill_img : 'banner_img.png'}}" class="img-fluid" alt="Responsive image">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <p class="card-title-desc">{!!$skill->short_des!!}</p>
                        </div>
                        <hr>
                        <div class="">
                            <p class="card-title-desc">{!!$skill->long_des!!}</p>
                        </div>
                        <a href="{{route('admin.skill.edit',$skill->id)}}" style="float: right;" class="btn btn-info">Edit Skill</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>

@endsection