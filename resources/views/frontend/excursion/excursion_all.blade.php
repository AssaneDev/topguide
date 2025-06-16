@extends('frontend.main_master')
@section('main')

@php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
$locale = Session::get('local') ?? 'fr';
Session::put('local', $locale);
App::setLocale($locale);
@endphp

@if ($locale == 'fr')
  <div class="breadcumb-wrapper" data-bg-src="{{ asset('frontend/assets/img/breadcumb/desti.png') }}" style="width: 100%; height: auto;">
    <div class="container z-index-common">
      <div class="breadcumb-content text-center">
        <h1 class="breadcumb-title" style="display: none">Destinations</h1>
      </div>
    </div>
  </div>
@endif

<section class="space-top space-extra-bottom">
  <div class="container">
    <!-- ✅ FILTRE DANS UNE LIGNE SÉPARÉE -->
    <div class="row justify-content-center mb-4">
      <div class="col-lg-6 text-center">
        <form method="GET" action="{{ route('excursion.filtres') }}">
          <label for="duree" class="form-label fw-bold me-2">Filtrer par durée :</label>
        <select name="duree" id="duree" onchange="this.form.submit()" class="form-select d-inline-block w-auto mx-2">
  <option value="">Toutes les excursions</option>
  <option value="demi-journee" {{ request('duree') == 'demi-journee' ? 'selected' : '' }}>Demi-journée</option>
  <option value="journee" {{ request('duree') == 'journee' ? 'selected' : '' }}>Journée</option>
</select>

        </form>
      </div>
    </div>

    <!-- ✅ GRILLE DES EXCURSIONS -->
    <div class="row justify-content-center">
      @foreach ($destination as $desti)
        <div class="col-xl-4 col-lg-6 col-sm-6 mb-4">
          <div class="package-style1 h-100">
            <div class="package-img">
              <a href="{{ url('excursion/detail/'.$desti->id) }}">
                <img src="{{ asset($desti->image_cap) }}" alt="Image Excursion" style="width:100%; height:auto;">
              </a>
            </div>
            <div class="package-content">
              <div class="package-review">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
              </div>
              <h3 class="package-title">
                <a href="{{ url('excursion/detail/'.$desti->id) }}">{{ $desti->name }}</a>
              </h3>
              <p class="package-text">{{ $desti->lieux }}</p>
              <div class="package-meta">
                <a href="{{ url('excursion/detail/'.$desti->id) }}">
                  <i class="fas fa-calendar-alt"></i> {{ $desti->dure_sejour }}
                </a>
                <span class="package-price">{{ $desti->prix }} €/Pers</span>
              </div>
              <div class="package-footer">
                <a href="{{ url('excursion/detail/'.$desti->id) }}" class="vs-btn">Voir détail</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
