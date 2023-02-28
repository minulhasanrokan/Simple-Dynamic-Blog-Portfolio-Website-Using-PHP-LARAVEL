<header>
    <div id="sticky-header" class="menu__area transparent-header">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="mobile__nav__toggler"><i class="fas fa-bars"></i></div>
                    <div class="menu__wrap">
                        <nav class="menu__nav">
                            <div class="logo">
                                <a href="{{url('/')}}" class="logo__black"><img src="{{asset('backend/system')}}/{!!$system_settings->logo!!}" alt=""></a>
                                <a href="{{url('/')}}" class="logo__white"><img src="{{asset('backend/system')}}/{!!$system_settings->logo!!}" alt=""></a>
                            </div>
                            <div class="navbar__wrap main__menu d-none d-xl-flex">
                                <ul class="navigation">
                                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{url('/')}}">Home</a></li>
                                    <li class="{{ Request::is('about-me') ? 'active' : '' }}"><a href="{{route('frontend.about.page')}}">About</a></li>
                                    <li class="{{ Request::is('all-services') ? 'active' : '' }}"><a href="{{route('frontend.all.services.page')}}">Services</a></li>
                                    <li class="{{ Request::is('portfolio') ? 'active' : '' }}"><a href="{{route('frontend.portfolio.page')}}">Portfolio</a></li>
                                    <li class="{{ Request::is('all-blog') ? 'active' : '' }}"><a href="{{route('blog.all')}}">Blog</a></li>
                                    <li class="{{ Request::is('contact-me') ? 'active' : '' }}"><a href="{{route('frontend.contact.page')}}">contact me</a></li>
                                </ul>
                            </div>
                            <div class="header__btn d-none d-md-block">
                                <a href="{!!$system_settings->contact_link!!}" class="btn">Contact me</a>
                            </div>
                        </nav>
                    </div>
                    <!-- Mobile Menu  -->
                    <div class="mobile__menu">
                        <nav class="menu__box">
                            <div class="close__btn"><i class="fal fa-times"></i></div>
                            <div class="nav-logo">
                                <a href="{{url('/')}}" class="logo__black"><img src="{{asset('backend/system')}}/{!!$system_settings->logo!!}" alt=""></a>
                                <a href="{{url('/')}}" class="logo__white"><img src="{{asset('backend/system')}}/{!!$system_settings->logo!!}" alt=""></a>
                            </div>
                            <div class="menu__outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                @php
                                    $social_media = $system_settings->social_media;
                                    $social_media_arr = explode("***",$social_media);
                                @endphp
                                @if(count($social_media_arr)>0)
                                    <ul class="clearfix">
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
                                        <li><a target="_blank" href="http://{{$social}}"><i class="fab fa-{{$icon}}"></i></a></li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>
                        </nav>
                    </div>
                    <div class="menu__backdrop"></div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
</header>