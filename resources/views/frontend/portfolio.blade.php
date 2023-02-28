    
@extends('frontend.main_master')

@section('content')
   	<title>{!!$system_settings->name!!} - All Portfolio</title>
    <!-- breadcrumb-area -->
    <section class="breadcrumb__wrap">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="breadcrumb__wrap__content">
                        <h2 class="title">Case Study</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
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
    <!-- portfolio-area -->

    @php
	    $project_cetagory = Illuminate\Support\Facades\DB::table('project_cetagories')
	        ->join('portfolios', 'project_cetagories.id', '=', 'portfolios.cetagory_id')
	        ->select('project_cetagories.id', 'project_cetagories.title')
	        ->where("portfolios.published_status", 1)
	        ->where('portfolios.delete_status',0)
	        ->where("portfolios.status_active", 1)
	        ->where("project_cetagories.published_status", 1)
	        ->where('project_cetagories.delete_status',0)
	        ->where("project_cetagories.status_active", 1)
	        ->groupBy('project_cetagories.id','project_cetagories.title')
	        ->orderBy(DB::raw('RAND()'))
	        ->get();
	    
	    $project_portfolio = App\Models\Portfolio::where("published_status", 1)
	        ->where('delete_status',0)
	        ->where("status_active", 1)
	        ->orderBy(DB::raw('RAND()'))
	        ->get();
    @endphp

    <section style="padding-top:50px; padding-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="portfolio__inner__nav">
                        <button class="active" data-filter="*">all</button>
                        @foreach($project_cetagory as $cetagory)
                        	<button data-filter=".cat-{{$cetagory->id}}">{{$cetagory->title}}</button>
                    	@endforeach
                    </div>
                </div>
            </div>
            <div class="portfolio__inner__active">
            	@foreach($project_portfolio as $portfolio)
	                <div class="portfolio__inner__item grid-item cat-{{$portfolio->cetagory_id}}">
	                    <div class="row gx-0 align-items-center">
	                        <div class="col-lg-6 col-md-10">
	                            <div class="portfolio__inner__thumb">
	                                <a href="{{route('portfolio.details',$portfolio->slug)}}">
	                                    <img src="{{asset('backend/portfolio/')}}/{{!empty(($portfolio->portfolio_img))? $portfolio->portfolio_img : 'portfolio_img.jpg'}}" alt="{!!$portfolio->short_title!!}">
	                                </a>
	                            </div>
	                        </div>
	                        <div class="col-lg-6 col-md-10">
	                            <div class="portfolio__inner__content">
	                                <h2 class="title"><a href="{{route('portfolio.details',$portfolio->slug)}}">{!!$portfolio->title!!}</a></h2>
	                                {!!$portfolio->short_des!!}
	                                <a href="{{route('portfolio.details',$portfolio->slug)}}" class="link">View Case Study</a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- portfolio-area-end -->
     <!-- contact-area -->
    @include('frontend.get_in_tuch.long_get_in_tuch')
    <!-- contact-area-end -->
@endsection