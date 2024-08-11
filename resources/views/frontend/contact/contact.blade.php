@extends('frontend.main_master')
@section('main')
@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);        
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
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



@if ($locale == 'fr')
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
                vacance au senegal <br>
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
              <li>Mobile: <a href="#123456789">(+221)75 752 91 48</a></li>
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
              <li>Lundi - Samedi: 8h:00 - 22h:00</li>
              <li>Dimanche: 9h:30 - 12h00</li>
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
@endif


@if ($locale == 'en')
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
              holidays in senegal <br>
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
              <li>Mobile: <a href="#123456789">(+221)75 752 91 48</a></li>
              <li>Fixed line: <a href="#123456789">33 999 47 28</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="contact-box">
            <div class="contact-box_icon">
              <i class="fas fa-clock"></i>
            </div>
            <h3 class="contact-box__title h5">Office</h3>
            <ul class="contact-box_list">
              <li>Monday - Saturday: 8h:00 - 22h:00</li>
              <li>Sunday: 9h:30 - 12h00</li>
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
            <span class="sec-subtitle">Contact us</span>
            <h2 class="sec-title h1">Get in touchct</h2>
            <p class="sec-text">
              Do you have any questions or would you like to plan your next adventure in Senegal? Our team is here to help !
            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 form-group">
          <input type="text" placeholder="Please enter your first name" name="fname" id="fname" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="text" placeholder=" Please enter your name" name="lname" id="lname" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="email" placeholder="Enter your email" name="email" id="email" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="number" placeholder="Telephone number" name="number" id="number" class="form-control" />
        </div>

        <div class="form-group col-12">
          <textarea placeholder="your message" name="messages" id="message" class="form-control"></textarea>
        </div>
        <div class="col-md-auto pt-lg-3">
          <button class="vs-btn style4" type="submit">Send Message</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endif


{{-- espagnol --}}


@if ($locale == 'es')
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
            <h3 class="contact-box__title h5">Dirección</h3>
            <p class="contact-box__text">
              vacaciones en senegal <br>
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
            <h3 class="contact-box__title h5">Contacto</h3>
            <ul class="contact-box_list">
              <li>Mobile: <a href="#123456789">(+221)75 752 91 48</a></li>
              <li>fijo: <a href="#123456789">33 999 47 28</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="contact-box">
            <div class="contact-box_icon">
              <i class="fas fa-clock"></i>
            </div>
            <h3 class="contact-box__title h5">Oficina</h3>
            <ul class="contact-box_list">
              <li>De lunes a sábado: 8h:00 - 22h:00</li>
              <li>Domingo: 9h:30 - 12h00</li>
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
            <span class="sec-subtitle">Contacto</span>
            <h2 class="sec-title h1">Contacto</h2>
            <p class="sec-text">
              ¿Tiene alguna pregunta o desea planificar su próxima aventura en Senegal? Nuestro equipo está aquí para ayudarte.            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 form-group">
          <input type="text" placeholder="Escriba su nombre" name="fname" id="fname" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="text" placeholder="Escribe tu nombre" name="lname" id="lname" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="email" placeholder="Escriba su dirección de correo electrónico" name="email" id="email" class="form-control" />
        </div>
        <div class="col-md-6 form-group">
          <input type="number" placeholder="Número de teléfono" name="number" id="number" class="form-control" />
        </div>

        <div class="form-group col-12">
          <textarea placeholder="su mensaje" name="messages" id="message" class="form-control"></textarea>
        </div>
        <div class="col-md-auto pt-lg-3">
          <button class="vs-btn style4" type="submit">Enviar mensaje</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endif
<!--==============================
    Contact Form Area End
  ==============================-->
<!--notification js -->
<script src="{{asset('backend/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/notifications/js/notifications.min.js')}}"></script>
<script src="{{asset('backend/assets/js/index3.js')}}"></script>
   ==============================-->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <!-- Toaster-->
 <script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
   case 'info':
   toastr.info(" {{ Session::get('message') }} ");
   break;
 
   case 'success':
   toastr.success(" {{ Session::get('message') }} ");
   break;
 
   case 'warning':
   toastr.warning(" {{ Session::get('message') }} ");
   break;
 
   case 'error':
   toastr.error(" {{ Session::get('message') }} ");
   break; 
  }
  @endif 
 </script>
@endsection