@php
    $service_title = App\Models\ServiceTitle::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("status_active", 1)
                    ->first();


    $service_data = Illuminate\Support\Facades\DB::table('services')
        ->select('services.*')
        ->where("services.published_status", 1)
        ->where('services.delete_status',0)
        ->where("services.status_active", 1)
        ->orderBy('services.id', 'DESC')
        ->limit(8)
        ->get();

@endphp

<section class="services">
    <div class="container">
        <div class="services__title__wrap">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-5 col-lg-6 col-md-8">
                    <div class="section__title">
                        <span class="sub-title">My Services</span>
                        <h2 class="title">{{$service_title->title}}</h2>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-4">
                    <div class="services__arrow"></div>
                </div>
            </div>
        </div>
        <div class="row gx-0 services__active">
            @foreach($service_data as $data)
            <div class="col-xl-3">
                <div class="services__item">
                    <div class="services__thumb">
                        <a href="{{route('service.details',$data->slug)}}"><img src="{{asset('backend/service/')}}/{{!empty(($data->service_img))? $data->service_img : 'banner_img.png'}}" alt=""></a>
                    </div>
                    <div class="services__content">
                        <div class="services__icon">
                            <img class="light" src="{{asset('backend/service/')}}/{{!empty(($data->service_icon))? $data->service_icon : 'banner_img.png'}}" alt="">
                            <img class="dark" src="{{asset('backend/service/')}}/{{!empty(($data->service_icon))? $data->service_icon : 'banner_img.png'}}" alt="">
                        </div>
                        <h3 class="title"><a href="{{route('service.details',$data->slug)}}">{!!$data->title!!}</a></h3>
                        {!! Str::limit($data->short_title, 200)!!}
                        <a href="{{route('service.details',$data->slug)}}" class="btn border-btn">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>