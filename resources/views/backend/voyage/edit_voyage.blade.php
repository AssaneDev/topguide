@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Modifier le Voyage</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.voyages.index') }}">Voyages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier Voyage</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container">
        <div class="main-body">
            <div class="row">
                <!-- Informations principales -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="bx bx-edit"></i> Modifier : {{ $voyage->nom_voyage }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="voyageEditForm" method="post" action="{{ route('voyages.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $voyage->id }}">
                                
                                <!-- Informations générales -->
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="bx bx-info-circle"></i> Informations Générales
                                        </h5>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-8">
                                        <label class="form-label">Nom du Voyage *</label>
                                        <input type="text" name="nom_voyage" class="form-control" required 
                                               value="{{ $voyage->nom_voyage }}" placeholder="Ex: Découverte du Sénégal Authentique">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Type de Voyage *</label>
                                        <select name="type_voyage" class="form-control" required>
                                            <option value="">Sélectionner un type</option>
                                            <option value="culturel" {{ $voyage->type_voyage == 'culturel' ? 'selected' : '' }}>Voyage Culturel</option>
                                            <option value="aventure" {{ $voyage->type_voyage == 'aventure' ? 'selected' : '' }}>Voyage Aventure</option>
                                            <option value="detente" {{ $voyage->type_voyage == 'detente' ? 'selected' : '' }}>Voyage Détente</option>
                                            <option value="famille" {{ $voyage->type_voyage == 'famille' ? 'selected' : '' }}>Voyage Famille</option>
                                            <option value="eco-tourisme" {{ $voyage->type_voyage == 'eco-tourisme' ? 'selected' : '' }}>Éco-tourisme</option>
                                            <option value="decouverte" {{ $voyage->type_voyage == 'decouverte' ? 'selected' : '' }}>Découverte</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-8">
                                        <label class="form-label">Région/Zone Géographique *</label>
                                        <input type="text" name="region" class="form-control" required 
                                               value="{{ $voyage->region }}" placeholder="Ex: Dakar, Casamance, Saint-Louis...">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Durée (jours) *</label>
                                        <input type="number" name="duree_jours" class="form-control" min="1" max="365" required 
                                               value="{{ $voyage->duree_jours }}" placeholder="Ex: 7">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">Description Courte *</label>
                                        <textarea name="description_courte" class="form-control" rows="3" required 
                                                  placeholder="Résumé attractif du voyage en quelques lignes...">{{ $voyage->description_courte }}</textarea>
                                        <small class="text-muted">Cette description apparaîtra dans les listes de voyages</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">Description Détaillée *</label>
                                        <textarea name="description_longue" id="myeditorinstance" class="form-control" rows="8" required 
                                                  placeholder="Description complète du voyage, itinéraire général, points forts...">{{ $voyage->description_longue }}</textarea>
                                    </div>
                                </div>

                                <!-- Tarification et Participants -->
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="bx bx-money"></i> Tarification et Participants
                                        </h5>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label">Prix de Base (FCFA) *</label>
                                        <input type="number" name="prix_base" class="form-control" min="0" required 
                                               value="{{ $voyage->prix_base }}" placeholder="Ex: 250000">
                                        <small class="text-muted">Prix par personne</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Prix avec Guide (FCFA)</label>
                                        <input type="number" name="prix_avec_guide" class="form-control" min="0" 
                                               value="{{ $voyage->prix_avec_guide }}" placeholder="Ex: 300000">
                                        <small class="text-muted">Optionnel</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Difficulté</label>
                                        <select name="difficulte" class="form-control">
                                            <option value="facile" {{ $voyage->difficulte == 'facile' ? 'selected' : '' }}>Facile</option>
                                            <option value="modere" {{ $voyage->difficulte == 'modere' ? 'selected' : '' }}>Modéré</option>
                                            <option value="difficile" {{ $voyage->difficulte == 'difficile' ? 'selected' : '' }}>Difficile</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label">Participants Min</label>
                                        <input type="number" name="participants_min" class="form-control" min="1" 
                                               value="{{ $voyage->participants_min }}" placeholder="Ex: 2">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Participants Max *</label>
                                        <input type="number" name="participants_max" class="form-control" min="1" required 
                                               value="{{ $voyage->participants_max }}" placeholder="Ex: 15">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Statut</label>
                                        <select name="statut" class="form-control">
                                            <option value="brouillon" {{ $voyage->statut == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                            <option value="publie" {{ $voyage->statut == 'publie' ? 'selected' : '' }}>Publié</option>
                                            <option value="archive" {{ $voyage->statut == 'archive' ? 'selected' : '' }}>Archivé</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Services inclus -->
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="bx bx-check-circle"></i> Services Inclus
                                        </h5>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Transports Inclus</label>
                                        <div class="transport-checkboxes">
                                            @php 
                                                $transports = [];
                                                if ($voyage->transports_inclus) {
                                                    $transports = is_array($voyage->transports_inclus) 
                                                        ? $voyage->transports_inclus 
                                                        : json_decode($voyage->transports_inclus, true) ?? [];
                                                }
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="bus" id="transport_bus"
                                                       {{ in_array('bus', $transports) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="transport_bus">
                                                    <i class="bx bx-bus"></i> Bus/Car
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="avion" id="transport_avion"
                                                       {{ in_array('avion', $transports) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="transport_avion">
                                                    <i class="bx bx-plane"></i> Avion
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="bateau" id="transport_bateau"
                                                       {{ in_array('bateau', $transports) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="transport_bateau">
                                                    <i class="bx bx-water"></i> Bateau
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="voiture" id="transport_voiture"
                                                       {{ in_array('voiture', $transports) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="transport_voiture">
                                                    <i class="bx bx-car"></i> Voiture
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="taxi" id="transport_taxi"
                                                       {{ in_array('taxi', $transports) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="transport_taxi">
                                                    <i class="bx bx-taxi"></i> Taxi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Hébergements Inclus</label>
                                        <div class="hebergement-checkboxes">
                                            @php 
                                                $hebergements = [];
                                                if ($voyage->hebergements_inclus) {
                                                    $hebergements = is_array($voyage->hebergements_inclus) 
                                                        ? $voyage->hebergements_inclus 
                                                        : json_decode($voyage->hebergements_inclus, true) ?? [];
                                                }
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="hotel" id="hebergement_hotel"
                                                       {{ in_array('hotel', $hebergements) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hebergement_hotel">
                                                    <i class="bx bx-building"></i> Hôtel
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="camping" id="hebergement_camping"
                                                       {{ in_array('camping', $hebergements) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hebergement_camping">
                                                    <i class="bx bx-home"></i> Camping
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="auberge" id="hebergement_auberge"
                                                       {{ in_array('auberge', $hebergements) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hebergement_auberge">
                                                    <i class="bx bx-bed"></i> Auberge
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="lodge" id="hebergement_lodge"
                                                       {{ in_array('lodge', $hebergements) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hebergement_lodge">
                                                    <i class="bx bx-store"></i> Lodge
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="maison_hote" id="hebergement_maison_hote"
                                                       {{ in_array('maison_hote', $hebergements) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hebergement_maison_hote">
                                                    <i class="bx bx-home-heart"></i> Maison d'hôte
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="service-checkboxes">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="repas_inclus" id="repas_inclus"
                                                       {{ $voyage->repas_inclus ? 'checked' : '' }}>
                                                <label class="form-check-label" for="repas_inclus">
                                                    <i class="bx bx-restaurant"></i> Repas inclus
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="service-checkboxes">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="guide_inclus" id="guide_inclus"
                                                       {{ $voyage->guide_inclus ? 'checked' : '' }}>
                                                <label class="form-check-label" for="guide_inclus">
                                                    <i class="bx bx-user-check"></i> Guide inclus
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Images -->
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="bx bx-image"></i> Images du Voyage
                                        </h5>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Image de Couverture</label>
                                        <input type="file" name="image_couverture" class="form-control" accept="image/*">
                                        <small class="text-muted">Dimensions recommandées: 370x150px - Laissez vide pour conserver l'image actuelle</small>
                                        @if($voyage->image_couverture)
                                        <div class="current-image mt-2">
                                            <p class="mb-1"><strong>Image actuelle :</strong></p>
                                            <img src="{{ asset($voyage->image_couverture) }}" alt="Image de couverture" 
                                                 style="max-width: 200px; max-height: 150px; border-radius: 4px; border: 1px solid #ddd;">
                                        </div>
                                        @endif
                                        <div class="preview-container mt-2" id="preview_couverture"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Image Principale</label>
                                        <input type="file" name="image_principale" class="form-control" accept="image/*">
                                        <small class="text-muted">Dimensions recommandées: 1362x900px - Laissez vide pour conserver l'image actuelle</small>
                                        @if($voyage->image_principale)
                                        <div class="current-image mt-2">
                                            <p class="mb-1"><strong>Image actuelle :</strong></p>
                                            <img src="{{ asset($voyage->image_principale) }}" alt="Image principale" 
                                                 style="max-width: 200px; max-height: 150px; border-radius: 4px; border: 1px solid #ddd;">
                                        </div>
                                        @endif
                                        <div class="preview-container mt-2" id="preview_principale"></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">Ajouter à la Galerie</label>
                                        <input type="file" name="galerie_images[]" class="form-control" multiple accept="image/*">
                                        <small class="text-muted">Vous pouvez ajouter de nouvelles images à la galerie existante</small>
                                        <div class="preview-container mt-2" id="preview_galerie"></div>
                                    </div>
                                </div>

                                <!-- Informations supplémentaires -->
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="bx bx-detail"></i> Informations Supplémentaires
                                        </h5>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Équipements Recommandés</label>
                                        <textarea name="equipements_recommandes" class="form-control" rows="4" 
                                                  placeholder="Ex: Chaussures de marche, crème solaire, appareil photo, vêtements légers...">{{ $voyage->equipements_recommandes }}</textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Conditions Particulières</label>
                                        <textarea name="conditions_particulieres" class="form-control" rows="4" 
                                                  placeholder="Ex: Bonne condition physique requise, accessible aux enfants, vaccination recommandée...">{{ $voyage->conditions_particulieres }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Informations Générales</label>
                                        <textarea name="informations_generales" class="form-control" rows="4" 
                                                  placeholder="Informations complémentaires sur le voyage, conseils, recommandations...">{{ $voyage->informations_generales }}</textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Offre Guide</label>
                                        <textarea name="offre_guide" class="form-control" rows="4" 
                                                  placeholder="Détails de l'offre avec guide, services inclus, plus-value...">{{ $voyage->offre_guide }}</textarea>
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <div class="d-flex gap-3 justify-content-end">
                                            <a href="{{ route('admin.voyages.index') }}" class="btn btn-secondary px-4">
                                                <i class="bx bx-arrow-back"></i> Retour à la liste
                                            </a>
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="bx bx-save"></i> Enregistrer les modifications
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Colonne de droite - Gestion des étapes et activités -->
                <div class="col-lg-4">
                    <!-- Statistiques du voyage -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-bar-chart"></i> Statistiques
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="stat-item">
                                        <h4 class="text-primary">{{ $voyage->etapes->count() }}</h4>
                                        <p class="mb-0">Étapes</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-item">
                                        <h4 class="text-success">{{ $voyage->activites->count() }}</h4>
                                        <p class="mb-0">Activités</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gestion des étapes -->
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-calendar"></i> Étapes ({{ $voyage->etapes->count() }})
                            </h5>
                            <button class="btn btn-sm btn-primary" onclick="ajouterEtape({{ $voyage->id }})">
                                <i class="bx bx-plus"></i> Ajouter
                            </button>
                        </div>
                        <div class="card-body">
                            @if($voyage->etapes->count() > 0)
                                <div class="etapes-list">
                                    @foreach($voyage->etapes as $etape)
                                    <div class="etape-item mb-2 p-2 border rounded">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <strong>Jour {{ $etape->numero_jour }}:</strong> {{ Str::limit($etape->titre_etape, 30) }}
                                                @if($etape->heure_debut)
                                                <br><small class="text-muted">{{ $etape->heuresFormatees }}</small>
                                                @endif
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-info" onclick="editEtape({{ $etape->id }})">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" onclick="supprimerEtape({{ $etape->id }})">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted text-center">Aucune étape définie</p>
                            @endif
                        </div>
                    </div>

                    <!-- Gestion des activités -->
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-list-ul"></i> Activités ({{ $voyage->activites->count() }})
                            </h5>
                            <button class="btn btn-sm btn-success" onclick="ajouterActivite({{ $voyage->id }})">
                                <i class="bx bx-plus"></i> Ajouter
                            </button>
                        </div>
                        <div class="card-body">
                            @if($voyage->activites->count() > 0)
                                <div class="activites-list">
                                    @foreach($voyage->activites as $activite)
                                    <div class="activite-item mb-2 p-2 border rounded">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <strong>{{ Str::limit($activite->nom_activite, 25) }}</strong>
                                                <br>
                                                <span class="badge badge-sm bg-{{ $activite->type_activite == 'incluse' ? 'success' : 'warning' }}">
                                                    {{ $activite->typeActiviteLabel }}
                                                </span>
                                                @if($activite->prix_activite > 0)
                                                <span class="text-muted">- {{ $activite->prixFormate }}</span>
                                                @endif
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-info" onclick="editActivite({{ $activite->id }})">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" onclick="supprimerActivite({{ $activite->id }})">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted text-center">Aucune activité définie</p>
                            @endif
                        </div>
                    </div>

                    <!-- Galerie d'images -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-images"></i> Galerie ({{ $voyage->galeries->count() }})
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($voyage->galeries->count() > 0)
                                <div class="row">
                                    @foreach($voyage->galeries as $galerie)
                                    <div class="col-6 mb-2">
                                        <div class="position-relative">
                                            <img src="{{ asset($galerie->chemin_image) }}" alt="Image galerie" 
                                                 class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                            <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" 
                                                    onclick="supprimerImageGalerie({{ $galerie->id }})">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted text-center">Aucune image dans la galerie</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals (étapes et activités) -->
@include('backend.voyage.modals.etape_modal')
@include('backend.voyage.modals.activite_modal')

@push('scripts')
<script>
let currentVoyageId = {{ $voyage->id }};

$(document).ready(function() {
    // Preview des images
    $('input[name="image_couverture"]').on('change', function() {
        previewImage(this, '#preview_couverture');
    });
    
    $('input[name="image_principale"]').on('change', function() {
        previewImage(this, '#preview_principale');
    });
    
    $('input[name="galerie_images[]"]').on('change', function() {
        previewMultipleImages(this, '#preview_galerie');
    });
    
    // Validation du formulaire
    $('#voyageEditForm').on('submit', function(e) {
        let isValid = true;
        
        // Vérifier les champs requis
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
                $(this).focus();
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            toastr.error('Veuillez remplir tous les champs obligatoires');
            return false;
        }
    });
    
    // Supprimer la classe d'erreur lors de la saisie
    $('[required]').on('input change', function() {
        $(this).removeClass('is-invalid');
    });
});

// Fonction pour prévisualiser une image
function previewImage(input, container) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(container).html(`
                <div class="preview-item">
                    <p class="mb-1"><strong>Nouvelle image :</strong></p>
                    <img src="${e.target.result}" class="preview-img" style="max-width: 200px; max-height: 150px; border-radius: 4px; border: 1px solid #ddd;">
                </div>
            `);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Fonction pour prévisualiser plusieurs images
function previewMultipleImages(input, container) {
    $(container).empty();
    if (input.files) {
        $(container).append('<p class="mb-1"><strong>Nouvelles images :</strong></p>');
        for (let i = 0; i < input.files.length; i++) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $(container).append(`
                    <div class="preview-item d-inline-block me-2 mb-2">
                        <img src="${e.target.result}" class="preview-img" style="max-width: 100px; max-height: 80px; border-radius: 4px; border: 1px solid #ddd;">
                    </div>
                `);
            }
            reader.readAsDataURL(input.files[i]);
        }
    }
}

// Fonctions pour la gestion des étapes
function ajouterEtape(voyageId) {
    $('#voyage_id_etape').val(voyageId);
    $('#modalAjouterEtape').modal('show');
}

function editEtape(etapeId) {
    // Charger les données de l'étape et ouvrir le modal d'édition
    $.ajax({
        url: '/admin/etapes/' + etapeId + '/edit',
        type: 'GET',
        success: function(data) {
            // Remplir le formulaire avec les données
            $('#etape_id_edit').val(data.id);
            $('#titre_etape_edit').val(data.titre_etape);
            $('#description_etape_edit').val(data.description_etape);
            $('#lieu_depart_edit').val(data.lieu_depart);
            $('#lieu_arrivee_edit').val(data.lieu_arrivee);
            $('#heure_debut_edit').val(data.heure_debut);
            $('#heure_fin_edit').val(data.heure_fin);
            $('#hebergement_etape_edit').val(data.hebergement_etape);
            $('#notes_speciales_edit').val(data.notes_speciales);
            
            $('#modalEditEtape').modal('show');
        },
        error: function() {
            toastr.error('Erreur lors du chargement des données de l\'étape');
        }
    });
}

function supprimerEtape(etapeId) {
    Swal.fire({
        title: 'Supprimer l\'étape',
        text: "Cette action est irréversible !",
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
                        location.reload(); // Recharger la page pour mettre à jour
                    }
                },
                error: function() {
                    toastr.error('Erreur lors de la suppression');
                }
            });
        }
    });
}

// Fonctions pour la gestion des activités
function ajouterActivite(voyageId) {
    $('#voyage_id_activite').val(voyageId);
    $('#modalAjouterActivite').modal('show');
}

function editActivite(activiteId) {
    // Charger les données de l'activité et ouvrir le modal d'édition
    $.ajax({
        url: '/admin/activites/' + activiteId + '/edit',
        type: 'GET',
        success: function(data) {
            // Remplir le formulaire avec les données
            $('#activite_id_edit').val(data.id);
            $('#nom_activite_edit').val(data.nom_activite);
            $('#description_activite_edit').val(data.description_activite);
            $('#type_activite_edit').val(data.type_activite);
            $('#lieu_activite_edit').val(data.lieu_activite);
            $('#duree_heures_edit').val(data.duree_heures);
            $('#prix_activite_edit').val(data.prix_activite);
            $('#jour_recommande_edit').val(data.jour_recommande);
            
            // Gérer les équipements requis
            $('.equipements-checkboxes-edit input[type="checkbox"]').prop('checked', false);
            if (data.equipements_requis) {
                let equipements = [];
                if (typeof data.equipements_requis === 'string') {
                    try {
                        equipements = JSON.parse(data.equipements_requis);
                    } catch (e) {
                        equipements = [];
                    }
                } else if (Array.isArray(data.equipements_requis)) {
                    equipements = data.equipements_requis;
                }
                
                equipements.forEach(function(equipement) {
                    $('.equipements-checkboxes-edit input[value="' + equipement + '"]').prop('checked', true);
                });
            }
            
            $('#modalEditActivite').modal('show');
        },
        error: function() {
            toastr.error('Erreur lors du chargement des données de l\'activité');
        }
    });
}

function supprimerActivite(activiteId) {
    Swal.fire({
        title: 'Supprimer l\'activité',
        text: "Cette action est irréversible !",
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
                        location.reload(); // Recharger la page pour mettre à jour
                    }
                },
                error: function() {
                    toastr.error('Erreur lors de la suppression');
                }
            });
        }
    });
}

// Fonction pour supprimer une image de galerie
function supprimerImageGalerie(galerieId) {
    Swal.fire({
        title: 'Supprimer l\'image',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/admin/galeries/' + galerieId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        location.reload(); // Recharger la page pour mettre à jour
                    }
                },
                error: function() {
                    toastr.error('Erreur lors de la suppression');
                }
            });
        }
    });
}

// Soumission du formulaire d'ajout d'étape
$(document).on('submit', '#formAjouterEtape', function(e) {
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
                location.reload(); // Recharger pour mettre à jour la liste
            }
        },
        error: function() {
            toastr.error('Erreur lors de l\'ajout de l\'étape');
        }
    });
});

# Soumission du formulaire d'ajout d'activité
$(document).on('submit', '#formAjouterActivite', function(e) {
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
                location.reload(); // Recharger pour mettre à jour la liste
            }
        },
        error: function() {
            toastr.error('Erreur lors de l\'ajout de l\'activité');
        }
    });
});

// NOUVEAU : Soumission du formulaire d'édition d'étape
$(document).on('submit', '#formEditEtape', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    let etapeId = $('#etape_id_edit').val();
    
    $.ajax({
        url: '/admin/etapes/' + etapeId,
        type: 'PUT',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message);
                $('#modalEditEtape').modal('hide');
                location.reload(); // Recharger pour mettre à jour la liste
            }
        },
        error: function() {
            toastr.error('Erreur lors de la modification de l\'étape');
        }
    });
});

// NOUVEAU : Soumission du formulaire d'édition d'activité
$(document).on('submit', '#formEditActivite', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    let activiteId = $('#activite_id_edit').val();
    
    $.ajax({
        url: '/admin/activites/' + activiteId,
        type: 'PUT',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message);
                $('#modalEditActivite').modal('hide');
                location.reload(); // Recharger pour mettre à jour la liste
            }
        },
        error: function() {
            toastr.error('Erreur lors de la modification de l\'activité');
        }
    });
});
</script>
@endpush

<style>
.form-check-group .form-check {
    margin-bottom: 0.5rem;
}

.form-check-group .form-check-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.is-invalid {
    border-color: #dc3545;
}

.text-primary {
    color: #0d6efd !important;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.card-title {
    margin-bottom: 0;
    color: #495057;
}

.transport-checkboxes,
.hebergement-checkboxes,
.service-checkboxes {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-check-label {
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-check-label i {
    color: #6c757d;
}

.form-check-input:checked + .form-check-label i {
    color: #0d6efd;
}

.preview-container {
    min-height: 50px;
}

.preview-item {
    position: relative;
}

.preview-img {
    transition: transform 0.2s ease-in-out;
}

.preview-img:hover {
    transform: scale(1.05);
}

.form-switch .form-check-input {
    width: 2.5rem;
    height: 1.25rem;
}

.form-switch .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.current-image img {
    transition: transform 0.2s ease-in-out;
}

.current-image img:hover {
    transform: scale(1.05);
}

.stat-item {
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
}

.stat-item h4 {
    margin-bottom: 0.25rem;
    font-weight: 700;
}

.etape-item, .activite-item {
    transition: all 0.2s ease-in-out;
}

.etape-item:hover, .activite-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.btn-group-sm .btn {
    padding: 0.125rem 0.25rem;
    font-size: 0.75rem;
}

.badge-sm {
    font-size: 0.65em;
}

/* Responsive */
@media (max-width: 768px) {
    .transport-checkboxes,
    .hebergement-checkboxes {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }
    
    .d-flex.gap-3 {
        flex-direction: column;
        gap: 0.5rem !important;
    }
    
    .btn {
        width: 100%;
    }
    
    .stat-item {
        text-align: center;
    }
}

/* Animation pour les sections */
.row.mb-4 {
    animation: fadeInUp 0.5s ease-in-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Style pour les titres de section */
h5.text-primary {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 0.5rem;
    margin-bottom: 1.5rem !important;
}

h5.text-primary i {
    margin-right: 0.5rem;
}

/* Amélioration des inputs */
.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Style pour les placeholders */
::placeholder {
    color: #6c757d;
    opacity: 0.7;
}

/* Style pour les small texts */
small.text-muted {
    font-size: 0.775em;
    line-height: 1.4;
}

/* Hover effects pour les boutons */
.btn {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Style pour les checkboxes et switches */
.form-check-input {
    cursor: pointer;
}

.form-switch .form-check-input {
    cursor: pointer;
}

/* Style pour le contenu du card */
.card-body {
    padding: 1.5rem;
}

/* Amélioration des labels */
.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

/* Galerie d'images */
.position-relative .btn {
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
}

.position-relative:hover .btn {
    opacity: 1;
}
</style>

@endsection