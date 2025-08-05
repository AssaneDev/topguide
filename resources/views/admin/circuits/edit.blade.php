{{-- resources/views/admin/circuits/edit.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    {{-- Header avec informations circuit --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">✏️ {{ $circuit->nom }}</h4>
                            <small class="text-light">
                                {{ $circuit->date_debut->format('d/m/Y') }} - {{ $circuit->date_fin->format('d/m/Y') }} 
                                ({{ $circuit->nb_jours }} jours)
                            </small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('circuits.dashboard') }}" class="btn btn-light btn-sm">
                                <i class="bx bx-arrow-back"></i> Retour
                            </a>
                            <span class="badge bg-{{ $circuit->statut === 'en_cours' ? 'success' : ($circuit->statut === 'planifié' ? 'warning' : 'secondary') }} fs-6">
                                {{ ucfirst($circuit->statut) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ FORMULAIRE DE MISE À JOUR DU CIRCUIT --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">📋 Informations Circuit</h5>
                </div>
                <div class="card-body">
                    <form id="formCircuit" method="POST" action="{{ route('circuits.update', $circuit) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom du Circuit</label>
                                <input type="text" name="nom" class="form-control" 
                                       value="{{ $circuit->nom }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Guide Principal</label>
                                <input type="text" name="guide_principal" class="form-control" 
                                       value="{{ $circuit->guide_principal }}">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Date de Début</label>
                                <input type="date" name="date_debut" class="form-control" 
                                       value="{{ $circuit->date_debut->format('Y-m-d') }}" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Nombre de Jours</label>
                                <input type="number" name="nb_jours" class="form-control" 
                                       value="{{ $circuit->nb_jours }}" required min="1" max="30">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Statut</label>
                                <select name="statut" class="form-select">
                                    <option value="planifié" {{ $circuit->statut === 'planifié' ? 'selected' : '' }}>Planifié</option>
                                    <option value="en_cours" {{ $circuit->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="terminé" {{ $circuit->statut === 'terminé' ? 'selected' : '' }}>Terminé</option>
                                    <option value="annulé" {{ $circuit->statut === 'annulé' ? 'selected' : '' }}>Annulé</option>
                                </select>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $circuit->description }}</textarea>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    <i class="bx bx-save"></i> Enregistrer les Modifications
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Actions globales --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-2 flex-wrap">
                        <button onclick="genererToutesConsignes()" class="btn btn-purple">
                            <i class="bx bx-magic-wand"></i> Générer Toutes les Consignes
                        </button>
                        
                        @if($circuit->statut === 'planifié')
                        <button onclick="activerCircuit()" class="btn btn-success">
                            <i class="bx bx-play"></i> Activer Circuit
                        </button>
                        @endif
                        
                        <button onclick="previsualiserLiens()" class="btn btn-info">
                            <i class="bx bx-link"></i> Prévisualiser Liens Équipe
                        </button>
                        
                        @if($circuit->statut === 'en_cours')
                        <button onclick="envoyerLiensAujourdhui()" class="btn btn-warning">
                            <i class="bx bx-send"></i> Envoyer Liens Aujourd'hui
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Programme jour par jour --}}
    @foreach($circuit->programmeJournaliers as $programme)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                {{-- Header jour --}}
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">
                                <i class="bx bx-calendar"></i> 
                                Jour {{ $programme->jour_numero }} - {{ $programme->date->format('d/m/Y') }}
                            </h5>
                            <small class="text-muted">{{ $programme->lieu_principal }}</small>
                        </div>
                        <div class="d-flex gap-2">
                            <button onclick="genererConsignes({{ $programme->id }})" 
                                    class="btn btn-sm btn-success">
                                <i class="bx bx-magic-wand"></i> Générer Consignes
                            </button>
                            <button onclick="toggleJour({{ $programme->id }})" 
                                    class="btn btn-sm btn-primary">
                                <i class="bx bx-edit"></i> Éditer
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Contenu jour --}}
                <div id="jour-{{ $programme->id }}" class="card-body">
                    <div class="row">
                        {{-- Programme --}}
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">📋 Programme du Jour</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">📍 Lieu Principal</label>
                                <p class="mb-0">{{ $programme->lieu_principal }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">🎯 Activités</label>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($programme->activites)) !!}
                                </div>
                            </div>

                            @if($programme->hebergement)
                            <div class="mb-3">
                                <label class="form-label fw-bold">🏨 Hébergement</label>
                                <p class="mb-0">{{ $programme->hebergement }}</p>
                            </div>
                            @endif

                            @if($programme->horaires)
                            <div class="mb-3">
                                <label class="form-label fw-bold">⏰ Horaires</label>
                                <div class="row g-2">
                                    @foreach($programme->horaires as $moment => $heure)
                                    <div class="col-6">
                                        <div class="bg-light p-2 rounded text-center">
                                            <small class="text-muted d-block">{{ ucfirst($moment) }}</small>
                                            <strong>{{ $heure }}</strong>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($programme->notes_speciales)
                            <div class="alert alert-warning">
                                <h6 class="alert-heading">⚠️ Notes Spéciales</h6>
                                {!! nl2br(e($programme->notes_speciales)) !!}
                            </div>
                            @endif
                        </div>

                        {{-- Consignes communication --}}
                        <div class="col-md-6">
                            <h6 class="text-success mb-3">📱 Consignes Communication</h6>
                            
                            {{-- Consignes Photographe --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">📸 Consignes Photographe</label>
                                @if($programme->getConsignesPhotographe())
                                    @php $consignesPhoto = $programme->getConsignesPhotographe() @endphp
                                    <div class="card border-primary">
                                        <div class="card-body p-3">
                                            <div class="mb-2">
                                                {!! nl2br(e($consignesPhoto->consignes_specifiques)) !!}
                                            </div>
                                            @if($consignesPhoto->hashtags_jour)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($consignesPhoto->hashtags_jour as $hashtag)
                                                <span class="badge bg-primary">{{ $hashtag }}</span>
                                                @endforeach
                                            </div>
                                            @endif
                                            <small class="text-muted d-block mt-2">
                                                <i class="bx bx-flag"></i> Priorité: {{ ucfirst($consignesPhoto->priorite) }}
                                            </small>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center text-muted py-3 border rounded">
                                        <i class="bx bx-info-circle"></i> Pas encore générées
                                    </div>
                                @endif
                            </div>

                            {{-- Consignes Gestionnaire --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold text-success">✍️ Consignes Gestionnaire</label>
                                @if($programme->getConsignesGestionnaire())
                                    @php $consignesGest = $programme->getConsignesGestionnaire() @endphp
                                    <div class="card border-success">
                                        <div class="card-body p-3">
                                            <div class="mb-2">
                                                {!! nl2br(e($consignesGest->consignes_specifiques)) !!}
                                            </div>
                                            @if($consignesGest->hashtags_jour)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($consignesGest->hashtags_jour as $hashtag)
                                                <span class="badge bg-success">{{ $hashtag }}</span>
                                                @endforeach
                                            </div>
                                            @endif
                                            <small class="text-muted d-block mt-2">
                                                <i class="bx bx-flag"></i> Priorité: {{ ucfirst($consignesGest->priorite) }}
                                            </small>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center text-muted py-3 border rounded">
                                        <i class="bx bx-info-circle"></i> Pas encore générées
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ✅ FORMULAIRE ÉDITION CORRIGÉ --}}
                <div id="form-{{ $programme->id }}" class="card-body border-top bg-light d-none">
                    <form method="POST" action="{{ route('programme.update', $programme) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Lieu Principal</label>
                                <input type="text" name="lieu_principal" 
                                       value="{{ $programme->lieu_principal }}" 
                                       class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hébergement</label>
                                <input type="text" name="hebergement" 
                                       value="{{ $programme->hebergement }}" 
                                       class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Activités du Jour</label>
                                <textarea name="activites" rows="4" 
                                          class="form-control">{{ $programme->activites }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Notes Spéciales</label>
                                <textarea name="notes_speciales" rows="3" 
                                          class="form-control">{{ $programme->notes_speciales }}</textarea>
                            </div>

                            {{-- Horaires --}}
                            <div class="col-12">
                                <label class="form-label">Horaires</label>
                                <div class="row g-2">
                                    @foreach(['matin' => 'Matin', 'dejeuner' => 'Déjeuner', 'apres_midi' => 'Après-midi', 'diner' => 'Dîner'] as $key => $label)
                                    <div class="col-md-3">
                                        <label class="form-label small">{{ $label }}</label>
                                        <input type="time" name="horaires[{{ $key }}]" 
                                               value="{{ $programme->horaires[$key] ?? '' }}"
                                               class="form-control form-control-sm">
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="button" onclick="sauvegarderJour({{ $programme->id }})"
                                            class="btn btn-success">
                                        <i class="bx bx-save"></i> Sauvegarder
                                    </button>
                                    <button type="button" onclick="toggleJour({{ $programme->id }})"
                                            class="btn btn-secondary">
                                        <i class="bx bx-x"></i> Annuler
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
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
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">📸 Lien Photographe/Vidéaste</label>
                        <div class="input-group">
                            <input type="text" id="lienPhotographe" 
                                   value="{{ route('terrain.acces', 'TOKEN_PHOTOGRAPHE') }}" 
                                   class="form-control" readonly>
                            <button class="btn btn-outline-secondary" onclick="copierLien('lienPhotographe')">
                                <i class="bx bx-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">✍️ Lien Gestionnaire Posts</label>
                        <div class="input-group">
                            <input type="text" id="lienGestionnaire" 
                                   value="{{ route('terrain.acces', 'TOKEN_GESTIONNAIRE') }}" 
                                   class="form-control" readonly>
                            <button class="btn btn-outline-secondary" onclick="copierLien('lienGestionnaire')">
                                <i class="bx bx-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3">
                    <i class="bx bx-info-circle"></i>
                    <strong>Info :</strong> Ces liens permettent à votre équipe d'accéder directement au programme du jour sur mobile.
                </div>
            </div>
        </div>
    </div>
</div>

// ===== REMPLACER TOUT LE JAVASCRIPT DANS edit.blade.php PAR CECI =====

<script>
// ✅ JAVASCRIPT ENTIÈREMENT CORRIGÉ

function toggleJour(id) {
    const contenu = document.getElementById('jour-' + id);
    const form = document.getElementById('form-' + id);
    
    if (contenu && form) {
        contenu.classList.toggle('d-none');
        form.classList.toggle('d-none');
    }
}

function sauvegarderJour(id) {
    const form = document.querySelector(`#form-${id} form`);
    if (!form) {
        console.error('Formulaire non trouvé pour ID:', id);
        toastr.error('Formulaire non trouvé');
        return;
    }
    
    const formData = new FormData(form);
    
    // ✅ URL CORRIGÉE AVEC /admin/ 
    fetch(`/admin/coordination/programme/${id}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-HTTP-Method-Override': 'PUT'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            toastr.success(data.message || 'Programme mis à jour avec succès !');
            setTimeout(() => location.reload(), 1000);
        } else {
            toastr.error(data.message || 'Erreur lors de la sauvegarde');
        }
    })
    .catch(error => {
        console.error('Erreur complète:', error);
        toastr.error('Erreur lors de la sauvegarde');
    });
}

function genererConsignes(id) {
    console.log('Génération consignes pour ID:', id);
    
    // ✅ URL CORRIGÉE AVEC /admin/
    fetch(`/admin/coordination/programme/${id}/consignes`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            toastr.success(data.message || 'Consignes générées avec succès !');
            setTimeout(() => location.reload(), 1000);
        } else {
            toastr.error(data.message || 'Erreur lors de la génération');
        }
    })
    .catch(error => {
        console.error('Erreur complète:', error);
        toastr.error('Erreur lors de la génération');
    });
}

// ✅ GESTION DU FORMULAIRE CIRCUIT PRINCIPAL CORRIGÉE
document.addEventListener('DOMContentLoaded', function() {
    const formCircuit = document.getElementById('formCircuit');
    
    if (formCircuit) {
        formCircuit.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Soumission formulaire circuit');
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    toastr.success(data.message || 'Circuit mis à jour avec succès !');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(data.message || 'Erreur lors de la mise à jour');
                }
            })
            .catch(error => {
                console.error('Erreur complète:', error);
                toastr.error('Erreur lors de la mise à jour');
            });
        });
    }
});

function genererToutesConsignes() {
    if (confirm('Générer les consignes pour tous les jours du circuit ?')) {
        const programmes = document.querySelectorAll('[id^="jour-"]');
        let completed = 0;
        const total = programmes.length;
        
        console.log(`Génération pour ${total} programmes`);
        
        programmes.forEach(programme => {
            const id = programme.id.replace('jour-', '');
            console.log('Génération pour programme ID:', id);
            
            // ✅ URL CORRIGÉE AVEC /admin/
            fetch(`/admin/coordination/programme/${id}/consignes`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                completed++;
                console.log(`Complété ${completed}/${total}`);
                if (completed === total) {
                    toastr.success('Toutes les consignes ont été générées !');
                    setTimeout(() => location.reload(), 2000);
                }
            })
            .catch(error => {
                console.error('Erreur pour programme', id, error);
                completed++;
            });
        });
    }
}

function activerCircuit() {
    if (confirm('Activer ce circuit et envoyer les liens à l\'équipe ?')) {
        console.log('Activation circuit ID:', {{ $circuit->id }});
        
        // ✅ URL CORRIGÉE AVEC /admin/
        fetch(`/admin/coordination/circuits/{{ $circuit->id }}/activer`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                toastr.success(data.message || 'Circuit activé avec succès !');
                setTimeout(() => location.reload(), 1000);
            } else {
                toastr.error(data.message || 'Erreur lors de l\'activation');
            }
        })
        .catch(error => {
            console.error('Erreur complète:', error);
            toastr.error('Erreur lors de l\'activation');
        });
    }
}

function previsualiserLiens() {
    const modal = new bootstrap.Modal(document.getElementById('modalLiensEquipe'));
    modal.show();
}

function envoyerLiensAujourdhui() {
    if (confirm('Envoyer les liens du jour à toute l\'équipe ?')) {
        // ✅ URL CORRIGÉE AVEC /admin/
        fetch('/admin/coordination/circuits/envoyer-liens-aujourdhui', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(`Liens envoyés à ${data.equipes_notifiees} équipes !`);
            } else {
                toastr.error(data.message || 'Erreur lors de l\'envoi');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            toastr.error('Erreur lors de l\'envoi');
        });
    }
}

function copierLien(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
        input.select();
        input.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(input.value);
        toastr.success('Lien copié dans le presse-papier !');
    }
}

// ✅ VÉRIFICATIONS AU CHARGEMENT
document.addEventListener('DOMContentLoaded', function() {
    // Vérifier la présence du token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('Token CSRF manquant ! Ajoutez <meta name="csrf-token" content="{{ csrf_token() }}"> dans le head');
    } else {
        console.log('Token CSRF trouvé:', csrfToken.content.substring(0, 10) + '...');
    }
    
    // Vérifier la présence de toastr
    if (typeof toastr === 'undefined') {
        console.error('Toastr non chargé ! Ajoutez les scripts toastr dans votre layout');
        window.toastr = {
            success: (msg) => alert('Succès: ' + msg),
            error: (msg) => alert('Erreur: ' + msg)
        };
    }
    
    console.log('JavaScript circuit chargé avec succès');
});
</script>
<style>
.btn-purple {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
}

.btn-purple:hover {
    background-color: #5a359a;
    border-color: #5a359a;
    color: white;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.border-primary {
    border-color: #0d6efd !important;
}

.border-success {
    border-color: #198754 !important;
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>

@endsection