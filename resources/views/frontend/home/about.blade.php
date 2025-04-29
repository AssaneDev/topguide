@php
  // use Illuminate\Support\Facades\App;
  // use Illuminate\Support\Facades\Session;
  //      $locale = Session::get('local') ?? 'fr';
  //       Session::put('local',$locale);
  //       App::setLocale($locale);

       
    $destination = App\Models\Destination::latest()->get();
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);




@endphp

  <!--==============================
    Tour Package Area Start 
  ==============================-->
  <section class="space package-layout1">
    <div class="container ">
      <div class="row">
        <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
          <div class="package-top">
            <div class="title-area">
              <span class="sec-subtitle">Festered Tours</span>
              <h2 class="sec-title h1">Most Favorite Tour Place</h2>
            </div>
            <div class="title-btn">
              <a class="vs-btn style4" href="tour-booking.html">View all place</a>
            </div>
          </div>
        </div>
      </div>

      <div class="package-style2">
        <div class="row gx-5 align-items-center">
          <div class="col-lg-4">
            <div class="package-img">
              <a href="tour-booking.html">
                <img src=" {{asset('frontend/assets/img/tours/tour-5-1.jpg')}} " alt="Package Image">
              </a>
              <div class="price-box">
                <p class="price-text">Form</p>
                <span class="package-price">$100.00</span>
              </div>
              <div class="package-icon">
                <a href="tour-booking.html">
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
              <h3 class="package-title"><a href="tour-booking.html">Over Turkish Waves</a></h3>
              <p class="package-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffere</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="package-meta">
              <ul>
                <li>
                  <a href="#"><i class="fas fa-user-friends"></i><strong>Min:</strong>Age15+</a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-telegram-plane"></i><strong>Tour Type:</strong>Adventure. Fun</a>
                </li>
                <li>
                  <a href="#"><i class="fas fa-map-marker-alt"></i><strong>Location:</strong>Broadway, NY Morris Street.</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>


      
      <div class="package-style2">
        <div class="row gx-5 align-items-center">
          <div class="col-lg-4">
            <div class="package-img">
              <a href="tour-booking.html">
                <img src=" {{asset('frontend/assets/img/tours/tour-5-2.jpg')}} " alt="Package Image">
              </a>
              <div class="price-box">
                <p class="price-text">Form</p>
                <span class="package-price">$105.00</span>
              </div>
              <div class="package-icon">
                <a href="tour-booking.html">
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
                <span>5 (4)</span>
              </div>
              <h3 class="package-title"><a href="tour-booking.html">Beach Bliss Exploration</a></h3>
              <p class="package-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffere</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="package-meta">
              <ul>
                <li>
                  <a href="#"><i class="fas fa-user-friends"></i><strong>Min:</strong>Age15+</a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-telegram-plane"></i><strong>Tour Type:</strong>Adventure. Fun</a>
                </li>
                <li>
                  <a href="#"><i class="fas fa-map-marker-alt"></i><strong>Location:</strong>Broadway, NY Morris Street.</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="package-style2 pb-0">
        <div class="row gx-5 align-items-center">
          <div class="col-lg-4">
            <div class="package-img">
              <a href="tour-booking.html">
                <img src=" {{asset('frontend/assets/img/tours/tour-5-3.jpg')}} " alt="Package Image">
              </a>
              <div class="price-box">
                <p class="price-text">Form</p>
                <span class="package-price">$90.00</span>
              </div>
              <div class="package-icon">
                <a href="tour-booking.html">
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
                <span>5 (4)</span>
              </div>
              <h3 class="package-title"><a href="tour-booking.html">US Skyline Adventure</a></h3>
              <p class="package-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffere</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="package-meta">
              <ul>
                <li>
                  <a href="#"><i class="fas fa-user-friends"></i><strong>Min:</strong>Age15+</a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-telegram-plane"></i><strong>Tour Type:</strong>Adventure. Fun</a>
                </li>
                <li>
                  <a href="#"><i class="fas fa-map-marker-alt"></i><strong>Location:</strong>Broadway, NY Morris Street.</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--==============================
    Tour Package Area End 
  ==============================-->

  
  <section class="space shape-mockup-wrap">
    <div class="shape-mockup d-none d-xl-block ripple-animation z-index-negative" data-top="10%" data-left="5%">
      <img src="{{asset('frontend/assets/img/shape/Ballon.png')}}" alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-top="10%" data-right="10%">
      <img src="{{asset('frontend/assets/img/shape/up-arrow.png')}}" alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="0%" data-left="0%">
      <img class="plane2" src="{{asset('frontend/assets/img/shape/plane2.png')}}" alt="svg">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="15%" data-right="5%">
      <img src="{{asset('frontend/assets/img/shape/Lines.png')}}" alt="svg">
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
      <div class="container">
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
      </div>
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
  </section>
 



 