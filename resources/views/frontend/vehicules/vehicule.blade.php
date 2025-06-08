@extends('frontend.main_master')
@section('main')

@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);        
@endphp


      <!-- ==============================
    Hero Area Start 
  ============================== -->
  <section class="hero-layout2">
    <div>
      <div class="vs-carousel hero-slider3" data-slide-show="1" data-fade="true" >
        <div class="hero-slide hero-mask" data-bg-src=" {{asset('assets/img/about/herbergement221.jpg')}} ">
          <div class="container">
            <div class="row align-items-center justify-content-between">
              <div class="col-lg-8">
                <div class="hero-content">
                  @if ($locale == 'fr')
                  <span class="hero-subtitle">Allons</span>
                  <h1 class="hero-title">Profitez pleinement de votre voyage </h1>
                  <p class="hero-text"> Voitures mises à votre disposition pour la réussite de votre séjour
                  </p>
                  @endif


                  @if ($locale == 'en')
                  <span class="hero-subtitle">Let's go</span>
                  <h1 class="hero-title">Make the most of your trip </h1>
                  <p class="hero-text"> Cars at your disposal to make your stay a success
                  </p>
                  @endif



                  @if ($locale == 'es')
                  <span class="hero-subtitle">Vamos.</span>
                  <h1 class="hero-title">Aproveche al máximo su viaje </h1>
                  <p class="hero-text"> Coches a su disposición para que su estancia sea un éxito
                  </p>
                  @endif
                 
                  {{-- <a href="about.html" class="vs-btn style4">Read More</a> --}}
                </div>
              </div>
              <div class="col-lg-4">
                <div class="hero-img">
                  <img class="shape-mokup d-none d-lg-block" src=" {{asset('assets/img/banner/brush.png')}} " alt="brush">
                 
                </div>
              </div>
            </div>
          </div>
        </div>
       
      
      </div>
   
    </div>
   
  </section>
  <!-- ============================
    Hero Area End 
  ==============================-->

  <!-- ==============================
    About Area Start 
  ============================== -->
  <section class="space shape-mockup-wrap">
    <div class="shape-mockup d-none d-xl-block ripple-animation z-index-negative" data-top="10%" data-left="5%">
      <img src=" {{asset('assets/img/shape/Ballon.png')}} " alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="10%" data-right="10%">
      <img src=" {{asset('assets/img/shape/up-arrow.png')}} " alt="svg">
    </div>
    <div class="  shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="0%" data-left="0%">
      <img class="plane2" src="{{asset('assets/img/shape/plane2.png')}}" alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="15%" data-right="5%">
      <img src=" {{asset('assets/img/shape/Lines.png')}} " alt="svg">
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-5">

          @if ($locale == 'fr')
          <div class="about-content">
            <div class="title-area">
              {{-- <span class="sec-subtitle">We are Travolo</span> --}}
              <h2 class="sec-title h1">Location De Voitures </h2>
              <h4 class="sec-text" style="font-size: 18px; font-weight: 600">Pour vos besoins de location de véhicules, Nous vous offrons diverses options : avec ou sans chauffeur, ou encore une formule complète incluant véhicule, chauffeur, et guide.<br><br>
              
                Nos tarifs varient en fonction du choix de véhicule, de la distance et du type de voyage (privatif ou collectif, avec ou sans guide).<br><br>
                PERSONNEL ACCOMPAGNATEUR<br>
                Notre équipe est composée de chauffeurs et de guides parlant français, anglais, espagnol et allemand.
                Faites-nous part de vos préférences, nous nous occupons du reste..</h4>
            </div>
            <ul class="about-list1" style="width: auto">
                <li style="font-size: 18px; font-weight: 600">GAMME DE VÉHICULES
                  <ol> •  Bus</ol>
                <ol>•  Autocars de luxe</ol>
                <ol>•  Minibus climatisés</ol>
                <ol>•  Véhicules utilitaires.</ol>
              </li>
                <li style="font-size: 18px; font-weight: 600">OPTIONS DE LOCATION
                  <ol>•Véhicules avec chauffeur</ol>
                  <ol>•Véhicules sans chauffeur</ol>
                  <ol>•Véhicules avec chauffeur et guides</ol>
                </li>
                <li style="font-size: 18px; font-weight: 600">ITINÉRAIRES
                  <ol>• Transferts depuis l'aéroport et destinations à travers le Sénégal</ol>
                  <ol>•  Circuits et excursions à travers le Sénégal</ol>
                </li>
           
            </ul>
            {{-- <a href="about.html" class="vs-btn style4">View More</a> --}}
          </div>
          @endif

          @if ($locale == 'en')
          <div class="about-content">
            <div class="title-area">
              {{-- <span class="sec-subtitle">We are Travolo</span> --}}
              <h2 class="sec-title h1">Rent a car </h2>
              <h4 class="sec-text" style="font-size: 18px; font-weight: 600">For your vehicle rental needs, we offer a range of options: with or without driver, or a complete package including vehicle, driver and guide..<br><br>
              
                Our prices vary according to the choice of vehicle, distance and type of trip (private or group, with or without a guide).<br><br>
                ACCOMPANYING STAFF<br>
                Our team is made up of drivers and guides who speak French, English, Spanish and German.
                Tell us your preferences and we'll take care of the rest.</h4>
            </div>
            <ul class="about-list1" style="width: auto">
                <li style="font-size: 18px; font-weight: 600">RANGE OF VEHICLES
                <ol>•  Cars.</ol>
                  <ol> •  Bus</ol>   
                <ol>•  Luxury Car</ol>
                <ol>•  Minibus </ol>
              </li>
                <li style="font-size: 18px; font-weight: 600">RENTAL OPTIONS
                  <ol>•Vehicles with driver</ol>
                  <ol>•Vehicles without a driver</ol>
                  <ol>•Vehicles with drivers and guides</ol>
                </li>
                <li style="font-size: 18px; font-weight: 600">ITINERARIES
                  <ol>• Airport transfers and destinations throughout Senegal</ol>
                  <ol>•  Tours and excursions in Senegal</ol>
                </li>
           
            </ul>
            {{-- <a href="about.html" class="vs-btn style4">View More</a> --}}
          </div>
          @endif

          @if ($locale == 'es')
          <div class="about-content">
            <div class="title-area">
              {{-- <span class="sec-subtitle">We are Travolo</span> --}}
              <h2 class="sec-title h1">Alquiler de vehículos </h2>
              <h4 class="sec-text" style="font-size: 18px; font-weight: 600">Para sus necesidades de alquiler de vehículos, le ofrecemos diversas opciones: con o sin conductor, o un paquete completo que incluye vehículo, conductor y guía..<br><br>
              
                Nuestros precios varían en función de la elección del vehículo, la distancia y el tipo de viaje (privado o en grupo, con o sin guía).<br><br>
                PERSONAL ACOMPAÑANTE<br>
                Nuestro equipo está formado por conductores y guías que hablan francés, inglés, español y alemán.
                Díganos sus preferencias y nosotros nos encargamos del resto.</h4>
            </div>
            <ul class="about-list1" style="width: auto">
                <li style="font-size: 18px; font-weight: 600">GAMA DE VEHÍCULOS
                  <ol> •  Autobús</ol>
                <ol>•  Minibús </ol>
                <ol>•  Vehículos </ol>
              </li>
                <li style="font-size: 18px; font-weight: 600">OPCIONES DE ALQUILER
                  <ol>•Vehículos con chófer</ol>
                  <ol>•Vehículos sin conductor</ol>
                  <ol>•Vehículos con conductor y guías</ol>
                </li>
                <li style="font-size: 18px; font-weight: 600">ITINERARIOS
                  <ol>• Traslados al aeropuerto y destinos en todo Senegal</ol>
                  <ol>•  Visitas y excursiones en Senegal</ol>
                </li>
           
            </ul>
            {{-- <a href="about.html" class="vs-btn style4">View More</a> --}}
          </div>
          @endif

          
        </div>
        <div class="col-xl-6">
          <div class="img-box3">
            <img class="img1" src="{{asset('assets/img/about/herbergement221.jpg')}}" alt="about image">
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ==============================
    About Area End 
  ============================== -->
@endsection