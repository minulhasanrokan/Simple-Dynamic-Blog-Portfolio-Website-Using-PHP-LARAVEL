
@extends('frontend.main_master')

@section('content')
<!-- breadcrumb-area -->
<title>{!!$system_settings->name!!} - About Me</title>
<section class="breadcrumb__wrap">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="breadcrumb__wrap__content">
                    <h2 class="title">About me</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Me</li>
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

<!-- about-area -->
<section class="about about__style__two">
    <div class="container">
        @include('frontend.about_page.about')
        <div class="row">
            <div class="col-12">
                <div class="about__info__wrap">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button"
                                role="tab" aria-controls="about" aria-selected="true">About</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button"
                                role="tab" aria-controls="skills" aria-selected="false">Skills</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="awards-tab" data-bs-toggle="tab" data-bs-target="#awards" type="button"
                                role="tab" aria-controls="awards" aria-selected="false">awards</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button"
                                role="tab" aria-controls="education" aria-selected="false">education</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @include('frontend.about_page.about_details')
                        @include('frontend.about_page.skill_about_page')
                        @include('frontend.about_page.award_about_page')
                        @include('frontend.about_page.education_about_page')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-area-end -->

<!-- services-area -->
@include('frontend.about_page.service')
<!-- services-area-end -->

<!-- testimonial-area -->
@include('frontend.about_page.testimonial')
<!-- testimonial-area-end -->
 
<!-- blog-area -->
@include('frontend.home_all.home_blog')
<!-- blog-area-end -->

<!-- contact-area -->
@include('frontend.get_in_tuch.long_get_in_tuch')
<!-- contact-area-end -->
@endsection