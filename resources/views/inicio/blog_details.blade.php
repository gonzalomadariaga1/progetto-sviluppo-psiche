@extends ('layouts.inicio')

@section ('title', 'Blog')

@section('contenido')

<main id="main">

    <!-- ======= Blog Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Blog</h2>

          <ol>
            <li><a href="/">Home</a></li>
            <li>Blog</li>
          </ol>
        </div>

      </div>
    </section><!-- End Blog Section -->

    <!-- ======= Blog Section ======= -->
    <section id="blogv2" class="blogv2">
        <!-- blog main wrapper start -->
        <div class="blog-main-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2">
                        <div class="blog-sidebar-wrapper mt-md-34 mt-sm-30">

                            @include('inicio.blog._blog_sidebar_wrapper')

                        </div>
                    </div>
                    <div class="col-lg-9 order-1">
                        <div class="blog-wrapper-inner">
                            <div class="row blog-content-wrap">
                                <!-- start single blog item -->
                                <div class="col-lg-12">
                                    <div class="blog-item mb-30">
                                        

                                        @include('inicio.blog._blog_thumb_details')

                                        <div class="blog-content">
                                            <div class="blog-details">
                                                <h3 class="blog-heading">{{$post->{'title_'.app()->getLocale()} }}</h3>
                                                <div class="blog-meta">
                                                    <a class="author" href="#"><i class="icon-people"></i> {{$post->user['name'] }}</a>
                                                    <a class="post-time" href="#"><i class="icon-calendar"></i> {{$post->published_at }}</a>
                                                </div>
                                                {!! $post->{'content_'.app()->getLocale()} !!}
                                            </div>
                                        </div>
                                        <div class="tag-line">
                                            <h4>tag:</h4>
                                            @foreach ($post->tags as $tag)
                                                <a href="#"> {{$tag->{'name_'.app()->getLocale()} }} </a>
                                            @endforeach
                                            
                                        </div>
                                        <div class="blog-sharing text-center mt-34 mt-sm-34">
                                            <h4>share this post:</h4>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="comment-section">
                                       
                                        
                                        <div id="disqus_thread"></div>
                                        @include('inicio.blog._disqus-script')
                                    </div>
                                </div>
                                <!-- end single blog item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog main wrapper end -->
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

@endsection