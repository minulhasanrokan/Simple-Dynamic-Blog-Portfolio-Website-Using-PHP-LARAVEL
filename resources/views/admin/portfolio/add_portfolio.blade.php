
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - Add Portfolio Details</title>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Portfolio Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Portfolio Details</li>
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
                        <form method="POST" autocomplete="off" action="{{route('admin.store.portfolio')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Portfolio Title" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Short Title</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_title" id="short_title" placeholder="Enter Portfolio Short Description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_des" id="short_des" placeholder="Enter Portfolio Short Description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">

                                    <textarea class="form-control" name="long_des" id="long_des" placeholder="Enter Portfolio Long Description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Cetagory</label>
                                <div class="col-sm-10">
                                    <select name="  cetagory_id" id="  cetagory_id" class="form-select" aria-label="Default select example" required>
                                        <option selected="">Select Cetagory</option>
                                        @php

                                            $cetagory = App\Models\ProjectCetagory::where("published_status", 1)
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
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="project_date" id="project_date" type="date" placeholder="Enter Portfolio Date" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Location</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="project_location" id="project_location" type="text" placeholder="Enter Portfolio Location" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Client</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="project_client" id="project_client" type="text" placeholder="Enter Portfolio Client" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Link</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="project_link" id="project_link" type="text" placeholder="Enter Portfolio Link" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Photo</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="photo" src="{{asset('backend/about/banner_img.png')}}"/>
                                    <input onchange="readUrl(this);" accept="image/*" class="form-control" name="portfolio_img" id="portfolio_img" type="file" placeholder="Upload Portfolio Photo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Multiple Image</label>
                                <div class="col-sm-10">
                                    <input accept="image/*" class="form-control" multiple name="portfolio_multi_img[]" id="portfolio_multi_img" type="file" placeholder="Upload Portfolio Multi Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Add Portfolio" class="btn btn-info">
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
</script>
<script type="text/javascript">
    CKEDITOR.replace('short_des');
    CKEDITOR.replace('long_des');
</script>
@endsection