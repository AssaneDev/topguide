<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
 
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Vacance au Sénégal - Agence local Sénégalaise d'organisation d'Exursions-Circuits-Voyages d'entreprise</title>
  <meta name="author" content="vecuro">
  <meta name="description" content="Vacance au senegal -  Agence local d'exursions et de circuits">
  <meta name="keywords" content="Vacance au senegal-   Agence local d'exursions et de circuits">
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!--==============================
        All CSS File
    ============================== -->
  <!-- Bootstrap -->
  <!-- <link rel="stylesheet" href="assets/css/app.min.css"> -->
  <link rel="stylesheet" href=" {{asset('assets/css/bootstrap.min.css')}} ">
  <!-- Fontawesome Icon -->
  <link rel="stylesheet" href=" {{asset('assets/css/fontawesome.min.css')}} ">
  <!-- Magnific Popup -->
  <link rel="stylesheet" href=" {{asset('assets/css/magnific-popup.min.css')}} ">
  <!-- Slick Slider -->
  <link rel="stylesheet" href=" {{asset('assets/css/slick.min.css')}} ">
  <!-- Theme Custom CSS -->
  <link rel="stylesheet" href=" {{asset('assets/css/style.css')}} ">



<script async src="https://www.googletagmanager.com/gtag/js?id=G-N7J417T7SV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-N7J417T7SV');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-W8G6KK4K');</script>
  <!-- End Google Tag Manager -->

  <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="60239d0b-c958-4f1e-b562-6faf74f7b289";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

</head>


<body>
    <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W8G6KK4K"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
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
          <a href="{{url('/')}}"><img src=" {{asset('assets/img/logo2.svg')}} " alt="Travolo"></a>
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
  <script src=" {{asset('assets/js/vendor/jquery-3.6.0.min.js')}} "></script>
  <!-- Slick Slider -->
  <script src="{{asset('assets/js/slick.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <!-- Magnific Popup -->
  <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
  <!-- jquery Ui -->
  <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
  <!-- Circle Progress -->
  <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>
  <!-- isotope -->
  <script src="{{asset('assets/js/imagesLoaded.js')}}"></script>
  <script src="{{asset('assets/js/isotope.js')}}"></script>
  <!-- Wow.js -->
  <script src="{{asset('assets/js/wow.min.js')}}"></script>
  <!-- Main Js File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>