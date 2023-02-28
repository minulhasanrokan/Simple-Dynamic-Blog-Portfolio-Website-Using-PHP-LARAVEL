
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - Edit About Details - {{$about->title}}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit About Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.all.about')}}">About</a></li>
                            <li class="breadcrumb-item active">Edit About Details</li>
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
                        <form method="POST" action="{{route('admin.update.about')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">About Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter About Title" required value="{!!$about->title!!}">
                                    <input class="form-control" name="id" id="id" type="hidden" placeholder="Enter Home Slider Title" value="{{$about->id}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">About Short Title</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_title" id="short_title" placeholder="Enter About Short Description" required>{!!$about->short_title!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_des" id="short_des" placeholder="Enter About Short Description" required>{!!$about->short_des!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">

                                    <textarea class="form-control" name="long_des" id="long_des" placeholder="Enter About Long Description" required>{!!$about->long_des!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Display Section</label>
                                <div class="col-sm-10">
                                    <select name="display_status" id="display_status" class="form-select" aria-label="Default select example" required>
                                        <option selected="">Select Display Section</option>
                                        <option value="1">Home Page</option>
                                        <option value="2">About Page</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">About Photo</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="photo" src="{{asset('backend/about/')}}/{{!empty(($about->about_img))? $about->about_img : 'banner_img.png'}}"/>
                                    <input onchange="readUrl(this);" accept="image/*" class="form-control" name="about_img" id="about_img" type="file" placeholder="Upload Slider Photo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">About Icon</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="icon" src="{{asset('backend/about/')}}/{{!empty(($about->about_icon))? $about->about_icon : 'banner_img.png'}}"/>
                                    <input onchange="readUrl_icon(this);" accept="image/*" class="form-control" name="about_icon" id="about_icon" type="file" placeholder="Upload Slider Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Update About" class="btn btn-info">
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
    document.getElementById('display_status').value = {{$about->display_status}};
</script>
<script type="text/javascript">
    CKEDITOR.replace('short_title');
    CKEDITOR.replace('short_des');
    CKEDITOR.replace('long_des');
</script>
@endsection