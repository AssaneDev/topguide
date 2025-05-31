@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);

        
@endphp

  @if ($locale == 'fr')
  <footer class="footer-wrapper footer-layout1 shape-mockup-wrap">

    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="20%" data-left="0%">
      <img src=" {{asset('assets/img/shape/tree-left.png')}} " alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="20%" data-right="0%">
      <img src=" {{asset('assets/img/shape/tree-right.png')}} " alt="svg">
    </div>
    <div class="container ">
      <div class="footer-newsletter2 space-top">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="newsletter-style2">
              <div class="newsletter-img">
                <img src=" {{asset('assets/img/shape/call.png')}} " alt="image">
              </div>
              <h3 class="newsletter-text">Contactez-nous 24/7</h3>
              <a href="tel:+221757529148"> +221 75 752 9148 </a>
              <a href="https://api.whatsapp.com/send/?phone=776466670&text&type=phone_number&app_absent=0"> 
                <img width="40px" src="{{asset('frontend/assets/img/whatsapp.png')}}" alt=""> whatsapp
              </a>

            </div>
          </div>
          {{-- <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="newsletter-style2">
              <div class="newsletter-img">
                <img src=" {{asset('frontend/assets/img/shape/share.png')}} " alt="image">
              </div>
              <h3 class="newsletter-text">Se conne</h3>
              <a href="#">Sign up for daily update</a>
            </div>
          </div> --}}
          <div class="col-lg-4 col-md-6 col-sm-12">
            <form class="form-group">
              <input type="email" class="form-control" placeholder="Enter votre email">
              <button class="vs-btn style4" type="submit">S'incrires</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="widget-area2">
      <div class="container">
        <div class="row g-5 justify-content-between">
          <div class="col-md-6 col-xl-3">
            <div class="widget footer-widget">
              <div class="vs-widget-about">
                <div class="footer-logo">
                  <a href="index.html"><img src=" {{asset('assets/img/logor.png')}} " alt="Travolo" class="logo" /></a>
                </div>
                <p class="footer-text">Nous croyons que chaque voyageur mérite une expérience authentique et inoubliable.</p>
                <div class="social-style1">
                  <a href="https://web.facebook.com/profile.php?id=61560799666028" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  {{-- <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-twitter"></i></a> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-2">
            <div class="widget widget_nav_menu footer-widget">
              <h3 class="widget_title">Navigation</h3>
              <div class="menu-all-pages-container">
                <ul class="menu">
                  <li><a href="{{url('/')}}"> Acceuil</a></li>
                  <li><a href="{{route('destination')}}"> Destinations</a></li>
                  <li><a href="{{route('blog.list')}}">Blog</a></li>
                  <li><a href="{{route('contact')}}">Contact</a></li>
                
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-2">
            <div class="widget widget_nav_menu footer-widget footer-contact">
              <h3 class="widget_title">Contact</h3>
              <div class="menu-all-pages-container">
                <ul class="menu">
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i> Mbour, Saly
                      .</a></li>
                  <li><a href="#"><i class="fas fa-envelope"></i> vacancesenegal221@gmail.com</a></li>
                  <li><a href="#"><i class="fas fa-phone-alt"></i> +221 75 752 9148 </a></li>
                  <li><a href="#"><i class="fas fa-phone-alt"></i> 33 999 41 57 </a></li>

                </ul>
              </div>
            </div>
          </div>
          {{-- <div class="col-md-6 col-xl-3">
            <div class="widget footer-widget">
              <h4 class="widget_title">Our Instagram</h4>
              <div class="sidebar-gallery">
                <a href=" {{asset('frontend/assets/img/footer/insta1.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta1.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta2.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta2.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta3.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta3.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta4.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta4.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta5.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta5.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta6.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta6.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="container">
      <div class="copyright-wrap">
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-auto">
            <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> <script>document.write(new Date().getFullYear())</script> <a href="#">Entragence</a>.
              All Rights Reserved By <a href="">vacanceausenegal</a></p>
          </div>
          <div class="col-auto d-none d-lg-block">
            <div class="copyright-menu">
              <ul class="list-unstyled">
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</footer>
  @endif


  @if ($locale == 'en')
  <footer class="footer-wrapper footer-layout1 shape-mockup-wrap">

    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="20%" data-left="0%">
      <img src=" {{asset('frontend/assets/img/shape/tree-left.png')}} " alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="20%" data-right="0%">
      <img src=" {{asset('frontend/assets/img/shape/tree-right.png')}} " alt="svg">
    </div>
    <div class="container ">
      <div class="footer-newsletter2 space-top">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="newsletter-style2">
              <div class="newsletter-img">
                <img src=" {{asset('frontend/assets/img/shape/call.png')}} " alt="image">
              </div>
              <h3 class="newsletter-text">Contact us 24/7</h3>
              <a href="tel:+221757529148"> +221 75 752 9148 </a>
            </div>
          </div>
          {{-- <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="newsletter-style2">
              <div class="newsletter-img">
                <img src=" {{asset('frontend/assets/img/shape/share.png')}} " alt="image">
              </div>
              <h3 class="newsletter-text">Se conne</h3>
              <a href="#">Sign up for daily update</a>
            </div>
          </div> --}}
          <div class="col-lg-4 col-md-6 col-sm-12">
            <form class="form-group">
              <input type="email" class="form-control" placeholder="Enter votre email">
              <button class="vs-btn style4" type="submit">Get in</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="widget-area2">
      <div class="container">
        <div class="row g-5 justify-content-between">
          <div class="col-md-6 col-xl-3">
            <div class="widget footer-widget">
              <div class="vs-widget-about">
                <div class="footer-logo">
                  <a href="index.html"><img src=" {{asset('frontend/assets/img/logor.png')}} " alt="Travolo" class="logo" /></a>
                </div>
                <p class="footer-text">We believe that every traveller deserves an authentic and unforgettable experience.</p>
                <div class="social-style1">
                  <a href="https://web.facebook.com/profile.php?id=61560799666028" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  {{-- <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-twitter"></i></a> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-2">
            <div class="widget widget_nav_menu footer-widget">
              <h3 class="widget_title">Navigate</h3>
              <div class="menu-all-pages-container">
                <ul class="menu">
                  <li><a href="{{url('/')}}"> Home</a></li>
                  <li><a href="{{route('destination')}}"> Destination</a></li>
                  <li><a href="{{route('blog.list')}}">Blog</a></li>
                  <li><a href="{{route('contact')}}">Contact us</a></li>
                
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-2">
            <div class="widget widget_nav_menu footer-widget footer-contact">
              <h3 class="widget_title">Contact</h3>
              <div class="menu-all-pages-container">
                <ul class="menu">
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i> Mbour, Saly
                      .</a></li>
                  <li><a href="#"><i class="fas fa-envelope"></i> contact@vacancesenegal.com</a></li>
                  <li><a href="#"><i class="fas fa-phone-alt"></i> +221 75 752 9148 </a></li>
                </ul>
              </div>
            </div>
          </div>
          {{-- <div class="col-md-6 col-xl-3">
            <div class="widget footer-widget">
              <h4 class="widget_title">Our Instagram</h4>
              <div class="sidebar-gallery">
                <a href=" {{asset('frontend/assets/img/footer/insta1.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta1.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta2.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta2.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta3.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta3.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta4.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta4.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta5.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta5.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta6.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta6.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="container">
      <div class="copyright-wrap">
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-auto">
            <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> <script>document.write(new Date().getFullYear())</script> <a href="#">Entragence</a>.
              All Rights Reserved By <a href="">vacanceausenegal</a></p>
          </div>
          <div class="col-auto d-none d-lg-block">
            <div class="copyright-menu">
              <ul class="list-unstyled">
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</footer>
  @endif

  @if ($locale == 'es')
  <footer class="footer-wrapper footer-layout1 shape-mockup-wrap">

    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="20%" data-left="0%">
      <img src=" {{asset('frontend/assets/img/shape/tree-left.png')}} " alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="20%" data-right="0%">
      <img src=" {{asset('frontend/assets/img/shape/tree-right.png')}} " alt="svg">
    </div>
    <div class="container ">
      <div class="footer-newsletter2 space-top">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="newsletter-style2">
              <div class="newsletter-img">
                <img src=" {{asset('frontend/assets/img/shape/call.png')}} " alt="image">
              </div>
              <h3 class="newsletter-text">Contáctenos 24/7</h3>
              <a href="tel:+221757529148"> +221 75 752 9148 </a>
            </div>
          </div>
          {{-- <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="newsletter-style2">
              <div class="newsletter-img">
                <img src=" {{asset('frontend/assets/img/shape/share.png')}} " alt="image">
              </div>
              <h3 class="newsletter-text">Se conne</h3>
              <a href="#">Sign up for daily update</a>
            </div>
          </div> --}}
          <div class="col-lg-4 col-md-6 col-sm-12">
            <form class="form-group">
              <input type="email" class="form-control" placeholder="Enter votre email">
              <button class="vs-btn style4" type="submit">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="widget-area2">
      <div class="container">
        <div class="row g-5 justify-content-between">
          <div class="col-md-6 col-xl-3">
            <div class="widget footer-widget">
              <div class="vs-widget-about">
                <div class="footer-logo">
                  <a href="index.html"><img src=" {{asset('frontend/assets/img/logor.png')}} " alt="Travolo" class="logo" /></a>
                </div>
                <p class="footer-text">Creemos que todo viajero merece una experiencia auténtica e inolvidable.</p>
                <div class="social-style1">
                  <a href="https://web.facebook.com/profile.php?id=61560799666028" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  {{-- <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                  <a href="#" target="_blank"><i class="fab fa-twitter"></i></a> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-2">
            <div class="widget widget_nav_menu footer-widget">
              <h3 class="widget_title">Navegue por</h3>
              <div class="menu-all-pages-container">
                <ul class="menu">
                  <li><a href="{{url('/')}}"> Inicio</a></li>
                  <li><a href="{{route('destination')}}"> Destino</a></li>
                  <li><a href="{{route('blog.list')}}">Blog</a></li>
                  <li><a href="{{route('contact')}}">Contáctenos</a></li>
                
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-2">
            <div class="widget widget_nav_menu footer-widget footer-contact">
              <h3 class="widget_title">Contacto</h3>
              <div class="menu-all-pages-container">
                <ul class="menu">
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i> Mbour, Saly
                      .</a></li>
                  <li><a href="#"><i class="fas fa-envelope"></i> contact@vacancesenegal.com</a></li>
                  <li><a href="#"><i class="fas fa-phone-alt"></i> +221 75 752 9148 </a></li>
                </ul>
              </div>
            </div>
          </div>
          {{-- <div class="col-md-6 col-xl-3">
            <div class="widget footer-widget">
              <h4 class="widget_title">Our Instagram</h4>
              <div class="sidebar-gallery">
                <a href=" {{asset('frontend/assets/img/footer/insta1.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta1.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta2.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta2.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta3.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta3.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta4.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta4.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta5.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta5.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
                <a href=" {{asset('frontend/assets/img/footer/insta6.jpg')}} " class="popup-image"><img src=" {{asset('frontend/assets/img/footer/insta6.jpg')}} " alt="Gallery Image" class="w-100" />
                </a>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="container">
      <div class="copyright-wrap">
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-auto">
            <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> <script>document.write(new Date().getFullYear())</script> <a href="#">Entragence</a>.
              All Rights Reserved By <a href="">vacanceausenegal</a></p>
          </div>
          <div class="col-auto d-none d-lg-block">
            <div class="copyright-menu">
              <ul class="list-unstyled">
                <li><a href="#">Privacidad</a></li>
                <li><a href="#">Términos & Condiciones</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</footer>
  @endif