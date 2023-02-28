@extends('frontend.main_master')

@section('content')
<!-- breadcrumb-area -->
<title>{!!$system_settings->name!!} - {!!$portfolio->title!!}</title>
<section class="breadcrumb__wrap">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="breadcrumb__wrap__content">
                    <h2 class="title">{!!$portfolio->short_title!!}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portfolio.cetagory.details',$portfolio->cat_slug)}}">{{$portfolio->cat_title}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$portfolio->title}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb__wrap__icon">
        <ul>
            <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon01.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon02.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon03.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon04.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon05.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/breadcrumb_icon06.png')}}" alt=""></li>
        </ul>
    </div>
</section>
<!-- breadcrumb-area-end -->

<!-- portfolio-details-area -->
<section class="services__details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="services__details__thumb">
                    <img src="{{asset('backend/portfolio/')}}/{{!empty(($portfolio->portfolio_img))? $portfolio->portfolio_img : 'banner_img.png'}}" alt="{{$portfolio->title}}">
                </div>
                <div class="services__details__content">
                    <h2 class="title">{!!$portfolio->short_title!!}</h2>
                    {!!$portfolio->short_des!!}
                    @if($portfolio->portfolio_multi_img!='')

	                    @php

	                        $image_arr = explode("***",$portfolio->portfolio_multi_img);

	                        $i=1;
	                    @endphp

	                    <div class="services__details__img">
	                        <div class="row">
	                        	@foreach($image_arr as $img)

		                    		@if($img!='')
		                            <div class="col-sm-4" @if($i>3 && $i%3==1) style="margin-top: 10px;" @endif>
		                                <img src="{{asset('backend/portfolio/')}}/{{!empty(($img))? $img : 'banner_img.png'}}" alt="{!!$portfolio->short_title!!}">
		                            </div>
		                             @endif

		                             @php
		                             	$i++;
		                             @endphp
                    			@endforeach
	                        </div>
	                    </div>
                    @endif
                    {!!$portfolio->long_des!!}
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="services__sidebar">
                    @include('frontend.get_in_tuch.short_get_in_tuch')
                    <div class="widget">
                        <h5 class="title">Project Information</h5>
                        <ul class="sidebar__contact__info">
                            <li><span>Date :</span>{!!date('d-m-Y', strtotime($portfolio->project_date))!!}</li>
                            <li><span>Location :</span>{!!$portfolio->project_location!!}</li>
                            <li><span>Client :</span>{!!$portfolio->project_client!!}</li>
                            <li class="cagegory"><span>Category :</span>
                                <a href="{{route('portfolio.cetagory.details',$portfolio->cat_slug)}}">{!!$portfolio->cat_title!!}</a>
                            </li>
                            <li><span>Project Link :</span> <a target="_blank" href="http://{!!$portfolio->project_link!!}">{!!$portfolio->project_link!!}</a></li>
                        </ul>
                    </div>
                    @include('frontend.get_in_tuch.short_contact_details')
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- portfolio-details-area-end -->


<!-- contact-area -->
@include('frontend.get_in_tuch.long_get_in_tuch')
<!-- contact-area-end -->

@endsection