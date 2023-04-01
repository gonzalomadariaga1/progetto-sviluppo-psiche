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
        <div class="blog-main-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="blog-sidebar-wrapper">

                            @include('inicio.blog._blog_sidebar_wrapper')
                        </div>
                    </div>
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="blog-wrapper-inner">
                            <div class="row">
                                <!-- start single blog item -->
                                @foreach ($posts as $post)
                                <div class="col-lg-6 col-md-6">
                                    <div class="blog-item mb-26">
                                    @include('inicio.blog._blog_thumb')
                                        <div class="blog-content">
                                            <h3><a href="{{ route('blog_details' , $post) }}"> {{$post->{'title_'.app()->getLocale()} }} </a></h3>
                                            <div class="blog-meta">
                                                <span class="posted-author"> <strong> {{$post->user['name'] }} </strong>  </span>
                                                <span class="post-date"> {{$post->published_at }} </span>
                                            </div>
                                            <p>{{$post->{'resumen_'.app()->getLocale()} }}</p>
                                        </div>
                                        <a href="{{ route('blog_details' , $post) }}"> {{__('blog.blog-detail')}} <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>   
                                @endforeach
                            </div>
                        </div>
                        <!-- start pagination area -->
                        <div class="paginatoin-area text-center pt-30 pb-30">
                            <div class="row">
                                <div class="col-12">
                                    {{-- <ul class="pagination-box">
                                        <li><a class="Previous" href="#">Previous</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a class="Next" href="#"> Next </a></li>
                                    </ul> --}}
                                    {{$posts->render()}}
                                </div>
                            </div>
                        </div>
                        <!-- end pagination area -->
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->


@endsection

