<x-mail::message>
@component('mail::message')
# Nouvelle réservation confirmée

**Nom :** {{ $reservation->nom }}  
**Destination :** {{ $reservation->destination }}  
**Date :** {{ $reservation->date->format('d/m/Y') }}
{{-- 
@component('mail::button', ['url' => route('admin.excursions.show', $reservation->id)])
Voir la réservation
@endcomponent --}}

@endcomponent

{{ config('app.name') }}
</x-mail::message>
