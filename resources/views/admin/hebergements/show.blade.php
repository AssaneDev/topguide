{{-- resources/views/admin/hebergements/show.blade.php --}}
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $hebergement->nom }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.hebergements.edit', $hebergement) }}" class="btn btn-primary">
                    <i class="bx bx-edit"></i> Modifier
                </a>
                <a href="{{ route('admin.hebergements.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Informations principales --}}
        <div class="col-xl-8">
            {{-- En-tête avec image principale --}}
            <div class="card">
                <div class="card-body p-0">
                    @if($hebergement->images && count($hebergement->images) > 0)
                        <div class="position-relative">
                            <img src="{{ asset($hebergement->images[0]) }}" 
                                 class="w-100 rounded-top" 
                                 style="height: 300px; object-fit: cover;" 
                                 alt="{{ $hebergement->nom }}">
                            
                            {{-- Badges overlay --}}
                            <div class="position-absolute top-0 start-0 p-3">
                                @if($hebergement->featured)
                                    <span class="badge bg-warning text-dark fs-6">
                                        <i class="bx bx-star"></i> En vedette
                                    </span>
                                @endif
                                <span class="badge bg-{{ $hebergement->statut == 'actif' ? 'success' : ($hebergement->statut == 'inactif' ? 'danger' : 'warning') }} fs-6 d-block mt-2">
                                    {{ ucfirst($hebergement->statut) }}
                                </span>
                            </div>
                            
                            {{-- Prix overlay --}}
                            @if($hebergement->tarif_min || $hebergement->tarif_max)
                                <div class="position-absolute bottom-0 end-0 p-3">
                                    <div class="bg-dark text-white px-3 py-2 rounded">
                                        <strong>{{ $hebergement->tarif_format }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h2 class="mb-2">{{ $hebergement->nom }}</h2>
                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="bx bx-map me-2"></i>
                                    <span>{{ $hebergement->adresse }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="bx bx-location-plus me-2"></i>
                                    <span>{{ $hebergement->lieu_touristique ?? $hebergement->departement }}, {{ $hebergement->region }}</span>
                                </div>
                            </div>
                            
                            {{-- Note admin --}}
                            @if($hebergement->note_admin)
                                <div class="text-end">
                                    <div class="mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bx bx{{ $i <= $hebergement->note_admin ? 's' : '' }}-star text-warning"></i>
                                        @endfor
                                    </div>
                                    <small class="text-muted">Note admin: {{ $hebergement->note_admin }}/5</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">📝 Description</h5>
                </div>
                <div class="card-body">
                    <div class="description-content">
                        {!! $hebergement->description !!}
                    </div>
                </div>
            </div>

            {{-- Galerie d'images --}}
            @if($hebergement->images && count($hebergement->images) > 1)
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">📸 Galerie d'images ({{ count($hebergement->images) }} images)</h5>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @foreach($hebergement->images as $index => $image)
                            <div class="col-md-4 col-lg-3">
                                <div class="image-item">
                                    <img src="{{ asset($image) }}" 
                                         class="w-100 rounded cursor-pointer" 
                                         style="height: 150px; object-fit: cover;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#galerieModal"
                                         data-index="{{ $index }}"
                                         alt="Image {{ $index + 1 }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- Équipements et badges --}}
            <div class="row mt-3">
                @if($hebergement->amenities)
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">🏊‍♀️ Équipements</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($hebergement->amenities as $amenity)
                                    @php $amenityLabel = \App\Models\Hebergement::getAmenitiesDisponibles()[$amenity] ?? $amenity; @endphp
                                    <div class="col-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-check text-success me-2"></i>
                                            <span class="small">{{ $amenityLabel }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($hebergement->badges)
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">🎖️ Badges</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($hebergement->badges as $badge)
                                    @php $badgeLabel = \App\Models\Hebergement::getBadgesDisponibles()[$badge] ?? $badge; @endphp
                                    <span class="badge bg-primary">{{ $badgeLabel }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Commentaires clients --}}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">💬 Avis Clients ({{ $hebergement->commentaires->count() }})</h5>
                    <a href="{{ route('admin.hebergements.commentaires') }}?hebergement={{ $hebergement->id }}" 
                       class="btn btn-sm btn-outline-primary">
                        Gérer tous les avis
                    </a>
                </div>
                <div class="card-body">
                    @if($hebergement->commentaires->count() > 0)
                        {{-- Statistiques des avis --}}
                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <h3 class="text-primary">{{ number_format($hebergement->note_client_moyenne, 1) }}</h3>
                                <div class="rating-stars mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bx bx{{ $i <= round($hebergement->note_client_moyenne) ? 's' : '' }}-star text-warning"></i>
                                    @endfor
                                </div>
                                <small class="text-muted">Note moyenne</small>
                            </div>
                            <div class="col-md-8">
                                <div class="rating-breakdown">
                                    @for($i = 5; $i >= 1; $i--)
                                        @php $count = $hebergement->commentaires->where('note_client', $i)->count(); @endphp
                                        @php $percentage = $hebergement->commentaires->count() > 0 ? ($count / $hebergement->commentaires->count()) * 100 : 0; @endphp
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="me-2">{{ $i }}★</span>
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                <div class="progress-bar bg-warning" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $count }}</small>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        {{-- Liste des commentaires récents --}}
                        <div class="commentaires-list">
                            @foreach($hebergement->commentaires->take(5) as $commentaire)
                                <div class="commentaire-item border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-1">{{ $commentaire->nom_client }}</h6>
                                            <div class="rating-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="bx bx{{ $i <= $commentaire->note_client ? 's' : '' }}-star text-warning"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-{{ $commentaire->statut == 'approuve' ? 'success' : ($commentaire->statut == 'rejete' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($commentaire->statut) }}
                                            </span>
                                            <small class="text-muted">{{ $commentaire->created_at->format('d/m/Y') }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-0">{{ $commentaire->commentaire }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-message-dots display-4 text-muted"></i>
                            <h5 class="mt-2">Aucun avis pour le moment</h5>
                            <p class="text-muted">Cet hébergement n'a pas encore reçu d'avis clients.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-xl-4">
            {{-- Statistiques --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📊 Statistiques</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center g-3">
                        <div class="col-6">
                            <div class="stat-box p-3 border rounded">
                                <h4 class="text-primary mb-1">{{ number_format($hebergement->vues) }}</h4>
                                <small class="text-muted">Vues totales</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box p-3 border rounded">
                                <h4 class="text-success mb-1">{{ $hebergement->nombre_commentaires }}</h4>
                                <small class="text-muted">Avis clients</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box p-3 border rounded">
                                <h4 class="text-warning mb-1">{{ number_format($hebergement->note_client_moyenne, 1) }}</h4>
                                <small class="text-muted">Note moyenne</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box p-3 border rounded">
                                <h4 class="text-info mb-1">{{ $hebergement->ordre_affichage }}</h4>
                                <small class="text-muted">Ordre d'affichage</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informations de contact --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">📞 Contact</h5>
                </div>
                <div class="card-body">
                    @if($hebergement->telephone)
                        <div class="d-flex align-items-center mb-3">
                            <i class="bx bx-phone text-primary me-3"></i>
                            <div>
                                <small class="text-muted d-block">Téléphone</small>
                                <a href="tel:{{ $hebergement->telephone }}">{{ $hebergement->telephone }}</a>
                            </div>
                        </div>
                    @endif

                    @if($hebergement->email)
                        <div class="d-flex align-items-center mb-3">
                            <i class="bx bx-envelope text-primary me-3"></i>
                            <div>
                                <small class="text-muted d-block">Email</small>
                                <a href="mailto:{{ $hebergement->email }}">{{ $hebergement->email }}</a>
                            </div>
                        </div>
                    @endif

                    @if($hebergement->site_web)
                        <div class="d-flex align-items-center mb-3">
                            <i class="bx bx-globe text-primary me-3"></i>
                            <div>
                                <small class="text-muted d-block">Site Web</small>
                                <a href="{{ $hebergement->site_web }}" target="_blank">Visiter le site</a>
                            </div>
                        </div>
                    @endif

                    @if(!$hebergement->telephone && !$hebergement->email && !$hebergement->site_web)
                        <p class="text-muted text-center">Aucune information de contact disponible.</p>
                    @endif
                </div>
            </div>

            {{-- Localisation --}}
            @if($hebergement->latitude && $hebergement->longitude)
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">📍 Localisation</h5>
                </div>
                <div class="card-body">
                    <div id="carte-hebergement" style="height: 250px; border-radius: 8px;"></div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <strong>Coordonnées:</strong><br>
                            Latitude: {{ $hebergement->latitude }}<br>
                            Longitude: {{ $hebergement->longitude }}
                        </small>
                    </div>
                </div>
            </div>
            @endif

            {{-- Notes administratives --}}
            @if($hebergement->commentaire_admin)
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">📝 Notes Internes</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $hebergement->commentaire_admin }}</p>
                </div>
            </div>
            @endif

            {{-- Informations système --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">⚙️ Informations Système</h5>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">ID:</span>
                            <span>#{{ $hebergement->id }}</span>
                        </div>
                        @if($hebergement->slug)
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Slug:</span>
                            <span><code>{{ $hebergement->slug }}</code></span>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Créé le:</span>
                            <span>{{ $hebergement->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Modifié le:</span>
                            <span>{{ $hebergement->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="card mt-3">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.hebergements.edit', $hebergement) }}" class="btn btn-primary">
                            <i class="bx bx-edit"></i> Modifier
                        </a>
                        <a href="{{ route('hebergements.show', $hebergement) }}" target="_blank" class="btn btn-success">
                            <i class="bx bx-show"></i> Voir sur le site
                        </a>
                        <button class="btn btn-warning" onclick="toggleFeatured({{ $hebergement->id }})">
                            <i class="bx bx-star"></i> 
                            {{ $hebergement->featured ? 'Retirer de la vedette' : 'Mettre en vedette' }}
                        </button>
                        <button class="btn btn-danger" onclick="deleteHebergement({{ $hebergement->id }})">
                            <i class="bx bx-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Galerie --}}
@if($hebergement->images && count($hebergement->images) > 1)
<div class="modal fade" id="galerieModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Galerie - {{ $hebergement->nom }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div id="galerieCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($hebergement->images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset($image) }}" 
                                     class="d-block w-100" 
                                     style="height: 500px; object-fit: contain; background: #000;">
                            </div>
                        @endforeach
                    </div>
                    
                    <button class="carousel-control-prev" type="button" data-bs-target="#galerieCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#galerieCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                    
                    <div class="carousel-indicators">
                        @foreach($hebergement->images as $index => $image)
                            <button type="button" data-bs-target="#galerieCarousel" data-bs-slide-to="{{ $index }}" 
                                    class="{{ $index == 0 ? 'active' : '' }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<style>
.cursor-pointer {
    cursor: pointer;
}

.image-item {
    transition: transform 0.3s ease;
}

.image-item:hover {
    transform: scale(1.05);
}

.rating-stars i {
    font-size: 1rem;
}

.commentaire-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.stat-box {
    transition: transform 0.3s ease;
}

.stat-box:hover {
    transform: translateY(-2px);
}

.description-content {
    line-height: 1.6;
}

.description-content p {
    margin-bottom: 1rem;
}

.info-list {
    font-size: 0.9rem;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
$(document).ready(function() {
    // Initialiser la carte si les coordonnées existent
    @if($hebergement->latitude && $hebergement->longitude)
        initCarte();
    @endif
    
    // Ouvrir la galerie à une image spécifique
    $('[data-bs-target="#galerieModal"]').click(function() {
        const index = $(this).data('index');
        $('#galerieCarousel').carousel(index);
    });
});

@if($hebergement->latitude && $hebergement->longitude)
function initCarte() {
    const carte = L.map('carte-hebergement').setView([{{ $hebergement->latitude }}, {{ $hebergement->longitude }}], 15);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(carte);
    
    L.marker([{{ $hebergement->latitude }}, {{ $hebergement->longitude }}])
     .addTo(carte)
     .bindPopup(`
        <div class="p-2 text-center">
            <strong>{{ $hebergement->nom }}</strong><br>
            <small>{{ $hebergement->adresse }}</small>
        </div>
     `).openPopup();
}
@endif

function toggleFeatured(id) {
    $.ajax({
        url: `/admin/hebergements/${id}/toggle-featured`,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            toastr.success(response.message);
            setTimeout(() => {
                location.reload();
            }, 1000);
        },
        error: function() {
            toastr.error('Erreur lors de la mise à jour');
        }
    });
}

function deleteHebergement(id) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action supprimera définitivement l'hébergement et toutes ses données !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            // Créer un formulaire et le soumettre
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/hebergements/${id}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endpush

@endsection