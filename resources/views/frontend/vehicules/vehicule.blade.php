@extends('frontend.main_master')
@section('main')
      <!-- ==============================
    Hero Area Start 
  ============================== -->
  <section class="hero-layout2">
    <div>
      <div class="vs-carousel hero-slider3" data-slide-show="1" data-fade="true" >
        <div class="hero-slide hero-mask" data-bg-src=" {{asset('frontend/assets/img/banner/vehicule.jpg')}} ">
          <div class="container">
            <div class="row align-items-center justify-content-between">
              <div class="col-lg-8">
                <div class="hero-content">
                  <span class="hero-subtitle">Allons</span>
                  <h1 class="hero-title">Profitez pleinement de votre voyage </h1>
                  <p class="hero-text"> Voitures mises à votre disposition pour la réussite de votre séjour
                  </p>
                  {{-- <a href="about.html" class="vs-btn style4">Read More</a> --}}
                </div>
              </div>
              <div class="col-lg-4">
                <div class="hero-img">
                  <img class="shape-mokup d-none d-lg-block" src=" {{asset('frontend/assets/img/banner/brush.png')}} " alt="brush">
                 
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
      <img src=" {{asset('frontend/assets/img/shape/Ballon.png')}} " alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="10%" data-right="10%">
      <img src=" {{asset('frontend/assets/img/shape/up-arrow.png')}} " alt="svg">
    </div>
    <div class="  shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="0%" data-left="0%">
      <img class="plane2" src="{{asset('frontend/assets/img/shape/plane2.png')}}" alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="15%" data-right="5%">
      <img src=" {{asset('frontend/assets/img/shape/Lines.png')}} " alt="svg">
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-5">
          <div class="about-content">
            <div class="title-area">
              {{-- <span class="sec-subtitle">We are Travolo</span> --}}
              <h2 class="sec-title h1">Location De Voitures </h2>
              <h4 class="sec-text" style="font-size: 18px; font-weight: 600">Pour vos besoins de location de véhicules, Top Guides vous offre diverses options : avec ou sans chauffeur, ou encore une formule complète incluant véhicule, chauffeur, et guide.<br><br>
              
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
        </div>
        <div class="col-xl-6">
          <div class="img-box3">
            <img class="img1" src="{{asset('frontend/assets/img/about/loc.jpg')}}" alt="about image">
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ==============================
    About Area End 
  ============================== -->
@endsection