
@extends('admin.admin_master')

@section('content')
<title>{!!$system_settings->name!!} - All Blog Comments</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Blog</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Blog</li>
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
                                    <th width="10" align="center">Image</th>
                                    <th width="300" align="center">Title</th>
                                    <th width="700" align="center">Comment</th>
                                    <th width="30" align="center">Publish Status</th>
                                    <th width="50" align="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blog_comments as $comment)
                                <tr>
                                    <td valign="middle">
                                        <img width="50" src="{{asset('backend/blog/')}}/{{!empty(($comment->blog_img))? $comment->blog_img : 'banner_img.png'}}" alt="{{$comment->title}}">
                                    </td>
                                    <td valign="middle">{!! Str::limit($comment->title, 40)!!}</td>
                                    <td valign="middle">{!! Str::limit($comment->comments, 100)!!}</td>
                                    <td align="center" valign="middle">
                                        @if($comment->comments_published_status==1)
                                            <span class="badge rounded-pill bg-primary">Published</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Un Published</span>
                                        @endif    
                                    </td>
                                    <td valign="middle">
                                        @if($comment->comments_published_status==1)
                                            <a href="{{route('admin.blog.comment.change_publish_status',$comment->id)}}" class="btn btn-danger"><i class="mdi mdi-power"></i></a>
                                        @else
                                            <a href="{{route('admin.blog.comment.change_publish_status',$comment->id)}}" class="btn btn-primary"><i class="mdi mdi-power"></i></a>
                                        @endif

                                        <a href="{{route('admin.blog.comment.delete',$comment->id)}}" class="btn btn-danger"><i class="mdi mdi-archive-arrow-down"></i></a>
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