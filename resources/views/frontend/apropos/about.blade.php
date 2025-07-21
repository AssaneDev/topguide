@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);

        
@endphp

@if ($locale == 'fr')
<section class="space">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="image-box1">
          <img class="img1" src="{{asset('assets/img/about/img-2-14.jpg')}}" alt="image1">
          <img class="img2" src="{{asset('assets/img/about/img-2-2.jpg')}}" alt="image2">
          <div class="media-box1">
            <span class="media-info">20 années</span>
            <p class="media-text">D'Experiences</p>
          </div>
          {{-- <div class="media-box2">
            <span class="media-info"></span>
            <p class="media-text">Clients Satisfaits</p>
          </div> --}}
        </div>
      </div>
      <div class="col-lg-5">
        <div class="about-content">
          <div class="title-area">
            <span class="sec-subtitle">Vacance Sénégal</span>
            <h2 class="sec-title h1">Voyagez à votre rythme </h2>
            <h2 style="font-size: 20px" class="sec-text">  Notre réputation s’appuie sur une approche innovante du voyage. Grâce à notre système flexible, vous organisez vos vacances en toute liberté, selon vos envies.
Nous vous proposons deux formules au choix :
 <li>1. Voyage sur mesure</li>
Profitez de l’accompagnement de nos experts pour concevoir un séjour personnalisé, qui respecte vos goûts, vos envies et votre rythme.<br><br>
<li>2. Option "Juste un guide"</li> 
Vous avez déjà une idée de votre parcours ? Bénéficiez simplement des services d’un guide local professionnel, agréé par le Ministère du Tourisme, pour enrichir votre expérience.
Parce que chaque voyage est unique, nous accordons une attention particulière à vos besoins pour vous offrir un accompagnement sur mesure, efficace et inspirant..</h2>
          </div>
          <ul style="font-size: 20px" class="about-list1">
            <li>Guide Personnel .</li>
            <li>Guide interprète spécialist .</li>
            <li>Guide Ornithologie.</li>
            <li>Guide Culture.</li>
            <li>Guide Trek .</li>
            <li>Guide Botanique</li>
            <li>Guide Incentive , Time Building.</li>
          </ul>
          <a href="{{route('contact')}}" class="vs-btn style4">Entrer en contact</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endif


@if ($locale == 'es')
<section class="space">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="image-box1">
          <img class="img1" src="{{asset('frontend/assets/img/about/img-2-1.jpg')}}" alt="image1">
          <img class="img2" src="{{asset('frontend/assets/img/about/img-2-2.jpg')}}" alt="image2">
          <div class="media-box1">
            <span class="media-info">20 años</span>
            <p class="media-text">Experiencias </p>
          </div>
          <div class="media-box2">
            <span class="media-info">1000+</span>
            <p class="media-text">Clientes satisfechos</p>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="about-content">
          <div class="title-area">
            <span class="sec-subtitle">Disfrutar de las vacaciones en Senegal</span>
            <h2 class="sec-title h1">Guías prácticas y consejos para Senegal </h2>
            <h2 style="font-size: 20px" class="sec-text">  Nuestra reputación se basa en nuestras prácticas innovadoras en el sector de los viajes, en particular nuestro sistema que ofrece a los establecimientos la posibilidad de beneficiarse de los servicios de un guía turístico local profesional homologado por el Ministerio de Turismo. Nuestro enfoque se basa en la convicción de que el progreso sólo puede lograrse mediante la participación de las partes interesadas. Por eso es tan importante para nosotros identificar sus necesidades y aplicar soluciones eficaces para garantizar el éxito de su viaje.</h2>
          </div>
          <ul style="font-size: 20px" class="about-list1">
          <li>Guía personal</li> 
          <li>Guía intérprete especialista </li>
          <li>Guía de ornitología.</li>
          <li>Guía de cultura.</li>
          <li>Guía de senderismo.</li>
          <li>Guía botánica.</li>
          <li>Guía de incentivos , Time Building.</li>
          </ul>
          <a href="{{route('contact')}}" class="vs-btn style4">Contacto</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endif


@if ($locale == 'en')
<section class="space">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="image-box1">
          <img class="img1" src="{{asset('frontend/assets/img/about/img-2-1.jpg')}}" alt="image1">
          <img class="img2" src="{{asset('frontend/assets/img/about/img-2-2.jpg')}}" alt="image2">
          <div class="media-box1">
            <span class="media-info">20 years old</span>
            <p class="media-text">Experiences</p>
          </div>
          <div class="media-box2">
            <span class="media-info">1000+</span>
            <p class="media-text">Satisfied customers</p>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="about-content">
          <div class="title-area">
            <span class="sec-subtitle">Enjoy your holiday in Senegal</span>
            <h2 class="sec-title h1">Practical guides and advice for Senegal </h2>
            <h2 style="font-size: 20px" class="sec-text">  Our reputation is based on our innovative practices in the travel sector, in particular our system offering establishments the possibility of benefiting from the services of a professional local tourist guide approved by the Ministry of Tourism. Our approach is based on the belief that progress can only be achieved through stakeholder involvement. That's why it's so important for us to identify your needs and implement effective solutions to ensure the success of your trip..</h2>
          </div>
          <ul style="font-size: 20px" class="about-list1">
            <li>Guide Personnel .</li>
            <li>Specialist interpreter guide .</li>
            <li>Ornithology guide.</li>
            <li>Culture guide .</li>
            <li>Trek guide .</li>
            <li>Botanical guide</li>
            <li>Incentive guide , Time Building.</li>
          </ul>
          <a href="{{route('contact')}}" class="vs-btn style4">Get in touch</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

