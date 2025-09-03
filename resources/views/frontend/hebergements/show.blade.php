{{-- resources/views/frontend/hebergements/show.blade.php --}}
@extends('frontend.main_master')
@section('main')

{{-- Breadcrumb --}}
<div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg.jpg') }}">
    <div class="container z-index-common">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">{{ $hebergement->nom }}</h1>
            <div class="breadcumb-menu-wrap">
                <ul class="breadcumb-menu">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li><a href="{{ route('hebergements.index') }}">Hébergements</a></li>
                    <li>{{ $hebergement->nom }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="vs-tour-wrapper space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                {{-- Galerie d'images --}}
                <div class="vs-gallery-wrapper mb-4">
                    <div class="row g-2">
                        @if($hebergement->images && count($hebergement->images) > 0)
                            {{-- Image principale --}}
                            <div class="col-md-8">
                                <div class="vs-gallery-thumb">
                                    <img src="{{ asset('storage/' . $hebergement->images[0]) }}" 
                                         alt="{{ $hebergement->nom }}" 
                                         class="w-100 rounded" 
                                         style="height: 400px; object-fit: cover; cursor: pointer;"
                                         data-bs-toggle="modal" data-bs-target="#galerieModal" data-index="0">
                                </div>
                            </div>
                            
                            {{-- Images secondaires --}}
                            <div class="col-md-4">
                                <div class="row g-2">
                                    @foreach(array_slice($hebergement->images, 1, 4) as $index => $image)
                                        <div class="col-6">
                                            <div class="vs-gallery-thumb">
                                                <img src="{{ asset($image) }}" 
                                                     alt="{{ $hebergement->nom }}" 
                                                     class="w-100 rounded" 
                                                     style="height: 95px; object-fit: cover; cursor: pointer;"
                                                     data-bs-toggle="modal" data-bs-target="#galerieModal" data-index="{{ $index + 1 }}">
                                                
                                                @if($index == 3 && count($hebergement->images) > 5)
                                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 text-white rounded">
                                                        <span class="fw-bold">+{{ count($hebergement->images) - 5 }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                <img src="{{ asset('assets/img/hebergement-default.jpg') }}" 
                                     alt="{{ $hebergement->nom }}" 
                                     class="w-100 rounded" style="height: 400px; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Informations principales --}}
                <div class="tour-details-content">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="tour-title">{{ $hebergement->nom }}</h2>
                            <div class="d-flex align-items-center text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>{{ $hebergement->adresse }}</span>
                            </div>
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-globe me-2"></i>
                                <span>{{ $hebergement->lieu_touristique ?? $hebergement->departement }}, {{ $hebergement->region }}</span>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <div class="tour-price mb-2">
                                <span class="price-text">{{ $hebergement->tarif_format }}</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-danger btn-sm favori-btn" data-id="{{ $hebergement->id }}">
                                    <i class="far fa-heart"></i> Favoris
                                </button>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#partagerModal">
                                    <i class="fas fa-share-alt"></i> Partager
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Note et commentaires --}}
                    @if($totalCommentaires > 0)
                    <div class="rating-section mb-4 p-3 bg-light rounded">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="rating-score">
                                        <span class="score">{{ number_format($hebergement->note_client_moyenne, 1) }}</span>
                                        <span class="total">/5</span>
                                    </div>
                                    <div class="rating-stars mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= round($hebergement->note_client_moyenne) ? 'text-warning' : 'text-muted' }}">★</span>
                                        @endfor
                                    </div>
                                    <small class="text-muted">{{ $totalCommentaires }} avis client{{ $totalCommentaires > 1 ? 's' : '' }}</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="rating-breakdown">
                                    @for($i = 5; $i >= 1; $i--)
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="me-2">{{ $i }}★</span>
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                @php $percentage = $totalCommentaires > 0 ? ($statistiquesNotes[$i] / $totalCommentaires) * 100 : 0; @endphp
                                                <div class="progress-bar bg-warning" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $statistiquesNotes[$i] }}</small>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Badges --}}
                    @if($hebergement->badges)
                    <div class="badges-section mb-4">
                        @foreach($hebergement->badges as $badge)
                            <span class="badge bg-primary me-2 mb-2">
                                {{ \App\Models\Hebergement::getBadgesDisponibles()[$badge] ?? $badge }}
                            </span>
                        @endforeach
                    </div>
                    @endif

                    {{-- Description --}}
                    <div class="tour-description mb-4">
                        <h4>Description</h4>
                        <div class="description-content">
                            {!! $hebergement->description !!}
                        </div>
                    </div>

                    {{-- Équipements --}}
                    @if($hebergement->amenities)
                    <div class="amenities-section mb-4">
                        <h4>Équipements & Services</h4>
                        <div class="row">
                            @foreach($hebergement->amenities as $amenity)
                                @php $amenityLabel = \App\Models\Hebergement::getAmenitiesDisponibles()[$amenity] ?? $amenity; @endphp
                                <div class="col-md-6 col-lg-4 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <span>{{ $amenityLabel }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Localisation --}}
                    <div class="location-section mb-4">
                        <h4>Localisation</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="location-info">
                                    <p><strong>Adresse complète:</strong><br>{{ $hebergement->adresse }}</p>
                                    <p><strong>Région:</strong> {{ $hebergement->region }}</p>
                                    <p><strong>Département:</strong> {{ $hebergement->departement }}</p>
                                    @if($hebergement->lieu_touristique)
                                        <p><strong>Lieu touristique:</strong> {{ $hebergement->lieu_touristique }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($hebergement->latitude && $hebergement->longitude)
                                    <div id="carte-hebergement" style="height: 250px; border-radius: 8px;"></div>
                                @else
                                    <div class="bg-light p-4 rounded text-center">
                                        <i class="fas fa-map-marker-alt fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">Localisation précise non disponible</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Commentaires --}}
                    <div class="reviews-section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Avis Clients ({{ $totalCommentaires }})</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterAvisModal">
                                <i class="fas fa-plus"></i> Laisser un avis
                            </button>
                        </div>

                        @if($hebergement->commentairesApprouves->count() > 0)
                            <div class="reviews-list">
                                @foreach($hebergement->commentairesApprouves->take(5) as $commentaire)
                                    <div class="review-item mb-4 p-3 border rounded">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1">{{ $commentaire->nom_client }}</h6>
                                                <div class="rating-stars">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <span class="{{ $i <= $commentaire->note_client ? 'text-warning' : 'text-muted' }}">★</span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ $commentaire->temps_ecoule }}</small>
                                        </div>
                                        <p class="mb-0">{{ $commentaire->commentaire }}</p>
                                    </div>
                                @endforeach

                                @if($hebergement->commentairesApprouves->count() > 5)
                                    <div class="text-center">
                                        <button class="btn btn-outline-primary" id="voir-plus-avis">
                                            Voir plus d'avis ({{ $hebergement->commentairesApprouves->count() - 5 }} restants)
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-comment fa-3x text-muted mb-3"></i>
                                <h5>Aucun avis pour le moment</h5>
                                <p class="text-muted">Soyez le premier à laisser un avis sur cet hébergement.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar-area">
                    {{-- Carte de réservation --}}
                    <div class="widget widget_book_tour">
                        <h3 class="widget_title">💰 Informations Tarifs</h3>
                        <div class="book-tour-wrapper">
                            <div class="price-display text-center mb-3">
                                <h3 class="text-primary">{{ $hebergement->tarif_format }}</h3>
                                @if($hebergement->tarif_min && $hebergement->tarif_max)
                                    <small class="text-muted">Selon la période et le type de chambre</small>
                                @endif
                            </div>
                            
                            {{-- Contact --}}
                            <div class="contact-info">
                                @if($hebergement->telephone)
                                    <a href="tel:{{ $hebergement->telephone }}" class="btn btn-success w-100 mb-2">
                                        <i class="fas fa-phone"></i> Appeler: {{ $hebergement->telephone }}
                                    </a>
                                @endif
                                
                                @if($hebergement->email)
                                    <a href="mailto:{{ $hebergement->email }}" class="btn btn-info w-100 mb-2">
                                        <i class="fas fa-envelope"></i> Email
                                    </a>
                                @endif
                                
                                @if($hebergement->site_web)
                                    <a href="{{ $hebergement->site_web }}" target="_blank" class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-globe"></i> Site Web
                                    </a>
                                @endif
                                
                                <a href="{{ route('contact') }}?sujet=Réservation {{ $hebergement->nom }}" class="btn btn-primary w-100">
                                    <i class="fas fa-calendar-check"></i> Demander une réservation
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Hébergements similaires --}}
                    @if($hebergementsSimilaires->count() > 0)
                    <div class="widget">
                        <h3 class="widget_title">🏨 Hébergements Similaires</h3>
                        <div class="similar-tours">
                            @foreach($hebergementsSimilaires as $similaire)
                                <div class="vs-blog style2 mb-3">
                                    <div class="blog-img">
                                        <img src="{{ asset('storage/' . $similaire->image_principale) }}" 
                                             alt="{{ $similaire->nom }}" style="height: 80px; object-fit: cover;">
                                    </div>
                                    <div class="blog-content">
                                        <h6 class="blog-title">
                                            <a href="{{ route('hebergements.show', $similaire) }}">{{ $similaire->nom }}</a>
                                        </h6>
                                        <div class="blog-meta">
                                            <small class="text-muted">{{ $similaire->lieu_touristique ?? $similaire->departement }}</small>
                                        </div>
                                        <div class="blog-price">
                                            <small class="text-primary fw-bold">{{ $similaire->tarif_format }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Widget Aide --}}
                    <div class="widget widget_help">
                        <h3 class="widget_title">🆘 Besoin d'aide ?</h3>
                        <div class="help-content">
                            <p>Notre équipe est disponible pour vous accompagner dans votre réservation.</p>
                            <div class="help-contact">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <span>+221 XX XXX XX XX</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    <span>contact@vacancesenegal.com</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <span>Lun-Ven: 8h-18h</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal Galerie --}}
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
                        @if($hebergement->images)
                            @foreach($hebergement->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         class="d-block w-100" 
                                         style="height: 500px; object-fit: contain;">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    @if($hebergement->images && count($hebergement->images) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#galerieCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#galerieCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ajouter Avis --}}
<div class="modal fade" id="ajouterAvisModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laisser un avis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('hebergements.commentaire', $hebergement) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="note_client" class="form-label">Note *</label>
                        <div class="rating-input">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" id="star{{ $i }}" name="note_client" value="{{ $i }}" required>
                                <label for="star{{ $i }}" class="star-label">★</label>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nom_client" class="form-label">Nom *</label>
                        <input type="text" class="form-control" id="nom_client" name="nom_client" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email_client" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email_client" name="email_client" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Votre avis *</label>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="4" 
                                  placeholder="Partagez votre expérience..." required></textarea>
                        <div class="form-text">Minimum 10 caractères</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Publier l'avis</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Partager --}}
<div class="modal fade" id="partagerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Partager cet hébergement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="social-share">
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" class="btn btn-primary w-100">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($hebergement->nom) }}" 
                               target="_blank" class="btn btn-info w-100">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="https://wa.me/?text={{ urlencode($hebergement->nom . ' - ' . request()->url()) }}" 
                               target="_blank" class="btn btn-success w-100">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-secondary w-100" onclick="copierLien()">
                                <i class="fas fa-copy"></i> Copier le lien
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <label for="lien-partage" class="form-label">Lien direct:</label>
                    <input type="text" class="form-control" id="lien-partage" value="{{ request()->url() }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<style>
.rating-score .score {
    font-size: 2.5rem;
    font-weight: bold;
    color: #ffc107;
}

.rating-score .total {
    font-size: 1.2rem;
    color: #6c757d;
}

.rating-input {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
}

.rating-input input[type="radio"] {
    display: none;
}

.rating-input .star-label {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
}

.rating-input input[type="radio"]:checked ~ .star-label,
.rating-input .star-label:hover,
.rating-input .star-label:hover ~ .star-label {
    color: #ffc107;
}

.amenities-section .fa-check {
    font-size: 0.8rem;
}

.review-item {
    transition: box-shadow 0.3s ease;
}

.review-item:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.similar-tours .vs-blog {
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
}

.social-share .btn {
    border-radius: 8px;
}

.description-content {
    line-height: 1.6;
}

.description-content p {
    margin-bottom: 1rem;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
$(document).ready(function() {
    // Initialiser la carte
    @if($hebergement->latitude && $hebergement->longitude)
        initCarte();
    @endif
    
    // Gestion des favoris
    let favoris = JSON.parse(localStorage.getItem('favoris_hebergements')) || [];
    updateFavoriButton();
    
    $('.favori-btn').click(function() {
        const id = {{ $hebergement->id }};
        const index = favoris.indexOf(id);
        
        if (index > -1) {
            favoris.splice(index, 1);
            $(this).removeClass('btn-danger').addClass('btn-outline-danger')
                   .html('<i class="far fa-heart"></i> Favoris');
        } else {
            favoris.push(id);
            $(this).removeClass('btn-outline-danger').addClass('btn-danger')
                   .html('<i class="fas fa-heart"></i> Retiré des favoris');
        }
        
        localStorage.setItem('favoris_hebergements', JSON.stringify(favoris));
    });
    
    // Ouvrir la galerie à une image spécifique
    $('[data-bs-target="#galerieModal"]').click(function() {
        const index = $(this).data('index');
        $('#galerieCarousel').carousel(index);
    });
    
    // Voir plus d'avis
    $('#voir-plus-avis').click(function() {
        // Charger plus d'avis via AJAX
        // Pour l'instant, on cache le bouton
        $(this).hide();
        // TODO: Implémenter le chargement AJAX des avis
    });
    
    function initCarte() {
        const carte = L.map('carte-hebergement').setView([{{ $hebergement->latitude }}, {{ $hebergement->longitude }}], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(carte);
        
        L.marker([{{ $hebergement->latitude }}, {{ $hebergement->longitude }}])
         .addTo(carte)
         .bindPopup(`
            <div class="p-2">
                <strong>{{ $hebergement->nom }}</strong><br>
                <small>{{ $hebergement->adresse }}</small>
            </div>
         `).openPopup();
    }
    
    function updateFavoriButton() {
        const id = {{ $hebergement->id }};
        if (favoris.includes(id)) {
            $('.favori-btn').removeClass('btn-outline-danger').addClass('btn-danger')
                           .html('<i class="fas fa-heart"></i> Retiré des favoris');
        }
    }
});

function copierLien() {
    const input = document.getElementById('lien-partage');
    input.select();
    input.setSelectionRange(0, 99999);
    
    navigator.clipboard.writeText(input.value).then(function() {
        alert('Lien copié dans le presse-papiers !');
    });
}
</script>
@endpush

@endsection