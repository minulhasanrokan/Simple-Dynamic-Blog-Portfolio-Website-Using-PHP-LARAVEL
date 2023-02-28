
@foreach($all_blog as $data)
<div class="standard__blog__post">
    <div class="standard__blog__thumb">
        <a href="{{route('blog.details',$data->slug)}}"><img src="{{asset('backend/blog/')}}/{{!empty(($data->blog_img))? $data->blog_img : 'blog_thumb01.jpg'}}" alt="{!!$data->title!!}"></a>
        <a href="{{route('blog.details',$data->slug)}}" class="blog__link"><i class="far fa-long-arrow-right"></i></a>
    </div>
    <div class="standard__blog__content">
        <h2 class="title"><a href="{{route('blog.details',$data->slug)}}">{!!$data->title!!}</a></h2>
        <p>{!! Str::limit($data->short_title, 200)!!}</p>
        
        <ul class="blog__post__meta">
            <li><i class="fal fa-calendar-alt"></i>{{date("d F Y",strtotime($data->created_at))}}</li>
        </ul>
    </div>
</div>
@endforeach

