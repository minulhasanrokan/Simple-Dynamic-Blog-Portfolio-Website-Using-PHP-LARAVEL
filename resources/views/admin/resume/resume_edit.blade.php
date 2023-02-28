@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - Edit Portfolio Category Details - {{$resume->title}}</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Resume Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Resume Details</li>
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
                        <form method="POST" autocomplete="off" action="{{route('admin.update.resume')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Resume Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Skill Title" value="{{$resume->title}}" required>
                                    <input class="form-control" name="id" id="id" type="hidden" placeholder="Enter Skill Title" value="{{$resume->id}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Resume File</label>
                                <div class="col-sm-10">
                                    <embed id="pdf" src="{{asset('backend/resume/')}}/{{$resume->cv_url}}" scrolling="auto" />
                                    <input onchange="readUrl(this);" accept="application/pdf" class="form-control" name="cv_url" id="cv_url" type="file" placeholder="Upload Resume">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Update Resume" class="btn btn-info">
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
                $('#pdf').attr('src', e.target.result).width(250).height(300);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection