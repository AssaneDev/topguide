@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);
@endphp



@if ($locale == 'fr')
<section class="space bg-light">
  <div class="container" data-bg-src="assets/img/bg/map-bg.png">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
        <div class="title-area">
          <span class="sec-subtitle">Nos Guides</span>
          <h2 class="sec-title h1">Spécialistes</h2>
        </div>
      </div>
    </div>
    <div class="row mt-60 mb-70">
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guide Personnel</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Expérimenté et passionné par le Sénégal, capable de personnaliser l'itinéraire en fonction des intérêts et des préférences du client. Avec un guide personnel, vous bénéficiez d'une attention individualisée, de conseils locaux précieux et d'un accès privilégié à des lieux et des expériences souvent hors des sentiers battus.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guide ornithologie</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Grâce à une connaissance approfondie des habitats, des comportements et des espèces aviaires locales, le guide ornithologie vous emmène dans des expéditions riches en découvertes et en rencontres avec une variété d'oiseaux. Que ce soit pour repérer des espèces rares, explorer des zones protégées ou simplement en apprendre davantage sur la vie aviaire.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guide Culturel</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> un expert local passionné par l'histoire, la diversité ethnique, la musique dynamique, la cuisine savoureuse et les traditions vibrantes de ce pays d'Afrique de l'Ouest. Grâce à leur connaissance approfondie de la culture sénégalaise, ces guides vous entraînent dans des visites enrichissantes à travers des sites historiques, des marchés animés, des villages traditionnels et des manifestations culturelles telles que le sabar, la danse traditionnelle sénégalaise..</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guide Incentive</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Leur expertise consiste à concevoir des itinéraires sur mesure qui combinent des activités stimulantes, des aventures passionnantes et des découvertes culturelles dans le cadre inspirant du Sénégal. Que ce soit pour des équipes en quête de renforcement de la cohésion, des cadres cherchant à récompenser la performance ou des partenaires commerciaux visant à créer des liens durables, les guides Incentive du Sénégal assurent des expériences mémorables qui inspirent, motivent et renforcent les liens professionnels..</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guide Trek</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> guides chevronnés vous emmènent hors des sentiers battus pour découvrir des itinéraires de trekking uniques, allant des montagnes verdoyantes de la région de Kédougou aux vastes déserts de lompoul. Ils partagent leur connaissance intime de la nature, de la faune et de la culture locales, tout en assurant la sécurité et le confort des randonneurs. Que ce soit pour une courte escapade d'une journée ou une aventure de plusieurs jours, nos guides  vous permettes de vivre une expérience de trekking authentique et immersive dans ce magnifique pays d'Afrique de l'Ouest..</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guide Botanique</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> guides spécialisés vous accompagnent dans des explorations enrichissantes à travers une variété d'écosystèmes, des forêts tropicales luxuriantes aux savanes arides, en passant par les zones côtières et les régions désertiques. Grâce à leur connaissance approfondie des plantes indigènes, des arbres, des fleurs et de leurs utilisations traditionnelles, ils vous initient à la richesse botanique du Sénégal. Que ce soit pour découvrir des espèces rares, étudier la biodiversité locale ou simplement apprécier la beauté naturelle, un guide botanique du Sénégal vous offre une expérience immersive et éducative au cœur de la nature sénégalaise..</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endif


@if ($locale == 'en')
<section class="space bg-light">
  <div class="container" data-bg-src="assets/img/bg/map-bg.png">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
        <div class="title-area">
          <span class="sec-subtitle">Our Guides</span>
          <h2 class="sec-title h1">Specialists</h2>
        </div>
      </div>
    </div>
    <div class="row mt-60 mb-70">
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Personal Guide</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Experienced and passionate about Senegal, able to tailor the itinerary to the interests and preferences of the client. With a personal guide, you benefit from individual attention, invaluable local advice and privileged access to places and experiences that are often off the beaten track.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Ornithology guide</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Thanks to an in-depth knowledge of local bird habitats, behaviour and species, the ornithology guide will take you on expeditions full of discoveries and encounters with a variety of birds. Whether you want to spot rare species, explore protected areas or simply learn more about bird life.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Cultural Guide</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> a local expert with a passion for the history, ethnic diversity, dynamic music, tasty cuisine and vibrant traditions of this West African country. With their in-depth knowledge of Senegalese culture, these guides take you on enriching tours of historic sites, bustling markets, traditional villages and cultural events such as sabar, the traditional Senegalese dance...</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Incentive Guide</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Their expertise lies in designing tailor-made itineraries that combine stimulating activities, exciting adventures and cultural discoveries in the inspiring surroundings of Senegal. Whether it's for teams looking to strengthen cohesion, executives looking to reward performance or business partners looking to create lasting bonds, Senegal's Incentive Guides ensure memorable experiences that inspire, motivate and strengthen professional ties...</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Trek Guide</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> experienced guides take you off the beaten track to discover unique trekking routes, from the verdant mountains of the Kédougou region to the vast deserts of Lompoul. They share their intimate knowledge of local nature, wildlife and culture, while ensuring the safety and comfort of trekkers. Whether it's a short day trip or a multi-day adventure, our guides will provide you with an authentic and immersive trekking experience in this beautiful West African country..</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Botanical Guide</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> specialist guides accompany you on enriching explorations through a variety of ecosystems, from lush tropical forests to arid savannahs, coastal zones and desert regions. With their in-depth knowledge of native plants, trees, flowers and their traditional uses, they will introduce you to Senegal's botanical wealth. Whether you want to discover rare species, study local biodiversity or simply enjoy the natural beauty, a Senegal botanical guide offers you an immersive and educational experience at the heart of Senegalese nature..</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endif


@if ($locale == 'es')
<section class="space bg-light">
  <div class="container" data-bg-src="assets/img/bg/map-bg.png">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
        <div class="title-area">
          <span class="sec-subtitle">Nuestras guías</span>
          <h2 class="sec-title h1">Especialistas</h2>
        </div>
      </div>
    </div>
    <div class="row mt-60 mb-70">
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guía personal</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Experimentados y apasionados por Senegal, capaces de adaptar el itinerario a los intereses y preferencias del cliente. Con un guía personal, se beneficiará de una atención individualizada, de inestimables consejos locales y de un acceso privilegiado a lugares y experiencias que suelen estar fuera de los caminos trillados..</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guía de aves</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Gracias a un profundo conocimiento de los hábitats, el comportamiento y las especies de aves locales, el guía ornitológico le llevará en expediciones llenas de descubrimientos y encuentros con una gran variedad de aves. Tanto si desea avistar especies raras, explorar zonas protegidas o simplemente aprender más sobre la avifauna.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guía cultural</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> un experto local apasionado por la historia, la diversidad étnica, la música dinámica, la sabrosa cocina y las vibrantes tradiciones de este país de África Occidental. Gracias a su profundo conocimiento de la cultura senegalesa, estos guías le llevarán por enriquecedores recorridos por lugares históricos, bulliciosos mercados, pueblos tradicionales y actos culturales como el sabar, la danza tradicional senegalesa...</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guía de incentivos</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text">Su experiencia reside en diseñar itinerarios a medida que combinan actividades estimulantes, aventuras emocionantes y descubrimientos culturales en el inspirador entorno de Senegal. Ya sea para equipos que buscan reforzar la cohesión, ejecutivos que buscan recompensar el rendimiento o socios comerciales que buscan crear vínculos duraderos, los Guías de Incentivos de Senegal garantizan experiencias memorables que inspiran, motivan y refuerzan los lazos profesionales.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guía de trekking</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> Guías experimentados le llevarán fuera de los caminos trillados para descubrir rutas de senderismo únicas, desde las verdes montañas de la región de Kédougou hasta los vastos desiertos de Lompoul. Comparten su profundo conocimiento de la naturaleza, la fauna y la cultura locales, al tiempo que garantizan la seguridad y la comodidad de los senderistas. Tanto si se trata de una excursión corta de un día como de una aventura de varios días, nuestros guías le proporcionarán una experiencia de senderismo auténtica y envolvente en este magnífico país de África Occidental.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 history-steped">
        <span class="divider"></span>
        <div class="vs-history">
          <div class="header-area">
            <h3 class="history-title">Guía botánica</h3>
            <span class="history-date"></span>
          </div>
          <p class="history-text"> Los guías especializados le acompañarán en enriquecedoras exploraciones por diversos ecosistemas, desde exuberantes bosques tropicales hasta áridas sabanas, zonas costeras y regiones desérticas. Con su profundo conocimiento de las plantas autóctonas, los árboles, las flores y sus usos tradicionales, le introducirán en la riqueza botánica de Senegal. Tanto si desea descubrir especies raras, estudiar la biodiversidad local o simplemente disfrutar de la belleza natural, una guía botánica de Senegal le ofrece una experiencia inmersiva y educativa en el corazón de la naturaleza senegalesa...</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endif