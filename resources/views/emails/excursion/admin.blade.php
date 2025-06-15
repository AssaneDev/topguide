<x-mail::message>
# Nouvelle réservation confirmée

Une excursion vient d'être confirmée par le client. Voici les détails :

- **Nom** : {{ $reservation->nom }}
- **Email** : {{ $reservation->email }}
- **Téléphone** : {{ $reservation->tel }}
- **Destination** : {{ $reservation->destination }}
- **Date** : {{ $reservation->date->format('d/m/Y') }}
- **Nombre de personnes** : {{ $reservation->nbr_Pax }}
- **Message du client** :  
> {{ $reservation->message }}

{{-- 
<x-mail::button :url="route('admin.excursions.show', $reservation->id)">
Voir la réservation
</x-mail::button>
--}}

Merci de traiter cette demande dans les plus brefs délais.

— {{ config('app.name') }}
</x-mail::message>
