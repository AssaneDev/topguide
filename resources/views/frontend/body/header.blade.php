@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);

        
@endphp

<header class="vs-header header-layout2">
  <div class="container">
    <div class="header-top">
      <div class="row justify-content-between align-items-center">
        <div class="col d-none d-lg-block">
          <ul class="header-contact">
            <li><i class="fas fa-envelope"></i> <a href="mailto:info@travolo.com">info@travolo.com</a>
            </li>
            <li><i class="fas fa-phone-alt"></i> <a href="tel:02073885619">020 7388 5619</a></li>
          </ul>
        </div>
        <div class="col-auto">
          <div class="header-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest-p"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
        <div class="col-auto d-flex ">
          <div class="header-dropdown">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown"
              aria-expanded="false">Englais</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
              <li>
               
                
                <a href="{{route('ang')}}">Englais</a>
                <a href="{{route('fr')}}">Français</a>
                <a href="{{route('es')}}">Espagnol</a>

                
                
               
              </li>
            </ul>
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

                    @if ($locale == 'en')
                        
                        <li>
                          <a href="{{url('/')}}">Home</a>
                          
                        </li>
                        <li>
                          <a href="{{route('apropos')}}">About</a>
                        
                        </li>


                        <li>
                          <a href="{{route('destination')}}">Destinations</a>
                          
                        </li>
                        <li>
                          <a href="{{route('blog.list')}}">Blog</a>
                          
                        </li>
                      
                        <li>
                          <a href="{{route('contact')}}">Contact</a>
                        </li>
                        
                            
                        @endif
                        @if ($locale == 'fr')
                        <li>
                          <a href="{{url('/')}}">Acceuil</a>
                          
                        </li>
                        <li>
                          <a href="{{route('apropos')}}">A propos</a>
                        
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
                       
                    @endif


                    @if ($locale == 'es')
                    <li>
                      <a href="{{url('/')}}">Casa</a>
                      
                    </li>
                    <li>
                      <a href="{{route('apropos')}}">Quiénes somos</a>
                    
                    </li>


                    <li>
                      <a href="{{route('destination')}}">Destinos</a>
                      
                    </li>
                    <li>
                      <a href="{{route('blog.list')}}">Blog</a>
                      
                    </li>
                  
                    <li>
                      <a href="{{route('contact')}}">Contacto</a>
                    </li>
                   
                @endif

                  {{-- <button class="vs-btn style4">Devenir Partenaire</button> --}}



                </ul>
              </nav>
              <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </header>
