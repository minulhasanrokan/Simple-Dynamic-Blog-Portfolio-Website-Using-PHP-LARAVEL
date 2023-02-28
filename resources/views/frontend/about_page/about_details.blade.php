@php
    $home_about = App\Models\About::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("display_status", 2)
                    ->where("status_active", 1)
                    ->first();
@endphp

<div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
    {!!$home_about->long_des!!}
</div>