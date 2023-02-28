
@php

    $home_multi_image_2 = App\Models\MultiImage::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("display_status", 2)
                    ->where("status_active", 1)
                    ->first();

    $image_arr2 = explode("***",$home_multi_image_2->multi_image);

    $partner = App\Models\Partners::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("status_active", 1)
                    ->first();

@endphp

<section class="partner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <ul class="partner__logo__wrap">
                    @foreach($image_arr2 as $img)
                    <li>
                        <img class="light" src="{{asset('backend/multi_image')}}/{{$img}}" alt="{{$home_multi_image_2->title}}">
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="partner__content">
                    <div class="section__title">
                        <span class="sub-title">Partners</span>
                        <h2 class="title">{!!$partner->title!!}</h2>
                    </div>
                    {!!$partner->long_des!!}
                    <a href="http://{!!$partner->conversion_url!!}" class="btn">Start a conversation</a>
                </div>
            </div>
        </div>
    </div>
</section>