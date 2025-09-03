@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Gestion des Circuits</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tous les Circuits</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.voyages.create') }}" class="btn btn-primary px-4">
                    <i class="bx bx-plus"></i> Ajouter Voyage
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Nom du Voyage</th>
                            <th>Type</th>
                            <th>Durée</th>
                            <th>Prix Base</th>
                            <th>Participants</th>
                            <th>Confort</th>
                            <th>Étapes</th>
                            <th>Activités</th>
                            <th>Statut & Badges</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($voyages as $key => $voyage)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <img src="{{ asset($voyage->image_couverture) }}" alt="{{ $voyage->nom_voyage }}" 
                                     style="width: 70px; height: 40px; object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $voyage->nom_voyage }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($voyage->description_courte, 50) }}</small>
                                    <br>
                                    <small class="text-info">
                                        <i class="bx bx-map"></i> {{ $voyage->region }}
                                    </small>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-voyage-{{ $voyage->type_voyage }}">
                                    {{ $voyage->typeVoyageLabel }}
                                </span>
                            </td>
                            <td>
                                <div class="text-center">
                                    <strong>{{ $voyage->dureeFormattee }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        <i class="bx bx-calendar"></i> {{ $voyage->duree_jours }} jour{{ $voyage->duree_jours > 1 ? 's' : '' }}
                                    </small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong class="text-success">{{ $voyage->prixBaseFormate }}</strong>
                                    @if($voyage->prix_avec_guide)
                                    <br>
                                    <small class="text-primary">
                                        <i class="bx bx-user"></i> +{{ $voyage->prixAvecGuideFormate }}
                                    </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge bg-info">
                                        {{ $voyage->participants_min }}-{{ $voyage->participants_max ?? '∞' }}
                                    </span>
                                    @if($voyage->guide_inclus)
                                    <br><small class="text-success"><i class="bx bx-user-check"></i> Guide inclus</small>
                                    @endif
                                    @if($voyage->repas_inclus)
                                    <br><small class="text-warning"><i class="bx bx-restaurant"></i> Repas inclus</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge bg-secondary">{{ $voyage->niveau_confort_label ?? 'Standard' }}</span>
                                    <br>
                                    <small class="text-muted">{{ $voyage->getDifficulteLabel() }}</small>
                                    @if($voyage->point_depart)
                                    <br>
                                    <small class="text-info">
                                        <i class="bx bx-map-pin"></i> {{ Str::limit($voyage->point_depart, 15) }}
                                    </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($voyage->etapes->count() > 0)
                                <div class="text-center">
                                    <span class="badge bg-primary">{{ $voyage->etapes->count() }} étapes</span>
                                    <button class="btn btn-sm btn-outline-primary mt-1" onclick="voirEtapes({{ $voyage->id }})">
                                        <i class="bx bx-calendar"></i> Voir
                                    </button>
                                </div>
                                @else
                                <div class="text-center">
                                    <span class="text-muted">Aucune étape</span>
                                    <button class="btn btn-sm btn-outline-secondary mt-1" onclick="ajouterEtape({{ $voyage->id }})">
                                        <i class="bx bx-plus"></i> Ajouter
                                    </button>
                                </div>
                                @endif
                            </td>
                            <td>
                                @if($voyage->activites->count() > 0)
                                <div class="text-center">
                                    <div class="d-flex flex-column gap-1">
                                        @if($voyage->activitesIncluses->count() > 0)
                                        <span class="badge bg-success">{{ $voyage->activitesIncluses->count() }} incluse(s)</span>
                                        @endif
                                        @if($voyage->activitesOptionnelles->count() > 0)
                                        <span class="badge bg-warning">{{ $voyage->activitesOptionnelles->count() }} option(s)</span>
                                        @endif
                                        <button class="btn btn-sm btn-outline-info" onclick="voirActivites({{ $voyage->id }})">
                                            <i class="bx bx-list-ul"></i> Voir
                                        </button>
                                    </div>
                                </div>
                                @else
                                <div class="text-center">
                                    <span class="text-muted">Aucune activité</span>
                                    <button class="btn btn-sm btn-outline-secondary mt-1" onclick="ajouterActivite({{ $voyage->id }})">
                                        <i class="bx bx-plus"></i> Ajouter
                                    </button>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="text-center">
                                    @if($voyage->statut === 'publie')
                                    <span class="badge bg-success">Publié</span>
                                    @elseif($voyage->statut === 'brouillon')
                                    <span class="badge bg-warning">Brouillon</span>
                                    @else
                                    <span class="badge bg-secondary">Archivé</span>
                                    @endif
                                    
                                    <!-- Nouveaux badges circuit -->
                                    <div class="mt-1">
                                        @if($voyage->nouveau)
                                        <span class="badge bg-info text-white">Nouveau</span>
                                        @endif
                                        @if($voyage->recommande)
                                        <span class="badge bg-warning">⭐ Recommandé</span>
                                        @endif
                                        @if($voyage->sur_mesure)
                                        <span class="badge bg-primary">Sur mesure</span>
                                        @endif
                                        @if($voyage->note_moyenne > 0)
                                        <br><small class="text-success">{{ number_format($voyage->note_moyenne, 1) }}/5 ({{ $voyage->nombre_avis }} avis)</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1 justify-content-center">
                                    <!-- Bouton éditer -->
                                    <a href="{{ route('admin.voyages.edit', $voyage->id) }}" class="btn btn-info btn-sm" title="Éditer">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    
                                    <!-- Bouton dupliquer -->
                                    <button class="btn btn-warning btn-sm" onclick="dupliquerVoyage({{ $voyage->id }})" title="Dupliquer">
                                        <i class="bx bx-copy"></i>
                                    </button>
                                    
                                    <!-- Bouton voir détails -->
                                    <button class="btn btn-primary btn-sm" onclick="voirDetails({{ $voyage->id }})" title="Voir détails">
                                        <i class="bx bx-show"></i>
                                    </button>
                                    
                                    <!-- Bouton supprimer -->
                                    <a href="{{ route('admin.voyages.delete', $voyage->id) }}" class="btn btn-danger btn-sm" id="delete" title="Supprimer">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour voir les étapes -->
<div class="modal fade" id="modalEtapes" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Programme Jour par Jour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="contenuEtapes">
                <!-- Contenu chargé dynamiquement -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="ajouterEtapeModal()">
                    <i class="bx bx-plus"></i> Ajouter Étape
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour voir les activités -->
<div class="modal fade" id="modalActivites" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activités du Voyage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="contenuActivites">
                <!-- Contenu chargé dynamiquement -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="ajouterActiviteModal()">
                    <i class="bx bx-plus"></i> Ajouter Activité
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour ajouter une étape -->
<div class="modal fade" id="modalAjouterEtape" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Étape</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formAjouterEtape">
                <div class="modal-body">
                    <input type="hidden" id="voyage_id_etape" name="voyage_id">
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Titre de l'étape *</label>
                            <input type="text" name="titre_etape" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Description *</label>
                            <textarea name="description_etape" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Lieu de départ</label>
                            <input type="text" name="lieu_depart" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lieu d'arrivée</label>
                            <input type="text" name="lieu_arrivee" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Heure de début</label>
                            <input type="time" name="heure_debut" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Heure de fin</label>
                            <input type="time" name="heure_fin" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Hébergement</label>
                            <input type="text" name="hebergement_etape" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Notes spéciales</label>
                            <textarea name="notes_speciales" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Enregistrer
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour ajouter une activité -->
<div class="modal fade" id="modalAjouterActivite" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Activité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formAjouterActivite">
                <div class="modal-body">
                    <input type="hidden" id="voyage_id_activite" name="voyage_id">
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label">Nom de l'activité *</label>
                            <input type="text" name="nom_activite" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Type *</label>
                            <select name="type_activite" class="form-control" required>
                                <option value="">Sélectionner</option>
                                <option value="incluse">Incluse</option>
                                <option value="optionnelle">Optionnelle</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Description *</label>
                            <textarea name="description_activite" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label">Lieu de l'activité *</label>
                            <input type="text" name="lieu_activite" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Durée (heures)</label>
                            <input type="number" name="duree_heures" class="form-control" min="0" step="0.5">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Prix (FCFA)</label>
                            <input type="number" name="prix_activite" class="form-control" min="0" value="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jour recommandé</label>
                            <input type="number" name="jour_recommande" class="form-control" min="1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Enregistrer
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentVoyageId = null;

// Fonction pour voir les étapes d'un voyage
function voirEtapes(voyageId) {
    currentVoyageId = voyageId;
    $.ajax({
        url: '/admin/voyages/' + voyageId + '/etapes',
        type: 'GET',
        success: function(data) {
            let html = '';
            if (data.length > 0) {
                data.forEach(function(etape, index) {
                    html += `
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Jour ${etape.numero_jour}: ${etape.titre_etape}</h6>
                                <div>
                                    ${etape.heure_debut ? `<span class="badge bg-info">${etape.heure_debut} ${etape.heure_fin ? '- ' + etape.heure_fin : ''}</span>` : ''}
                                    <button class="btn btn-sm btn-outline-danger ms-2" onclick="supprimerEtape(${etape.id})">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>${etape.description_etape}</p>
                                ${etape.lieu_depart ? `<p><strong>Départ:</strong> ${etape.lieu_depart}</p>` : ''}
                                ${etape.lieu_arrivee ? `<p><strong>Arrivée:</strong> ${etape.lieu_arrivee}</p>` : ''}
                                ${etape.activites_jour ? `<p><strong>Activités:</strong> ${etape.activites_jour.join ? etape.activites_jour.join(', ') : etape.activites_jour}</p>` : ''}
                                ${etape.hebergement_etape ? `<p><strong>Hébergement:</strong> ${etape.hebergement_etape}</p>` : ''}
                                ${etape.notes_speciales ? `<p><em>${etape.notes_speciales}</em></p>` : ''}
                            </div>
                        </div>
                    `;
                });
            } else {
                html = '<p class="text-muted text-center">Aucune étape pour ce voyage.</p>';
            }
            
            $('#contenuEtapes').html(html);
            $('#modalEtapes').modal('show');
        },
        error: function() {
            toastr.error('Erreur lors du chargement des étapes');
        }
    });
}

// Fonction pour voir les activités d'un voyage
function voirActivites(voyageId) {
    currentVoyageId = voyageId;
    $.ajax({
        url: '/admin/voyages/' + voyageId + '/activites',
        type: 'GET',
        success: function(data) {
            let html = '';
            if (data.length > 0) {
                // Séparer les activités incluses et optionnelles
                let incluses = data.filter(a => a.type_activite === 'incluse');
                let optionnelles = data.filter(a => a.type_activite === 'optionnelle');
                
                if (incluses.length > 0) {
                    html += '<h6 class="text-success mb-3">Activités Incluses</h6>';
                    incluses.forEach(function(activite) {
                        html += generateActiviteCard(activite, 'success');
                    });
                }
                
                if (optionnelles.length > 0) {
                    html += '<h6 class="text-warning mb-3 mt-4">Activités Optionnelles</h6>';
                    optionnelles.forEach(function(activite) {
                        html += generateActiviteCard(activite, 'warning');
                    });
                }
            } else {
                html = '<p class="text-muted text-center">Aucune activité pour ce voyage.</p>';
            }
            
            $('#contenuActivites').html(html);
            $('#modalActivites').modal('show');
        },
        error: function() {
            toastr.error('Erreur lors du chargement des activités');
        }
    });
}

function generateActiviteCard(activite, type) {
    return `
        <div class="card mb-3 border-${type}">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0">${activite.nom_activite}</h6>
                <div>
                    ${activite.prix_activite > 0 ? `<span class="badge bg-${type}">${new Intl.NumberFormat().format(activite.prix_activite)} FCFA</span>` : ''}
                    ${activite.duree_heures ? `<span class="badge bg-secondary ms-1">${activite.duree_heures}h</span>` : ''}
                    <button class="btn btn-sm btn-outline-danger ms-2" onclick="supprimerActivite(${activite.id})">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p>${activite.description_activite}</p>
                <p><strong>Lieu:</strong> ${activite.lieu_activite}</p>
                ${activite.jour_recommande ? `<p><strong>Jour recommandé:</strong> Jour ${activite.jour_recommande}</p>` : ''}
                ${activite.equipements_requis ? `<p><strong>Équipements:</strong> ${activite.equipements_requis.join ? activite.equipements_requis.join(', ') : activite.equipements_requis}</p>` : ''}
            </div>
        </div>
    `;
}

// Fonction pour ajouter une étape
function ajouterEtape(voyageId) {
    currentVoyageId = voyageId;
    $('#voyage_id_etape').val(voyageId);
    $('#modalAjouterEtape').modal('show');
}

function ajouterEtapeModal() {
    if (currentVoyageId) {
        ajouterEtape(currentVoyageId);
    }
}

// NOUVELLE FONCTION pour ajouter une activité
function ajouterActivite(voyageId) {
    currentVoyageId = voyageId;
    $('#voyage_id_activite').val(voyageId);
    $('#modalAjouterActivite').modal('show');
}

function ajouterActiviteModal() {
    if (currentVoyageId) {
        ajouterActivite(currentVoyageId);
    }
}

// Soumission du formulaire d'ajout d'étape
$('#formAjouterEtape').on('submit', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    let voyageId = $('#voyage_id_etape').val();
    
    $.ajax({
        url: '/admin/voyages/' + voyageId + '/etapes',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message);
                $('#modalAjouterEtape').modal('hide');
                $('#formAjouterEtape')[0].reset();
                // Recharger les étapes si le modal est ouvert
                if ($('#modalEtapes').hasClass('show')) {
                    voirEtapes(voyageId);
                }
                // Recharger la page pour mettre à jour le compteur
                location.reload();
            }
        },
        error: function() {
            toastr.error('Erreur lors de l\'ajout de l\'étape');
        }
    });
});

// NOUVEAU : Soumission du formulaire d'ajout d'activité
$('#formAjouterActivite').on('submit', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    let voyageId = $('#voyage_id_activite').val();
    
    $.ajax({
        url: '/admin/voyages/' + voyageId + '/activites',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message);
                $('#modalAjouterActivite').modal('hide');
                $('#formAjouterActivite')[0].reset();
                // Recharger les activités si le modal est ouvert
                if ($('#modalActivites').hasClass('show')) {
                    voirActivites(voyageId);
                }
                // Recharger la page pour mettre à jour le compteur
                location.reload();
            }
        },
        error: function() {
            toastr.error('Erreur lors de l\'ajout de l\'activité');
        }
    });
});

// Fonction pour supprimer une étape
function supprimerEtape(etapeId) {
    Swal.fire({
        title: 'Supprimer l\'étape',
        text: "Voulez-vous vraiment supprimer cette étape ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/admin/etapes/' + etapeId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        voirEtapes(currentVoyageId);
                    }
                },
                error: function() {
                    toastr.error('Erreur lors de la suppression');
                }
            });
        }
    });
}

// NOUVELLE FONCTION : Supprimer une activité
function supprimerActivite(activiteId) {
    Swal.fire({
        title: 'Supprimer l\'activité',
        text: "Voulez-vous vraiment supprimer cette activité ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/admin/activites/' + activiteId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        voirActivites(currentVoyageId);
                    }
                },
                error: function() {
                    toastr.error('Erreur lors de la suppression');
                }
            });
        }
    });
}

// Fonction pour dupliquer un voyage
function dupliquerVoyage(voyageId) {
    Swal.fire({
        title: 'Dupliquer le voyage',
        text: "Voulez-vous créer une copie de ce voyage ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, dupliquer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/admin/voyages/' + voyageId + '/duplicate',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Dupliqué!',
                            response.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire(
                        'Erreur!',
                        'Une erreur est survenue lors de la duplication.',
                        'error'
                    );
                }
            });
        }
    });
}

$(document).ready(function() {
    // Initialisation du DataTable
    $('#example').DataTable({
        "pageLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        },
        "columnDefs": [
            { "orderable": false, "targets": [1, 11] }, // Désactiver le tri sur Image et Actions
            { "width": "5%", "targets": 0 },
            { "width": "8%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "8%", "targets": 4 },
            { "width": "12%", "targets": 5 },
            { "width": "10%", "targets": 6 },
            { "width": "8%", "targets": 7 },
            { "width": "10%", "targets": 8 },
            { "width": "10%", "targets": 9 },
            { "width": "8%", "targets": 10 },
            { "width": "15%", "targets": 11 }
        ]
    });
});
</script>
@endpush

<style>
/* Badges personnalisés pour les types de voyages */
.badge-voyage-culturel { background-color: #6f42c1; }
.badge-voyage-aventure { background-color: #fd7e14; }
.badge-voyage-detente { background-color: #20c997; }
.badge-voyage-famille { background-color: #e83e8c; }
.badge-voyage-eco-tourisme { background-color: #198754; }
.badge-voyage-decouverte { background-color: #0dcaf0; }

/* Badges pour la difficulté */
.badge-difficulte-facile { background-color: #198754; }
.badge-difficulte-modere { background-color: #fd7e14; }
.badge-difficulte-difficile { background-color: #dc3545; }

/* Styles pour les cartes dans les modals */
.modal .card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.modal .card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0,0,0,.125);
}

/* Responsive pour les boutons d'action */
@media (max-width: 768px) {
    .d-flex.gap-1 {
        flex-direction: column;
    }
    
    .btn-sm {
        margin-bottom: 2px;
    }
}

/* Amélioration de l'affichage des badges */
.badge {
    font-size: 0.75em;
}

/* Style pour les tooltips */
[title] {
    cursor: help;
}

/* Animation pour les cartes */
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

/* Styles pour la table responsive */
.table-responsive {
    border-radius: 0.375rem;
}

.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    font-weight: 600;
    font-size: 0.875rem;
    padding: 1rem 0.75rem;
}

.table td {
    padding: 0.75rem;
    vertical-align: middle;
}

/* Style pour les images dans le tableau */
.table img {
    border-radius: 0.375rem;
    border: 2px solid #e9ecef;
}

/* Styles pour les boutons du header */
.btn-group .btn {
    margin-left: 0.5rem;
}

.btn-group .btn:first-child {
    margin-left: 0;
}

/* Style pour les modals */
.modal-xl {
    max-width: 1200px;
}

.modal-lg {
    max-width: 900px;
}

/* Animation pour les badges */
.badge {
    transition: all 0.2s ease-in-out;
}

.badge:hover {
    transform: scale(1.05);
}

/* Style pour les formulaires dans les modals */
.modal .form-label {
    font-weight: 600;
    color: #495057;
}

.modal .form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Style pour les alertes vides */
.text-muted {
    font-style: italic;
}

/* Amélioration des boutons d'action */
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.btn-sm i {
    font-size: 1rem;
}

/* Style pour les compteurs */
.badge.bg-primary {
    background-color: #0d6efd !important;
}

.badge.bg-success {
    background-color: #198754 !important;
}

.badge.bg-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
}

.badge.bg-info {
    background-color: #0dcaf0 !important;
    color: #000 !important;
}

/* Responsive design pour mobile */
@media (max-width: 576px) {
    .modal-dialog {
        margin: 0.5rem;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-sm {
        padding: 0.125rem 0.25rem;
        font-size: 0.75rem;
    }
}

/* Style pour les états de statut */
.badge.bg-success {
    background-color: #28a745 !important;
}

.badge.bg-warning {
    background-color: #ffc107 !important;
    color: #212529 !important;
}

.badge.bg-secondary {
    background-color: #6c757d !important;
}
</style>

@endsection