<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Vacance au Sénégal</title>
  <meta name="author" content="vecuro">
  <meta name="description" content="Travolo -  Travel Agency & Tour Booking HTML Template">
  <meta name="keywords" content="Travolo -  Travel Agency & Tour Booking HTML Template">
  <meta name="robots" content="INDEX,FOLLOW">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Favicons - Place favicon.ico in the root directory -->
  <link rel="icon" type="image/png" href="assets/img/favicons/favicon.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

  <!--==============================
	  Google Fonts
	============================== -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!--==============================
	    All CSS File
	============================== -->
  <!-- Bootstrap -->
  <!-- <link rel="stylesheet" href="assets/css/app.min.css"> -->
  <link rel="stylesheet" href=" {{asset('frontend/assets/css/bootstrap.min.css')}} ">
  <!-- Fontawesome Icon -->
  <link rel="stylesheet" href=" {{asset('frontend/assets/css/fontawesome.min.css')}} ">
  <!-- Magnific Popup -->
  <link rel="stylesheet" href=" {{asset('frontend/assets/css/magnific-popup.min.css')}} ">
  <!-- Slick Slider -->
  <link rel="stylesheet" href=" {{asset('frontend/assets/css/slick.min.css')}} ">
  <!-- Theme Custom CSS -->
  <link rel="stylesheet" href=" {{asset('frontend/assets/css/style.css')}} ">
</head>

<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="60239d0b-c958-4f1e-b562-6faf74f7b289";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

<body>

  <!--********************************
  Code Start From Here 
	******************************** -->

  <!--==============================
    Mobile Menu
  ============================== -->
  <div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
      <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
      <div class="mobile-logo">
        <a href="index.html"><img src="assets/img/logo.svg" alt="Travolo"></a>
      </div>
      <div class="vs-mobile-menu">
        <ul>
          <li>
            <a href="{{url('/')}}">Acceuil</a>
            
          </li>
          <li>
            <a href="{{route('apropos')}}">A Propos</a>
           
          </li>


          <li>
            <a href="{{route('destination')}}">Destination</a>
            
          </li>
          <li>
            <a href="{{route('blog.list')}}">Blog</a>
            
          </li>
        
          <li>
            <a href="{{route('contact')}}">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!--==============================
    Sidemenu
  ============================== -->
  

  <!--==============================
    Cart Side bar
  ============================== -->

  <!--==============================
    Popup Search Box
  ============================== -->
 

  <!--==============================
    Header Area
  ==============================-->
 @include('frontend.body.header')

  @yield('main')

  <!--==============================
	  Footer Area
	============================== -->
    @include('frontend.body.footer')

  <!-- ********************************
    Code Ends Here 
	********************************* -->

  <!-- Scroll To Top -->
  <a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>

  <!-- ==============================
    All Js File
  ================================ -->
  <!-- Jquery -->
  <script src=" {{asset('frontend/assets/js/vendor/jquery-3.6.0.min.js')}} "></script>
  <!-- Slick Slider -->
  <script src="{{asset('frontend/assets/js/slick.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
  <!-- Magnific Popup -->
  <script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
  <!-- jquery Ui -->
  <script src="{{asset('frontend/assets/js/jquery-ui.min.js')}}"></script>
  <!-- Circle Progress -->
  <script src="{{asset('frontend/assets/js/circle-progress.min.js')}}"></script>
  <!-- isotope -->
  <script src="{{asset('frontend/assets/js/imagesLoaded.js')}}"></script>
  <script src="{{asset('frontend/assets/js/isotope.js')}}"></script>
  <!-- Wow.js -->
  <script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
  <!-- Main Js File -->
  <script src="{{asset('frontend/assets/js/main.js')}}"></script>
</body>

</html>