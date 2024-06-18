@php
    $BlogPost = App\Models\BlogPost::latest()->limit(4)->get();
@endphp
<section class="space space-extra-bottom blog-wrapper">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xl-6 col-lg-8 wow fadeInUp" data-wow-delay="0.3s">
          <div class="title-area">
            <span class="sec-subtitle">Blog & Nouvelles Du Sénégal</span>
            <h2 class="sec-title h1">Nos Dernieres articles</h2>
            <p class="sec-text">Ici, TopGuide partage  des conseils pratiques, des récits authentiques et des rencontres inoubliables avec une culture sénégalaise riche et chaleureuse.</p>
          </div>
        </div>
      </div>
      <div class="row vs-carousel" data-slide-show="3" data-arrows="false" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">
       @foreach ($BlogPost as $item)
           
   
        <div class="col-xl-4">
          <div class="vs-blog blog-style3">
            <div class="blog-img">
              <a href=""><img src="{{asset($item->post_image)}}" alt="blog image"></a>
            </div>
            <div class="blog-content">
              <h2 class="blog-title"><a href="blog-details.html">{{$item->post_title}}</a></h2>
              <p class="blog-text">{{$item->short_descp}}</p>
              <div class="blog-bottom">
                <a class="blog-date" href="blog-details.html"><i class="fas fa-calendar-alt"></i> {{$item->created_at->format('d M Y')}} </a>
                <a class="vs-btn style4" href="{{ url('blog/detail/'.$item->post_slug) }}">Voir plus <i class="fal fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        @endforeach  
      
      </div>
      <div class="text-center mb-30 wow fadeInUp pt-lg-2" data-wow-delay="0.7s">
        <a href="blog-grid.html" class="vs-btn">Voir Plus</a>
      </div>
    </div>
  </section>