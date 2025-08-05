{{-- resources/views/admin/equipes/dashboard.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    {{-- Header --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">👥 Gestion Équipes Terrain</h4>
                        <div class="d-flex gap-2">
                            <button onclick="toggleModal('nouvelleEquipe')" class="btn btn-light btn-sm">
                                <i class="bx bx-plus"></i> Nouvelle Équipe
                            </button>
                            <button onclick="exporterEquipes()" class="btn btn-warning btn-sm">
                                <i class="bx bx-download"></i> Exporter CSV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Équipes</h6>
                            <h3>{{ $stats['total_equipes'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-group font-size-24"></i>
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
                            <h3>{{ $stats['equipes_actives'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-check-circle font-size-24"></i>
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
                            <h6>Photographes</h6>
                            <h3>{{ $stats['photographes'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-camera font-size-24"></i>
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
                            <h6>Gestionnaires</h6>
                            <h3>{{ $stats['gestionnaires'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-edit font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Liste équipes --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des Équipes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle" id="tableEquipes">
                            <thead class="table-light">
                                <tr>
                                    <th>Équipe</th>
                                    <th>Contact</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    <th>Dernière Connexion</th>
                                    <th>Lien d'Accès</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($equipes as $equipe)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <div class="avatar-title bg-soft-{{ $equipe->role === 'photographe' ? 'primary' : 'success' }} 
                                                            text-{{ $equipe->role === 'photographe' ? 'primary' : 'success' }} rounded-circle">
                                                    <i class="bx {{ $equipe->role === 'photographe' ? 'bx-camera' : 'bx-edit' }}"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $equipe->nom }}</h6>
                                                <small class="text-muted">ID: {{ $equipe->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div>{{ $equipe->email }}</div>
                                            @if($equipe->telephone)
                                            <small class="text-muted">{{ $equipe->telephone }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $equipe->role === 'photographe' ? 'primary' : 'success' }}">
                                            {{ $equipe->role === 'photographe' ? '📸 Photographe' : '✍️ Gestionnaire' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" 
                                                   {{ $equipe->actif ? 'checked' : '' }}
                                                   onchange="toggleActif({{ $equipe->id }})">
                                            <label class="form-check-label">
                                                {{ $equipe->actif ? 'Actif' : 'Inactif' }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        @if($equipe->derniere_connexion)
                                            <div>
                                                <small class="text-muted">{{ $equipe->derniere_connexion->diffForHumans() }}</small>
                                                <br>
                                                <span class="badge bg-{{ $equipe->derniere_connexion > now()->subMinutes(10) ? 'success' : 'secondary' }}">
                                                    {{ $equipe->derniere_connexion > now()->subMinutes(10) ? 'En ligne' : 'Hors ligne' }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-muted">Jamais connecté</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button onclick="copierLien('{{ route('terrain.acces', $equipe->token_acces) }}')"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-bs-toggle="tooltip" title="Copier Lien">
                                                <i class="bx bx-copy"></i>
                                            </button>
                                            <button onclick="envoyerLien({{ $equipe->id }})"
                                                    class="btn btn-sm btn-outline-success"
                                                    data-bs-toggle="tooltip" title="Envoyer par Email">
                                                <i class="bx bx-send"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button onclick="regenererToken({{ $equipe->id }})"
                                                    class="btn btn-sm btn-outline-warning"
                                                    data-bs-toggle="tooltip" title="Régénérer Token">
                                                <i class="bx bx-refresh"></i>
                                            </button>
                                            <button onclick="voirHistorique({{ $equipe->id }})"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-bs-toggle="tooltip" title="Historique">
                                                <i class="bx bx-history"></i>
                                            </button>
                                            <button onclick="supprimerEquipe({{ $equipe->id }})"
                                                    class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Supprimer">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bx bx-info-circle font-size-24 mb-2"></i>
                                            <p>Aucune équipe configurée</p>
                                            <button onclick="toggleModal('nouvelleEquipe')" class="btn btn-primary btn-sm">
                                                Créer la première équipe
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
</div>

{{-- Modal Nouvelle Équipe --}}
<div class="modal fade" id="nouvelleEquipe" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">👤 Nouvelle Équipe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('equipe.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom Complet</label>
                        <input type="text" name="nom" class="form-control" required 
                               placeholder="Ex: Mamadou Diallo">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required 
                               placeholder="mamadou@vacancesenegal.com">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="telephone" class="form-control" 
                               placeholder="+221 70 123 45 67">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Rôle</label>
                        <select name="role" class="form-select" required>
                            <option value="">Choisir un rôle</option>
                            <option value="photographe">📸 Photographe/Vidéaste</option>
                            <option value="gestionnaire_posts">✍️ Gestionnaire Posts</option>
                            <option value="guide">🎯 Guide</option>
                            <option value="admin">👨‍💼 Admin</option>
                        </select>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bx bx-info-circle"></i>
                        <strong>Info :</strong> Un lien d'accès unique sera généré automatiquement pour cette équipe.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Créer Équipe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Historique --}}
<div class="modal fade" id="modalHistorique" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">📊 Historique d'Activité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="contenuHistorique">
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

// Toggle actif/inactif
function toggleActif(equipeId) {
    fetch(`/admin/coordination/equipes/${equipeId}/toggle-actif`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success(data.message);
        }
    });
}

// Copier lien dans le presse-papier
function copierLien(lien) {
    navigator.clipboard.writeText(lien).then(() => {
        toastr.success('Lien copié dans le presse-papier !');
    });
}

// Envoyer lien par email
function envoyerLien(equipeId) {
    if (confirm('Envoyer le lien d\'accès par email ?')) {
        fetch(`/admin/coordination/equipes/${equipeId}/envoyer-lien`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message);
            }
        });
    }
}

// Régénérer token
function regenererToken(equipeId) {
    if (confirm('Régénérer le token d\'accès ? L\'ancien lien ne fonctionnera plus.')) {
        fetch(`/admin/coordination/equipes/${equipeId}/regenerer-token`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message);
                setTimeout(() => location.reload(), 1000);
            }
        });
    }
}

// Voir historique
function voirHistorique(equipeId) {
    fetch(`/admin/coordination/equipes/${equipeId}/historique`)
        .then(response => response.json())
        .then(data => {
            let html = '<div class="timeline">';
            data.historique.forEach(item => {
                html += `
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">${item.action}</h6>
                            <small class="text-muted">${item.date} - IP: ${item.ip}</small>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            
            document.getElementById('contenuHistorique').innerHTML = html;
            const modal = new bootstrap.Modal(document.getElementById('modalHistorique'));
            modal.show();
        });
}

// Supprimer équipe
function supprimerEquipe(equipeId) {
    if (confirm('Supprimer définitivement cette équipe ?')) {
        fetch(`/admin/coordination/equipes/${equipeId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(() => {
            toastr.success('Équipe supprimée');
            location.reload();
        });
    }
}

// Exporter CSV
function exporterEquipes() {
    window.location.href = '/admin/coordination/equipes/export';
}

// Initialiser DataTable
$(document).ready(function() {
    $('#tableEquipes').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
        },
        pageLength: 25,
        order: [[0, 'asc']]
    });
});

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

.bg-soft-primary { background-color: rgba(64, 93, 230, 0.1); }
.bg-soft-success { background-color: rgba(0, 208, 132, 0.1); }
.text-primary { color: #405de6 !important; }
.text-success { color: #00d084 !important; }
</style>

@endsection