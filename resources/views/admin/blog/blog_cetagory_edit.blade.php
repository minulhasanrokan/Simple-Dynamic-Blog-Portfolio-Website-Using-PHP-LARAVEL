
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - Edit Blog Category - {{$blog_cetagory->title}}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Blog Category Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.all.blog.cetagory')}}">All Blog Category</a></li>
                            <li class="breadcrumb-item active">Add Blog Category Details</li>
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
                        <form method="POST" action="{{route('admin.update.blog.category')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" value="{{$blog_cetagory->title}}" name="title" id="title" type="text" placeholder="Enter Category Title" required>
                                    <input class="form-control" value="{{$blog_cetagory->id}}" name="id" id="id" type="hidden" placeholder="Enter Category Title" required>
                                    @error('title')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Short Title</label>
                                <div class="col-sm-10">
                                     <input class="form-control" name="short_title" id="short_title" type="text" placeholder="Enter Short Category Title" value="{{$blog_cetagory->short_title}}" required>
                                     @error('short_title')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_des" id="short_des" placeholder="Enter Category Short Description" required>{{$blog_cetagory->short_des}}</textarea>
                                    @error('short_des')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">

                                    <textarea class="form-control" name="long_des" id="long_des" placeholder="Enter Category Long Description" required>{{$blog_cetagory->long_des}}</textarea>
                                    @error('long_des')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Photo</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="photo" src="{{asset('backend/blog/')}}/{{!empty(($blog_cetagory->cat_img))? $blog_cetagory->cat_img : 'banner_img.png'}}"/>
                                    <input onchange="readUrl(this);" accept="image/*" class="form-control" name="cat_img" id="cat_img" type="file" placeholder="Upload Slider Photo">
                                    @error('cat_img')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Icon</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="icon" src="{{asset('backend/blog/')}}/{{!empty(($blog_cetagory->cat_icon))? $blog_cetagory->cat_icon : 'banner_img.png'}}"/>
                                    <input onchange="readUrl_icon(this);" accept="image/*" class="form-control" name="cat_icon" id="cat_icon" type="file" placeholder="Upload Slider Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Update Category" class="btn btn-info">
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
    function readUrl_icon(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#icon').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script type="text/javascript">
    CKEDITOR.replace('short_des');
    CKEDITOR.replace('long_des');
</script>
@endsection