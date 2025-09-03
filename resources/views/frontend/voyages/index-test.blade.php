@extends('frontend.main_master')

@section('main')
<!DOCTYPE html>
<html>
<head>
    <title>Test Voyages</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .card { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 8px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nos Voyages - Test Simple</h1>
        
        <div class="grid">
            @forelse($voyages as $voyage)
                <div class="card">
                    <h3>{{ $voyage->nom_voyage }}</h3>
                    <p><strong>Type:</strong> {{ $voyage->type_voyage }}</p>
                    <p><strong>Région:</strong> {{ $voyage->region }}</p>
                    <p><strong>Durée:</strong> {{ $voyage->duree_jours }} jours</p>
                    <p><strong>Prix:</strong> {{ number_format($voyage->prix_base) }} FCFA</p>
                    @if($voyage->image_couverture)
                        <img src="{{ asset($voyage->image_couverture) }}" alt="{{ $voyage->nom_voyage }}" style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 4px;">
                    @endif
                    <p>{{ Str::limit($voyage->description_courte ?? 'Description non disponible', 100) }}</p>
                </div>
            @empty
                <div class="card">
                    <h3>Aucun voyage disponible</h3>
                    <p>Il n'y a actuellement aucun voyage publié.</p>
                </div>
            @endforelse
        </div>
        
        <div style="margin-top: 30px; padding: 15px; background: #f0f0f0; border-radius: 8px;">
            <h3>Informations de debug :</h3>
            <p>Nombre de voyages: {{ $voyages->count() }}</p>
            <p>Environment: {{ app()->environment() }}</p>
            <p>Debug mode: {{ config('app.debug') ? 'Activé' : 'Désactivé' }}</p>
        </div>
    </div>
</body>
</html>
@endsection