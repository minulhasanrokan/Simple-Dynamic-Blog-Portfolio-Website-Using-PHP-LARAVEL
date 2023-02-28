
@php

    $project_cetagory = Illuminate\Support\Facades\DB::table('project_cetagories')
        ->join('portfolios', 'project_cetagories.id', '=', 'portfolios.cetagory_id')
        ->select('project_cetagories.id', 'project_cetagories.title')
        ->where("portfolios.published_status", 1)
        ->where('portfolios.delete_status',0)
        ->where("portfolios.status_active", 1)
        ->where("project_cetagories.published_status", 1)
        ->where('project_cetagories.delete_status',0)
        ->where("project_cetagories.status_active", 1)
        ->groupBy('project_cetagories.id','project_cetagories.title')
        ->orderBy(DB::raw('RAND()'))
        ->get();

    $project_portfolio = App\Models\Portfolio::where("published_status", 1)
        ->where('delete_status',0)
        ->where("status_active", 1)
        ->orderBy(DB::raw('RAND()'))
        ->get();

    $project_portfolio_arr = array();

    foreach($project_portfolio as $data){

        $project_portfolio_arr[$data->cetagory_id][$data->id]['title']= $data->title;
        $project_portfolio_arr[$data->cetagory_id][$data->id]['short_title']= $data->short_title;
        $project_portfolio_arr[$data->cetagory_id][$data->id]['portfolio_img']= $data->portfolio_img;
        $project_portfolio_arr[$data->cetagory_id][$data->id]['slug']= $data->slug;
    }

@endphp

<section class="portfolio">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section__title text-center">
                    <span class="sub-title">Portfolio</span>
                    <h2 class="title">All creative work</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <ul class="nav nav-tabs portfolio__nav" id="portfolioTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button"
                            role="tab" aria-controls="all" aria-selected="true">All</button>
                    </li>
                    @foreach($project_cetagory as $cetagory)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="p_tab_{{$cetagory->id}}" data-bs-toggle="tab" data-bs-target="#p_cetgagory_{{$cetagory->id}}" type="button"
                            role="tab" aria-controls="p_cetgagory_{{$cetagory->id}}" aria-selected="false">{{$cetagory->title}}</button>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content" id="portfolioTabContent">
        <div class="tab-pane show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="container">
                <div class="row gx-0 justify-content-center">
                    <div class="col">
                        <div class="portfolio__active">
                            @foreach($project_portfolio as $portfolio)
                            <div class="portfolio__item">
                                <div class="portfolio__thumb">
                                    <img src="{{asset('backend/portfolio/')}}/{{!empty(($portfolio->portfolio_img))? $portfolio->portfolio_img : 'portfolio_img.jpg'}}" alt="{!!$portfolio->short_title!!}">
                                </div>
                                <div class="portfolio__overlay__content">
                                    <span>{!!$portfolio->title!!}</span>
                                    <h4 class="title"><a href="{{route('portfolio.details',$portfolio->slug)}}">{!!$portfolio->short_title!!}</a></h4>
                                    <a href="{{route('portfolio.details',$portfolio->slug)}}" class="link">Case Study</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($project_portfolio_arr as $key=>$portfolio_data)
        <div class="tab-pane" id="p_cetgagory_{{$key}}" role="tabpanel" aria-labelledby="p_tab_{{$key}}">
            <div class="container">
                <div class="row gx-0 justify-content-center">
                    <div class="col">
                        <div class="portfolio__active">
                            @php
                                foreach($portfolio_data as $id=>$data){
                            @endphp
                            <div class="portfolio__item">
                                <div class="portfolio__thumb">
                                    <img src="{{asset('backend/portfolio/')}}/{{!empty(($data['portfolio_img']))? $data['portfolio_img'] : 'portfolio_img.jpg'}}" alt="{!!$data['short_title']!!}">
                                </div>
                                <div class="portfolio__overlay__content">
                                    <span>{!!$data['title']!!}</span>
                                    <h4 class="title"><a href="{{route('portfolio.details',$data['slug'])}}">{!!$data['short_title']!!}</a></h4>
                                    <a href="{{route('portfolio.details',$data['slug'])}}" class="link">Case Study</a>
                                </div>
                            </div>
                            @php
                                }
                            @endphp
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>