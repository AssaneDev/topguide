{{-- ===== CRÉER: resources/views/terrain/erreur.blade.php ===== --}}
@extends('terrain.layout')

@section('title', 'Erreur')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header bg-danger">
                <h4 class="mb-0 text-white">
                    <span class="emoji">⚠️</span> Erreur
                </h4>
            </div>
            <div class="card-body py-5">
                <div class="mb-4">
                    <i class="fas fa-exclamation-triangle text-danger" style="font-size: 4rem;"></i>
                </div>
                
                <h5 class="text-danger mb-3">{{ $message ?? 'Une erreur est survenue' }}</h5>
                
                <p class="text-muted mb-4">
                    {{ $details ?? 'Veuillez réessayer plus tard ou contacter l\'administrateur si le problème persiste.' }}
                </p>
                
                <div class="d-flex gap-2 justify-content-center">
                    <button onclick="history.back()" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
                    <button onclick="location.reload()" class="btn btn-primary">
                        <i class="fas fa-sync-alt"></i> Réessayer
                    </button>
                </div>
                
                @if(config('app.debug'))
                <div class="mt-4 text-start">
                    <details>
                        <summary class="text-muted">Détails techniques</summary>
                        <pre class="text-start text-muted small mt-2">{{ $exception ?? 'Aucun détail disponible' }}</pre>
                    </details>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection