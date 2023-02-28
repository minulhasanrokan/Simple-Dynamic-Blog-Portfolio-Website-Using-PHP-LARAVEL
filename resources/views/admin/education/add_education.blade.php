
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - Add Education Details</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Education Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Education Details</li>
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
                        <form method="POST" action="{{route('admin.store.education')}}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Education Title" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Institute Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="institute_name" id="institute_name" type="text" placeholder="Enter Institute Name" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Subject</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Education Subject" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Group</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="group" id="group" type="text" placeholder="Enter Education Group" value="" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Start And End Date</label>
                                <div class="col-sm-4">
                                    <input class="form-control" onchange="check_education_date();" name="start_date" id="start_date" type="date" placeholder="Enter Education Start Date" value="" required>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" onchange="check_education_date();" name="end_date" id="end_date" type="date" placeholder="Enter Education End Date" value="" required>
                                </div>
                                <div class="col-sm-2 form-check form-check-left" style="margin-top:10px;">
                                    <label class="form-check-label" for="continue_status">Continue Study</label> <input class="form-check-input" autocomplete="off" type="checkbox" onclick="set_continue_status(this.id);" name="continue_status" id="continue_status">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Result</label>
                                <div class="col-sm-5">
                                    <input class="form-control" name="result" id="result" type="text" placeholder="Enter Education Result" value="">
                                </div>
                                <div class="col-sm-5">
                                    <input class="form-control" name="out_of_result" id="out_of_result" type="text" placeholder="Enter Education Out Of Result" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_des" id="short_des" placeholder="Enter About Short Description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">

                                    <textarea class="form-control" name="long_des" id="long_des" placeholder="Enter About Long Description" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Photo</label>
                                <div class="col-sm-10">
                                    <input autocomplete="off" onchange="readUrl(this);" accept="image/*" class="form-control" name="edu_img[]" id="edu_img" type="file" multiple placeholder="Upload Education Photo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Icon</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="icon" src="{{asset('backend/about/banner_img.png')}}"/>
                                    <input autocomplete="off" onchange="readUrl_icon(this);" accept="image/*" class="form-control" name="edu_icon" id="edu_icon" type="file" placeholder="Upload Education Photo">
                                </div>
                            </div>
                            <input style="float: right;" type="submit" value="Add Education" class="btn btn-info">
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
    function  set_continue_status(id) {
        
        var yes = document.getElementById(id);
        
        if (yes.checked == true){

            $('#end_date').attr('disabled',true);
            $('#result').attr('disabled',true);
            $('#out_of_result').attr('disabled',true);

            $('#end_date').val('');
            $('#result').val('');
            $('#out_of_result').val('');
        }
        else{

            $('#end_date').attr('disabled',false);
            $('#result').attr('disabled',false);
            $('#out_of_result').attr('disabled',false);
        }
    }

    function check_education_date(){

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        if(end_date<start_date && start_date!='' && end_date!=''){

            alert("Start Date Can Not Be Grater Than End Date!!!");

            $('#start_date').val('');
            $('#end_date').val('');

            return;
        }
    }
</script>
<script type="text/javascript">
    CKEDITOR.replace('short_des');
    CKEDITOR.replace('long_des');
</script>
@endsection