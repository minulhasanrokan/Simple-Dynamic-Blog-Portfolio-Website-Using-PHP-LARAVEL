
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - Add About Multi Image</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add About Multi Image</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add About Multi Image</li>
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
                        <form autocomplete="off" method="POST" action="{{route('admin.store.multi.image')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">About Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter About Title" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Display Section</label>
                                <div class="col-sm-10">
                                    <select name="display_status" id="display_status" class="form-select" aria-label="Default select example" required>
                                        <option value="0">Select Display Section</option>
                                        <option value="1">Section 1</option>
                                        <option value="2">Section 2</option>
                                        <option value="3">Section 3</option>
                                        </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">About Photo</label>
                                <div class="col-sm-10">
                                    <input onchange="readUrl(this);" accept="image/*" multiple class="form-control" name="multi_image[]" id="multi_image" type="file" placeholder="Upload Slider Photo" required>
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Add Multi Image" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
@endsection