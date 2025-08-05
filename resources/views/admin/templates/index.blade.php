{{-- resources/views/admin/templates/index.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    {{-- Header --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">📝 Templates de Consignes</h4>
                        <div class="d-flex gap-2">
                            <button onclick="toggleModal('testMotsCles')" class="btn btn-light btn-sm">
                                <i class="bx bx-test-tube"></i> Tester Mots-clés
                            </button>
                            <a href="{{ route('templates.create') }}" class="btn btn-light btn-sm">
                                <i class="bx bx-plus"></i> Nouveau Template
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bx bx-cog"></i> Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('templates.export') }}">
                                        <i class="bx bx-download"></i> Exporter Templates
                                    </a></li>
                                    <li><a class="dropdown-item" href="#" onclick="toggleModal('importTemplates')">
                                        <i class="bx bx-upload"></i> Importer Templates
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#" onclick="creerTemplatesParDefaut()">
                                        <i class="bx bx-magic-wand"></i> Créer Templates par Défaut
                                    </a></li>
                                </ul>
                            </div>
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
                            <h6>Total Templates</h6>
                            <h3>{{ $stats['total_templates'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-file-blank font-size-24"></i>
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
                            <h6>Templates Actifs</h6>
                            <h3>{{ $stats['templates_actifs'] }}</h3>
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
                            <h3>{{ $stats['templates_photographe'] }}</h3>
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
                            <h3>{{ $stats['templates_gestionnaire'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-edit font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtres --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <select id="filtreTypeEquipe" class="form-select" onchange="filtrerTemplates()">
                                <option value="">Tous les types</option>
                                <option value="photographe">📸 Photographe</option>
                                <option value="gestionnaire_posts">✍️ Gestionnaire Posts</option>
                                <option value="both">👥 Les deux</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="filtreCategorie" class="form-select" onchange="filtrerTemplates()">
                                <option value="">Toutes catégories</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie }}">{{ ucfirst($categorie) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="filtreStatut" class="form-select" onchange="filtrerTemplates()">
                                <option value="">Tous statuts</option>
                                <option value="1">Actifs</option>
                                <option value="0">Inactifs</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="rechercheTemplate" class="form-control" 
                                   placeholder="Rechercher..." onkeyup="filtrerTemplates()">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Liste des templates --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Liste des Templates</h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="modeReorganisation">
                            <label class="form-check-label" for="modeReorganisation">
                                Mode Réorganisation
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="listeTemplates" class="row g-3">
                        @forelse($templates as $template)
                        <div class="col-md-6 col-lg-4 template-item" 
                             data-type="{{ $template->type_equipe }}"
                             data-categorie="{{ $template->categorie }}"
                             data-actif="{{ $template->actif ? '1' : '0' }}"
                             data-nom="{{ strtolower($template->nom) }}">
                            
                            <div class="card h-100 {{ !$template->actif ? 'opacity-50' : '' }}">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{ $template->icone }}</span>
                                        <h6 class="mb-0">{{ $template->nom }}</h6>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <span class="badge bg-{{ $template->couleur }}">{{ $template->categorie }}</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" 
                                                   {{ $template->actif ? 'checked' : '' }}
                                                   onchange="toggleActif({{ $template->id }})">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="mb-2">
                                        <small class="text-muted">Type:</small>
                                        <span class="badge bg-{{ $template->type_equipe === 'photographe' ? 'primary' : ($template->type_equipe === 'gestionnaire_posts' ? 'success' : 'info') }}">
                                            {{ $template->type_equipe === 'photographe' ? '📸 Photographe' : ($template->type_equipe === 'gestionnaire_posts' ? '✍️ Gestionnaire' : '👥 Les deux') }}
                                        </span>
                                    </div>
                                    
                                    @if($template->description)
                                    <p class="text-muted small mb-2">{{ Str::limit($template->description, 100) }}</p>
                                    @endif
                                    
                                    <div class="mb-2">
                                        <small class="text-muted">Mots-clés:</small>
                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                            @foreach(array_slice($template->mots_cles, 0, 3) as $motCle)
                                            <span class="badge bg-light text-dark">{{ $motCle }}</span>
                                            @endforeach
                                            @if(count($template->mots_cles) > 3)
                                            <span class="badge bg-light text-dark">+{{ count($template->mots_cles) - 3 }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <small class="text-muted">Priorité:</small>
                                        <span class="badge bg-{{ $template->priorite_defaut === 'critique' ? 'danger' : ($template->priorite_defaut === 'importante' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($template->priorite_defaut) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button onclick="previsualiserTemplate({{ $template->id }})" 
                                                class="btn btn-sm btn-outline-info">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <a href="{{ route('templates.edit', $template) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button onclick="dupliquerTemplate({{ $template->id }})" 
                                                class="btn btn-sm btn-outline-secondary">
                                            <i class="bx bx-copy"></i>
                                        </button>
                                        <button onclick="supprimerTemplate({{ $template->id }})" 
                                                class="btn btn-sm btn-outline-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bx bx-file-blank font-size-48 text-muted"></i>
                                <h5 class="mt-3">Aucun template créé</h5>
                                <p class="text-muted">Commencez par créer votre premier template de consignes</p>
                                <a href="{{ route('templates.create') }}" class="btn btn-primary">
                                    <i class="bx bx-plus"></i> Créer un Template
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Test Mots-clés --}}
<div class="modal fade" id="testMotsCles" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">🧪 Tester Correspondance Mots-clés</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Type d'équipe</label>
                    <select id="testTypeEquipe" class="form-select">
                        <option value="photographe">📸 Photographe</option>
                        <option value="gestionnaire_posts">✍️ Gestionnaire Posts</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Texte à tester (lieu + activités)</label>
                    <textarea id="testTexte" class="form-control" rows="3" 
                              placeholder="Ex: Lac Rose balade 4x4 dunes coucher soleil"></textarea>
                </div>
                <button onclick="testerCorrespondance()" class="btn btn-primary">
                    <i class="bx bx-search"></i> Tester
                </button>
                
                <div id="resultatsTest" class="mt-4" style="display: none;">
                    <h6>Résultats:</h6>
                    <div id="contenuResultats"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Import --}}
<div class="modal fade" id="importTemplates" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">📤 Importer Templates</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('templates.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Fichier JSON</label>
                        <input type="file" name="fichier" class="form-control" accept=".json" required>
                    </div>
                    <div class="alert alert-info">
                        <i class="bx bx-info-circle"></i>
                        Seuls les templates avec des noms uniques seront importés.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-upload"></i> Importer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Prévisualisation --}}
<div class="modal fade" id="modalPreview" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">👀 Prévisualisation Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Lieu</label>
                        <input type="text" id="previewLieu" class="form-control" value="Lac Rose">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Activités</label>
                        <input type="text" id="previewActivites" class="form-control" value="Balade 4x4 + Photos coucher soleil">
                    </div>
                </div>
                <button onclick="actualiserPreview()" class="btn btn-primary mb-3">
                    <i class="bx bx-refresh"></i> Actualiser Préview
                </button>
                
                <div id="contenuPreview">
                    <!-- Contenu généré via AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let templatePreviewId = null;

// Toggle modal
function toggleModal(modalId) {
    const modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();
}

// Filtrer templates
function filtrerTemplates() {
    const typeEquipe = document.getElementById('filtreTypeEquipe').value;
    const categorie = document.getElementById('filtreCategorie').value;
    const statut = document.getElementById('filtreStatut').value;
    const recherche = document.getElementById('rechercheTemplate').value.toLowerCase();
    
    const items = document.querySelectorAll('.template-item');
    
    items.forEach(item => {
        let visible = true;
        
        if (typeEquipe && item.dataset.type !== typeEquipe && item.dataset.type !== 'both') {
            visible = false;
        }
        
        if (categorie && item.dataset.categorie !== categorie) {
            visible = false;
        }
        
        if (statut && item.dataset.actif !== statut) {
            visible = false;
        }
        
        if (recherche && !item.dataset.nom.includes(recherche)) {
            visible = false;
        }
        
        item.style.display = visible ? 'block' : 'none';
    });
}

// Toggle actif template
function toggleActif(templateId) {
    fetch(`/admin/coordination/templates/${templateId}/toggle-actif`, {
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

// Prévisualiser template
function previsualiserTemplate(templateId) {
    templatePreviewId = templateId;
    actualiserPreview();
    const modal = new bootstrap.Modal(document.getElementById('modalPreview'));
    modal.show();
}

function actualiserPreview() {
    if (!templatePreviewId) return;
    
    const lieu = document.getElementById('previewLieu').value;
    const activites = document.getElementById('previewActivites').value;
    
    fetch(`/admin/coordination/templates/${templatePreviewId}/preview?lieu=${lieu}&activites=${activites}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let html = `
                    <div class="card">
                        <div class="card-header">
                            <h6>Template: ${data.template}</h6>
                        </div>
                        <div class="card-body">
                            <h6>Consignes générées:</h6>
                            <div class="bg-light p-3 rounded mb-3">
                                <pre class="mb-0">${data.consignes.consignes_specifiques}</pre>
                            </div>
                            
                            <h6>Hashtags:</h6>
                            <div class="mb-3">
                                ${data.consignes.hashtags_jour.map(tag => `<span class="badge bg-primary me-1">${tag}</span>`).join('')}
                            </div>
                            
                            <h6>Objectifs:</h6>
                            <p class="mb-3">${data.consignes.objectifs_contenu}</p>
                            
                            <h6>Priorité:</h6>
                            <span class="badge bg-${data.consignes.priorite === 'critique' ? 'danger' : (data.consignes.priorite === 'importante' ? 'warning' : 'secondary')}">${data.consignes.priorite}</span>
                        </div>
                    </div>
                `;
                document.getElementById('contenuPreview').innerHTML = html;
            }
        });
}

// Dupliquer template
function dupliquerTemplate(templateId) {
    if (confirm('Dupliquer ce template ?')) {
        fetch(`/admin/coordination/templates/${templateId}/duplicate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(() => {
            toastr.success('Template dupliqué !');
            setTimeout(() => location.reload(), 1000);
        });
    }
}

// Supprimer template
function supprimerTemplate(templateId) {
    if (confirm('Supprimer définitivement ce template ?')) {
        fetch(`/admin/coordination/templates/${templateId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(() => {
            toastr.success('Template supprimé');
            setTimeout(() => location.reload(), 1000);
        });
    }
}

// Tester correspondance mots-clés
function testerCorrespondance() {
    const typeEquipe = document.getElementById('testTypeEquipe').value;
    const texte = document.getElementById('testTexte').value;
    
    fetch('/admin/coordination/templates/tester-mots-cles', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            type_equipe: typeEquipe,
            texte: texte
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let html = '';
            
            if (data.correspondances.length > 0) {
                html += '<div class="alert alert-success">Templates correspondants:</div>';
                data.correspondances.forEach(template => {
                    html += `
                        <div class="card mb-2">
                            <div class="card-body p-2">
                                <h6>${template.nom}</h6>
                                <small class="text-muted">Catégorie: ${template.categorie}</small><br>
                                <small>Mots-clés: ${template.mots_cles.join(', ')}</small>
                            </div>
                        </div>
                    `;
                });
                
                if (data.meilleur_template) {
                    html += `<div class="alert alert-info">Meilleur template: <strong>${data.meilleur_template.nom}</strong></div>`;
                }
            } else {
                html = '<div class="alert alert-warning">Aucun template correspondant trouvé</div>';
            }
            
            document.getElementById('contenuResultats').innerHTML = html;
            document.getElementById('resultatsTest').style.display = 'block';
        }
    });
}

// Créer templates par défaut
function creerTemplatesParDefaut() {
    if (confirm('Créer les templates par défaut ? (Photographe & Gestionnaire)')) {
        // Cette fonction sera implémentée côté serveur
        toastr.info('Fonctionnalité à implémenter...');
    }
}
</script>

<style>
.bg-gradient-primary { background: linear-gradient(45deg, #405de6, #5983fe); }
.bg-gradient-success { background: linear-gradient(45deg, #00d084, #7cf7a0); }
.bg-gradient-warning { background: linear-gradient(45deg, #fd9644, #ffb976); }
.bg-gradient-info { background: linear-gradient(45deg, #11cdef, #87d4f1); }

.template-item {
    transition: all 0.3s ease;
}

.template-item:hover {
    transform: translateY(-2px);
}

.card-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
}

pre {
    white-space: pre-wrap;
    font-family: inherit;
    font-size: 0.9em;
}
</style>

@endsection