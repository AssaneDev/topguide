{{-- resources/views/admin/templates/create.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    {{-- Header --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">➕ Nouveau Template de Consignes</h4>
                        <a href="{{ route('templates.index') }}" class="btn btn-light btn-sm">
                            <i class="bx bx-arrow-back"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulaire --}}
    <form action="{{ route('templates.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- Informations générales --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">📋 Informations Générales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nom du Template <span class="text-danger">*</span></label>
                                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                                       value="{{ old('nom') }}" required 
                                       placeholder="Ex: Template Lac Rose - Photographe">
                                @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" placeholder="Description détaillée de ce template...">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Type d'Équipe <span class="text-danger">*</span></label>
                                <select name="type_equipe" class="form-select @error('type_equipe') is-invalid @enderror" required>
                                    <option value="">Choisir le type</option>
                                    <option value="photographe" {{ old('type_equipe') === 'photographe' ? 'selected' : '' }}>
                                        📸 Photographe/Vidéaste
                                    </option>
                                    <option value="gestionnaire_posts" {{ old('type_equipe') === 'gestionnaire_posts' ? 'selected' : '' }}>
                                        ✍️ Gestionnaire Posts
                                    </option>
                                    <option value="both" {{ old('type_equipe') === 'both' ? 'selected' : '' }}>
                                        👥 Les deux équipes
                                    </option>
                                </select>
                                @error('type_equipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Catégorie <span class="text-danger">*</span></label>
                                <select name="categorie" class="form-select @error('categorie') is-invalid @enderror" required>
                                    <option value="">Choisir la catégorie</option>
                                    @foreach($categories as $categorie)
                                    <option value="{{ $categorie }}" {{ old('categorie') === $categorie ? 'selected' : '' }}>
                                        {{ ucfirst($categorie) }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('categorie')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mots-clés --}}
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">🔍 Mots-clés de Déclenchement</h5>
                        <small class="text-muted">Ces mots-clés permettront de sélectionner automatiquement ce template</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Mots-clés <span class="text-danger">*</span></label>
                            <div id="motsClesContainer">
                                <div class="input-group mb-2">
                                    <input type="text" name="mots_cles[]" class="form-control" 
                                           placeholder="Ex: lac rose, dunes, 4x4" required>
                                    <button type="button" class="btn btn-outline-danger" onclick="supprimerMotCle(this)">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="ajouterMotCle()">
                                <i class="bx bx-plus"></i> Ajouter un mot-clé
                            </button>
                            @error('mots_cles')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="bx bx-info-circle"></i>
                            <strong>Exemples de mots-clés :</strong><br>
                            • <strong>Lieux :</strong> lac rose, gorée, saint-louis, sine saloum<br>
                            • <strong>Activités :</strong> plongée, pirogue, dromadaire, safari<br>
                            • <strong>Types :</strong> coucher soleil, marché, pêche, village
                        </div>
                    </div>
                </div>

                {{-- Contenu du template --}}
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">📝 Contenu du Template</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Consignes Spécifiques <span class="text-danger">*</span></label>
                            <textarea name="consignes_template" class="form-control @error('consignes_template') is-invalid @enderror" 
                                      rows="8" required placeholder="📸 FOCUS JOUR : {LIEU}

🎬 STORIES :
- Matin : Ambiance réveil + paysage
- Action : {ACTIVITES} en cours  
- Soir : Bilan + teaser demain

🎥 VIDÉO COURTE :
- 30-45s action principale
- Réactions clients
- Musique locale

📱 TECHNIQUE :
- Vérifier batterie/stockage
- Mode HDR paysages
- Stabilisation vidéos">{{ old('consignes_template') }}</textarea>
                            @error('consignes_template')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Utilisez des variables : {LIEU}, {ACTIVITES}, {DATE}, {HEURE_MATIN}, {HEURE_ACTION}, {HEURE_SOIR}
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Objectifs du Contenu <span class="text-danger">*</span></label>
                            <input type="text" name="objectifs_template" class="form-control @error('objectifs_template') is-invalid @enderror" 
                                   value="{{ old('objectifs_template') }}" required 
                                   placeholder="Ex: Capturer l'authenticité du {LIEU} + émotions clients">
                            @error('objectifs_template')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Paramètres --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">⚙️ Paramètres</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Priorité par Défaut</label>
                            <select name="priorite_defaut" class="form-select">
                                <option value="normale" {{ old('priorite_defaut') === 'normale' ? 'selected' : '' }}>
                                    Normale
                                </option>
                                <option value="importante" {{ old('priorite_defaut') === 'importante' ? 'selected' : '' }}>
                                    Importante
                                </option>
                                <option value="critique" {{ old('priorite_defaut') === 'critique' ? 'selected' : '' }}>
                                    Critique
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ordre d'Affichage</label>
                            <input type="number" name="ordre" class="form-control" 
                                   value="{{ old('ordre', 0) }}" min="0" 
                                   placeholder="0 = premier">
                            <small class="form-text text-muted">Plus le nombre est bas, plus le template sera prioritaire</small>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="actif" value="1" 
                                   {{ old('actif', true) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                Template actif
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Moments clés --}}
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">⏰ Moments Clés</h5>
                        <small class="text-muted">Horaires importants pour ce type d'activité</small>
                    </div>
                    <div class="card-body">
                        <div id="momentsContainer">
                            <div class="row mb-2">
                                <div class="col-6">
                                    <input type="text" name="moments_keys[]" class="form-control form-control-sm" 
                                           placeholder="Ex: matin" value="matin">
                                </div>
                                <div class="col-5">
                                    <input type="time" name="moments_values[]" class="form-control form-control-sm" 
                                           value="08:00">
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="supprimerMoment(this)">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="ajouterMoment()">
                            <i class="bx bx-plus"></i> Ajouter
                        </button>
                    </div>
                </div>

                {{-- Hashtags --}}
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">🏷️ Hashtags par Défaut</h5>
                    </div>
                    <div class="card-body">
                        <div id="hashtagsContainer">
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">#</span>
                                <input type="text" name="hashtags_template[]" class="form-control" 
                                       placeholder="VacancesSénégal" value="VacancesSénégal">
                                <button type="button" class="btn btn-outline-danger" onclick="supprimerHashtag(this)">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="ajouterHashtag()">
                            <i class="bx bx-plus"></i> Ajouter
                        </button>
                    </div>
                </div>

                {{-- Prévisualisation --}}
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">👀 Prévisualisation</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-info btn-sm w-100" onclick="previsualiserTemplate()">
                            <i class="bx bx-show"></i> Voir le Rendu
                        </button>
                        <div id="previewContainer" class="mt-3" style="display: none;">
                            <div id="previewContent" class="bg-light p-3 rounded">
                                <!-- Contenu de prévisualisation -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bx bx-save"></i> Créer le Template
                            </button>
                            <button type="button" class="btn btn-info" onclick="previsualiserTemplate()">
                                <i class="bx bx-show"></i> Prévisualiser
                            </button>
                            <a href="{{ route('templates.index') }}" class="btn btn-secondary">
                                <i class="bx bx-x"></i> Annuler
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Ajouter/supprimer mots-clés
function ajouterMotCle() {
    const container = document.getElementById('motsClesContainer');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" name="mots_cles[]" class="form-control" placeholder="Nouveau mot-clé" required>
        <button type="button" class="btn btn-outline-danger" onclick="supprimerMotCle(this)">
            <i class="bx bx-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

function supprimerMotCle(button) {
    const container = document.getElementById('motsClesContainer');
    if (container.children.length > 1) {
        button.closest('.input-group').remove();
    }
}

// Ajouter/supprimer moments
function ajouterMoment() {
    const container = document.getElementById('momentsContainer');
    const div = document.createElement('div');
    div.className = 'row mb-2';
    div.innerHTML = `
        <div class="col-6">
            <input type="text" name="moments_keys[]" class="form-control form-control-sm" placeholder="Ex: action">
        </div>
        <div class="col-5">
            <input type="time" name="moments_values[]" class="form-control form-control-sm" value="14:00">
        </div>
        <div class="col-1">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="supprimerMoment(this)">
                <i class="bx bx-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(div);
}

function supprimerMoment(button) {
    button.closest('.row').remove();
}

// Ajouter/supprimer hashtags
function ajouterHashtag() {
    const container = document.getElementById('hashtagsContainer');
    const div = document.createElement('div');
    div.className = 'input-group input-group-sm mb-2';
    div.innerHTML = `
        <span class="input-group-text">#</span>
        <input type="text" name="hashtags_template[]" class="form-control" placeholder="NouveauHashtag">
        <button type="button" class="btn btn-outline-danger" onclick="supprimerHashtag(this)">
            <i class="bx bx-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

function supprimerHashtag(button) {
    button.closest('.input-group').remove();
}

// Prévisualisation
function previsualiserTemplate() {
    const formData = new FormData();
    
    // Récupérer les données du formulaire
    const consignes = document.querySelector('[name="consignes_template"]').value;
    const objectifs = document.querySelector('[name="objectifs_template"]').value;
    
    // Moments clés
    const momentsKeys = Array.from(document.querySelectorAll('[name="moments_keys[]"]')).map(el => el.value);
    const momentsValues = Array.from(document.querySelectorAll('[name="moments_values[]"]')).map(el => el.value);
    const moments = {};
    momentsKeys.forEach((key, index) => {
        if (key && momentsValues[index]) {
            moments[key] = momentsValues[index];
        }
    });
    
    // Hashtags
    const hashtags = Array.from(document.querySelectorAll('[name="hashtags_template[]"]'))
                          .map(el => el.value)
                          .filter(val => val)
                          .map(val => val.startsWith('#') ? val : '#' + val);
    
    // Variables de test
    const lieu = 'Lac Rose';
    const activites = 'Balade 4x4 + Photos coucher soleil';
    
    // Remplacer variables
    let consignesPreview = consignes
        .replace(/{LIEU}/g, lieu)
        .replace(/{ACTIVITES}/g, activites)
        .replace(/{DATE}/g, new Date().toLocaleDateString('fr-FR'))
        .replace(/{HEURE_MATIN}/g, '08:00')
        .replace(/{HEURE_ACTION}/g, '14:00')
        .replace(/{HEURE_SOIR}/g, '18:00');
    
    let objectifsPreview = objectifs
        .replace(/{LIEU}/g, lieu)
        .replace(/{ACTIVITES}/g, activites);
    
    // Afficher la prévisualisation
    const previewContent = `
        <h6>Consignes générées :</h6>
        <div class="bg-white p-3 rounded mb-3 border">
            <pre class="mb-0" style="white-space: pre-wrap; font-family: inherit; font-size: 0.9em;">${consignesPreview}</pre>
        </div>
        
        <h6>Hashtags :</h6>
        <div class="mb-3">
            ${hashtags.map(tag => `<span class="badge bg-primary me-1">${tag}</span>`).join('')}
        </div>
        
        <h6>Moments clés :</h6>
        <div class="mb-3">
            ${Object.entries(moments).map(([key, value]) => `<span class="badge bg-info me-1">${key}: ${value}</span>`).join('')}
        </div>
        
        <h6>Objectifs :</h6>
        <p class="mb-0">${objectifsPreview}</p>
    `;
    
    document.getElementById('previewContent').innerHTML = previewContent;
    document.getElementById('previewContainer').style.display = 'block';
    
    // Scroll vers la prévisualisation
    document.getElementById('previewContainer').scrollIntoView({ behavior: 'smooth' });
}

// Validation en temps réel
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter validation pour les hashtags
    document.addEventListener('input', function(e) {
        if (e.target.name === 'hashtags_template[]') {
            let value = e.target.value;
            if (value && !value.startsWith('#')) {
                e.target.value = '#' + value;
            }
        }
    });
});
</script>

<style>
.form-control, .form-select {
    border-radius: 0.375rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

pre {
    margin: 0;
    white-space: pre-wrap;
    word-wrap: break-word;
}

.input-group-sm .form-control,
.input-group-sm .input-group-text {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>

@endsection