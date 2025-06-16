@extends('frontend.main_master')
@section('main')

@php
  $clientEmail = session('client_email'); // on le passe via la session depuis le contrôleur
@endphp

<section class="text-center py-5" style="margin-top: 120px;">
  <div class="container">
    <h1 class="text-success mb-4" style="font-size: 3rem;">✅ Demande envoyée avec succès</h1>

    <p class="lead mb-2">Merci pour votre demande de réservation.</p>
    
    @if($clientEmail)
      <p class="lead mb-4">Un email a été envoyé à <strong>{{ $clientEmail }}</strong> avec les prochaines étapes.</p>
    @endif

    <p class="mb-3">Veuillez consulter vos mails et réserver un créneau pour un appel téléphonique avec notre équipe.</p>

    <a href="https://calendly.com/vacancesenegal/30min" class="btn btn-success btn-lg mt-3" target="_blank">
      📅 Réserver un créneau d'appel
    </a>

    <br><br>
    <a href="{{ url('/') }}" class="btn btn-outline-primary mt-4">Retour à l'accueil</a>
  </div>
</section>

@endsection
