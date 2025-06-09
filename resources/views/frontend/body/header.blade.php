@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);

        
@endphp



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
                  <a href="index.html"><img src="{{asset('assets/img/logo2.svg')}}" style="width: 100px;height: 100px;" alt="logo"></a>
                </div>
              </div>
              <div class="col text-end">
                <nav class="main-menu  menu-style1 d-none d-lg-block">
                  <ul>

                  
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