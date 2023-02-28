<footer class="footer">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4">
                <div class="footer__widget">
                    <div class="fw-title">
                        <h5 class="sub-title">Contact Us</h5>
                        <h4 class="title">{!!$system_settings->mobile!!}</h4>
                    </div>
                    <div class="footer__widget__text">
                        {!!$system_settings->contuct_us_text!!}
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="footer__widget">
                    <div class="fw-title">
                        <h5 class="sub-title">My Address</h5>
                        <h4 class="title">{!!$system_settings->country!!}</h4>
                    </div>
                    <div class="footer__widget__address">
                        <p>{!!$system_settings->address!!}</p>
                        <a href="mailto:{!!$system_settings->email!!}" class="mail">{!!$system_settings->email!!}</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="footer__widget">
                    <div class="fw-title">
                        <h5 class="sub-title">Follow me</h5>
                        <h4 class="title">socially connect</h4>
                    </div>
                    <div class="footer__widget__social">
                        {!!$system_settings->social_link_text!!}

                        @php
                            $social_media = $system_settings->social_media;
                            $social_media_arr = explode("***",$social_media);
                        @endphp
                        @if(count($social_media_arr)>0)
                            <ul class="footer__social__list">
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
                </div>
            </div>
        </div>
        <div class="copyright__wrap">
            <div class="row">
                <div class="col-12">
                    <div class="copyright__text text-center">
                        <p>{!!$system_settings->copy_right_text!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>