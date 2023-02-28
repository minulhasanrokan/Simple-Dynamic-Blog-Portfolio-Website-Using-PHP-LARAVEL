
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - Edit About Multi Image - {{$award->title}}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Award Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.all.award')}}">Award</a></li>
                            <li class="breadcrumb-item active">Edit Award Details</li>
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
                        <form method="POST" action="{{route('admin.update.award')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Award Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Award Title" required value="{!!$award->title!!}">
                                    <input class="form-control" name="id" id="id" type="hidden" placeholder="Enter Home Slider Title" value="{{$award->id}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Award Short Title</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_title" id="short_title" placeholder="Enter Award Short Description" required>{!!$award->short_title!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_des" id="short_des" placeholder="Enter Award Short Description" required>{!!$award->short_des!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">

                                    <textarea class="form-control" name="long_des" id="long_des" placeholder="Enter Award Long Description" required>{!!$award->long_des!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Award Photo</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="photo" src="{{asset('backend/award/')}}/{{!empty(($award->award_img))? $award->award_img : 'banner_img.png'}}"/>
                                    <input onchange="readUrl(this);" accept="image/*" class="form-control" name="award_img" id="award_img" type="file" placeholder="Upload Award Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Update Award" class="btn btn-info">
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
    CKEDITOR.replace('short_title');
    CKEDITOR.replace('short_des');
    CKEDITOR.replace('long_des');
</script>
@endsection