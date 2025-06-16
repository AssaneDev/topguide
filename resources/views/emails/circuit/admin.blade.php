<x-mail::message>
@component('mail::message')
# Nouvelle réservation confirmée

**Nom :** {{ $reservation->nom }}  
**Téléphone :** {{ $reservation->tel }}  
**Destination :** {{ $reservation->destination }}  
**Offre :** {{ $reservation->offre }}  
**Message :** {{ $reservation->message }}


@endcomponent


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
