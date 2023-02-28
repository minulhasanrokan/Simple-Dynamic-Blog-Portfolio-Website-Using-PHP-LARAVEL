    
@extends('frontend.main_master')

@section('content')
    
    <title>{!!$system_settings->name!!} - {!!$system_settings->title!!}</title>
    <!-- banner-area -->
    @include('frontend.home_all.home_slider')
    <!-- banner-area-end -->
    <!-- about-area -->
    @include('frontend.home_all.home_about')
    <!-- about-area-end -->

    <!-- services-area -->
    @include('frontend.home_all.home_servie_all')
    <!-- services-area-end -->

    <!-- work-process-area -->
    @include('frontend.home_all.home_working_process')
    <!-- work-process-area-end -->

    <!-- portfolio-area -->
    @include('frontend.home_all.portfolio')
    <!-- portfolio-area-end -->

    <!-- partner-area -->
    @include('frontend.home_all.home_partner')
    <!-- partner-area-end -->

    <!-- testimonial-area -->
    @include('frontend.home_all.home_testimonial')
    <!-- testimonial-area-end -->

    <!-- blog-area -->
    @include('frontend.home_all.home_blog')
    <!-- blog-area-end -->

    <!-- contact-area -->
    @include('frontend.get_in_tuch.long_get_in_tuch')
    <!-- contact-area-end -->
@endsection