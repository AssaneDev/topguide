@php
  // use Illuminate\Support\Facades\App;
  // use Illuminate\Support\Facades\Session;
  //      $locale = Session::get('local') ?? 'fr';
  //       Session::put('local',$locale);
  //       App::setLocale($locale);

       
  $destination = App\Models\Destination::latest()->limit(3)->get();


    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);




@endphp

  <!--==============================
    Tour Package Area Start 
  ==============================-->
  <section class=" package-layout1">
    <div class="container ">
      <div class="row">
        <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
          <div class="package-top">
            <div class="title-area">
              <span class="sec-subtitle">Circuits Typiques</span>
              <h2 class="sec-title h1">Ils plaisent aux voyageurs</h2>
            </div>
            <div class="title-btn">
              <a class="vs-btn style4" href="{{route('destination')}}">Tous Les Circuits</a>
            </div>
          </div>
        </div>
      </div>

      @foreach ($destination as $item)
          <div class="package-style2">
            <div class="row gx-5 align-items-center">
              <div class="col-lg-4">
                <div class="package-img">
                  <a href="tour-booking.html">
                
                    <a href="{{ url('destination/detail/'.$item->id) }}">  <img src="{{asset($item->image_cap)}}" alt="destination image"> 
                    
                  </a>
                  <div class="price-box">
                    <p class="price-text">A Partir</p>
                    <span class="package-price"> {{$item->prix}}€ </span>
                  </div>
                  <div class="package-icon">
                    <a href="{{ url('destination/detail/'.$item->id) }}">
                      <i class="far fa-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="package-content">
                  <div class="package-review">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                    <span>5 (3)</span>
                  </div>
                  <h3 class="package-title"><a href="{{ url('destination/detail/'.$item->id) }}">{{$item->name}}</a></h3>
                  <p class="package-text">{!!$item->short_descp!!}</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="package-meta">
                  <ul>
                    <li>
                      <a href="{{ url('destination/detail/'.$item->id) }}"><i class="fas fa-calendar-alt"></i><strong>Durée</strong>{{$item->dure_sejour}}</a>
                      
                    </li>
                    <li>
                      <a href="{{ url('destination/detail/'.$item->id) }}"><i class="fab fa-telegram-plane"></i><strong> Type Circuit:</strong>{{$item->type_circuit}}</a>
                    </li>
                    <li>
                      <a href="{{ url('destination/detail/'.$item->id) }}"><i class="fas fa-map-marker-alt"></i><strong>Lieux:</strong>{{$item->lieux}}</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
      @endforeach

      


      
     
    </div>
  </section>
  <!--==============================
    Tour Package Area End 
  ==============================-->

  
  <section class=" shape-mockup-wrap">
    <div class="shape-mockup d-none d-xl-block ripple-animation z-index-negative" data-top="10%" data-left="5%">
      <img src="{{asset('assets/img/shape/Ballon.png')}}" alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="10%" data-right="10%">
      <img src="{{asset('assets/img/shape/up-arrow.png')}}" alt="svg">
    </div>
    {{-- <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="0%" data-left="0%">
      <img class="plane2" src="{{asset('assets/img/shape/afri.jpg')}}" alt="svg">
    </div> --}}
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="15%" data-right="5%">
      <img src="{{asset('assets/img/shape/Lines.png')}}" alt="svg">
    </div>

   
    @if ($locale == 'en')
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-xl-5">
              <div class="about-content">
                <div class="title-area">
                  <span class="sec-subtitle">Experience Your Holiday in Senegal </span>
                  <h2 class="sec-title h1">Guides & Practical Advice for Senegal </h2>
                  <h4 class="sec-text" style="font-size:22px; font-weight: 400">

                    Guides & Practical Advice for Senegal.  
                    Our reputation is built on our innovative practices in the travel sector, particularly our system that allows establishments to benefit from the services of a local professional tour guide accredited by the Ministry of Tourism. Our approach is based on the belief that progress can only be achieved with the involvement of stakeholders. Therefore, we place crucial importance on identifying your needs and implementing effective solutions to ensure the success of your travels. 

                  </h4>
                </div>
                <ul class="about-list1" style="font-size: 20px; font-weight: 400">
                  <li>Personal Guide .</li>
                  <li>Interpreter Specialist Guide.</li>
                  <li>Ornithology Guide.</li>
                  <li>Trek Guide.</li>
                
                
                  
                </ul>
                <a href="{{route('apropos')}}" class="vs-btn style4 ">Read More</a>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="img-box3">
                <img class="img1" src=" {{asset('frontend/assets/img/about/about-1-1.jpg')}} " alt="about image">
                <div class="bottom-img">
                  <img class="img2" src="{{asset('frontend/assets/img/about/deux.jpg')}}" alt="about image">
                  <img class="img3" src="{{asset('frontend/assets/img/about/about-1-3.jpg')}}" alt="about image">
                </div>
              </div>
            </div>
          </div>
        </div>
    @endif

    @if ($locale == 'fr')
      <!--==============================
    About Area Start 
  ==============================-->
  <section class=" about-layout1 bg-smoke">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="about-content">
            <div class="title-area">
              <span class="sec-subtitle">Vacance Sénégal</span>
              <h2 class="sec-title h1"> Votre Guide à la journée </h2>
              <p class="sec-text">Partez à l’aventure avec un guide expérimenté tout en gardant la liberté de gérer votre budget à votre façon. Vous ne payez que la prestation du guide. Nous vous assistons dans l'organisation, mais vous restez libre sur l'hébergement, les repas et les transports. </p>
            </div>
            <ul class="about-list3">
              {{-- <li class="list-item">
                <div class="about-icon">
                  <img src=" {{asset('frontend/assets/img/icons/about-icon1.png')}} " alt="about-icon">
                </div>
                 <div class="icon-content">
                  <h3 class="title">Safety first always</h3>
                  <p class="text">There are many variations of passages Nulla vestibulum tincidunt.</p>
                </div> 
              </li> --}}
              <li class="list-item">
                <div class="about-icon">
                  <img src=" {{asset('assets/img/icons/about-icon2.png')}} " alt="about-icon">
                </div>
                <div class="icon-content">
                  <h3 class="title">Prix Accessible Aux Voyageurs</h3>
                  <p class="text">Vous ne payez que la prestation du guide.</p>
                </div>
              </li>
            </ul>
            <div class="about-bottom">
              <a href="{{route('test.form')}}" class="vs-btn style5">Réservez votre guide</a>
              <div class="item2">
                <div class="item2__icon">
                  <img src=" {{asset('assets/img/icons/phone-icon-2.svg')}} " alt="phone icon 1">
                </div>
                <div class="item2__text">
                  <span>Téléphone:</span>
                  <a href="tel:+221771117420">(+221)77111 74 20</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="img-box3">
            <div class="box1">
              <div class="media-box1">
                <p class="media-text"> Années D'Experiences</p>
                <span class="media-info">25</span>
              </div>
            </div>
            <img class="img1" src=" {{asset('assets/img/about/guide3.jpg')}} " alt="about image">
            <div class="bottom-img">
              <img class="img3" src=" {{asset('assets/img/about/guide2.jpg')}} " alt="about image">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--==============================
    About Area End 
  ==============================-->
      {{-- <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-xl-5">
            <div class="about-content">
              <div class="title-area">
                <span class="sec-subtitle">Vacance au Sénégal</span>
                <h2 class="sec-title h1">Guides experts du Sénégal </h2>
                <h4 class="sec-text" style="font-size:22px; font-weight: 400">


                  Plus de 40 voyages de groupes et de famille organisés en 2023, nos guides multilingues et spécialistes vous accompagneront pour une expérience unique. Nous avons aidé plus de 100 voyageurs à planifier leur voyage parfait au Sénégal. Partez à l'aventure  et profitez des connaissances approfondies de nos experts pour une immersion totale dans la culture sénégalaise!  <br><br>

                </h4>
              </div>
              <ul class="about-list1" style="font-size: 20px; font-weight: 400">
                <li>Guide interprète spécialist .</li>
                <li>Excursion.</li>
                <li>Circuit.</li>
                <li>Hebergement .</li>
              
              
                
              </ul>
              <a href="{{route('apropos')}}" class="vs-btn style4 ">Voir plus</a>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="img-box3">
              <img class="img1" src=" {{asset('frontend/assets/img/about/about-1-1.jpg')}} " alt="about image">
              <div class="bottom-img">
                <img class="img2" src="{{asset('frontend/assets/img/about/deux.jpg')}}" alt="about image">
                <img class="img3" src="{{asset('frontend/assets/img/about/about-1-3.jpg')}}" alt="about image">
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    @endif

    @if ($locale == 'es')
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-xl-5">
            <div class="about-content">
              <div class="title-area">
                <span class="sec-subtitle">Vacaciones en Senegal</span>
                <h2 class="sec-title h1">Guías expertos en Senegal </h2>
                <h4 class="sec-text" style="font-size:22px; font-weight: 400">
                  Más de 40 viajes en grupo y en familia organizados en 2023, nuestros guías multilingües y especialistas le acompañarán para vivir una experiencia única. Hemos ayudado a más de 100 viajeros a planificar su viaje perfecto a Senegal. Embárquese en una aventura y benefíciese de los profundos conocimientos de nuestros expertos para una inmersión total en la cultura senegalesa. 
                </h4>
              </div>
              <ul class="about-list1" style="font-size: 20px; font-weight: 400">
                <li>Guía intérprete especialista.</li>
                <li>Guía de ornitología.</li>
                <li>Guía de cultura.</li>
                <li>Guía de senderismo.</li>
              
              
                
              </ul>
              <a href="{{route('apropos')}}" class="vs-btn style4 ">Ver más</a>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="img-box3">
              <img class="img1" src=" {{asset('assets/img/about/about-1-1.jpg')}} " alt="about image">
              <div class="bottom-img">
                <img class="img2" src="{{asset('assets/img/about/deux.jpg')}}" alt="about image">
                <img class="img3" src="{{asset('assets/img/about/about-1-3.jpg')}}" alt="about image">
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </section>
 



 