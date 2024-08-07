
@extends('frontend.main_master')
@section('main')
@php
    $BlogPost = App\Models\BlogPost::latest()->limit(4)->get();
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Session;
   $locale = Session::get('local') ?? 'fr';
    Session::put('local',$locale);
    App::setLocale($locale);
@endphp

  <!-- Hero Area Start -->
  <div class="breadcumb-wrapper" data-bg-src=" {{asset('frontend/assets/img/breadcumb/bg.png')}} ">
   <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title"></h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.html"></a></li>
            <li></li>
            <li></li>
          </ul>
        </div>
      </div>
    </div> 
  </div>
  <!-- Hero Area End -->

  <!-- Blog details Content Area Start -->

    @if ($locale == 'fr')
    <div class="vs-blog-wrapper vs-blog-details space-top space-extra-bottom">
      <div class="container">
        <div class="row gx-30">
          <div class="col-lg-8">
            <div class="vs-blog blog-single">
              <div class="blog-img">
                <img src="{{asset($blog->post_image )}}" alt="blog image" style="width:1242px;height:540px">
               
  
              </div>
              <div class="blog-content">
                <h2 class="blog-title">{{$blog->post_title}}.</h2>
                <div class="blog-meta">
                  <a href="blog.html"><i class="far fa-calendar"></i>{{$blog->created_at->format('d M Y')}}</a>
                  <a href="blog.html"><i class="fal fa-user"></i>{{$blog['author']['name']}}</a>
                </div>
                <p> {!!$blog->long_descp!!} </p>
                <div class="clearfix share-links">
                  <div class="row justify-content-between gy-30">
                    
                    <div class="col-xl-auto col-md-auto">
                      <span class="share-links-title">Partager:</span>
                      <ul class="social-links">
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                      </ul>
                      <!-- End Social Share -->
                    </div>
                    <!-- Share Links Area end -->
                  </div>
                </div>
  
                {{-- <div class="post-pagination">
                  <div class="row justify-content-between align-items-center">
                    <div class="col">
                      <div class="post-pagi-box prev">
                        <a href="blog-details.html"><img src="assets/img/blog/page-1-1.jpg" alt="pagi"></a>
                        <a href="blog-details.html" class="pagi-title">Previous Post</a>
                      </div>
                    </div>
                    <div class="col-auto d-none d-sm-block">
                      <a href="blog.html" class="pagi-icon"><i class="fas fa-th"></i></a>
                    </div>
                    <div class="col">
                      <div class="post-pagi-box next">
                        <a href="blog-details.html"><img src="assets/img/blog/page-1-2.jpg" alt="pagi"></a>
                        <a href="blog-details.html" class="pagi-title">Next Post</a>
                      </div>
                    </div>
                  </div>
                </div> --}}
  
               
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar-area">
              {{-- <div class="widget widget_search">
                <div class="widget_title">Search</div>
                <form class="search-form">
                  <input type="text" placeholder="Search Tour">
                  <button type="submit"><i class="far fa-search"></i></button>
                </form>
              </div> --}}
              <div class="widget">
                <h3 class="widget_title">Article Récents</h3>
                <div class="recent-post-wrap">
   
                  @foreach ($lpost as $post)
                      
                
  
                  <div class="recent-post">
                    <div class="media-img">
                      <a href="{{ url('blog/detail/'.$post->post_slug) }}"">
                        <img src="{{asset($post->post_image) }}" alt="Blog Image">
                      </a>
                    </div>
                    <div class="media-body">
                      <h4 class="post-title">
                        <a class="text-inherit" href="{{ url('blog/detail/'.$post->post_slug) }}"">{{$post->post_title}}</a>
                      </h4>
                      <div class="recent-post-meta">
                        <i class="fas fa-calendar-alt"></i>
                        <a href="{{ url('blog/detail/'.$post->post_slug) }}">{{$blog->created_at->format('d M Y')}}</a>
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
  
              {{-- <div class="widget widget-newsletter">
                <h3 class="widget_title">Newsletter</h3>
                <form class="newsletter-form">
                  <input class="form-control" type="email" placeholder="Enter Your Email" />
                  <button type="submit" class="vs-btn style4">Submit</button>
                </form>
              </div> --}}
  
           
  
              <div class="widget widget-social">
                <h3 class="widget_title">Nous Suivres</h3>
                <div class="social-style widget_social_style">
                  <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if ($locale == 'en')
    <div class="vs-blog-wrapper vs-blog-details space-top space-extra-bottom">
      <div class="container">
        <div class="row gx-30">
          <div class="col-lg-8">
            <div class="vs-blog blog-single">
              <div class="blog-img">
                <img src="{{asset(($blog->post_image))}}" alt="blog image" style="width:1242px;height:540px">
               
  
              </div>
              <div class="blog-content">
                <h2 class="blog-title">{{$blog->post_title_en}}.</h2>
                <div class="blog-meta">
                  <a href="blog.html"><i class="far fa-calendar"></i>{{$blog->created_at->format('d M Y')}}</a>
                  <a href="blog.html"><i class="fal fa-user"></i>{{$blog['author']['name']}}</a>
                </div>
                <p> {!!$blog->long_descp_en!!} </p>
                <div class="clearfix share-links">
                  <div class="row justify-content-between gy-30">
                    
                    <div class="col-xl-auto col-md-auto">
                      <span class="share-links-title">Partager:</span>
                      <ul class="social-links">
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                      </ul>
                      <!-- End Social Share -->
                    </div>
                    <!-- Share Links Area end -->
                  </div>
                </div>
  
                {{-- <div class="post-pagination">
                  <div class="row justify-content-between align-items-center">
                    <div class="col">
                      <div class="post-pagi-box prev">
                        <a href="blog-details.html"><img src="assets/img/blog/page-1-1.jpg" alt="pagi"></a>
                        <a href="blog-details.html" class="pagi-title">Previous Post</a>
                      </div>
                    </div>
                    <div class="col-auto d-none d-sm-block">
                      <a href="blog.html" class="pagi-icon"><i class="fas fa-th"></i></a>
                    </div>
                    <div class="col">
                      <div class="post-pagi-box next">
                        <a href="blog-details.html"><img src="assets/img/blog/page-1-2.jpg" alt="pagi"></a>
                        <a href="blog-details.html" class="pagi-title">Next Post</a>
                      </div>
                    </div>
                  </div>
                </div> --}}
  
               
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar-area">
              {{-- <div class="widget widget_search">
                <div class="widget_title">Search</div>
                <form class="search-form">
                  <input type="text" placeholder="Search Tour">
                  <button type="submit"><i class="far fa-search"></i></button>
                </form>
              </div> --}}
              <div class="widget">
                <h3 class="widget_title">Recent articles</h3>
                <div class="recent-post-wrap">
   
                  @foreach ($lpost as $post)
                      
                
  
                  <div class="recent-post">
                    <div class="media-img">
                      <a href="{{ url('blog/detail/'.$post->post_slug) }}"">
                        <img src="{{asset($post->post_image) }}" alt="Blog Image">
                      </a>
                    </div>
                    <div class="media-body">
                      <h4 class="post-title">
                        <a class="text-inherit" href="{{ url('blog/detail/'.$post->post_slug) }}"">{{$post->post_title_en}}</a>
                      </h4>
                      <div class="recent-post-meta">
                        <i class="fas fa-calendar-alt"></i>
                        <a href="{{ url('blog/detail/'.$post->post_slug) }}">{{$blog->created_at->format('d M Y')}}</a>
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
                  <li><a class="active" href="{{url('blog/cat/list',$cat->id)}}">{{$cat->category_name_en}}</a> </li>
                  @endforeach
                  
                  
                 
                </ul>
              </div>
  
              {{-- <div class="widget widget-newsletter">
                <h3 class="widget_title">Newsletter</h3>
                <form class="newsletter-form">
                  <input class="form-control" type="email" placeholder="Enter Your Email" />
                  <button type="submit" class="vs-btn style4">Submit</button>
                </form>
              </div> --}}
  
           
  
              <div class="widget widget-social">
                <h3 class="widget_title">Follow Us</h3>
                <div class="social-style widget_social_style">
                  <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if ($locale == 'es')
    <div class="vs-blog-wrapper vs-blog-details space-top space-extra-bottom">
      <div class="container">
        <div class="row gx-30">
          <div class="col-lg-8">
            <div class="vs-blog blog-single">
              <div class="blog-img">
                <img src="{{asset(($blog->post_image))}}" alt="blog image" style="width:1242px;height:540px">
               
  
              </div>
              <div class="blog-content">
                <h2 class="blog-title">{{$blog->post_title_es}}.</h2>
                <div class="blog-meta">
                  <a href="blog.html"><i class="far fa-calendar"></i>{{$blog->created_at->format('d M Y')}}</a>
                  <a href="blog.html"><i class="fal fa-user"></i>{{$blog['author']['name']}}</a>
                </div>
                <p> {!!$blog->long_descp_es!!} </p>
                <div class="clearfix share-links">
                  <div class="row justify-content-between gy-30">
                    
                    <div class="col-xl-auto col-md-auto">
                      <span class="share-links-title">Comparta:</span>
                      <ul class="social-links">
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                       
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                          <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                      </ul>
                      <!-- End Social Share -->
                    </div>
                    <!-- Share Links Area end -->
                  </div>
                </div>
  
                {{-- <div class="post-pagination">
                  <div class="row justify-content-between align-items-center">
                    <div class="col">
                      <div class="post-pagi-box prev">
                        <a href="blog-details.html"><img src="assets/img/blog/page-1-1.jpg" alt="pagi"></a>
                        <a href="blog-details.html" class="pagi-title">Previous Post</a>
                      </div>
                    </div>
                    <div class="col-auto d-none d-sm-block">
                      <a href="blog.html" class="pagi-icon"><i class="fas fa-th"></i></a>
                    </div>
                    <div class="col">
                      <div class="post-pagi-box next">
                        <a href="blog-details.html"><img src="assets/img/blog/page-1-2.jpg" alt="pagi"></a>
                        <a href="blog-details.html" class="pagi-title">Next Post</a>
                      </div>
                    </div>
                  </div>
                </div> --}}
  
               
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar-area">
              {{-- <div class="widget widget_search">
                <div class="widget_title">Search</div>
                <form class="search-form">
                  <input type="text" placeholder="Search Tour">
                  <button type="submit"><i class="far fa-search"></i></button>
                </form>
              </div> --}}
              <div class="widget">
                <h3 class="widget_title">Artículos recientes</h3>
                <div class="recent-post-wrap">
   
                  @foreach ($lpost as $post)
                      
                
  
                  <div class="recent-post">
                    <div class="media-img">
                      <a href="{{ url('blog/detail/'.$post->post_slug) }}"">
                        <img src="{{asset($post->post_image) }}" alt="Blog Image">
                      </a>
                    </div>
                    <div class="media-body">
                      <h4 class="post-title">
                        <a class="text-inherit" href="{{ url('blog/detail/'.$post->post_slug) }}"">{{$post->post_title_es}}</a>
                      </h4>
                      <div class="recent-post-meta">
                        <i class="fas fa-calendar-alt"></i>
                        <a href="{{ url('blog/detail/'.$post->post_slug) }}">{{$blog->created_at->format('d M Y')}}</a>
                      </div>
                    </div>
                  </div>
  
                  @endforeach
                 
                </div>
              </div>
  
              <div class="widget widget_categories">
                <h3 class="widget_title">Categorías</h3>
                <ul>
                  @foreach ($bcategory as $cat)
                  <li><a class="active" href="{{url('blog/cat/list',$cat->id)}}">{{$cat->category_name_es}}</a> </li>
                  @endforeach
                  
                  
                 
                </ul>
              </div>
  
              {{-- <div class="widget widget-newsletter">
                <h3 class="widget_title">Newsletter</h3>
                <form class="newsletter-form">
                  <input class="form-control" type="email" placeholder="Enter Your Email" />
                  <button type="submit" class="vs-btn style4">Submit</button>
                </form>
              </div> --}}
  
           
  
              <div class="widget widget-social">
                <h3 class="widget_title">Síguenos en</h3>
                <div class="social-style widget_social_style">
                  <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

  
  <!-- Blog Details Content Area End -->
@endsection
