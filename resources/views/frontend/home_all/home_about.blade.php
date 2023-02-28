@php
    $home_about = App\Models\About::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("display_status", 1)
                    ->where("status_active", 1)
                    ->first();

    $home_multi_image_1 = App\Models\MultiImage::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("display_status", 1)
                    ->where("status_active", 1)
                    ->first();

    $image_arr = explode("***",$home_multi_image_1->multi_image);

    $resume = App\Models\Resume::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("status_active", 1)
                    ->first();
                                    
@endphp

<section id="aboutSection" class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <ul class="about__icons__wrap">
                    @foreach($image_arr as $img)
                    <li>
                        <img class="light" src="{{asset('backend/multi_image')}}/{{$img}}" alt="{{$home_multi_image_1->title}}">
                        <img class="dark" src="{{asset('backend/multi_image')}}/{{$img}}" alt="{{$home_multi_image_1->title}}">
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <div class="section__title">
                        <span class="sub-title">About me</span>
                        <h2 class="title">{!!$home_about->title!!}</h2>
                    </div>
                    <div class="about__exp">
                        <div class="about__exp__icon">
                            <img src="{{asset('backend/about')}}/{{$home_about->about_icon}}" alt="{!!$home_about->title!!}">
                        </div>
                        <div class="about__exp__content">
                            <p>{!!$home_about->short_title!!}</p>
                        </div>
                    </div>
                    <p class="desc"> <p>{!!$home_about->short_des!!}</p></p>
                    <a href="{{route('resume.details',$resume->slug)}}" class="btn">Download my resume</a>
                </div>
            </div>
        </div>
    </div>
</section>