<x-mail::message>
@component('mail::message')
# Bonjour {{ $reservation->nom }},

Merci pour votre demande de réservation concernant le circuit **{{ $reservation->destination }}**.

Voici un récapitulatif de votre demande :

- **Nombre de personnes :** {{ $reservation->nbr_Pax }}  
- **Offre choisie :** {{ $reservation->offre }}  
- **Message :** {{ $reservation->message }}

---

📞 **Prochaine étape : Planifions un appel**  
Afin de mieux comprendre vos attentes et personnaliser votre circuit, nous vous invitons à choisir un créneau horaire pour un échange téléphonique avec notre équipe.

@component('mail::button', ['url' => 'https://calendly.com/vacancesenegal/30min'])
Réserver un créneau d'appel
@endcomponent

À l’issue de cet échange, nous vous enverrons l’itinéraire détaillé de votre circuit, que nous pourrons ajuster selon vos préférences.

Merci pour votre confiance,  
L’équipe de **{{ config('app.name') }}**
@endcomponent
</x-mail::message>
