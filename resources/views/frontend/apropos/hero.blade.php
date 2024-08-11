@php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
     $locale = Session::get('local') ?? 'fr';
      Session::put('local',$locale);
      App::setLocale($locale);

      
@endphp
  
  <!--==============================
	  Hero area Start
	==============================-->
    <div class="breadcumb-wrapper" data-bg-src=" {{asset('frontend/assets/img/breadcumb/breadcumb-bg.jpg')}}">
        <div class="container z-index-common">
          <div class="breadcumb-content">
            @if ($locale == 'fr')
            <h1 class="breadcumb-title">Vacance au  Sénégal</h1>
            @endif

            @if ($locale == 'en')
            <h1 class="breadcumb-title">Holiday in Senegal</h1>
            @endif

            @if ($locale == 'es')
            <h1 class="breadcumb-title">Vacaciones en Senegal</h1>
            @endif
           
            <div class="breadcumb-menu-wrap">
              <!-- <ul class="breadcumb-menu">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>About Us</li>
              </ul> -->
            </div>
          </div>
        </div>
      </div>
      <!--==============================
          Hero Area End
        ==============================-->