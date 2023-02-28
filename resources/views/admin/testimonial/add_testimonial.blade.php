@extends('admin.admin_master')

@section('content')
<title>{!!$system_settings->name!!} - Add Testimonial Details</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Testimonial Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Testimonial Details</li>
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
                        <form method="POST" autocomplete="off" action="{{route('admin.store.testimonial')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Select Service</label>
                                <div class="col-sm-10">
                                    <select name="service_id" id="service_id" class="form-select" aria-label="Default select example" required>
                                        <option selected="">Select Service</option>
                                        @php

                                            $service_data = App\Models\Service::where("published_status", 1)
                                                        ->where('delete_status',0)
                                                        ->where("status_active", 1)
                                                        ->get()
                                        @endphp
                                        @foreach($service_data as $data)
                                        <option value="{{$data->id}}">{{$data->title}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Buyer Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="buyer_name" id="buyer_name" type="text" placeholder="Enter Buyer Name" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Buyer Website</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="buyer_website" id="buyer_website" type="text" placeholder="Enter Buyer Website" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Testimonial Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Testimonial Title" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Testimonial Short Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="short_title" id="short_title" type="text" placeholder="Enter Short Title" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_des" id="short_des" placeholder="Enter Testimonial Short Description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">

                                    <textarea class="form-control" name="long_des" id="long_des" placeholder="Enter Testimonial Long Description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Testimonial Multiple Image</label>
                                <div class="col-sm-10">
                                    <input accept="image/*" class="form-control" multiple name="testimonial_multi_img[]" id="testimonial_multi_img" type="file" placeholder="Upload Testimonial Multi Photo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Testimonial Photo</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="photo" src="{{asset('backend/about/banner_img.png')}}"/>
                                    <input onchange="readUrl(this);" accept="image/*" class="form-control" name="testimonial_img" id="testimonial_img" type="file" placeholder="Upload Testimonial Photo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Testimonial Icon</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="icon" src="{{asset('backend/about/banner_img.png')}}"/>
                                    <input onchange="readUrl_icon(this);" accept="image/*" class="form-control" name="testimonial_icon" id="testimonial_icon" type="file" placeholder="Upload Slider Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Add Testimonial" class="btn btn-info">
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