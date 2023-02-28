
@extends('admin.admin_master')

@section('content')
<title>{!!$system_settings->name!!} - Edit Working Process Details - {{$process->title}}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Working Process Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.all.process')}}">All Working Process</a></li>
                            <li class="breadcrumb-item active">Edit Working Process Details</li>
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
                        <form method="POST" autocomplete="off" action="{{route('admin.update.process')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Working Process Step</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="process_step" id="process_step" type="text" placeholder="Enter Working Process Step" value="{{$process->process_step}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Working Process Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Working Process Title" value="{{$process->title}}" required>
                                    <input class="form-control" name="id" id="id" type="hidden" value="{{$process->id}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Working Process Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="long_des" id="long_des" placeholder="Enter Working Process Description" required>{!!$process->long_des!!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Working Process Icon</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="icon" src="{{asset('backend/workign_process/')}}/{{!empty(($process->workign_processes_icon))? $process->workign_processes_icon : 'banner_img.png'}}"/>
                                    <input onchange="readUrl_icon(this);" accept="image/*" class="form-control" name="workign_processes_icon" id="workign_processes_icon" type="file" placeholder="Upload Slider Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Update Working Process" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<script type="text/javascript">
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
    CKEDITOR.replace('long_des');
</script>
@endsection