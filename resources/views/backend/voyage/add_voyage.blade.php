@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ajouter Nouveau Circuit</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.voyages.index') }}">Voyages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nouveau Voyage</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="bx bx-plus-circle"></i> Créer un Nouveau Circuit
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="voyageForm" method="post" action="{{ route('admin.voyages.store') }}" enctype="multipart/form-data">
                                @csrf
                                
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
                                        <label class="form-label">Nom du Circuit *</label>
                                        <input type="text" name="nom_voyage" class="form-control" required 
                                               placeholder="Ex: Circuit Découverte du Sénégal Authentique">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Type de Circuit *</label>
                                        <select name="type_voyage" class="form-control" required>
                                            <option value="">Sélectionner un type</option>
                                            <option value="culturel">Circuit Culturel</option>
                                            <option value="aventure">Circuit Aventure</option>
                                            <option value="detente">Circuit Détente</option>
                                            <option value="famille">Circuit Famille</option>
                                            <option value="eco-tourisme">Éco-tourisme</option>
                                            <option value="decouverte">Circuit Découverte</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-8">
                                        <label class="form-label">Région/Zone Géographique *</label>
                                        <input type="text" name="region" class="form-control" required 
                                               placeholder="Ex: Dakar, Casamance, Saint-Louis...">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-label">Durée (jours) *</label>
                                        <input type="number" name="duree_jours" class="form-control" min="1" max="365" required 
                                               placeholder="Ex: 7">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-label">Nuits</label>
                                        <input type="number" name="duree_nuits" class="form-control" min="0" max="364" 
                                               placeholder="Ex: 6">
                                        <small class="text-muted">Généralement jours-1</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">Description Courte *</label>
                                        <textarea name="description_courte" class="form-control" rows="3" required 
                                                  placeholder="Résumé attractif du voyage en quelques lignes..."></textarea>
                                        <small class="text-muted">Cette description apparaîtra dans les listes de voyages</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">Description Détaillée *</label>
                                        <textarea name="description_longue" id="myeditorinstance" class="form-control" rows="8" required 
                                                  placeholder="Description complète du voyage, itinéraire général, points forts..."></textarea>
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
                                               placeholder="Ex: 250000">
                                        <small class="text-muted">Prix par personne</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Prix avec Guide (FCFA)</label>
                                        <input type="number" name="prix_avec_guide" class="form-control" min="0" 
                                               placeholder="Ex: 300000">
                                        <small class="text-muted">Optionnel</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Difficulté</label>
                                        <select name="difficulte" class="form-control">
                                            <option value="facile" selected>Facile</option>
                                            <option value="modere">Modéré</option>
                                            <option value="difficile">Difficile</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label">Participants Min</label>
                                        <input type="number" name="participants_min" class="form-control" value="1" min="1" 
                                               placeholder="Ex: 2">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Participants Max *</label>
                                        <input type="number" name="participants_max" class="form-control" min="1" required 
                                               placeholder="Ex: 15">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Statut</label>
                                        <select name="statut" class="form-control">
                                            <option value="brouillon" selected>Brouillon</option>
                                            <option value="publie">Publié</option>
                                            <option value="archive">Archivé</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Informations Circuit -->
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="bx bx-map-pin"></i> Itinéraire et Confort
                                        </h5>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label">Point de Départ</label>
                                        <input type="text" name="point_depart" class="form-control" 
                                               placeholder="Ex: Aéroport Dakar">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Point d'Arrivée</label>
                                        <input type="text" name="point_arrivee" class="form-control" 
                                               placeholder="Ex: Hôtel Dakar">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Niveau de Confort</label>
                                        <select name="niveau_confort" class="form-control">
                                            <option value="economique">Économique</option>
                                            <option value="standard" selected>Standard</option>
                                            <option value="superieur">Supérieur</option>
                                            <option value="luxe">Luxe</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label">Prix par Personne (FCFA)</label>
                                        <input type="number" name="prix_par_personne" class="form-control" min="0" 
                                               placeholder="Prix final par personne">
                                        <small class="text-muted">Peut différer du prix de base</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Supplément Chambre Individuelle</label>
                                        <input type="number" name="supplement_chambre_individuelle" class="form-control" min="0" 
                                               placeholder="Ex: 50000">
                                        <small class="text-muted">FCFA par nuit</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Délai Réservation (jours)</label>
                                        <input type="number" name="delai_reservation_min" class="form-control" value="7" min="0" 
                                               placeholder="Ex: 7">
                                        <small class="text-muted">Minimum avant départ</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">Saisons Disponibles</label>
                                        <div class="saisons-checkboxes d-flex flex-wrap gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="1" id="mois_1">
                                                <label class="form-check-label" for="mois_1">Jan</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="2" id="mois_2">
                                                <label class="form-check-label" for="mois_2">Fév</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="3" id="mois_3">
                                                <label class="form-check-label" for="mois_3">Mar</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="4" id="mois_4">
                                                <label class="form-check-label" for="mois_4">Avr</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="5" id="mois_5">
                                                <label class="form-check-label" for="mois_5">Mai</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="6" id="mois_6">
                                                <label class="form-check-label" for="mois_6">Juin</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="7" id="mois_7">
                                                <label class="form-check-label" for="mois_7">Juil</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="8" id="mois_8">
                                                <label class="form-check-label" for="mois_8">Août</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="9" id="mois_9">
                                                <label class="form-check-label" for="mois_9">Sep</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="10" id="mois_10">
                                                <label class="form-check-label" for="mois_10">Oct</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="11" id="mois_11">
                                                <label class="form-check-label" for="mois_11">Nov</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="saisons_disponibles[]" value="12" id="mois_12">
                                                <label class="form-check-label" for="mois_12">Déc</label>
                                            </div>
                                        </div>
                                        <small class="text-muted">Laissez vide pour toute l'année</small>
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
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="bus" id="transport_bus">
                                                <label class="form-check-label" for="transport_bus">
                                                    <i class="bx bx-bus"></i> Bus/Car
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="avion" id="transport_avion">
                                                <label class="form-check-label" for="transport_avion">
                                                    <i class="bx bx-plane"></i> Avion
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="bateau" id="transport_bateau">
                                                <label class="form-check-label" for="transport_bateau">
                                                    <i class="bx bx-water"></i> Bateau
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="voiture" id="transport_voiture">
                                                <label class="form-check-label" for="transport_voiture">
                                                    <i class="bx bx-car"></i> Voiture
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="transports_inclus[]" value="taxi" id="transport_taxi">
                                                <label class="form-check-label" for="transport_taxi">
                                                    <i class="bx bx-taxi"></i> Taxi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Hébergements Inclus</label>
                                        <div class="hebergement-checkboxes">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="hotel" id="hebergement_hotel">
                                                <label class="form-check-label" for="hebergement_hotel">
                                                    <i class="bx bx-building"></i> Hôtel
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="camping" id="hebergement_camping">
                                                <label class="form-check-label" for="hebergement_camping">
                                                    <i class="bx bx-home"></i> Camping
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="auberge" id="hebergement_auberge">
                                                <label class="form-check-label" for="hebergement_auberge">
                                                    <i class="bx bx-bed"></i> Auberge
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="lodge" id="hebergement_lodge">
                                                <label class="form-check-label" for="hebergement_lodge">
                                                    <i class="bx bx-store"></i> Lodge
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hebergements_inclus[]" value="maison_hote" id="hebergement_maison_hote">
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
                                                <input class="form-check-input" type="checkbox" name="repas_inclus" id="repas_inclus">
                                                <label class="form-check-label" for="repas_inclus">
                                                    <i class="bx bx-restaurant"></i> Repas inclus
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="service-checkboxes">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="guide_inclus" id="guide_inclus">
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
                                        <label class="form-label">Image de Couverture *</label>
                                        <input type="file" name="image_couverture" class="form-control" accept="image/*" required>
                                        <small class="text-muted">Dimensions recommandées: 370x150px - Format: JPG, PNG</small>
                                        <div class="preview-container mt-2" id="preview_couverture"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Image Principale *</label>
                                        <input type="file" name="image_principale" class="form-control" accept="image/*" required>
                                        <small class="text-muted">Dimensions recommandées: 1362x900px - Format: JPG, PNG</small>
                                        <div class="preview-container mt-2" id="preview_principale"></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">Galerie d'Images</label>
                                        <input type="file" name="galerie_images[]" class="form-control" multiple accept="image/*">
                                        <small class="text-muted">Vous pouvez sélectionner plusieurs images pour la galerie</small>
                                        <div class="preview-container mt-2" id="preview_galerie"></div>
                                    </div>
                                </div>

                                <!-- Équipements et Options Circuit -->
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="bx bx-cog"></i> Équipements et Options Circuit
                                        </h5>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Équipements Obligatoires</label>
                                        <div class="equipements-checkboxes">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="equipements_obligatoires[]" value="chaussures_marche" id="equip_chaussures">
                                                <label class="form-check-label" for="equip_chaussures">
                                                    <i class="bx bx-walk"></i> Chaussures de marche
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="equipements_obligatoires[]" value="maillot_bain" id="equip_maillot">
                                                <label class="form-check-label" for="equip_maillot">
                                                    <i class="bx bx-swim"></i> Maillot de bain
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="equipements_obligatoires[]" value="chapeau" id="equip_chapeau">
                                                <label class="form-check-label" for="equip_chapeau">
                                                    <i class="bx bx-hat"></i> Chapeau/Casquette
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="equipements_obligatoires[]" value="creme_solaire" id="equip_creme">
                                                <label class="form-check-label" for="equip_creme">
                                                    <i class="bx bx-shield"></i> Crème solaire
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="equipements_obligatoires[]" value="appareil_photo" id="equip_photo">
                                                <label class="form-check-label" for="equip_photo">
                                                    <i class="bx bx-camera"></i> Appareil photo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Options Circuit</label>
                                        <div class="options-checkboxes">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="sur_mesure" id="sur_mesure">
                                                <label class="form-check-label" for="sur_mesure">
                                                    <i class="bx bx-customize"></i> Circuit sur mesure possible
                                                </label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="recommande" id="recommande">
                                                <label class="form-check-label" for="recommande">
                                                    <i class="bx bx-star"></i> Circuit recommandé
                                                </label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="nouveau" id="nouveau" checked>
                                                <label class="form-check-label" for="nouveau">
                                                    <i class="bx bx-badge"></i> Nouveau circuit
                                                </label>
                                            </div>
                                        </div>
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
                                                  placeholder="Ex: Chaussures de marche, crème solaire, appareil photo, vêtements légers..."></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Conditions Particulières</label>
                                        <textarea name="conditions_particulieres" class="form-control" rows="4" 
                                                  placeholder="Ex: Bonne condition physique requise, accessible aux enfants, vaccination recommandée..."></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Informations Générales</label>
                                        <textarea name="informations_generales" class="form-control" rows="4" 
                                                  placeholder="Informations complémentaires sur le voyage, conseils, recommandations..."></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Offre Guide</label>
                                        <textarea name="offre_guide" class="form-control" rows="4" 
                                                  placeholder="Détails de l'offre avec guide, services inclus, plus-value..."></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label">Conseils Santé</label>
                                        <textarea name="conseils_sante" class="form-control" rows="3" 
                                                  placeholder="Vaccinations, médicaments, précautions santé..."></textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Informations Climat</label>
                                        <textarea name="infos_climat" class="form-control" rows="3" 
                                                  placeholder="Température, saison des pluies, vêtements..."></textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Culture Locale</label>
                                        <textarea name="infos_culture_locale" class="form-control" rows="3" 
                                                  placeholder="Traditions, coutumes, conseils comportement..."></textarea>
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <div class="d-flex gap-3 justify-content-end">
                                            <button type="button" class="btn btn-secondary px-4" onclick="window.history.back()">
                                                <i class="bx bx-arrow-back"></i> Retour
                                            </button>
                                            <button type="button" class="btn btn-outline-primary px-4" onclick="saveAsDraft()">
                                                <i class="bx bx-save"></i> Enregistrer comme Brouillon
                                            </button>
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="bx bx-check"></i> Enregistrer et Publier
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
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
    $('#voyageForm').on('submit', function(e) {
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
        
        // Mettre le statut à publié pour ce bouton
        $('input[name="statut"]').remove();
        $(this).append('<input type="hidden" name="statut" value="publie">');
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

// Fonction pour sauvegarder comme brouillon
function saveAsDraft() {
    // Mettre le statut à brouillon
    $('input[name="statut"]').remove();
    $('#voyageForm').append('<input type="hidden" name="statut" value="brouillon">');
    
    // Soumettre le formulaire
    $('#voyageForm').submit();
}

// Auto-save des données du formulaire (optionnel)
function autoSave() {
    const formData = new FormData($('#voyageForm')[0]);
    localStorage.setItem('voyage_draft', JSON.stringify(Object.fromEntries(formData)));
}

// Charger les données sauvegardées (optionnel)
function loadDraft() {
    const draft = localStorage.getItem('voyage_draft');
    if (draft) {
        const data = JSON.parse(draft);
        Object.keys(data).forEach(key => {
            const input = $(`[name="${key}"]`);
            if (input.attr('type') === 'checkbox') {
                input.prop('checked', data[key] === 'on');
            } else if (!input.attr('type') || input.attr('type') === 'text' || input.is('textarea') || input.is('select')) {
                input.val(data[key]);
            }
        });
    }
}

// Auto-save toutes les 30 secondes
setInterval(autoSave, 30000);
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
    padding: 2rem;
}

/* Amélioration des labels */
.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

/* Style pour les required fields */
.form-label::after {
    content: "";
}

label[for] .form-label:has(+ input[required])::after,
.form-label:has(+ input[required])::after,
.form-label:has(+ select[required])::after,
.form-label:has(+ textarea[required])::after {
    content: " *";
    color: #dc3545;
}

/* Loading state pour le formulaire */
.form-loading {
    pointer-events: none;
    opacity: 0.6;
}

.form-loading .btn {
    cursor: not-allowed;
}

/* Success state */
.form-success {
    border-left: 4px solid #28a745;
    background-color: #f8fff9;
}
</style>

@endsection