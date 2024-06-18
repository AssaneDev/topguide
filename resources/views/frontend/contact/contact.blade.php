@extends('frontend.main_master')
@section('main')

{{-- <div class="breadcumb-wrapper" data-bg-src="{{asset('frontend/assets/img/breadcumb/breadcumb-bg.jpg')}}assets/img/breadcumb/breadcumb-bg.jpg">
  <div class="container z-index-common">
    <div class="breadcumb-content">
      <h1 class="breadcumb-title">Contact Us</h1>
      <div class="breadcumb-menu-wrap">
        <ul class="breadcumb-menu">
          <li><a href="index.html">Home</a></li>
          <li>Contact</li>
        </ul>
      </div>
    </div>
  </div>
</div> --}}
<!--==============================
    Hero Area End
  ==============================-->

<!--==============================
    Contact box Area Start
  ==============================-->
<section class="space contact-box_wrapper">
  <div class="outer-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="contact-box">
            <div class="contact-box_icon">
              <i class="fas fa-map-marked-alt"></i>
            </div>
            <h3 class="contact-box__title h5">Address</h3>
            <p class="contact-box__text">
                Soluguide <br>
                R1 Mbour
                Thies, Sénégal
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="contact-box">
            <div class="contact-box_icon">
              <i class="fas fa-address-card"></i>
            </div>
            <h3 class="contact-box__title h5">Contact</h3>
            <ul class="contact-box_list">
              <li>Mobile: <a href="#123456789">77 646 66 70</a></li>
              <li>Fixe: <a href="#123456789">33 999 47 28</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="contact-box">
            <div class="contact-box_icon">
              <i class="fas fa-clock"></i>
            </div>
            <h3 class="contact-box__title h5">Bureau</h3>
            <ul class="contact-box_list">
              <li>Lundi - Samedi: 8:00 - 22:00</li>
              <li>Dimance: 9:30 - 12h00</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--==============================
    Contact box Area End
  ==============================-->

<!--==============================
    Contact Form Area End
  ==============================-->
<div class="space bg-light">
  <div class="container">
    <form  action="{{route('send.mail')}}" method="POST">
        @csrf
      <div class="row justify-content-center text-center">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
          <div class="title-area">
            <span class="sec-subtitle">Contactez Nous</span>
            <h2 class="sec-title h1">Entrez en contact</h2>
            <p class="sec-text">
                Vous avez des questions ou souhaitez planifier votre prochaine aventure au Sénégal ? Notre équipe est là pour vous aider !
            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 form-group">
          <input type="text" placeholder="Entrer votre prénom" name="fname" id="fname" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="text" placeholder="Entrer votre nom" name="lname" id="lname" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="email" placeholder="Entrer votre email" name="email" id="email" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="number" placeholder="Numéro Téléphone" name="number" id="number" class="form-control" />
        </div>

        <div class="form-group col-12">
          <textarea placeholder="votre message" name="messages" id="message" class="form-control"></textarea>
        </div>
        <div class="col-md-auto pt-lg-3">
          <button class="vs-btn style4" type="submit">Envoyez Message</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--==============================
    Contact Form Area End
  ==============================-->

@endsection