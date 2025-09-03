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
                            <input type="text" name="nom_activite" class="form-control" required
                                   placeholder="Ex: Balade en pirogue">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Type *</label>
                            <select name="type_activite" class="form-control" required>
                                <option value="">Sélectionner</option>
                                <option value="incluse">Incluse dans le prix</option>
                                <option value="optionnelle">Optionnelle (supplément)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Description *</label>
                            <textarea name="description_activite" class="form-control" rows="3" required
                                      placeholder="Description détaillée de l'activité..."></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label">Lieu de l'activité *</label>
                            <input type="text" name="lieu_activite" class="form-control" required
                                   placeholder="Ex: Delta du Saloum">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Durée (heures)</label>
                            <input type="number" name="duree_heures" class="form-control" min="0" step="0.5"
                                   placeholder="Ex: 2.5">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Prix (FCFA)</label>
                            <input type="number" name="prix_activite" class="form-control" min="0" value="0"
                                   placeholder="0 si incluse">
                            <small class="text-muted">Laissez 0 si l'activité est incluse</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jour recommandé</label>
                            <input type="number" name="jour_recommande" class="form-control" min="1"
                                   placeholder="Ex: 3">
                            <small class="text-muted">Jour du voyage recommandé pour cette activité</small>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Équipements recommandés</label>
                            <div class="equipements-checkboxes">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="chaussures_marche" id="eq_chaussures">
                                            <label class="form-check-label" for="eq_chaussures">
                                                Chaussures de marche
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="maillot_bain" id="eq_maillot">
                                            <label class="form-check-label" for="eq_maillot">
                                                Maillot de bain
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="creme_solaire" id="eq_creme">
                                            <label class="form-check-label" for="eq_creme">
                                                Crème solaire
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="appareil_photo" id="eq_appareil">
                                            <label class="form-check-label" for="eq_appareil">
                                                Appareil photo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="chapeau" id="eq_chapeau">
                                            <label class="form-check-label" for="eq_chapeau">
                                                Chapeau/Casquette
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="vetements_legers" id="eq_vetements">
                                            <label class="form-check-label" for="eq_vetements">
                                                Vêtements légers
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="bouteille_eau" id="eq_bouteille">
                                            <label class="form-check-label" for="eq_bouteille">
                                                Bouteille d'eau
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="jumelles" id="eq_jumelles">
                                            <label class="form-check-label" for="eq_jumelles">
                                                Jumelles
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

<!-- Modal pour éditer une activité -->
<div class="modal fade" id="modalEditActivite" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier l'Activité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditActivite">
                <div class="modal-body">
                    <input type="hidden" id="activite_id_edit" name="activite_id">
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label">Nom de l'activité *</label>
                            <input type="text" id="nom_activite_edit" name="nom_activite" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Type *</label>
                            <select id="type_activite_edit" name="type_activite" class="form-control" required>
                                <option value="">Sélectionner</option>
                                <option value="incluse">Incluse dans le prix</option>
                                <option value="optionnelle">Optionnelle (supplément)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Description *</label>
                            <textarea id="description_activite_edit" name="description_activite" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label">Lieu de l'activité *</label>
                            <input type="text" id="lieu_activite_edit" name="lieu_activite" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Durée (heures)</label>
                            <input type="number" id="duree_heures_edit" name="duree_heures" class="form-control" min="0" step="0.5">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Prix (FCFA)</label>
                            <input type="number" id="prix_activite_edit" name="prix_activite" class="form-control" min="0" value="0">
                            <small class="text-muted">Laissez 0 si l'activité est incluse</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jour recommandé</label>
                            <input type="number" id="jour_recommande_edit" name="jour_recommande" class="form-control" min="1">
                            <small class="text-muted">Jour du voyage recommandé pour cette activité</small>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Équipements recommandés</label>
                            <div class="equipements-checkboxes-edit">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="chaussures_marche" id="eq_chaussures_edit">
                                            <label class="form-check-label" for="eq_chaussures_edit">
                                                Chaussures de marche
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="maillot_bain" id="eq_maillot_edit">
                                            <label class="form-check-label" for="eq_maillot_edit">
                                                Maillot de bain
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="creme_solaire" id="eq_creme_edit">
                                            <label class="form-check-label" for="eq_creme_edit">
                                                Crème solaire
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="appareil_photo" id="eq_appareil_edit">
                                            <label class="form-check-label" for="eq_appareil_edit">
                                                Appareil photo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="chapeau" id="eq_chapeau_edit">
                                            <label class="form-check-label" for="eq_chapeau_edit">
                                                Chapeau/Casquette
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="vetements_legers" id="eq_vetements_edit">
                                            <label class="form-check-label" for="eq_vetements_edit">
                                                Vêtements légers
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="bouteille_eau" id="eq_bouteille_edit">
                                            <label class="form-check-label" for="eq_bouteille_edit">
                                                Bouteille d'eau
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements_requis[]" value="jumelles" id="eq_jumelles_edit">
                                            <label class="form-check-label" for="eq_jumelles_edit">
                                                Jumelles
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Mettre à jour
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>