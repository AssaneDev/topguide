
@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);
@endphp


@if ($locale == 'fr')
<section class="space testimonial-style2" data-bg-src=" {{asset('frontend/assets/img/bg/testimonial-bg-2.jpg')}} ">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <div class="title-area white-title">
          <span class="sec-subtitle">Nos retours voyageur</span>
          <h2 class="sec-title h1">Ils ont voyagé avec nous </h2>
        </div>
      </div>
    </div>

    <div class="row vs-carousel testimonial-slider2" data-slide-show="2" data-arrows="false" data-lg-slide-show="2"
      data-md-slide-show="2" data-sm-slide-show="1">
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“Mon voyage avec votre guide a été une véritable révélation ! Grâce à ses connaissances approfondies et son enthousiasme contagieux, j'ai pu découvrir des coins de nature préservée que je n'aurais jamais imaginé. Une expérience unique et enrichissante que je recommande à tous les amoureux de la nature !".”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Sophie B.</h3>
          <span class="testi-degi">Aventure au cœur de la nature</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-1.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“Mon guide m'a ouvert les portes d'un Sénégal authentique et vibrant de culture. De Dakar aux villages reculés, chaque instant était une nouvelle découverte. Les rencontres avec les habitants, les saveurs des plats locaux et les visites des sites historiques ont rendu ce voyage inoubliable..”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Marc D.</h3>
          <span class="testi-degi">Exploration culturelle authentique</span>
          {{-- <div class="testi-avater">
            <img src="{{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}}" alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“Grâce à votre guide passionné, j'ai pu vivre une expérience de randonnée exceptionnelle ! Des sentiers escarpés de la région de Kédougou aux sommets panoramiques, chaque pas était une aventure. Les paysages époustouflants et la camaraderie du groupe ont fait de ce voyage une expérience inoubliable.”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name"> Emma R.</h3>
          <span class="testi-degi"> Randonnée éblouissante</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“Mes vacances à la plage avec votre guide ont dépassé toutes mes attentes ! Non seulement j'ai pu me détendre sur des plages de sable blanc paradisiaques, mais j'ai également eu l'occasion de découvrir la culture locale grâce aux recommandations avisées de mon guide. Un séjour balnéaire parfait à un prix incroyablement abordable !.”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Thomas L.</h3>
          <span class="testi-degi"> Plaisirs balnéaires abordables</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</section>
@endif



@if ($locale == 'en')
<section class="space testimonial-style2" data-bg-src=" {{asset('frontend/assets/img/bg/testimonial-bg-2.jpg')}} ">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <div class="title-area white-title">
          <span class="sec-subtitle">Our feedback</span>
          <h2 class="sec-title h1">They travelled with us </h2>
        </div>
      </div>
    </div>

    <div class="row vs-carousel testimonial-slider2" data-slide-show="2" data-arrows="false" data-lg-slide-show="2"
      data-md-slide-show="2" data-sm-slide-show="1">
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“My trip with your guide was a real revelation! Thanks to his in-depth knowledge and infectious enthusiasm, I was able to discover corners of unspoilt nature that I'd never have imagined. It was a unique and enriching experience that I would recommend to all nature lovers. !".”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Sophie B.</h3>
          <span class="testi-degi">Adventure in the heart of nature</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-1.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“The vacance au sénégal agency opened the doors to an authentic Senegal, vibrant with culture. From Dakar to remote villages, every moment was a new discovery. The encounters with the locals, the flavours of the local dishes and the visits to historic sites made this trip unforgettable.”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Marc D.</h3>
          <span class="testi-degi">Exploration culturelle authentique</span>
          {{-- <div class="testi-avater">
            <img src="{{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}}" alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“Thanks to your passionate guide, I had an exceptional hiking experience! From the steep paths of the Kédougou region to the panoramic peaks, every step was an adventure. The breathtaking scenery and the camaraderie of the group made this trip an unforgettable experience.”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name"> Emma R.</h3>
          <span class="testi-degi"> Dazzling walk</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“My beach holiday with your guide exceeded all my expectations! Not only was I able to relax on heavenly white sandy beaches, but I also had the opportunity to discover the local culture thanks to my guide's sound recommendations. A perfect seaside holiday at an incredibly affordable price!.”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Thomas L.</h3>
          <span class="testi-degi"> Affordable seaside fun</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</section>
@endif


@if ($locale == 'es')
<section class="space testimonial-style2" data-bg-src=" {{asset('frontend/assets/img/bg/testimonial-bg-2.jpg')}} ">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <div class="title-area white-title">
          <span class="sec-subtitle">Comentarios</span>
          <h2 class="sec-title h1">Viajaron con nosotros </h2>
        </div>
      </div>
    </div>

    <div class="row vs-carousel testimonial-slider2" data-slide-show="2" data-arrows="false" data-lg-slide-show="2"
      data-md-slide-show="2" data-sm-slide-show="1">
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“¡Mi viaje con su guía fue una auténtica revelación! Gracias a sus profundos conocimientos y a su contagioso entusiasmo, pude descubrir rincones de naturaleza virgen que nunca habría imaginado. Fue una experiencia única y enriquecedora que recomendaría a todos los amantes de la naturaleza. .”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Sophie B.</h3>
          <span class="testi-degi">Aventura en plena naturaleza</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-1.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“La agencia vacance au sénégal nos abrió las puertas a un Senegal auténtico, vibrante de cultura. De Dakar a las aldeas más remotas, cada momento era un nuevo descubrimiento. Los encuentros con los lugareños, los sabores de los platos locales y las visitas a lugares históricos hicieron que este viaje fuera inolvidable..”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Marc D.</h3>
          <span class="testi-degi">Auténtica exploración cultural</span>
          {{-- <div class="testi-avater">
            <img src="{{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}}" alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“Gracias a su apasionado guía, viví una experiencia de senderismo excepcional. Desde los empinados senderos de la región de Kédougou hasta las cumbres panorámicas, cada paso fue una aventura. Los impresionantes paisajes y la camaradería del grupo hicieron de este viaje una experiencia inolvidable..”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name"> Emma R.</h3>
          <span class="testi-degi"> Paseo deslumbrante</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
      <div class="col-xl-4">
        <div class="testi-style2">
          <div class="testi-body">
            <p class="testi-text">“Mis vacaciones en la playa con su guía superaron todas mis expectativas. No sólo pude relajarme en playas paradisíacas de arena blanca, sino que también tuve la oportunidad de descubrir la cultura local gracias a las acertadas recomendaciones de mi guía. Unas vacaciones perfectas junto al mar a un precio increíblemente asequible.”</p>
            <div class="testi-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <h3 class="testi-name">Thomas L.</h3>
          <span class="testi-degi"> Diversión asequible junto al mar</span>
          {{-- <div class="testi-avater">
            <img src=" {{asset('frontend/assets/img/testimonial/testimonial-2-2.jpg')}} " alt="customer image">
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</section>
@endif
