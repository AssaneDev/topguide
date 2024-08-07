@php
    $BlogPost = App\Models\BlogPost::latest()->limit(4)->get();
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Session;
   $locale = Session::get('local') ?? 'fr';
    Session::put('local',$locale);
    App::setLocale($locale);
@endphp

<section class="space space-extra-bottom blog-wrapper">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xl-6 col-lg-8 wow fadeInUp" data-wow-delay="0.3s">

          @if ($locale == 'fr')
          <div class="title-area">
            <span class="sec-subtitle">Blog & Nouvelles Du Sénégal</span>
            <h2 class="sec-title h1">Nos Dernieres articles</h2>
            <p class="sec-text">Ici, on partage  des conseils pratiques, des récits authentiques et des rencontres inoubliables avec une culture sénégalaise riche et chaleureuse.</p>
          </div>
          @endif


          @if ($locale == 'en')
          <div class="title-area">
            <span class="sec-subtitle">Senegal Blog & News</span>
            <h2 class="sec-title h1">Latest articles</h2>
            <p class="sec-text">Here, we shares practical advice, authentic stories and unforgettable encounters with a rich and warm Senegalese culture..</p>
          </div>
          @endif

          @if ($locale == 'es')
          <div class="title-area">
            <span class="sec-subtitle">Blog y noticias de Senegal</span>
            <h2 class="sec-title h1">Nuestros últimos artículos</h2>
            <p class="sec-text">Aquí, en comparte consejos prácticos, historias auténticas y encuentros inolvidables con una cultura senegalesa rica y cálida..</p>
          </div>
          @endif

          
        </div>
      </div>

      @if ($locale == 'fr')
      <div class="row vs-carousel" data-slide-show="3" data-arrows="false" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">
        @foreach ($BlogPost as $item)
            
    
         <div class="col-xl-4">
           <div class="vs-blog blog-style3">
             <div class="blog-img">
               <a href=""><img src="{{asset($item->post_image)}}" alt="blog image"></a>
             </div>
             <div class="blog-content">
               <h2 class="blog-title"><a href="{{ url('blog/detail/'.$item->post_slug) }}">{{$item->post_title}}</a></h2>
               <p class="blog-text">{!!$item->short_descp!!}</p>
               <div class="blog-bottom">
                 <a class="blog-date" href="{{ url('blog/detail/'.$item->post_slug) }}"><i class="fas fa-calendar-alt"></i> {{$item->created_at->format('d M Y')}} </a>
                 <a class="vs-btn style4" href="{{ url('blog/detail/'.$item->post_slug) }}">Voir plus <i class="fal fa-arrow-right"></i></a>
               </div>
             </div>
           </div>
         </div>
         @endforeach  
       
       </div>
       
      @endif

      @if ($locale == 'en')
      <div class="row vs-carousel" data-slide-show="3" data-arrows="false" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">
        @foreach ($BlogPost as $item)
            
    
         <div class="col-xl-4">
           <div class="vs-blog blog-style3">
             <div class="blog-img">
               <a href=""><img src="{{asset($item->post_image)}}" alt="blog image"></a>
             </div>
             <div class="blog-content">
               <h2 class="blog-title"><a href="{{ url('blog/detail/'.$item->post_slug_en) }}">{{$item->post_title_en}}</a></h2>
               <p class="blog-text">{!!$item->short_descp_en!!}</p>
               <div class="blog-bottom">
                 <a class="blog-date" href="{{ url('blog/detail/'.$item->post_slug) }}"><i class="fas fa-calendar-alt"></i> {{$item->created_at->format('d M Y')}} </a>
                 <a class="vs-btn style4" href="{{ url('blog/detail/'.$item->post_slug) }}">Read more <i class="fal fa-arrow-right"></i></a>
               </div>
             </div>
           </div>
         </div>
         @endforeach  
       
       </div>

      @endif

      @if ($locale == 'es')
      <div class="row vs-carousel" data-slide-show="3" data-arrows="false" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">
        @foreach ($BlogPost as $item)
            
    
         <div class="col-xl-4">
           <div class="vs-blog blog-style3">
             <div class="blog-img">
               <a href=""><img src="{{asset($item->post_image)}}" alt="blog image"></a>
             </div>
             <div class="blog-content">
               <h2 class="blog-title"><a href="{{ url('blog/detail/'.$item->post_slug_es) }}">{{$item->post_title_es}}</a></h2>
               <p class="blog-text">{!!$item->short_descp_es!!}</p>
               <div class="blog-bottom">
                 <a class="blog-date" href="{{ url('blog/detail/'.$item->post_slug) }}"><i class="fas fa-calendar-alt"></i> {{$item->created_at->format('d M Y')}} </a>
                 <a class="vs-btn style4" href="{{ url('blog/detail/'.$item->post_slug) }}">Ver más <i class="fal fa-arrow-right"></i></a>
               </div>
             </div>
           </div>
         </div>
         @endforeach  
       
       </div>
      @endif


    </div>
  </section>