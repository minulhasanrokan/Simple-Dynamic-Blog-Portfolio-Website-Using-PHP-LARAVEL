@php
    $about_award = App\Models\Award::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("status_active", 1)
                    ->get()
@endphp

<div class="tab-pane fade" id="awards" role="tabpanel" aria-labelledby="awards-tab">
    <div class="about__award__wrap">
        <div class="row justify-content-center">
            @foreach($about_award as $award)
            <div class="col-md-6 col-sm-9">
                <div class="about__award__item">
                    <div class="award__logo">
                        <a href="{{route('award.details',$award->slug)}}"><img src="{{asset('backend/award')}}/{{$award->award_img}}" alt="{!!$award->title!!}"></a>
                    </div>
                    <div class="award__content">
                        <h5 class="title"><a href="{{route('award.details',$award->slug)}}">{!!$award->title!!}</a></h5>
                        {!!$award->short_des!!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>