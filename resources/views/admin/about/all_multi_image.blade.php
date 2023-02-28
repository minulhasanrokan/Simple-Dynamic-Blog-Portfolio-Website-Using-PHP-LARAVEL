
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - All Multi Images</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Multi Images</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Multi Images</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th align="center">Images</th>
                                    <th align="center">Title</th>
                                    <th align="center">Display Section</th>
                                    <th align="center">Publish Status</th>
                                    <th align="center">Status</th>
                                    <th width="50" align="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_multi_images as $image)
                                <tr>
                                    <td valign="middle">
                                        @php

                                            $image_arr = explode("***",$image->multi_image);

                                        @endphp

                                        @foreach($image_arr as $img)
                                        <a href="{{asset('backend/multi_image/')}}/{{!empty(($img))? $img : 'banner_img.png'}}" target="_blank"><img width="50" src="{{asset('backend/multi_image/')}}/{{!empty(($img))? $img : 'banner_img.png'}}" alt="{{$image->title}}"></a>
                                        @endforeach

                                    </td>
                                    <td valign="middle">{!! Str::limit($image->title, 40)!!}</td>
                                    <td valign="middle">Section {!! $image->display_status!!}</td>
                                    <td align="center" valign="middle">
                                        @if($image->published_status==1)
                                            <span class="badge rounded-pill bg-primary">Published</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Un Published</span>
                                        @endif    
                                    </td>
                                    <td valign="middle">
                                        @if($image->status_active==1)
                                            <span class="badge rounded-pill bg-primary">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td valign="middle">
                                        <a href="{{route('admin.multi.image.edit',$image->id)}}" class="btn btn-info"><i style="width:100px;" class="mdi mdi-book-edit"></i></a>
                                        @if($image->published_status==1)
                                            <a href="{{route('admin.multi.image.change_publish_status',$image->id)}}" class="btn btn-danger"><i class="mdi mdi-power"></i></a>
                                        @else
                                            <a href="{{route('admin.multi.image.change_publish_status',$image->id)}}" class="btn btn-primary"><i class="mdi mdi-power"></i></a>
                                        @endif

                                        @if($image->status_active==1)
                                            <a href="{{route('admin.multi.image.change_active_status',$image->id)}}" class="btn btn-danger"><i class="mdi mdi-archive-arrow-down"></i></a>
                                        @else
                                            <a href="{{route('admin.multi.image.change_active_status',$image->id)}}" class="btn btn-primary"><i class="mdi mdi-archive-arrow-up"></i></a>
                                        @endif

                                        <a href="{{route('admin.multi.image.delete',$image->id)}}" class="btn btn-danger"><i style="width:100px;" class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container-fluid -->
</div>
@endsection