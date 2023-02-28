
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

<section class="services__style__two">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="section__title text-center">
                    <span class="sub-title">My Services</span>
                    <h2 class="title">{{$service_title->title}}</h2>
                </div>
            </div>
        </div>
        <div class="services__style__two__wrap">
            <div class="row gx-0">
                @foreach($service_data as $data)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="services__style__two__item">
                        <div class="services__style__two__icon">
                            <img src="{{asset('backend/service/')}}/{{!empty(($data->service_icon))? $data->service_icon : 'banner_img.png'}}" alt="">
                        </div>
                        <div class="services__style__two__content">
                            <h3 class="title"><a href="{{route('service.details',$data->slug)}}">{!!$data->title!!}</a></h3>
                            <p>{!! Str::limit($data->short_title, 200)!!}</p>
                            <a href="{{route('service.details',$data->slug)}}" class="services__btn"><i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>