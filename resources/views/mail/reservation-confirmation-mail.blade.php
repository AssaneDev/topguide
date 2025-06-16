<x-mail::message>
@component('mail::message')

# 👋 Bonjour {{ $reservation->name }},

Merci pour votre réservation avec **Vacance Sénégal** !  
Voici les détails de votre demande :

---

## 📄 Programme sélectionné

- 🕒 **Type** : {{ ucfirst($reservation->duree) }}
@if($reservation->duree === 'circuit')
- 📅 **Nombre de jours** : {{ $reservation->nbJours }}
@endif
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

- 👥 **Nombre de personnes** : {{ $reservation->nb_personnes }}

@php
    $nbJours = $reservation->nbJours ?? 1;
    $prixParJour = round($reservation->prix_final / ($reservation->duree === 'circuit' ? $nbJours : 1), 2);
@endphp

- 💸 **Tarif par jour** : {{ $prixParJour }} € / jour
- 💰 **Prix total** : {{ $reservation->prix_final }} €

@if($reservation->nb_personnes > 10)
- 🎉 **Tarif de groupe appliqué** : 8 €/personne
@endif

---

## 🙋 Informations personnelles

- 📧 **Email** : {{ $reservation->email }}
- 📞 **Téléphone** : {{ $reservation->phone }}
- 📍 **Ville de départ** : {{ $reservation->ville }}
- 🗓️ **Date souhaitée** : {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}

@if($reservation->interets)
---

## 🎯 Centres d’intérêt

{{ $reservation->interets }}
@endif

@if($reservation->details)
---

## 📝 Détails supplémentaires

{{ $reservation->details }}
@endif

---

@if($reservation->itineraire)
📎 **Itinéraire transmis** : Oui  
@else
📎 **Itinéraire transmis** : Non
@endif

---

@if($reservation->duree === 'journee')
@component('mail::button', ['url' => URL::signedRoute('confirmation.programme', ['id' => $reservation->id])])
✅ Confirmer mon programme
@endcomponent
@elseif($reservation->duree === 'circuit')
@component('mail::button', ['url' => url('/')])
📅 Prendre rendez-vous en ligne
@endcomponent
@else
@component('mail::button', ['url' => url('/')])
🌐 Visiter notre site
@endcomponent
@endif

Merci pour votre confiance,  
**L’équipe Vacance Sénégal**  
@component('mail::subcopy')
Besoin d’aide ? Répondez simplement à cet email.
@endcomponent
@endcomponent
</x-mail::message>
