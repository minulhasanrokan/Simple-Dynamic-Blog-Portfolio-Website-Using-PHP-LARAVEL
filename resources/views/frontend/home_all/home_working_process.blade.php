@php
    $process_title = App\Models\WorkignProcessTitle::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("status_active", 1)
                    ->first();

    $process_data = Illuminate\Support\Facades\DB::table('workign_processes')
        ->select('workign_processes.*')
        ->where("workign_processes.published_status", 1)
        ->where('workign_processes.delete_status',0)
        ->where("workign_processes.status_active", 1)
        ->orderBy('workign_processes.id', 'DESC')
        ->get();

@endphp

<section class="work__process">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section__title text-center">
                    <span class="sub-title">Working Process</span>
                    <h2 class="title">{{$process_title->title}}</h2>
                </div>
            </div>
        </div>
        <div class="row work__process__wrap">
            @foreach($process_data as $data)
            <div class="col">
                <div class="work__process__item">
                    <span class="work__process_step">{!! $data->process_step!!}</span>
                    <div class="work__process__icon">
                        <img class="light" src="{{asset('backend/workign_process')}}/{!! $data->workign_processes_icon!!}" alt="{!! $data->title!!}">
                        <img class="dark" src="{{asset('backend/workign_process')}}/{!! $data->workign_processes_icon!!}" alt="{!! $data->title!!}">
                    </div>
                    <div class="work__process__content">
                        <h4 class="title">{!! $data->title!!}</h4>
                        <p>{!! $data->long_des!!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>