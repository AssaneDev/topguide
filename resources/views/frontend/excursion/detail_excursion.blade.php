@extends('frontend.main_master')
@section('main')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .modern-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin-bottom: 40px;
    }
    .modern-card img {
        border-radius: 15px;
        width: 100%;
    }
    .gallery-img5 {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
    }
    .gallery-img5 img {
        transition: 0.3s ease;
        width: 100%;
    }
    .gallery-img5:hover img {
        transform: scale(1.05);
    }
    .gallery-content {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        padding: 8px;
    }
    .widget-newsletter input, 
    .widget-newsletter textarea {
        border-radius: 12px;
        padding-left: 15px;
        border: 1px solid #ccc;
        font-size: 15px;
    }
    .widget-newsletter .vs-btn {
        background-color: #ff5a5f;
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: bold;
        transition: 0.3s;
    }
    .widget-newsletter .vs-btn:hover {
        background-color: #e64c4f;
    }
    .widget-social a {
        display: inline-block;
        margin-right: 10px;
        font-size: 18px;
        background: #f0f0f0;
        width: 38px;
        height: 38px;
        line-height: 38px;
        border-radius: 50%;
        text-align: center;
        color: #333;
        transition: 0.3s;
    }
    .widget-social a:hover {
        background: #ff5a5f;
        color: #fff;
    }
</style>

@php
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Session;
    $locale = Session::get('local') ?? 'fr';
    Session::put('local', $locale);
    App::setLocale($locale);
@endphp

<section class="space">
    <div class="container">
        <div class="row">
            <!-- Contenu principal -->
            <div class="col-lg-8">
                <div class="modern-card">
                    <img src="{{ asset($destination->image) }}" alt="Image principale" class="mb-4">
                    <div class="ds-text">
                        {!! $destination->long_descp !!}
                    </div>
                </div>

                <!-- Galerie -->
                <div class="modern-card">
                    <h2 class="ds-title mb-3">Galerie d'images</h2>
                    <div class="row g-3">
                        @foreach ($imageGalerie as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="gallery-img5">
                                <img src="{{ asset('upload/excursion/multi_img/'.$item->image) }}" alt="image">
                                <div class="gallery-content">
                                    <a href="{{ asset('upload/excursion/multi_img/'.$item->image) }}" class="popup-image text-white">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="col-lg-4">
                <div class="modern-card">
                    <h3 class="widget_title mb-3">Demander un programme : {{ $destination->name }}</h3>
                    <form action="{{ route('envoie.form') }}" method="POST" class="newsletter-form">
                        @csrf
                        <input class="form-control mb-2" type="text" name="nom" placeholder="Votre nom" required>
                        <input class="form-control mb-2" type="email" name="email" placeholder="Votre email" required>
                        <input class="form-control mb-2" type="text" name="tel" placeholder="Téléphone" required>
                        <input type="hidden" name="destination" value="{{ $destination->name }}">
                        <input class="form-control mb-2" type="number" name="nbr_Pax" placeholder="Nombre de personnes" required>
                        <input class="form-control mb-2" type="date" name="date" required>
                        <textarea class="form-control mb-3" name="message" rows="3" placeholder="Votre message" required></textarea>
                        <button type="submit" class="vs-btn w-100">Envoyer</button>
                    </form>
                </div>

                <!-- Réseaux sociaux -->
                <div class="modern-card">
                    <h3 class="widget_title mb-3">Suivez-nous</h3>
                    <div class="widget-social">
                        <a href="https://web.facebook.com/profile.php?id=61560799666028" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        {{-- Ajoute d'autres réseaux ici si besoin --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info': toastr.info("{{ Session::get('message') }}"); break;
        case 'success': toastr.success("{{ Session::get('message') }}"); break;
        case 'warning': toastr.warning("{{ Session::get('message') }}"); break;
        case 'error': toastr.error("{{ Session::get('message') }}"); break;
    }
@endif
</script>

@endsection
