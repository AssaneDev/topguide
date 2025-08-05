@extends('terrain.layout')

@section('title', 'Pas de Programme Aujourd\'hui')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <span class="emoji">📅</span> {{ $circuit->nom }}
                </h4>
            </div>
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-calendar-day text-warning" style="font-size: 4rem;"></i>
                </div>
                
                <h5 class="text-muted mb-3">Pas de programme pour aujourd'hui</h5>
                
                <p class="text-muted mb-4">
                    Le circuit <strong>{{ $circuit->nom }}</strong> est actif, mais aucun programme 
                    n'est prévu pour la date d'aujourd'hui.
                </p>
                
                <div class="row text-start">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-calendar-alt"></i> Informations Circuit</h6>
                            <p class="mb-1"><strong>Dates :</strong> {{ $circuit->date_debut->format('d/m/Y') }} - {{ $circuit->date_fin->format('d/m/Y') }}</p>
                            <p class="mb-1"><strong>Durée :</strong> {{ $circuit->nb_jours }} jours</p>
                            <p class="mb-0"><strong>Guide :</strong> {{ $circuit->guide_principal ?? 'Non assigné' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success">
                            <h6><i class="fas fa-user"></i> Votre Équipe</h6>
                            <p class="mb-1"><strong>Nom :</strong> {{ $equipe->nom }}</p>
                            <p class="mb-0"><strong>Rôle :</strong> 
                                <span class="badge bg-{{ $equipe->role === 'photographe' ? 'primary' : 'success' }}">
                                    {{ $equipe->role === 'photographe' ? '📸 Photographe' : '✍️ Gestionnaire Posts' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <button onclick="location.reload()" class="btn btn-primary">
                    <i class="fas fa-sync-alt"></i> Actualiser
                </button>
            </div>
        </div>
    </div>
</div>
@endsection