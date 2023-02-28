
@extends('admin.admin_master')


@section('content')
<title>{!!$system_settings->name!!} - All Portfolio Category</title>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Portfolio Cetagory</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Portfolio Cetagory</li>
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
                        <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th align="center">Image</th>
                                    <th align="center">Title</th>
                                    <th align="center">Publish Status</th>
                                    <th align="center">Status</th>
                                    <th width="50" align="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_cetagory as $cetagory)
                                <tr>
                                    <td valign="middle">
                                        <img width="50" src="{{asset('backend/portfolio/')}}/{{!empty(($cetagory->cetagory_img))? $cetagory->cetagory_img : 'banner_img.png'}}" alt="Home about Avatar">
                                    </td>
                                    <td valign="middle">{!! Str::limit($cetagory->title, 40)!!}</td>
                                    <td align="center" valign="middle">
                                        @if($cetagory->published_status==1)
                                            <span class="badge rounded-pill bg-primary">Published</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Un Published</span>
                                        @endif    
                                    </td>
                                    <td valign="middle">
                                        @if($cetagory->status_active==1)
                                            <span class="badge rounded-pill bg-primary">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td valign="middle">
                                        <a href="{{route('admin.portfolio.cetagory.edit',$cetagory->id)}}" class="btn btn-info"><i style="width:100px;" class="mdi mdi-book-edit"></i></a>
                                        <a href="{{route('admin.portfolio.cetagory.view',$cetagory->id)}}" class="btn btn-info"><i style="width:100px;" class="mdi mdi-monitor-eye"></i></a>
                                        @if($cetagory->published_status==1)
                                            <a href="{{route('admin.portfolio.cetagory.change_publish_status',$cetagory->id)}}" class="btn btn-danger"><i class="mdi mdi-power"></i></a>
                                        @else
                                            <a href="{{route('admin.portfolio.cetagory.change_publish_status',$cetagory->id)}}" class="btn btn-primary"><i class="mdi mdi-power"></i></a>
                                        @endif

                                        @if($cetagory->status_active==1)
                                            <a href="{{route('admin.portfolio.cetagory.change_active_status',$cetagory->id)}}" class="btn btn-danger"><i class="mdi mdi-archive-arrow-down"></i></a>
                                        @else
                                            <a href="{{route('admin.portfolio.cetagory.change_active_status',$cetagory->id)}}" class="btn btn-primary"><i class="mdi mdi-archive-arrow-up"></i></a>
                                        @endif

                                        <a href="{{route('admin.portfolio.cetagory.delete',$cetagory->id)}}" class="btn btn-danger"><i style="width:100px;" class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container-fluid -->
</div>
@endsection