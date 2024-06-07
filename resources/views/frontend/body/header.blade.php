<header class="vs-header header-layout2">
    <div class="header-top">
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col d-none d-lg-block">
            <ul class="header-contact">
              <li><i class="fas fa-envelope"></i> <a href="mailto:info@travolo.com">reservez@topguide.com</a>
              </li>
              <li><i class="fas fa-phone-alt"></i> <a href="tel:02073885619">33 999 41 57</a></li>
            </ul>
          </div>
          <div class="col-auto">
            <div class="header-social">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
   
        </div>
      </div>
    </div>
    <div class="sticky-wrapper">
      <div class="sticky-active">
        <div class="container position-relative z-index-common">
          <div class="row align-items-center justify-content-between">
            <div class="col-auto">
              <div class="vs-logo">
                <a href="{{url('/')}}"><img src=" {{asset('frontend/assets/img/logor.png')}} " style="width: 100px;height: 100px;" alt="logo"></a>
              </div>
            </div>
            <div class="col text-end text-xl-center">
              <nav class="main-menu  menu-style1 d-none d-lg-block">
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
                  <button class="searchBoxTggler">Devenir Partenaire</button>
                </ul>
              </nav>
              <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </header>
