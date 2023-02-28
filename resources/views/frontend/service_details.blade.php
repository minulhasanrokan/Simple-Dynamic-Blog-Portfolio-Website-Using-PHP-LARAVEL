@extends('frontend.main_master')

@section('content')
<!-- breadcrumb-area -->
<title>{!!$system_settings->name!!} - {!!$service->title!!}</title>
<section class="breadcrumb__wrap">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="breadcrumb__wrap__content">
                    <h2 class="title">{!!$service->title!!}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('service.details',$service->slug)}}">{{$service->title}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$service->title}}</li>
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

<section class="standard__blog blog__details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="standard__blog__post">
                    <div class="standard__blog__thumb">
                        <img src="{{asset('backend/service/')}}/{{!empty(($service->service_img))? $service->service_img : 'banner_img.png'}}" alt="{{$service->title}}">
                    </div>
                    <div class="blog__details__content services__details__content">
                        <ul class="blog__post__meta">
                            <li><i class="fal fa-calendar-alt"></i>{{date("d-F-Y",strtotime($service->created_at))}}</li>
                        </ul>
                        <h2 class="title">{!!$service->title!!}</h2>
                        <h4 class="title">{!!$service->short_title!!}</h4>
                        {!!$service->short_des!!}

                        @if($service->service_multi_img!='')

                        @php

                            $image_arr = explode("***",$service->service_multi_img);

                            $i=1;
                        @endphp

                        <div class="services__details__img">
                            <div class="row">
                                @foreach($image_arr as $img)

                                    @if($img!='')
                                    <div class="col-sm-4" @if($i>3 && $i%3==1) style="margin-top: 10px;" @endif>
                                        <img src="{{asset('backend/service/')}}/{{!empty(($img))? $img : 'banner_img.png'}}" alt="{!!$service->short_title!!}">
                                    </div>
                                     @endif

                                     @php
                                        $i++;
                                     @endphp
                                @endforeach
                            </div>
                        </div>
                        @endif
                        {!!$service->long_des!!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="blog__sidebar">
                    <div class="widget">
                        <h4 class="widget-title">Recent Blog</h4>
                        @php

                            $all_blog = Illuminate\Support\Facades\DB::table('blogs')
                                ->inRandomOrder()
                                ->join('blog_categories', 'blog_categories.id', '=', 'blogs.cetagory_id')
                                ->select('blog_categories.title as cat_title', 'blog_categories.slug as cat_slug', 'blogs.*')
                                ->where("blogs.published_status", 1)
                                ->where('blogs.delete_status',0)
                                ->where("blogs.status_active", 1)
                                ->where("blog_categories.published_status", 1)
                                ->where('blog_categories.delete_status',0)
                                ->where("blog_categories.status_active", 1)
                                ->orderBy('blogs.id', 'DESC')
                                ->limit(10)
                                ->get();

                        @endphp
                        <ul class="rc__post">
                            @foreach($all_blog as $blog)
                            <li class="rc__post__item">
                                <div class="rc__post__thumb">
                                    <a href="{{route('blog.details',$blog->slug)}}"><img src="{{asset('backend/blog/')}}/{{!empty(($blog->blog_img))? $blog->blog_img : 'blog_thumb01.jpg'}}" alt="{!!$blog->title!!}" height="100"></a>
                                </div>
                                <div class="rc__post__content">
                                    <h5 class="title"><a href="{{route('blog.details',$blog->slug)}}">{!!$blog->title!!}</a></h5>
                                    <span class="post-date"><i class="fal fa-calendar-alt"></i>{{date("d F Y",strtotime($blog->created_at))}}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">

                        @php

                            $all_cat = Illuminate\Support\Facades\DB::table('blogs')
                                ->join('blog_categories', 'blog_categories.id', '=', 'blogs.cetagory_id')
                                ->select('blog_categories.*',DB::raw('COUNT(blogs.id) as total_blog'))
                                ->where("blogs.published_status", 1)
                                ->where('blogs.delete_status',0)
                                ->where("blogs.status_active", 1)
                                ->where("blog_categories.published_status", 1)
                                ->where('blog_categories.delete_status',0)
                                ->where("blog_categories.status_active", 1)
                                ->orderBy('blog_categories.id', 'DESC')
                                ->groupBy('blog_categories.id', 'blog_categories.title', 'blog_categories.slug', 'blog_categories.cat_img', 'blog_categories.short_title', 'blog_categories.short_des', 'blog_categories.long_des', 'blog_categories.status_active', 'blog_categories.delete_status', 'blog_categories.published_status', 'blog_categories.created_at', 'blog_categories.updated_at', 'blog_categories.cat_icon')
                                ->get();

                        @endphp

                        <h4 class="widget-title">Categories</h4>
                        <ul class="sidebar__cat">
                            @foreach($all_cat as $cat)
                            <li class="sidebar__cat__item"><a href="{{route('blog.cetagory.details',$cat->slug)}}">{!!$cat->title!!} ({!!$cat->total_blog!!})</a></li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- blog-details-area-end -->

<!-- contact-area -->
@include('frontend.get_in_tuch.long_get_in_tuch')
<!-- contact-area-end -->

@endsection