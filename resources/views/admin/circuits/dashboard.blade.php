{{-- resources/views/admin/circuits/dashboard.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    {{-- Header avec boutons d'action --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">🎬 Coordination Équipe Terrain</h4>
                        <div class="d-flex gap-2">
                            <button onclick="toggleModal('nouveauCircuit')" class="btn btn-light btn-sm">
                                <i class="bx bx-plus"></i> Nouveau Circuit
                            </button>
                            <button onclick="envoyerLiensAujourdhui()" class="btn btn-warning btn-sm">
                                <i class="bx bx-send"></i> Envoyer Liens Aujourd'hui
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats rapides --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Circuits Actifs</h6>
                            <h3>{{ $stats['circuits_actifs'] ?? 0 }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-play-circle font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 bg-gradient-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Équipes Actives</h6>
                            <h3>{{ $stats['equipes_actives'] ?? 0 }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-group font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Posts Aujourd'hui</h6>
                            <h3>{{ $stats['posts_aujourdhui'] ?? 0 }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-camera font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 bg-gradient-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Engagement Moyen</h6>
                            <h3>{{ $stats['engagement_moyen'] ?? '0%' }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-trending-up font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Liste des circuits --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Circuits en Cours et Planifiés</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Circuit</th>
                                    <th>Dates</th>
                                    <th>Statut</th>
                                    <th>Jour Actuel</th>
                                    <th>Guide</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($circuits as $circuit)
                                <tr>
                                    <td>
                                        <div>
                                            <h6 class="mb-0">{{ $circuit->nom }}</h6>
                                            <small class="text-muted">{{ $circuit->nb_jours }} jours</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div>{{ $circuit->date_debut->format('d/m/Y') }}</div>
                                            <small class="text-muted">au {{ $circuit->date_fin->format('d/m/Y') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($circuit->statut === 'en_cours') bg-success
                                            @elseif($circuit->statut === 'planifié') bg-primary
                                            @else bg-secondary @endif">
                                            {{ ucfirst($circuit->statut) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($circuit->statut === 'en_cours')
                                            <div class="text-center">
                                                <div class="h5 mb-0 text-primary">{{ $circuit->getJourActuel() }}</div>
                                                <small class="text-muted">/ {{ $circuit->nb_jours }}</small>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <div class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                    <i class="bx bx-user"></i>
                                                </div>
                                            </div>
                                            <div>{{ $circuit->guide_principal ?? 'Non assigné' }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('circuits.edit', $circuit) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               data-bs-toggle="tooltip" title="Éditer Programme">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            
                                            @if($circuit->statut === 'en_cours')
                                            <button onclick="envoyerLiensCircuit({{ $circuit->id }})"
                                                    class="btn btn-sm btn-outline-success"
                                                    data-bs-toggle="tooltip" title="Envoyer Liens Équipe">
                                                <i class="bx bx-send"></i>
                                            </button>
                                            <button onclick="voirLiensEquipe({{ $circuit->id }})"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-bs-toggle="tooltip" title="Voir Liens Équipe">
                                                <i class="bx bx-link"></i>
                                            </button>
                                            @endif
                                            
                                            @if($circuit->statut === 'planifié')
                                            <button onclick="activerCircuit({{ $circuit->id }})"
                                                    class="btn btn-sm btn-outline-warning"
                                                    data-bs-toggle="tooltip" title="Démarrer Circuit">
                                                <i class="bx bx-play"></i>
                                            </button>
                                            @endif
                                            
                                            <button onclick="supprimerCircuit({{ $circuit->id }})"
                                                    class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Supprimer">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bx bx-info-circle font-size-24 mb-2"></i>
                                            <p>Aucun circuit configuré</p>
                                            <button onclick="toggleModal('nouveauCircuit')" class="btn btn-primary btn-sm">
                                                Créer le premier circuit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Activité récente --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">🚀 Activité Équipe Aujourd'hui</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @forelse($activites as $activite)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">{{ $activite->action }}</h6>
                                <p class="text-muted mb-1">{{ $activite->description }}</p>
                                <small class="text-muted">{{ $activite->created_at->format('H:i') }}</small>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-muted py-3">
                            <i class="bx bx-time"></i> Aucune activité aujourd'hui
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
       <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">👥 Équipes Connectées</h5>
        </div>
        <div class="card-body">
            @forelse($equipes ?? [] as $equipe)
            <div class="d-flex align-items-center mb-3">
                <div class="avatar-sm me-3">
                    <div class="avatar-title bg-soft-{{ $equipe->role === 'photographe' ? 'primary' : 'success' }} 
                                text-{{ $equipe->role === 'photographe' ? 'primary' : 'success' }} rounded-circle">
                        <i class="bx {{ $equipe->role === 'photographe' ? 'bx-camera' : 'bx-edit' }}"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-0">{{ $equipe->nom }}</h6>
                    <small class="text-muted">{{ ucfirst($equipe->role) }}</small>
                </div>
                <div class="text-end">
                    @if($equipe->derniere_connexion)
                        <span class="badge bg-{{ $equipe->derniere_connexion > now()->subMinutes(10) ? 'success' : 'warning' }}">
                            {{ $equipe->derniere_connexion > now()->subMinutes(10) ? 'En ligne' : 'Hors ligne' }}
                        </span>
                        <br>
                        <small class="text-muted">{{ $equipe->derniere_connexion->diffForHumans() }}</small>
                    @else
                        <span class="badge bg-secondary">Jamais connecté</span>
                        <br>
                        <small class="text-muted">Aucune connexion</small>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center text-muted py-3">
                <i class="bx bx-user"></i> Aucune équipe active
            </div>
            @endforelse
        </div>
    </div>
</div>
    </div>
</div>

{{-- Modal Nouveau Circuit --}}
<div class="modal fade" id="nouveauCircuit" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">🆕 Nouveau Circuit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('circuits.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nom du Circuit</label>
                                <input type="text" name="nom" class="form-control" required 
                                       placeholder="Ex: Circuit Sénégal Authentique">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Guide Principal</label>
                                <input type="text" name="guide_principal" class="form-control" 
                                       placeholder="Ex: Mamadou Diallo">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date de Début</label>
                                <input type="date" name="date_debut" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre de Jours</label>
                                <input type="number" name="nb_jours" class="form-control" required 
                                       min="1" max="30" placeholder="15">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" 
                                  placeholder="Découverte authentique du Sénégal..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Créer Circuit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Liens Équipe --}}
<div class="modal fade" id="modalLiensEquipe" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">🔗 Liens Équipe Terrain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="contenuLiensEquipe">
                    <!-- Contenu chargé via AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript --}}
<script>
// Toggle modal
function toggleModal(modalId) {
    const modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();
}

// Envoyer liens circuit spécifique
function envoyerLiensCircuit(circuitId) {
    if (confirm('Envoyer les liens du jour à l\'équipe pour ce circuit ?')) {
        fetch(`/admin/circuits/${circuitId}/envoyer-liens`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success('Liens envoyés avec succès !');
            } else {
                toastr.error('Erreur lors de l\'envoi');
            }
        });
    }
}

// Envoyer liens aujourd'hui (tous circuits actifs)
function envoyerLiensAujourdhui() {
    if (confirm('Envoyer les liens du jour à toutes les équipes ?')) {
        fetch('/admin/circuits/envoyer-liens-aujourdhui', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            toastr.success(`Liens envoyés à ${data.equipes_notifiees} équipes !`);
        });
    }
}

// Voir liens équipe
function voirLiensEquipe(circuitId) {
    fetch(`/admin/circuits/${circuitId}/liens-equipe`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('contenuLiensEquipe').innerHTML = html;
            const modal = new bootstrap.Modal(document.getElementById('modalLiensEquipe'));
            modal.show();
        });
}

// Activer circuit
function activerCircuit(circuitId) {
    if (confirm('Démarrer ce circuit maintenant ?')) {
        fetch(`/admin/circuits/${circuitId}/activer`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(() => {
            toastr.success('Circuit activé !');
            location.reload();
        });
    }
}

// Supprimer circuit
function supprimerCircuit(circuitId) {
    if (confirm('Supprimer définitivement ce circuit ?')) {
        fetch(`/admin/circuits/${circuitId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(() => {
            toastr.success('Circuit supprimé');
            location.reload();
        });
    }
}

// Initialiser tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.timeline::before {
    content: '';
    position: absolute;
    left: -31px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.avatar-sm {
    width: 2rem;
    height: 2rem;
}

.avatar-title {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-size: 0.8rem;
}

.bg-gradient-primary { background: linear-gradient(45deg, #405de6, #5983fe); }
.bg-gradient-success { background: linear-gradient(45deg, #00d084, #7cf7a0); }
.bg-gradient-warning { background: linear-gradient(45deg, #fd9644, #ffb976); }
.bg-gradient-info { background: linear-gradient(45deg, #11cdef, #87d4f1); }
</style>

@endsection