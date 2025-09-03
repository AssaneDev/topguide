@extends('frontend.main_master')

@section('main')
<div class="container py-5">
    <h1>Test Page Voyages</h1>
    
    <div class="row">
        @forelse($voyages as $voyage)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $voyage->nom_voyage ?? 'Nom non disponible' }}</h5>
                        <p>ID: {{ $voyage->id }}</p>
                        <p>Type: {{ $voyage->type_voyage ?? 'N/A' }}</p>
                        <p>Région: {{ $voyage->region ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>Aucun voyage disponible</p>
            </div>
        @endforelse
    </div>
    
    <hr>
    
    <h3>Debug Info:</h3>
    <p>Nombre de voyages: {{ $voyages->count() }}</p>
    <p>Environment: {{ app()->environment() }}</p>
    
</div>
@endsection