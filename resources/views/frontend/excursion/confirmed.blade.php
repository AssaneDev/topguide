@extends('frontend.main_master')
@section('main')

<section class="space" style="padding: 100px 0; text-align: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="background: #f3f9f8; border-radius: 12px; padding: 40px; box-shadow: 0 5px 25px rgba(0,0,0,0.1);">
                    <h2 style="color: #28a745; margin-bottom: 20px;">
                        🎉 Merci pour votre confirmation !
                    </h2>
                    <p style="font-size: 18px;">
                        Votre réservation pour l'excursion a bien été confirmée.<br>
                        Un membre de notre équipe vous contactera très bientôt pour finaliser les détails.
                    </p>
                    <br>
                    <a href="{{ url('/') }}" class="vs-btn style4 mt-4">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
