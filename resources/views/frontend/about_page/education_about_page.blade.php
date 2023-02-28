
@php
    $education_about = App\Models\Education::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("status_active", 1)
                    ->get()
@endphp

<div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
    <div class="about__education__wrap">
        <div class="row">
            @foreach($education_about as $education)
            <div class="col-md-6">
                <div class="about__education__item">
                    <h3 class="title"><a href="{{route('education.details',$education->slug)}}">{!!$education->title!!}</a></h3>
                    <span class="date">{!!date('d-m-Y', strtotime($education->start_date))!!} – @if($education->continue_status==1)Continue @else {!!date('d-m-Y', strtotime($education->end_date))!!} @endif</span>
                    {!!$education->short_des!!}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>