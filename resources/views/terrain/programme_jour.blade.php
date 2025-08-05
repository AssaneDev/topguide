@extends('terrain.layout')

@section('title', 'Programme du Jour')

@section('content')
<div class="row">
    {{-- Header Principal --}}
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">
                            <span class="emoji">🎬</span> {{ $circuit->nom }}
                        </h4>
                        <small class="text-light">
                            Jour {{ $circuit->getJourActuel() }} / {{ $circuit->nb_jours }} - {{ $programmeAujourdhui->date->format('d/m/Y') }}
                        </small>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark">
                            {{ $equipe->role === 'photographe' ? '📸 Photographe' : '✍️ Gestionnaire Posts' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Programme Principal --}}
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-map-marker-alt"></i> Programme d'Aujourd'hui
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-primary">📍 Lieu Principal</h6>
                    <p class="h5">{{ $programmeAujourdhui->lieu_principal }}</p>
                </div>

                <div class="mb-3">
                    <h6 class="text-success">🎯 Activités</h6>
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($programmeAujourdhui->activites)) !!}
                    </div>
                </div>

                @if($programmeAujourdhui->hebergement)
                <div class="mb-3">
                    <h6 class="text-info">🏨 Hébergement</h6>
                    <p>{{ $programmeAujourdhui->hebergement }}</p>
                </div>
                @endif

                @if($programmeAujourdhui->horaires)
                <div class="mb-3">
                    <h6 class="text-warning">⏰ Horaires</h6>
                    <div class="row g-2">
                        @foreach($programmeAujourdhui->horaires as $moment => $heure)
                        <div class="col-6 col-md-3">
                            <div class="bg-light p-2 rounded text-center">
                                <small class="text-muted d-block">{{ ucfirst($moment) }}</small>
                                <strong>{{ $heure }}</strong>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($programmeAujourdhui->notes_speciales)
                <div class="alert alert-warning">
                    <h6 class="alert-heading">⚠️ Notes Importantes</h6>
                    {!! nl2br(e($programmeAujourdhui->notes_speciales)) !!}
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Consignes Équipe --}}
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-tasks"></i> Vos Consignes
                </h5>
            </div>
            <div class="card-body">
                @if($consignes)
                    <div class="mb-3">
                        <h6 class="text-primary">📋 Consignes Spécifiques</h6>
                        <div class="bg-light p-3 rounded">
                            {!! nl2br(e($consignes->consignes_specifiques)) !!}
                        </div>
                    </div>

                    @if($consignes->hashtags_jour && count($consignes->hashtags_jour) > 0)
                    <div class="mb-3">
                        <h6 class="text-success">🏷️ Hashtags du Jour</h6>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($consignes->hashtags_jour as $hashtag)
                            <span class="badge bg-primary">{{ $hashtag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($consignes->moments_cles && count($consignes->moments_cles) > 0)
                    <div class="mb-3">
                        <h6 class="text-info">⏰ Moments Clés</h6>
                        <div class="row g-2">
                            @foreach($consignes->moments_cles as $moment => $heure)
                            <div class="col-6">
                                <div class="bg-info bg-opacity-10 p-2 rounded text-center">
                                    <small class="text-muted d-block">{{ ucfirst($moment) }}</small>
                                    <strong>{{ $heure }}</strong>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mb-3">
                        <h6 class="text-warning">🎯 Objectifs</h6>
                        <p class="mb-0">{{ $consignes->objectifs_contenu }}</p>
                    </div>

                    <div class="text-center">
                        <span class="badge bg-{{ $consignes->priorite === 'critique' ? 'danger' : ($consignes->priorite === 'importante' ? 'warning' : 'success') }} fs-6">
                            <i class="fas fa-flag"></i> Priorité {{ ucfirst($consignes->priorite) }}
                        </span>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                        <h6 class="text-muted mt-3">Consignes en cours de préparation</h6>
                        <p class="text-muted">Les consignes pour votre équipe seront disponibles sous peu.</p>
                        <button onclick="location.reload()" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-sync-alt"></i> Actualiser
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Actions Rapides --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bolt"></i> Actions Rapides
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <button onclick="location.reload()" class="btn btn-outline-primary w-100">
                            <i class="fas fa-sync-alt"></i><br>
                            <small>Actualiser</small>
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button onclick="window.print()" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-print"></i><br>
                            <small>Imprimer</small>
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button onclick="partagerLien()" class="btn btn-outline-info w-100">
                            <i class="fas fa-share-alt"></i><br>
                            <small>Partager</small>
                        </button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('terrain.api', $equipe->token_acces) }}" class="btn btn-outline-success w-100" target="_blank">
                            <i class="fas fa-code"></i><br>
                            <small>API JSON</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function partagerLien() {
    if (navigator.share) {
        navigator.share({
            title: 'Programme {{ $circuit->nom }}',
            text: 'Programme du jour {{ $programmeAujourdhui->date->format("d/m/Y") }}',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href);
        alert('Lien copié dans le presse-papier !');
    }
}

// Auto-refresh après 5 minutes
setTimeout(() => {
    if (confirm('Actualiser le programme ?')) {
        location.reload();
    }
}, 300000);
</script>
@endsection