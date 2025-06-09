<x-mail::message>
@component('mail::message')
# Bonjour {{ $reservation->name }},

Merci d’avoir réservé un guide avec **Vacance Sénégal** !

Voici un récapitulatif de votre demande :

---

## 🧾 Informations personnelles
- 📧 Email : **{{ $reservation->email }}**
- 📞 Téléphone : **{{ $reservation->phone }}**
- 🗓️ Date souhaitée : **{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}**
- 📍 Ville de départ : **{{ $reservation->ville }}**

## ⛺ Détails du programme
- 🕒 Durée : **{{ ucfirst($reservation->duree) }}**
@if($reservation->duree === 'circuit')
- 📅 Nombre de jours : **{{ $reservation->nbJours }}**
@endif
- 🌍 Langue du guide : **{{ strtoupper($reservation->langue) }}**
- 💰 Prix total : **{{ $reservation->prix }} €**

@if($reservation->interets)
## 🎯 Centres d’intérêt
{{ $reservation->interets }}
@endif

@if($reservation->details)
## 📝 Détails supplémentaires
{{ $reservation->details }}
@endif

---

Si vous avez transmis un itinéraire, nous le traiterons avec soin pour personnaliser votre expérience.

@component('mail::button', ['url' => url('/')])
Visiter notre site
@endcomponent

Merci encore pour votre confiance,  
L’équipe **Vacance Sénégal**

@endcomponent

</x-mail::message>
