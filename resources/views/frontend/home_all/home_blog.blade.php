@php

    $blogs_data = Illuminate\Support\Facades\DB::table('blogs')
        ->join('blog_categories', 'blog_categories.id', '=', 'blogs.cetagory_id')
        ->select('blog_categories.title as cat_title', 'blog_categories.slug as cat_slug', 'blogs.*')
        ->where("blogs.published_status", 1)
        ->where('blogs.delete_status',0)
        ->where("blogs.status_active", 1)
        ->where("blog_categories.published_status", 1)
        ->where('blog_categories.delete_status',0)
        ->where("blog_categories.status_active", 1)
        ->orderBy('blogs.id', 'DESC')
        ->limit(3)
        ->get();

@endphp
<section class="blog">
    <div class="container">
        <div class="row gx-0 justify-content-center">
            @foreach($blogs_data as $data)
            <div class="col-lg-4 col-md-6 col-sm-9">
                <div class="blog__post__item">
                    <div class="blog__post__thumb">
                        <a href="{{route('blog.details',$data->slug)}}">
                            <img src="{{asset('backend/blog/')}}/{{!empty(($data->blog_img))? $data->blog_img : 'blog_thumb01.jpg'}}" alt="{!!$data->title!!}">
                        </a>
                        <div class="blog__post__tags">
                            <a href="{{route('blog.cetagory.details',$data->cat_slug)}}">{{$data->cat_title}}</a>
                        </div>
                    </div>
                    <div class="blog__post__content">
                        <span class="date">{{date("d-F-Y",strtotime($data->created_at))}}</span>
                        <h3 class="title"><a href="{{route('blog.details',$data->slug)}}">{{$data->title}}</a></h3>
                        <a href="{{route('blog.details',$data->slug)}}" class="read__more">Read mORe</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="blog__button text-center">
            <a href="{{route('blog.all')}}" class="btn">More Blog</a>
        </div>
    </div>
</section>