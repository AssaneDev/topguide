
@php
   
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
   $locale = Session::get('local') ?? 'fr';
    Session::put('local',$locale);
    App::setLocale($locale);

@endphp
<section class="space bg-light gallery2 shape-mockup-wrap">
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="20%" data-left="0%">
      <img src=" {{asset('assets/img/shape/visit-left.png')}} " alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="20%" data-right="0%">
      <img src=" {{asset('assets/img/shape/visit-right.png')}} " alt="svg">
    </div>
    <div class="shadow-color"></div>
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
          <div class="title-area">
            @if ($locale == 'fr')
            <span class="sec-subtitle">Allons Découvrir</span>
            <h2 class="sec-title h1">10 choses impressionnantes à savoir sur le SÉNÉGAL </h2>
            @endif

            @if ($locale == 'en')
            <span class="sec-subtitle">Let's discover</span>
            <h2 class="sec-title h1">10 impressive things to know about SENEGAL </h2>
            @endif

            @if ($locale == 'es')
            <span class="sec-subtitle">Descubramos</span>
            <h2 class="sec-title h1">10 cosas impresionantes que hay que saber sobre SENEGAL </h2>
            @endif
          
            {{-- <p class="sec-text"> Nous croyons en un tourisme responsable et nous nous efforçons de minimiser notre impact sur l'environnement et de maximiser les retombées positives pour les communautés locales..</p> --}}
          </div>
        </div>
      </div>
      <div class="gallery-style-2">
        
     

            <iframe width="560" height="475" src="https://www.youtube.com/embed/LhumUh8iTeA?si=p3ZWQM8qmMwSLyKh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

      </div>
    </div>
  </section>