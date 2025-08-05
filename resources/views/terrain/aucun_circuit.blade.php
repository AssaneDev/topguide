@extends('terrain.layout')

@section('title', 'Aucun Circuit Actif')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header">
                <h4 class="mb-0">
                    <span class="emoji">🏖️</span> Bienvenue {{ $equipe->nom }}
                </h4>
            </div>
            <div class="card-body py-5">
                <div class="mb-4">
                    <i class="fas fa-calendar-times text-muted" style="font-size: 4rem;"></i>
                </div>
                
                <h5 class="text-muted mb-3">Aucun circuit actif pour le moment</h5>
                
                <p class="text-muted">
                    Il n'y a actuellement aucun circuit en cours. 
                    Votre équipe sera notifiée dès qu'un nouveau circuit démarrera.
                </p>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Votre rôle :</strong> 
                    <span class="badge bg-{{ $equipe->role === 'photographe' ? 'primary' : 'success' }}">
                        {{ $equipe->role === 'photographe' ? '📸 Photographe' : '✍️ Gestionnaire Posts' }}
                    </span>
                </div>
                
                <button onclick="location.reload()" class="btn btn-outline-primary">
                    <i class="fas fa-sync-alt"></i> Actualiser
                </button>
            </div>
        </div>
    </div>
</div>
@endsection