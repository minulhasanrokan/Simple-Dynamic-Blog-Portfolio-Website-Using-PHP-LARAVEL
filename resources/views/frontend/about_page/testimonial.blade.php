@php
    $testimonial_title = App\Models\TestimonialTitle::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("status_active", 1)
                    ->first();

    $testimonial_data = Illuminate\Support\Facades\DB::table('testimonials')
        ->select('testimonials.*')
        ->where("testimonials.published_status", 1)
        ->where('testimonials.delete_status',0)
        ->where("testimonials.status_active", 1)
        ->orderBy('testimonials.id', 'DESC')
        ->get();

@endphp


<section class="testimonial testimonial__style__two">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-11">
                <div class="testimonial__wrap">
                    <div class="section__title text-center">
                        <span class="sub-title">Client Feedback</span>
                        <h2 class="title">{{$testimonial_title->title}}</h2>
                    </div>
                    <div class="testimonial__two__active">
                        @foreach($testimonial_data as $data)
                        <div class="testimonial__item">
                            <div class="testimonial__icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <div class="testimonial__content">
                                <a href="{{route('testimonial.details',$data->slug)}}">{!! $data->short_des!!}</a>
                                <div class="testimonial__avatar">
                                    <span><a href="{{route('testimonial.details',$data->slug)}}">{!! $data->buyer_name!!}</a></span>
                                    <div class="testi__avatar__img">
                                        <img src="{{asset('backend/testimonial/')}}/{{!empty(($data->testimonial_icon))? $data->testimonial_icon : 'banner_img.png'}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="testimonial__arrow"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonial__two__icons">
        <ul>
            <li><img src="{{asset('frontend/assets/img/icons/testi_shape01.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/testi_shape02.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/testi_shape03.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/testi_shape04.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/testi_shape05.png')}}" alt=""></li>
            <li><img src="{{asset('frontend/assets/img/icons/testi_shape06.png')}}" alt=""></li>
        </ul>
    </div>
</section>