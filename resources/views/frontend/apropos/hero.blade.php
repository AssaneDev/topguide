@php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
     $locale = Session::get('local') ?? 'fr';
      Session::put('local',$locale);
      App::setLocale($locale);

      
@endphp
  
  <!--==============================
	  Hero area Start
	=
      <!--==============================
          Hero Area End
        ==============================-->