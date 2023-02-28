
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - Edit About Multi Image - {{$multi_image->title}}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit About Multi Image</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.all.multi.image')}}">All Multi Image</a></li>
                            <li class="breadcrumb-item active">Edit About Multi Image</li>
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
                        <form autocomplete="off" method="POST" action="{{route('admin.update.multi.image')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Image Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Image Title" value="{{$multi_image->title}}" required>
                                    <input class="form-control" name="hidden_image" id="hidden_image" type="hidden" required>
                                    <input class="form-control" name="hidden_all_image" id="hidden_all_image" type="hidden" value="{{$multi_image->multi_image}}" required>
                                    <input class="form-control" name="id" id="id" type="hidden" value="{{$multi_image->id}}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <label for="example-text-input" style="margin-right: 40px;" class="col-sm-2 col-form-label">All Images</label>
                                    @php

                                        $image_arr = explode("***",$multi_image->multi_image);

                                        $i=1;

                                    @endphp

                                    @foreach($image_arr as $img)
                                    @if($img!='')
                                    <a id="deleteid_{{$i}}" onclick="remove_image({{$i}});" class="btn btn-primary"><i class="mdi mdi-delete"></i></a><img id="imageid_{{$i}}" width="50" src="{{asset('backend/multi_image/')}}/{{!empty(($img))? $img : 'banner_img.png'}}" alt="{{$multi_image->title}}">
                                    <input class="form-control" name="imagevalue[]" id="imagevalue_{{$i}}" type="hidden" value="{{$img}}" required>
                                    @php
                                        $i++;
                                    @endphp
                                    @endif
                                    @endforeach
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
                                    <input onchange="readUrl(this);" accept="image/*" multiple class="form-control" name="multi_image[]" id="multi_image" type="file" placeholder="Upload Multi Image Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Update Multi Image" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<script type="text/javascript">
    
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
    document.getElementById('display_status').value = {{$multi_image->display_status}};
</script>
@endsection