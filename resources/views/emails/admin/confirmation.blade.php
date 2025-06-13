<x-mail::message>
@component('mail::message')
# Réservation confirmée

Le client **{{ $reservation->name }}** a confirmé son programme.

---

## 📄 Détails de la réservation

- 📧 Email : **{{ $reservation->email }}**  
- 📞 Téléphone : **{{ $reservation->phone }}**  
- 🗓️ Date souhaitée : **{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}**  
- 📍 Ville de départ : **{{ $reservation->ville }}**  
- 🕒 Durée : **{{ ucfirst($reservation->duree) }}**

@if($reservation->duree === 'circuit')
- 📅 Nombre de jours : **{{ $reservation->nbJours }}**
@endif

- 🌍 Langue : **{{ strtoupper($reservation->langue) }}**  
- 💰 Prix : **{{ $reservation->prix }} €**

---

@if($reservation->interets)
## 🎯 Centres d’intérêt
{{ $reservation->interets }}
@endif

@if($reservation->details)
## 📝 Détails supplémentaires
{{ $reservation->details }}
@endif

---

### ✅ Confirmation effectuée le  
**{{ \Carbon\Carbon::parse($reservation->confirmed_at)->format('d/m/Y à H:i') }}**

@component('mail::button', ['url' => url('/')])
Accéder au site
@endcomponent

Merci,  
**L’équipe Vacance Sénégal**
@endcomponent

</x-mail::message>
