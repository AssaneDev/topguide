@extends('frontend.main_master')
@section('main')

  <!--==============================
	  Tours Area Start
	==============================-->
 
  <!--==============================
	  Tours Area End
	==============================-->

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
  

  @if ($locale =='fr')
  <div class="breadcumb-wrapper" data-bg-src=" {{asset('frontend/assets/img/breadcumb/desti.png')}} " style="width: 1280;height: 800;">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title" style="display: none" >Destinations</h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.html" style="display: none">Acceuil</a></li>
            <li style="display: none">Destinations</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @endif


  <!--==============================
	  Hero Area End
	==============================-->

  <!--==============================
     Destiniations Area Start 
  ==============================-->

  <section class="space-top space-extra-bottom">
    <div class="container">
      <div class="row justify-content-center">
      

        

        @foreach ($destination as $desti)
        <div class="col-xl-4 col-lg-6 col-sm-6 filter-item hightTolow">
          <div class="package-style1">
            <div class="package-img">
              <a href="{{ url('excursion/detail/'.$desti->id) }}"><img src="{{asset($desti->image_cap)}}" alt="Package Image"></a>
            </div>
            <div class="package-content">
              <div class="package-review">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
              </div>
              <h3 class="package-title"><a href="{{ url('excursion/detail/'.$desti->id) }}" > {{$desti->name}} </a></h3>
              <p class="package-text">{{$desti->lieux}}</p>
              <div class="package-meta">
                <a href="{{ url('excursion/detail/'.$desti->id) }}"><i class="fas fa-calendar-alt"></i> Jours: {{$desti->dure_sejour}}</a>
                <span class="package-price">{{$desti->prix}} €/Pers</span>
              
              </div>
              <div class="package-footer">
                <a href="{{ url('excursion/detail/'.$desti->id) }}"class="vs-btn">Voir detail</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
            
      

   
      
    

    


      
        
      </div>
      {{-- <div class="vs-pagination pt-lg-2">
           
        {{$destination->links('vendor.pagination.custom')}}


    
  </div> --}}
    </div>
  </section>

  
@endsection