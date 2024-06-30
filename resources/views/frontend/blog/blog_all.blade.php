@extends('frontend.main_master')
@section('main')
  <!-- Hero Area Start -->
  <div class="breadcumb-wrapper" data-bg-src=" {{asset('frontend/assets/img/breadcumb/bgblog.png')}} ">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title">Blog</h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.html">Acceuil</a></li>
            <li>Soluguide</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Hero Area End -->

  <!-- Blog Content Area Start -->
  <div class="vs-blog-wrapper space-top space-extra-bottom">
    <div class="container">
      <div class="row gx-30">
        <div class="col-lg-8">
          <div class="row">
            
            @foreach ($blog as $item)
            <div class="col-xl-6 col-md-6 col-sm-12 col-12">
              <div class="vs-blog blog-style2">
                <div class="blog-img">
                  <a href="{{ url('blog/detail/'.$item->post_slug) }}"><img src="{{asset($item->post_image)}}" alt="blog image"></a>
                  {{-- <div class="blog-inner-author">
                    <img src="{{asset('upload/admin_images/'.$item['author']['photo'])}}" alt="blog author image">
                    <a href="{{ url('blog/detail/'.$item->post_slug) }}" class="author-name">{{$item['author']['name']}}</a>
                    <span class="author-degi">{{$item['author']['role']}}</span>
                  </div> --}}
                </div>
                <div class="blog-content">
                  <h2 class="blog-title"><a href="{{ url('blog/detail/'.$item->post_slug) }}">{{$item->post_title}}</a></h2>
                  <p>{!!$item->short_descp!!}</p>
                  <div class="blog-bottom">
                    <a class="blog-date" href="{{ url('blog/detail/'.$item->post_slug) }}"><i class="fas fa-calendar-alt"></i> {{$item->created_at->format('d M Y')}}</a>
                    <a class="vs-btn has-arrow" href="{{ url('blog/detail/'.$item->post_slug) }}">Voir <i class="fal fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          
          
          </div>
          <div class="vs-pagination pt-lg-2">
           
                {{$blog->links('vendor.pagination.custom')}}


            
          </div>
        </div>
        <div class="col-lg-4">
          <div class="sidebar-area">
            <div class="widget widget_search">
              <div class="widget_title">Search</div>
              <form class="search-form">
                <input type="text" placeholder="Search Tour">
                <button type="submit"><i class="far fa-search"></i></button>
              </form>
            </div>
            <div class="widget">
              <h3 class="widget_title">Recent Posts</h3>
              <div class="recent-post-wrap">
                

                @foreach ($lpost as $post)
                    
              

                <div class="recent-post">
                  <div class="media-img">
                    <a href="{{ url('blog/detail/'.$post->post_slug) }}">
                      <img src="{{asset($post->post_image) }}" alt="Blog Image">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="post-title">
                      <a class="text-inherit" href="{{ url('blog/detail/'.$post->post_slug) }}"">{{$post->post_title}}</a>
                    </h4>
                    <div class="recent-post-meta">
                      <i class="fas fa-calendar-alt"></i>
                      <a href="{{ url('blog/detail/'.$post->post_slug) }}">{{$post->created_at->format('d M Y')}}</a>
                    </div>
                  </div>
                </div>

                @endforeach
               
              </div>
            </div>

            <div class="widget widget_categories">
              <h3 class="widget_title">Categories</h3>
              <ul>
                @foreach ($bcategory as $cat)
                <li><a class="active" href="{{url('blog/cat/list',$cat->id)}}">{{$cat->category_name}}</a> </li>
                @endforeach
                
                
               
              </ul>
            </div>

            <div class="widget widget-newsletter">
              <h3 class="widget_title">Newsletter</h3>
              <form class="newsletter-form">
                <input class="form-control" type="email" placeholder="Enter Your Email" />
                <button type="submit" class="vs-btn style4">Recevoir articles</button>
              </form>
            </div>


            <div class="widget widget-social">
              <h3 class="widget_title">Nous suivres</h3>
              <div class="social-style widget_social_style">
                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Blog Content Area End -->

  @endsection