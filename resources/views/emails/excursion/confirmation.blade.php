<x-mail::message>
 <p style="text-align: center;">
  <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" width="120" style="margin-bottom: 20px;">
</p>

# Bonjour {{ $reservation->nom }},

Merci pour votre demande de réservation pour **{{ $reservation->destination }}** prévue le **{{ $reservation->date->format('d/m/Y') }}**.

Voici un récapitulatif de votre demande :

- **Nom** : {{ $reservation->nom }}
- **Email** : {{ $reservation->email }}
- **Téléphone** : {{ $reservation->tel }}
- **Destination** : {{ $reservation->destination }}
- **Nombre de personnes** : {{ $reservation->nbr_Pax }}
- **Message** :
> {{ $reservation->message }}

---

Cliquez sur le bouton ci-dessous pour confirmer votre excursion :

<x-mail::button :url="route('excursion.confirm', $reservation->id)">
Confirmer l'excursion
</x-mail::button>

Nous vous contacterons rapidement pour finaliser les détails.

Merci de votre confiance,  
L’équipe {{ config('app.name') }}
</x-mail::message>
