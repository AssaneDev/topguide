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
                            <input type="text" name="titre_etape" class="form-control" required
                                   placeholder="Ex: Visite de Gorée">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Description *</label>
                            <textarea name="description_etape" class="form-control" rows="4" required
                                      placeholder="Description détaillée des activités de cette étape..."></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Lieu de départ</label>
                            <input type="text" name="lieu_depart" class="form-control"
                                   placeholder="Ex: Hôtel, Dakar">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lieu d'arrivée</label>
                            <input type="text" name="lieu_arrivee" class="form-control"
                                   placeholder="Ex: Île de Gorée">
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
                            <input type="text" name="hebergement_etape" class="form-control"
                                   placeholder="Ex: Hôtel Teranga, Auberge de Gorée">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Notes spéciales</label>
                            <textarea name="notes_speciales" class="form-control" rows="2"
                                      placeholder="Recommandations, équipements spéciaux, conditions météo..."></textarea>
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

<!-- Modal pour éditer une étape -->
<div class="modal fade" id="modalEditEtape" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier l'Étape</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditEtape">
                <div class="modal-body">
                    <input type="hidden" id="etape_id_edit" name="etape_id">
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Titre de l'étape *</label>
                            <input type="text" id="titre_etape_edit" name="titre_etape" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Description *</label>
                            <textarea id="description_etape_edit" name="description_etape" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Lieu de départ</label>
                            <input type="text" id="lieu_depart_edit" name="lieu_depart" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lieu d'arrivée</label>
                            <input type="text" id="lieu_arrivee_edit" name="lieu_arrivee" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Heure de début</label>
                            <input type="time" id="heure_debut_edit" name="heure_debut" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Heure de fin</label>
                            <input type="time" id="heure_fin_edit" name="heure_fin" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Hébergement</label>
                            <input type="text" id="hebergement_etape_edit" name="hebergement_etape" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Notes spéciales</label>
                            <textarea id="notes_speciales_edit" name="notes_speciales" class="form-control" rows="2"></textarea>
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