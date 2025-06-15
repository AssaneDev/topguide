<x-mail::message>
@component('mail::message')
# ✅ Réservation confirmée

Le client **{{ $reservation->name }}** a confirmé son programme de guide.  
Voici les détails de sa demande :

---

## 📋 Informations principales

- 📧 **Email** : {{ $reservation->email }}  
- 📞 **Téléphone** : {{ $reservation->phone }}  
- 🗓️ **Date souhaitée** : {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}  
- 📍 **Ville de départ** : {{ $reservation->ville }}  
@php
    $langues = [
        'fr' => ['nom' => 'Français', 'emoji' => '🇫🇷'],
        'en' => ['nom' => 'Anglais',  'emoji' => '🇬🇧'],
        'it' => ['nom' => 'Italien',  'emoji' => '🇮🇹'],
        'es' => ['nom' => 'Espagnol', 'emoji' => '🇪🇸'],
    ];
    $langueData = $langues[$reservation->langue] ?? ['nom' => ucfirst($reservation->langue), 'emoji' => '🌍'];
@endphp

-🌍 Langue du guide : **{{ $langueData['emoji'] }} {{ $langueData['nom'] }}**


---

## 🧭 Programme sélectionné

- 🕒 **Type** : {{ ucfirst($reservation->duree) }}
- 👥 **Nombre de personnes** : {{ $reservation->nb_personnes }}

@if($reservation->duree === 'circuit')
- 📅 **Nombre de jours** : {{ $reservation->nbJours }}
@php
    $nbJours = $reservation->nbJours ?? 1;
    $prixParJour = round($reservation->prix_final / $nbJours, 2);
@endphp
- 💸 **Tarif par jour** : {{ $prixParJour }} €
@endif

- 💰 **Prix total** : {{ $reservation->prix_final }} €

@if($reservation->nb_personnes > 10)
- 🎉 **Tarif de groupe détecté : 8 €/personne**
@endif

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

## 🕓 Confirmation enregistrée

- 🔒 Date : **{{ \Carbon\Carbon::parse($reservation->confirmed_at)->format('d/m/Y à H:i') }}**

@component('mail::button', ['url' => url('/')])
🌍 Accéder au site
@endcomponent

Merci,  
**L’équipe Vacance Sénégal**
@endcomponent
</x-mail::message>
