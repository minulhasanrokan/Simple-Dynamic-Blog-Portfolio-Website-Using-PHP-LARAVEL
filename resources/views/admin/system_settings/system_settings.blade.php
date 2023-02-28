
@extends('admin.admin_master')

@section('content')
<title>{!!$system_settings->name!!} - System Setting</title>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add System Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add System Details</li>
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
                        <form method="POST" autocomplete="off" action="{{route('admin.system.settings.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter System Title" value="{{$system_data['title']}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Enter System Name" value="{{$system_data['name']}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System E-mail</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Enter System E-mail" value="{{$system_data['email']}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Mobile</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter System Mobile" value="{{$system_data['mobile']}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Country</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="country" id="country" type="text" placeholder="Enter System Country" value="{{$system_data['country']}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="address" id="address" type="text" placeholder="Enter System Address" value="{{$system_data['address']}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Contuct Us Text</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="contuct_us_text" id="contuct_us_text" placeholder="Enter Contuct Us Text" required>{{$system_data['contuct_us_text']}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Social Link Text</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="social_link_text" id="social_link_text" placeholder="Enter Social Link Text" required>{{$system_data['social_link_text']}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Social Media</label>
                                <div class="col-sm-10">
                                    <table width="100%" cellpadding="0" cellspacing="2" border="0" class="rpt_table" rules="all" id="multi_social_media">
                                        <tbody id="multi_social_media_container">
                                            @php

                                                $social_media = $system_data['social_media'];

                                                $social_media_arr = explode("***",$social_media);

                                                $i = 1;

                                                $total_row = 1;

                                            @endphp
                                            @if(count($social_media_arr)>0)

                                                @php
                                                    $total_row = count($social_media_arr);

                                                @endphp

                                                @foreach($social_media_arr as $data_arr)

                                                    @php

                                                        $data = explode("___",$data_arr);

                                                        $social='';
                                                        $icon='';

                                                        if(isset($data[1])){

                                                            $social = $data[1];
                                                            $icon = $data[0];
                                                        }

                                                    @endphp
                                                    <tr id="row_{{$i}}">
                                                        <td align="center">
                                                            <select  name="socialMediaIcon_{{$i}}" style="width: 200px; float: left;" id="socialMediaIcon_{{$i}}" onchange="check_social_media_icon(this.id);" class="form-select" aria-label="Default select example">
                                                                <option @if($icon=='') selected @endif value="">Select Icon</option>
                                                                <option @if($icon=='facebook') selected @endif value="facebook">Facebook</option>
                                                                <option @if($icon=='twitter') selected @endif value="twitter">Twitter</option>
                                                                <option @if($icon=='linkedin') selected @endif value="linkedin">Linkedin</option>
                                                                <option @if($icon=='youtube') selected @endif value="youtube">Youtube</option>
                                                                <option @if($icon=='instagram') selected @endif value="instagram">Instagram</option>
                                                                <option @if($icon=='behance') selected @endif value="behance">Behance</option>
                                                                <option @if($icon=='pinterest') selected @endif value="pinterest">Pinterest</option>
                                                            </select>
                                                            <input style="width:650px" class="form-control" name="socialMedia_{{$i}}" id="socialMedia_{{$i}}" type="text" value="{{$social}}" placeholder="Enter Social Media Address">
                                                        </td>
                                                        <td>
                                                            <a id="addid_{{$i}}" onclick="add_social_media(this.id);" class="btn btn-primary"><i class="mdi mdi-plus"></i></a>
                                                            <a id="deleteid_{{$i}}" onclick="remove_social_media(this.id);" class="btn btn-primary"><i class="mdi mdi-minus"></i></a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <tr id="row_1">
                                                    <td align="center">
                                                        <select  name="socialMediaIcon_1" style="width: 200px; float: left;" id="socialMediaIcon_1" onchange="check_social_media_icon(this.id);" class="form-select" aria-label="Default select example">
                                                            <option selected="" value="">Select Icon</option>
                                                            <option value="facebook">Facebook</option>
                                                            <option value="twitter">Twitter</option>
                                                            <option value="linkedin">Linkedin</option>
                                                            <option value="youtube">Youtube</option>
                                                            <option value="instagram">Instagram</option>
                                                            <option value="behance">Behance</option>
                                                            <option value="pinterest">Pinterest</option>
                                                        </select>
                                                        <input style="width:650px" class="form-control" name="socialMedia_1" id="socialMedia_1" type="text" placeholder="Enter Social Media Address">
                                                    </td>
                                                    <td>
                                                        <a id="addid_1" onclick="add_social_media(this.id);" class="btn btn-primary"><i class="mdi mdi-plus"></i></a>
                                                        <a id="deleteid_1" onclick="remove_social_media(this.id);" class="btn btn-primary"><i class="mdi mdi-minus"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Copy Right Text</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="copy_right_text" id="copy_right_text" type="text" placeholder="Enter Copy Right Text" value="{{$system_data['copy_right_text']}}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Logo</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="system_logo" src="{{asset('backend/system/')}}/{{!empty(($system_data['logo']))? $system_data['logo'] : 'banner_img.png'}}"/>
                                    <input onchange="readUrl(this);" accept="image/*" class="form-control" name="logo" id="logo" type="file" placeholder="Upload Slider Photo">
                                    @error('logo')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Icon</label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" width="100" id="system_icon" src="{{asset('backend/system/')}}/{{!empty(($system_data['icon']))? $system_data['icon'] : 'banner_img.png'}}"/>
                                    <input onchange="readUrl_icon(this);" accept="image/*" class="form-control" name="icon" id="icon" type="file" placeholder="Upload Slider Photo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">System Location</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="location" id="location" type="text" placeholder="Enter System Location" value="{{$system_data['location']}}" required>
                                    <div id="contact-map">
                                    <iframe src="{{$system_data['location']}}"
                                        allowfullscreen loading="lazy"></iframe>
                                </div>
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Contact Link</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="contact_link" id="contact_link" type="text" placeholder="Enter Contact Link" value="{{$system_data['contact_link']}}" required>
                                </div>
                            </div>
                            <input class="form-control" name="total_row" value="{{$total_row}}" id="total_row" type="hidden">
                            <input style="float: right;" type="submit" value="Update System" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<script type="text/javascript">
    CKEDITOR.replace('contuct_us_text');
    CKEDITOR.replace('social_link_text');

    function add_social_media(id){

        var id_arr = id.split("_");
        var id = id_arr[1]*1;
       
        var row_num = $('#multi_social_media_container tr').length;
        var row_num1 = $('#multi_social_media_container tr').length;

        for(var k =1; k<=row_num;k++)
        {
            var social_media_value     = $('#socialMedia_'+k).val();

            var social_media_icon     = $('#socialMediaIcon_'+k).val();

            if(social_media_value=='' || social_media_icon=='')
            {
                alert("Please Fill Up Social Media Details, Then Add New Row!!!");
                return;
            }
        }

        row_num++;
        var clone= $("#row_"+id).clone();
        clone.attr({
            id: "row_" + row_num,
        });

        clone.find("input,select,a").each(function(){
            $(this).attr({ 
                'id': function(_, id) { var id=id.split("_"); return id[0] +"_"+ row_num },
                'name': function(_, name) { return name },
                'value': function(_, value) { return value }
            });
        }).end();

        $("#row_"+row_num1).after(clone);

        document.getElementById("socialMedia_"+row_num).value = '';
        document.getElementById("socialMediaIcon_"+row_num).value = '';


        $('#socialMedia_'+row_num).removeAttr("name");
        $('#socialMediaIcon_'+row_num).removeAttr("name");

        $('#socialMedia_'+row_num).attr("name","socialMedia_"+row_num);
        $('#socialMediaIcon_'+row_num).attr("name","socialMediaIcon_"+row_num);

        $('#total_row').val(row_num);

    }

    function remove_social_media(id){

        var id_arr = id.split("_");
        var id = id_arr[1]*1;

        var row_num = $('#multi_social_media_container tr').length;

        if(row_num!=1){

            $("#row_"+id).remove();

            var row_num = $('#multi_social_media_container tr').length;

            var j=1;

            for(var i=0; i<row_num;i++){

                //Remove attribute
                var val = i+j;
                $('#multi_social_media_container tr:eq(' + i + ')').removeAttr('id');
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(0) input:eq(0)').removeAttr('id');
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(0) select:eq(0)').removeAttr('id');
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(1) a:eq(0)').removeAttr('id');
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(1) a:eq(1)').removeAttr('id');

                $('#multi_social_media_container tr:eq(' + i + ') td:eq(0) input:eq(0)').removeAttr('name');
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(0) select:eq(0)').removeAttr('name');


                //add attribute
                $('#multi_social_media_container tr:eq(' + i + ')').attr('id','row_'+val);
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(0) input:eq(0)').attr('id','socialMedia_'+val);
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(0) select:eq(0)').attr('id','socialMediaIcon_'+val);
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(1) a:eq(0)').attr('id','addid_'+val);
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(1) a:eq(1)').attr('id','deleteid_'+val);

                $('#multi_social_media_container tr:eq(' + i + ') td:eq(0) input:eq(0)').attr("name","socialMedia_"+val);
                $('#multi_social_media_container tr:eq(' + i + ') td:eq(0) select:eq(0)').attr("name","socialMediaIcon_"+val);
                
            }

            $('#total_row').val(row_num);
        }
        else{

            return false;
        }
    }

    function check_social_media_icon(id){

        var value = $("#"+id).val();

        var id_arr = id.split("_");
        var id1 = id_arr[1]*1;

        var row_num = $('#multi_social_media_container tr').length;

        if(row_num!=1){

            for(var i=1; i<=row_num;i++){

                value1 = $("#socialMediaIcon_"+i).val();

                var new_id = "socialMediaIcon_"+i;

                if(value1==value && new_id!=id){

                    alert("Same  Social Media Multiple Time Not Allow");

                    $("#"+id).val('');
                    return;

                }
            }
        }
    }

    function readUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#system_logo').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readUrl_icon(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#system_icon').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection