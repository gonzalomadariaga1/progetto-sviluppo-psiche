
<div class="blog-sidebar mb-24">
    <h4 class="title mb-20"> {{__('blog.categoria')}} </h4>
    <ul class="blog-archive">
        @foreach ($post_categories as $post_category)
            <li><a href="{{ route('get_posts_category', $post_category ) }}">{{$post_category->{'name_'.app()->getLocale()} }} ({{$post_category->posts->count()}})</a></li>    
        @endforeach
    </ul>
</div> <!-- single sidebar end -->

<div class="blog-sidebar mb-24">
    <h4 class="title mb-20">{{__('blog.archivos')}}</h4>
    <ul class="blog-archive">
        @foreach ($months as $month)
        <li><a href=" {{route('get_posts_month' , \Str::slug($month->date, '-' )  )}} "> {{$month->date}} ({{$month->count}}) </a></li>
            
        @endforeach

    </ul>
</div> <!-- single sidebar end -->

<div class="blog-sidebar mb-24">
    <h4 class="title mb-30"> {{__('blog.reciente')}} </h4>

    @foreach ($recent_posts as $post)
    <div class="recent-post mb-20">
        {{-- <div class="recent-post-thumb">
            <a href="{{ route('blog_details', $post ) }}">
                <img src="assets/img/product/product-img1.jpg" alt="">
            </a>
        </div> --}}
        <div class="recent-post-des">
            <span><a href="{{ route('blog_details', $post ) }}">{{$post->{'title_'.app()->getLocale()} }}</a></span>
            <span class="post-date"> {{$post->published_at}} </span>
        </div>
    </div> 
    @endforeach
</div> <!-- single sidebar end -->
<div class="blog-sidebar mb-24">
    <h4 class="title mb-30">{{__('blog.etiqueta')}}</h4>
    <ul class="blog-tags">
        @foreach ($post_tags as $tag)
        <li><a href="{{ route('get_posts_tags', $tag ) }}"> {{$tag->{'name_'.app()->getLocale()} }} </a></li>
        @endforeach
        
    </ul>
</div> <!-- single sidebar end -->

