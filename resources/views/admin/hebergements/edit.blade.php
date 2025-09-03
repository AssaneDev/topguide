{{-- resources/views/admin/hebergements/edit.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Hébergements</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hebergements.index') }}">Hébergements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                </ol>
            </nav>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.hebergements.update', $hebergement) }}" enctype="multipart/form-data" id="hebergement-form">
        @csrf
        @method('PUT')
        
        <div class="row">
            {{-- Informations principales --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">🏨 Informations Principales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nom" class="form-label">Nom de l'hébergement *</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" name="nom" value="{{ old('nom', $hebergement->nom) }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="myeditorinstance" name="description" rows="6">{{ old('description', $hebergement->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="adresse" class="form-label">Adresse complète *</label>
                                <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                          id="adresse" name="adresse" rows="2" required>{{ old('adresse', $hebergement->adresse) }}</textarea>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="region" class="form-label">Région *</label>
                                <select class="form-select @error('region') is-invalid @enderror" 
                                        id="region" name="region" required>
                                    <option value="">Sélectionner une région</option>
                                    @foreach($regions as $key => $region)
                                        <option value="{{ $key }}" {{ old('region', $hebergement->region) == $key ? 'selected' : '' }}>
                                            {{ $region }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="departement" class="form-label">Département *</label>
                                <input type="text" class="form-control @error('departement') is-invalid @enderror" 
                                       id="departement" name="departement" value="{{ old('departement', $hebergement->departement) }}" required>
                                @error('departement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="lieu_touristique" class="form-label">Lieu touristique</label>
                                <input type="text" class="form-control" 
                                       id="lieu_touristique" name="lieu_touristique" 
                                       value="{{ old('lieu_touristique', $hebergement->lieu_touristique) }}"
                                       placeholder="Ex: Île de Gorée, Lac Rose, Saly...">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tarifs et Contact --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">💰 Tarifs et Contact</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tarif_min" class="form-label">Tarif minimum (XOF)</label>
                                <input type="number" class="form-control @error('tarif_min') is-invalid @enderror" 
                                       id="tarif_min" name="tarif_min" value="{{ old('tarif_min', $hebergement->tarif_min) }}" min="0">
                                @error('tarif_min')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tarif_max" class="form-label">Tarif maximum (XOF)</label>
                                <input type="number" class="form-control @error('tarif_max') is-invalid @enderror" 
                                       id="tarif_max" name="tarif_max" value="{{ old('tarif_max', $hebergement->tarif_max) }}" min="0">
                                @error('tarif_max')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" 
                                       id="telephone" name="telephone" value="{{ old('telephone', $hebergement->telephone) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $hebergement->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="site_web" class="form-label">Site Web</label>
                                <input type="url" class="form-control @error('site_web') is-invalid @enderror" 
                                       id="site_web" name="site_web" value="{{ old('site_web', $hebergement->site_web) }}"
                                       placeholder="https://example.com">
                                @error('site_web')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Images existantes --}}
                @if($hebergement->images && count($hebergement->images) > 0)
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">📸 Images Actuelles</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2" id="existing-images">
                            @foreach($hebergement->images as $index => $image)
                                <div class="col-md-4 col-lg-3 image-item" data-index="{{ $index }}">
                                    <div class="card">
                                        <img src="{{ asset($image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Image {{ $index + 1 }}</small>
                                                <button type="button" class="btn btn-sm btn-danger delete-image-btn" 
                                                        data-index="{{ $index }}" title="Supprimer">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Nouvelles images --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">📸 Ajouter de Nouvelles Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="images" class="form-label">Nouvelles images</label>
                            <input type="file" class="form-control @error('images.*') is-invalid @enderror" 
                                   id="images" name="images[]" multiple accept="image/*">
                            <div class="form-text">Formats acceptés: JPG, PNG, WebP. Taille max: 2MB par image.</div>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div id="new-image-preview" class="row g-2"></div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Note Admin --}}
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">⭐ Évaluation Interne</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="note_admin" class="form-label">Note administrative</label>
                            <select class="form-select" id="note_admin" name="note_admin">
                                <option value="">Pas de note</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('note_admin', $hebergement->note_admin) == $i ? 'selected' : '' }}>
                                        {{ $i }} étoile{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="commentaire_admin" class="form-label">Commentaire interne</label>
                            <textarea class="form-control" id="commentaire_admin" name="commentaire_admin" 
                                      rows="3" placeholder="Notes internes...">{{ old('commentaire_admin', $hebergement->commentaire_admin) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Statut et Options --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">⚙️ Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" name="statut">
                                <option value="actif" {{ old('statut', $hebergement->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('statut', $hebergement->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                <option value="en_cours" {{ old('statut', $hebergement->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                   {{ old('featured', $hebergement->featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">
                                Mettre en vedette
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Équipements --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">🏊‍♀️ Équipements</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($amenities as $key => $label)
                                <div class="col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               id="amenity_{{ $key }}" name="amenities[]" value="{{ $key }}"
                                               {{ in_array($key, old('amenities', $hebergement->amenities ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="amenity_{{ $key }}">
                                            {{ $label }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Badges --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">🎖️ Badges</h5>
                    </div>
                    <div class="card-body">
                        @foreach($badges as $key => $label)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" 
                                       id="badge_{{ $key }}" name="badges[]" value="{{ $key }}"
                                       {{ in_array($key, old('badges', $hebergement->badges ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label small" for="badge_{{ $key }}">
                                    {{ $label }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Statistiques --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">📊 Statistiques</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="stat-box">
                                    <h4 class="text-primary">{{ $hebergement->vues }}</h4>
                                    <small class="text-muted">Vues</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-box">
                                    <h4 class="text-success">{{ $hebergement->nombre_commentaires }}</h4>
                                    <small class="text-muted">Avis</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-box">
                                    <h4 class="text-warning">{{ number_format($hebergement->note_client_moyenne, 1) }}</h4>
                                    <small class="text-muted">Note/5</small>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="text-center">
                            <small class="text-muted">
                                Créé le {{ $hebergement->created_at->format('d/m/Y') }}<br>
                                Modifié le {{ $hebergement->updated_at->format('d/m/Y') }}
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" id="btn-submit">
                            <i class="bx bx-save"></i> <span id="btn-text">Mettre à jour</span>
                        </button>
                        <a href="{{ route('admin.hebergements.index') }}" class="btn btn-outline-secondary w-100 mb-2">
                            <i class="bx bx-arrow-back"></i> Retour à la liste
                        </a>
                        <a href="{{ route('admin.hebergements.show', $hebergement) }}" class="btn btn-outline-info w-100">
                            <i class="bx bx-show"></i> Voir les détails
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Prévisualisation des nouvelles images
    $('#images').change(function() {
        const files = this.files;
        const preview = $('#new-image-preview');
        preview.empty();
        
        if (files) {
            Array.from(files).forEach(function(file, index) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.append(`
                            <div class="col-md-6 col-lg-4 mb-2">
                                <div class="card">
                                    <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        <small class="text-muted">Nouvelle image ${index + 1}</small>
                                    </div>
                                </div>
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });

    // Suppression d'images existantes
    $('.delete-image-btn').click(function() {
        const index = $(this).data('index');
        const imageItem = $(this).closest('.image-item');
        
        Swal.fire({
            title: 'Supprimer cette image ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.hebergements.delete-image", $hebergement) }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        image_index: index
                    },
                    success: function(response) {
                        if (response.success) {
                            imageItem.fadeOut(300, function() {
                                $(this).remove();
                                // Réorganiser les index
                                $('#existing-images .image-item').each(function(newIndex) {
                                    $(this).attr('data-index', newIndex);
                                    $(this).find('.delete-image-btn').attr('data-index', newIndex);
                                    $(this).find('small').text('Image ' + (newIndex + 1));
                                });
                            });
                            toastr.success('Image supprimée avec succès');
                        }
                    },
                    error: function() {
                        toastr.error('Erreur lors de la suppression');
                    }
                });
            }
        });
    });

    // Validation tarifs
    $('#tarif_min, #tarif_max').on('input', function() {
        const min = parseFloat($('#tarif_min').val()) || 0;
        const max = parseFloat($('#tarif_max').val()) || 0;
        
        if (min > 0 && max > 0 && min > max) {
            $('#tarif_max').addClass('is-invalid');
            toastr.warning('Le tarif maximum doit être supérieur au minimum');
        } else {
            $('#tarif_max').removeClass('is-invalid');
        }
    });

    // Gestion du submit du formulaire
    $('#hebergement-form').on('submit', function(e) {
        e.preventDefault();
        
        // Désactiver le bouton pour éviter les doublons
        const submitBtn = $('#btn-submit');
        const btnText = $('#btn-text');
        
        submitBtn.prop('disabled', true);
        btnText.html('<span class="spinner-border spinner-border-sm me-2"></span>Mise à jour...');
        
        // Synchroniser TinyMCE
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }
        
        // Validation basique
        let isValid = true;
        const requiredFields = ['nom', 'adresse', 'region', 'departement'];
        
        // Validation du nom
        const nom = $('[name="nom"]').val().trim();
        if (!nom) {
            $('[name="nom"]').addClass('is-invalid');
            isValid = false;
        }
        
        // Validation de la description
        const description = $('#myeditorinstance').val().trim();
        if (!description || description === '') {
            toastr.error('La description est obligatoire');
            isValid = false;
            if (typeof tinymce !== 'undefined') {
                tinymce.get('myeditorinstance').focus();
            }
        }
        
        // Validation des autres champs
        requiredFields.forEach(function(field) {
            const input = $(`[name="${field}"]`);
            if (!input.val().trim()) {
                input.addClass('is-invalid');
                isValid = false;
            } else {
                input.removeClass('is-invalid');
            }
        });
        
        if (!isValid) {
            submitBtn.prop('disabled', false);
            btnText.html('Mettre à jour');
            toastr.error('Veuillez remplir tous les champs obligatoires');
            
            // Scroll vers le premier champ invalide
            const firstInvalid = $('.is-invalid').first();
            if (firstInvalid.length) {
                $('html, body').animate({
                    scrollTop: firstInvalid.offset().top - 100
                }, 500);
                firstInvalid.focus();
            }
            return;
        }
        
        // Soumettre le formulaire
        this.submit();
    });

    // Enlever les erreurs de validation au focus
    $('input, textarea, select').on('focus', function() {
        $(this).removeClass('is-invalid');
    });
});
</script>
@endpush

@endsection