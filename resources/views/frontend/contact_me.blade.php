    
@extends('frontend.main_master')

@section('content')
    
    <title>{!!$system_settings->name!!} - Contact Me</title>
    <!-- breadcrumb-area -->
    <section class="breadcrumb__wrap">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="breadcrumb__wrap__content">
                        <h2 class="title">Contact Me</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact</li>
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
    <!-- contact-map -->
    <div id="contact-map">
        <iframe src="{!!$system_settings->location!!}" allowfullscreen loading="lazy"></iframe>
    </div>
    <!-- contact-map-end -->
    <!-- contact-area -->
    <div class="contact-area">
        <div class="container">
            <form action="{{route('frontend.send.message')}}" method="post" class="contact__form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="user_name" id="user_name" placeholder="Enter your name*" required>
                        @error('user_name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="user_email" id="user_email" placeholder="Enter your mail*" required>
                        @error('user_email')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="m_mobile" id="m_mobile" placeholder="Your Budget*" required>
                        @error('m_mobile')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="m_subject" id="m_subject" placeholder="Enter your subject*" required>
                        @error('m_subject')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                </div>
                <textarea name="m_message" id="m_message" placeholder="Enter your massage*" required></textarea>
                @error('m_message')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                <input type="text" name="type2" id="type2" value="2" required>
                <button type="submit" class="btn">send massage</button>
            </form>
        </div>
    </div>
    <!-- contact-area-end -->
    <!-- contact-info-area -->
    <section class="contact-info-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="contact__info">
                        <div class="contact__info__icon">
                            <img src="{{asset('frontend/assets/img/icons/contact_icon01.png')}}" alt="">
                        </div>
                        <div class="contact__info__content">
                            <h4 class="title">Address Line</h4>
                            <span>{!!$system_settings->address!!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact__info">
                        <div class="contact__info__icon">
                            <img src="{{asset('frontend/assets/img/icons/contact_icon02.png')}}" alt="">
                        </div>
                        <div class="contact__info__content">
                            <h4 class="title">Phone Number</h4>
                            <span>{!!$system_settings->mobile!!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact__info">
                        <div class="contact__info__icon">
                            <img src="{{asset('frontend/assets/img/icons/contact_icon03.png')}}" alt="">
                        </div>
                        <div class="contact__info__content">
                            <h4 class="title">Mail Address</h4>
                            <span>{!!$system_settings->email!!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-info-area-end -->
    <!-- contact-area -->
    @include('frontend.get_in_tuch.long_get_in_tuch')
    <!-- contact-area-end -->
@endsection