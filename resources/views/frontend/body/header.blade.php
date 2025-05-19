@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);

        
@endphp

{{-- <header class="vs-header header-layout2">
  <div class="container">
    <div class="header-top">
      <div class="row justify-content-between align-items-center">
        <div class="col d-none d-lg-block">
          <ul class="header-contact">
            <li><i class="fas fa-envelope"></i> <a href="mailto:info@travolo.com">vacancesenegal221@gmail.com</a>
            </li>
            <li><i class="fas fa-phone-alt"></i> <a href="tel:02073885619">+221 75 752 9148</a></li>
            <li> <a href="https://api.whatsapp.com/send/?phone=776466670&text&type=phone_number&app_absent=0"> 
              <img style="width: 40px" src="{{asset('frontend/assets/img/whatsapp.png')}}" alt=""> Discuter sur whatsapp
            </a></li>
          </ul>
        </div>
        <div class="col-auto">
          
        </div>
        <div class="col-auto d-flex ">

         
          <div class="header-dropdown">
            <img src="{{asset('frontend/assets/img/belgium.png')}}" style="width: 40px; height: 40px;" alt="">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown"
              aria-expanded="false">Langues</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
              <li>
               
                
                <a href="{{route('ang')}}">English</a>
                <a href="{{route('es')}}">Espagnol</a>
                <a href="{{route('fr')}}">Français</a>
                

                
                
               
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

                  



                </ul>
              </nav>
              <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </header> --}}






    <!--==============================
      Header Area
    ==============================-->
    <header class="vs-header header-layout6">
      <div class="sticky-wrapper">
        <div class="sticky-active">
          <div class="container position-relative z-index-common">
            <div class="row align-items-center justify-content-between">
              <div class="col-auto">
                <div class="vs-logo">
                  <a href="index.html"><img src="{{asset('frontend/assets/img/logor.png')}}" style="width: 100px;height: 100px;" alt="logo"></a>
                </div>
              </div>
              <div class="col text-end">
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
                          <a href="{{route('destination')}}">Circuits</a>
                          
                        </li>
                        <li>
                          <a href="{{route('excursion')}}">Excursions</a>
                          
                        </li>
                        <li>
                          <a href="{{route('blog.list')}}">Blog</a>
                          
                        </li>
                      
                        <li>
                          <a href="{{route('contact')}}">Contact</a>
                        </li>
                       
                    @endif



                  {{-- <button class="vs-btn style4">Devenir Partenaire</button> --}}



                </ul>
                </nav>
                <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
              </div>
              <div class="col-auto d-none d-xl-block">
                <div class="header-right">
                  <ul>
                    {{-- <li class="mr-40">
                      <div class="header-btns">
                        <button class="searchBoxTggler">
                          <i class="fal fa-search"></i>
                        </button>
                        <button class="sideCartToggler">
                          <i class="fas fa-shopping-basket"></i><span class="button-badge">2</span>
                        </button>
                      </div>
                    </li> --}}
                    <li>
                      {{-- <a class="vs-btn style7" href="contact.html">
                        Get in Touch
                        <i>
                          <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M4.85355 4.35355C5.04882 4.15829 5.04882 3.84171 4.85355 3.64645L1.67157 0.464466C1.47631 0.269204 1.15973 0.269204 0.964466 0.464466C0.769204 0.659728 0.769204 0.976311 0.964466 1.17157L3.79289 4L0.964466 6.82843C0.769204 7.02369 0.769204 7.34027 0.964466 7.53553C1.15973 7.7308 1.47631 7.7308 1.67157 7.53553L4.85355 4.35355ZM4 4.5H4.5V3.5H4V4.5Z"
                              fill="white" />
                          </svg>
                        </i>
                      </a> --}}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  
    <!--==============================
      Hero Area Start 
    ==============================-->