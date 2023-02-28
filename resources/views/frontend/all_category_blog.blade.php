@extends('frontend.main_master')

@section('content')

<title>{!!$system_settings->name!!} - All Blog</title>
<!-- blog-details-area -->
<section class="standard__blog blog__details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div id="all_blog_div">
                    @include('frontend.home_all.all_blog')
                </div>
                <div class="blog__button text-center">
                    <button onclick="load_more_blog();" class="btn">More Blog</button>
                    <input type="hidden" name="ofset_data" id="ofset_data" value="10" >
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="blog__sidebar">
                    <div class="widget">
                        <h4 class="widget-title">Recent Blog</h4>
                        @php

                            $all_blog = Illuminate\Support\Facades\DB::table('blogs')
                                ->join('blog_categories', 'blog_categories.id', '=', 'blogs.cetagory_id')
                                ->select('blog_categories.title as cat_title', 'blog_categories.slug as cat_slug', 'blogs.*')
                                ->where("blogs.published_status", 1)
                                ->where('blogs.delete_status',0)
                                ->where("blogs.status_active", 1)
                                ->where("blog_categories.published_status", 1)
                                ->where('blog_categories.delete_status',0)
                                ->where("blog_categories.status_active", 1)
                                ->orderBy('blogs.id', 'DESC')
                                ->limit(10)
                                ->get();
                        @endphp
                        <ul class="rc__post">
                            @foreach($all_blog as $blog)
                            <li class="rc__post__item">
                                <div class="rc__post__thumb">
                                    <a href="{{route('blog.details',$blog->slug)}}"><img src="{{asset('backend/blog/')}}/{{!empty(($blog->blog_img))? $blog->blog_img : 'blog_thumb01.jpg'}}" alt="{!!$blog->title!!}" height="100"></a>
                                </div>
                                <div class="rc__post__content">
                                    <h5 class="title"><a href="{{route('blog.details',$blog->slug)}}">{!!$blog->title!!}</a></h5>
                                    <span class="post-date"><i class="fal fa-calendar-alt"></i>{{date("d F Y",strtotime($blog->created_at))}}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">

                        @php

                            $all_cat = Illuminate\Support\Facades\DB::table('blogs')
                                ->join('blog_categories', 'blog_categories.id', '=', 'blogs.cetagory_id')
                                ->select('blog_categories.*',DB::raw('COUNT(blogs.id) as total_blog'))
                                ->where("blogs.published_status", 1)
                                ->where('blogs.delete_status',0)
                                ->where("blogs.status_active", 1)
                                ->where("blog_categories.published_status", 1)
                                ->where('blog_categories.delete_status',0)
                                ->where("blog_categories.status_active", 1)
                                ->orderBy('blog_categories.id', 'DESC')
                                ->groupBy('blog_categories.id', 'blog_categories.title', 'blog_categories.slug', 'blog_categories.cat_img', 'blog_categories.short_title', 'blog_categories.short_des', 'blog_categories.long_des', 'blog_categories.status_active', 'blog_categories.delete_status', 'blog_categories.published_status', 'blog_categories.created_at', 'blog_categories.updated_at', 'blog_categories.cat_icon')
                                ->get();

                        @endphp

                        <h4 class="widget-title">Categories</h4>
                        <ul class="sidebar__cat">
                            @foreach($all_cat as $cat)
                            <li class="sidebar__cat__item"><a href="{{route('blog.cetagory.details',$cat->slug)}}">{!!$cat->title!!} ({!!$cat->total_blog!!})</a></li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- blog-details-area-end -->
<script type="text/javascript">

    function createObject() {
    
        var request_type;

        if (window.XMLHttpRequest){

          request_type=new XMLHttpRequest();
        }
        else{

          request_type=new ActiveXObject("Microsoft.XMLHTTP");
        }

        return request_type;
    }

    var http = createObject();
    
    function load_more_blog(){

        var ofset = $("#ofset_data").val();

        var data = "&ofset="+ofset;

        http.open("GET","{{route('blog.cetagory.details',$slug)}}?"+data);
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send(data);
        http.onreadystatechange = fnc_action_reponse;

    }

    function fnc_action_reponse(){

        if(http.readyState == 4) 
        {   
            $("#all_blog_div").append(http.responseText);

            if(http.responseText!=''){

                var ofset_data = $("#ofset_data").val()*1+10;

                $("#ofset_data").val(ofset_data);
            }

        }
  }
</script>

<!-- contact-area -->
@include('frontend.get_in_tuch.long_get_in_tuch')
<!-- contact-area-end -->

@endsection