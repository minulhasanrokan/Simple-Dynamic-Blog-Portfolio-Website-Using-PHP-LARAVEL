@php
    $about_skils = App\Models\Skill::where("published_status", 1)
                    ->where('delete_status',0)
                    ->where("status_active", 1)
                    ->get()
@endphp

<div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="skills-tab">
    <div class="about__skill__wrap">
        <div class="row">
            @foreach($about_skils as $skill)
            <div class="col-md-6">
                <div class="about__skill__item">
                    <h5 class="title"><a href="{{route('skill.details',$skill->slug)}}">{!!$skill->title!!}</a></h5>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {!!$skill->skill_persent!!}%;" aria-valuenow="{!!$skill->skill_persent!!}" aria-valuemin="0" aria-valuemax="100"><span class="percentage">{!!$skill->skill_persent!!}%</span></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>