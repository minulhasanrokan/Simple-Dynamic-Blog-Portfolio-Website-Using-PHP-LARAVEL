@php
    $home_about = App\Models\About::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("display_status", 2)
                    ->where("status_active", 1)
                    ->first();

    $resume = App\Models\Resume::where("published_status", 1)
                ->where('delete_status',0)
                ->where("status_active", 1)
                ->first();
@endphp

<div class="row align-items-center">
    <div class="col-lg-6">
        <div class="about__image">
            <img src="{{asset('backend/about/')}}/{{!empty(($home_about->about_img))? $home_about->about_img : 'banner_img.png'}}" alt="{!!$home_about->title!!}">
        </div>
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
                    <p><span>{!!$home_about->short_title!!}</p>
                </div>
            </div>
            <p>{!!$home_about->short_des!!}</p>
            <a href="{{route('resume.details',$resume->slug)}}" class="btn">Download my resume</a>
        </div>
    </div>
</div>