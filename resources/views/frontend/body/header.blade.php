<header class="vs-header header-layout6">
  <div class="sticky-wrapper">
    <div class="sticky-active">
      <div class="container position-relative z-index-common">
        <div class="row align-items-center justify-between">
          <div class="col-auto">
            <div class="vs-logo">
              <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo2.svg') }}" style="width: 100px; height: 100px;" alt="logo">
              </a>
            </div>
          </div>

          <div class="col text-end">
            <nav class="main-menu menu-style1 d-none d-lg-block">
              <ul>
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li><a href="{{ route('apropos') }}">À propos</a></li>
                <li><a href="{{ route('destination') }}">Circuits</a></li>
                <li><a href="{{ route('excursion') }}">Excursions</a></li>
                <li><a href="{{ route('blog.list') }}">Blog</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
              </ul>
            </nav>
            <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
          </div>
{{-- 
          <div class="col-auto d-none d-xl-block">
            <div class="header-right">
              <ul>
                <li>
                  <a class="vs-btn style7" href="{{route('test.form')}}">
                    Réservez votre guide à la journée
                    <i class="fas fa-arrow-right ms-2"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div> --}}

        </div>
      </div>
    </div>
  </div>
</header>
