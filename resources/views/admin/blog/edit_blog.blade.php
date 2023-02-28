
@extends('admin.admin_master')

@section('content')
<title>{!!$system_settings->name!!} - Edit Blog - {{$blog->title}}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Blog Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.all.blog')}}">All Blog</a></li>
                            <li class="breadcrumb-item active">Edit Blog Details</li>
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
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif
                        <form method="POST" autocomplete="off" action="{{route('admin.update.blog')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Blog Title" value="{{$blog->title}}" required>
                                    <input class="form-control" name="id" id="id" type="hidden" value="{{$blog->id}}" required>
                                    <input class="form-control" name="hidden_image" id="hidden_image" type="hidden" required>
                                    <input class="form-control" name="hidden_all_image" id="hidden_all_image" type="hidden" value="{{$blog->blog_multi_img}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Short Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="short_title" id="short_title" type="text" placeholder="Enter Short Title" value="{{$blog->short_title}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_des" id="short_des" placeholder="Enter blog Short Description" required>{!!$blog->short_des!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">

                                    <textarea class="form-control" name="long_des" id="long_des" placeholder="Enter blog Long Description" required>{!!$blog->long_des!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">blog Cetagory</label>
                                <div class="col-sm-10">
                                    <select name="cetagory_id" id="cetagory_id" class="form-select" aria-label="Default select example" required>
                                        <option selected="">Select Cetagory</option>
                                        @php
                                            $cetagory = App\Models\BlogCategory::where("published_status", 1)
                                                        ->where('delete_status',0)
                                                        ->where("status_active", 1)
                                                        ->get()
                                        @endphp
                                        @foreach($cetagory as $data)
                                        <option value="{{$data->id}}">{{$data->title}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Photo</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="photo" src="{{asset('backend/blog/')}}/{{!empty(($blog->blog_img))? $blog->blog_img : 'banner_img.png'}}"/>
                                    <input onchange="readUrl(this);" accept="image/*" class="form-control" name="blog_img" id="blog_img" type="file" placeholder="Upload Slider Photo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <label for="example-text-input" style="margin-right: 40px;" class="col-sm-2 col-form-label">All Blog Multiple Image</label>
                                    @php

                                        $image_arr = explode("***",$blog->blog_multi_img);

                                        $i=1;

                                    @endphp

                                    @foreach($image_arr as $img)
                                    @if($img!='')
                                    <a id="deleteid_{{$i}}" onclick="remove_image({{$i}});" class="btn btn-primary"><i class="mdi mdi-delete"></i></a><img id="imageid_{{$i}}" width="50" src="{{asset('backend/blog/')}}/{{!empty(($img))? $img : 'banner_img.png'}}" alt="{{$blog->title}}">
                                    <input class="form-control" name="imagevalue[]" id="imagevalue_{{$i}}" type="hidden" value="{{$img}}" required>
                                    @php
                                        $i++;
                                    @endphp
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Multiple Image</label>
                                <div class="col-sm-10">
                                    <input accept="image/*" class="form-control" multiple name="blog_multi_img[]" id="blog_multi_img" type="file" placeholder="Upload Blog Multi Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Update Blog" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<script type="text/javascript">
    function readUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#photo').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function remove_image(id) {
        
        var hidden_image_value = $('#hidden_image').val();

        var image_name = $('#imagevalue_'+id).val();

        if(hidden_image_value!=''){

            hidden_image_value =hidden_image_value+"***"+image_name;
        }
        else{

            hidden_image_value =image_name;
        }

        $('#hidden_image').val(hidden_image_value);

        $('#deleteid_'+id).remove();
        $('#imageid_'+id).remove();
        $('#imagevalue_'+id).remove();
    }
    document.getElementById('cetagory_id').value = {{$blog->cetagory_id}}
</script>
<script type="text/javascript">
    CKEDITOR.replace('short_des');
    CKEDITOR.replace('long_des');
</script>
@endsection