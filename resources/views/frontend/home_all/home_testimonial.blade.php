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

    $home_multi_image_3 = App\Models\MultiImage::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("display_status", 3)
                    ->where("status_active", 1)
                    ->first();

    $image_arr3 = explode("***",$home_multi_image_3->multi_image);

@endphp


<section class="testimonial">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 order-0 order-lg-2">
                <ul class="testimonial__avatar__img">
                    @foreach($image_arr3 as $img)
                    <li>
                        <img class="light" src="{{asset('backend/multi_image')}}/{{$img}}" alt="{{$home_multi_image_3->title}}">
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="testimonial__wrap">
                    <div class="section__title">
                        <span class="sub-title">Client Feedback</span>
                        <h2 class="title">{{$testimonial_title->title}}</h2>
                    </div>
                    <div class="testimonial__active">
                        @foreach($testimonial_data as $data)
                        <div class="testimonial__item">
                            <div class="testimonial__icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <a href="{{route('testimonial.details',$data->slug)}}">
                                <div class="testimonial__content">
                                    {!! $data->short_des!!}
                                    <div class="testimonial__avatar">
                                        <span>{!! $data->buyer_name!!}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="testimonial__arrow"></div>
                </div>
            </div>
        </div>
    </div>
</section>