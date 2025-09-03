@extends('frontend.main_master')

@section('main')
<div class="breadcumb-wrapper" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset($voyage->image_principale) }}');">
    <div class="container">
        <div class="breadcumb-content text-center">
            <h1 class="breadcumb-title text-white">Programme Complet</h1>
            <h2 class="text-white-50 mb-3">{{ $voyage->nom_voyage }}</h2>
            <div class="programme-badges mb-3">
                <span class="badge bg-success fs-6 px-3 py-2 me-2">
                    <i class="fas fa-unlock me-1"></i>Accès Complet
                </span>
                <span class="badge bg-primary fs-6 px-3 py-2">{{ $voyage->duree_formatee }}</span>
            </div>
            <ul class="breadcumb-menu justify-content-center">
                <li><a href="{{url('/')}}">Accueil</a></li>
                <li><a href="{{ route('voyages.index') }}">Voyages</a></li>
                <li><a href="{{ route('voyages.detail', $voyage->id) }}">{{ Str::limit($voyage->nom_voyage, 30) }}</a></li>
                <li>Programme Complet</li>
            </ul>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- En-tête avec résumé -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="programme-summary-card p-4 rounded-3 shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-3">{{ $voyage->nom_voyage }}</h3>
                        <p class="text-muted mb-3">{{ $voyage->description_courte }}</p>
                        <div class="voyage-highlights">
                            <div class="row g-2">
                                <div class="col-auto">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $voyage->region }}
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-calendar me-1"></i>{{ $voyage->duree_formatee }}
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-users me-1"></i>{{ $voyage->participants_max }} max
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-mountain me-1"></i>{{ $voyage->difficulte_label }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="price-highlight mb-3">
                            <div class="price-eur h4 mb-1 text-primary fw-bold">{{ $voyage->prix_base_eur_formate }}</div>
                            <div class="price-fcfa text-muted">{{ $voyage->prix_base_formate }}</div>
                        </div>
                        <a href="{{ route('voyages.reservation', $voyage->id) }}" class="btn btn-primary">
                            <i class="fas fa-calendar-check me-2"></i>Réserver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Programme jour par jour -->
            <div class="programme-complet-timeline">
                <div class="timeline-header mb-4">
                    <h3>
                        <i class="fas fa-route me-2 text-primary"></i>
                        Programme détaillé - {{ $voyage->etapes->count() }} jours
                    </h3>
                    <p class="text-muted">Voici le programme complet de votre voyage, jour par jour.</p>
                </div>

                @foreach($voyage->etapes as $etape)
                <div class="timeline-day-card mb-4" data-jour="{{ $etape->numero_jour }}">
                    <div class="day-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="day-number">
                                    {{ $etape->numero_jour }}
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="day-title mb-1">{{ $etape->titre_etape }}</h4>
                                @if($etape->heures_formatees)
                                    <p class="day-time text-muted mb-0">
                                        <i class="fas fa-clock me-1"></i>{{ $etape->heures_formatees }}
                                    </p>
                                @endif
                            </div>
                            @if($etape->duree_etape)
                            <div class="col-auto">
                                <span class="badge bg-info">Durée: {{ $etape->duree_etape }}h</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="day-content">
                        <div class="row g-4">
                            <div class="col-md-8">
                                <!-- Description principale -->
                                <div class="description-section mb-4">
                                    <h6><i class="fas fa-info-circle me-2 text-primary"></i>Description</h6>
                                    <p>{{ $etape->description_etape }}</p>
                                </div>

                                <!-- Activités du jour -->
                                @if($etape->activites_jour && count($etape->activites_jour) > 0)
                                <div class="activites-section mb-4">
                                    <h6><i class="fas fa-list me-2 text-success"></i>Activités prévues</h6>
                                    <div class="activites-grid">
                                        @foreach($etape->activites_jour as $index => $activite)
                                        <div class="activite-item">
                                            <span class="activite-number">{{ $index + 1 }}</span>
                                            <span class="activite-text">{{ $activite }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- Notes spéciales -->
                                @if($etape->notes_speciales)
                                <div class="notes-section">
                                    <h6><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Notes importantes</h6>
                                    <div class="alert alert-warning">
                                        {{ $etape->notes_speciales }}
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <!-- Lieux -->
                                @if($etape->lieu_depart || $etape->lieu_arrivee)
                                <div class="lieux-section mb-4">
                                    <h6><i class="fas fa-map me-2 text-info"></i>Itinéraire</h6>
                                    @if($etape->lieu_depart)
                                    <div class="lieu-item mb-2">
                                        <div class="lieu-icon bg-success">
                                            <i class="fas fa-play"></i>
                                        </div>
                                        <div class="lieu-content">
                                            <small class="lieu-label">Départ</small>
                                            <div class="lieu-name">{{ $etape->lieu_depart }}</div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($etape->lieu_arrivee)
                                    <div class="lieu-item">
                                        <div class="lieu-icon bg-danger">
                                            <i class="fas fa-stop"></i>
                                        </div>
                                        <div class="lieu-content">
                                            <small class="lieu-label">Arrivée</small>
                                            <div class="lieu-name">{{ $etape->lieu_arrivee }}</div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <!-- Hébergement -->
                                @if($etape->hebergement_etape)
                                <div class="hebergement-section mb-4">
                                    <h6><i class="fas fa-bed me-2 text-purple"></i>Hébergement</h6>
                                    <div class="hebergement-card">
                                        <i class="fas fa-hotel me-2"></i>
                                        {{ $etape->hebergement_etape }}
                                    </div>
                                </div>
                                @endif

                                <!-- Images de l'étape -->
                                @php
                                    $imagesEtape = $voyage->galeries->where('type_image', 'etape_specifique')
                                                                   ->where('numero_jour', $etape->numero_jour);
                                @endphp
                                @if($imagesEtape->count() > 0)
                                <div class="images-section">
                                    <h6><i class="fas fa-images me-2 text-secondary"></i>Photos</h6>
                                    <div class="etape-gallery">
                                        @foreach($imagesEtape->take(3) as $image)
                                        <div class="gallery-thumb">
                                            <img src="{{ asset($image->chemin_image) }}" 
                                                 alt="{{ $image->alt_image }}"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#imageModal"
                                                 data-image="{{ asset($image->chemin_image) }}"
                                                 data-title="Jour {{ $etape->numero_jour }} - {{ $etape->titre_etape }}">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Actions finales -->
            <div class="actions-finales mt-5 p-4 bg-light rounded-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-2">Prêt pour cette aventure ?</h5>
                        <p class="mb-0 text-muted">Réservez dès maintenant votre place pour ce voyage exceptionnel.</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="{{ route('voyages.reservation', $voyage->id) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-rocket me-2"></i>Réserver maintenant
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <!-- Navigation rapide -->
                <div class="navigation-card mb-4">
                    <h5 class="card-title mb-3">Navigation rapide</h5>
                    <div class="days-navigation">
                        @foreach($voyage->etapes as $etape)
                        <div class="nav-day-item" data-target="jour-{{ $etape->numero_jour }}">
                            <div class="nav-day-number">{{ $etape->numero_jour }}</div>
                            <div class="nav-day-content">
                                <div class="nav-day-title">{{ Str::limit($etape->titre_etape, 30) }}</div>
                                @if($etape->lieu_depart && $etape->lieu_arrivee)
                                <div class="nav-day-route">
                                    {{ Str::limit($etape->lieu_depart, 15) }} → {{ Str::limit($etape->lieu_arrivee, 15) }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Informations voyage -->
                <div class="voyage-info-sidebar-card mb-4">
                    <h5 class="card-title mb-3">Informations pratiques</h5>
                    <div class="info-list">
                        <div class="info-item">
                            <i class="fas fa-calendar text-primary"></i>
                            <span>{{ $voyage->duree_formatee }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-users text-primary"></i>
                            <span>{{ $voyage->participants_min }}-{{ $voyage->participants_max }} participants</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-mountain text-primary"></i>
                            <span>Difficulté {{ $voyage->difficulte_label }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-route text-primary"></i>
                            <span>{{ $voyage->etapes->count() }} étapes</span>
                        </div>
                        @if($voyage->guide_inclus)
                        <div class="info-item">
                            <i class="fas fa-user-tie text-success"></i>
                            <span>Guide inclus</span>
                        </div>
                        @endif
                        @if($voyage->repas_inclus)
                        <div class="info-item">
                            <i class="fas fa-utensils text-success"></i>
                            <span>Repas inclus</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="quick-actions-sidebar-card">
                    <h5 class="card-title mb-3">Actions</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Retour aux détails
                        </a>
                        <a href="{{ route('voyages.galerie', $voyage->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-images me-2"></i>Voir la galerie
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>Imprimer le programme
                        </button>
                        <a href="{{ route('contact') }}" class="btn btn-outline-info">
                            <i class="fas fa-comments me-2"></i>Une question ?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour les images -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img src="" alt="" class="img-fluid w-100" id="modalImage">
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.programme-summary-card {
    background: linear-gradient(135deg, #fff, #f8f9fa);
    border: 1px solid #e9ecef;
}

.timeline-day-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    overflow: hidden;
    transition: all 0.3s ease;
}

.timeline-day-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.day-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 1.5rem;
    border-bottom: 1px solid #e9ecef;
}

.day-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #FF6B35, #e55a2b);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.day-title {
    color: #333;
    font-weight: 600;
}

.day-content {
    padding: 2rem;
}

.description-section h6,
.activites-section h6,
.notes-section h6,
.lieux-section h6,
.hebergement-section h6,
.images-section h6 {
    color: #333;
    font-weight: 600;
    margin-bottom: 1rem;
}

.activites-grid {
    display: grid;
    gap: 0.5rem;
}

.activite-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid #FF6B35;
}

.activite-number {
    background: #FF6B35;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.lieu-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
}

.lieu-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 0.75rem;
    font-size: 0.8rem;
}

.lieu-label {
    color: #6c757d;
    font-size: 0.75rem;
    text-transform: uppercase;
    font-weight: 600;
}

.lieu-name {
    font-weight: 500;
    color: #333;
}

.hebergement-card {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border-left: 3px solid #6f42c1;
    color: #333;
}

.etape-gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.5rem;
}

.gallery-thumb img {
    width: 100%;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-thumb img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.navigation-card,
.voyage-info-sidebar-card,
.quick-actions-sidebar-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.nav-day-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.nav-day-item:hover {
    background: #f8f9fa;
    transform: translateX(5px);
    border-color: #FF6B35;
}

.nav-day-number {
    width: 32px;
    height: 32px;
    background: #FF6B35;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.9rem;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.nav-day-title {
    font-weight: 600;
    color: #333;
    font-size: 0.9rem;
    line-height: 1.2;
}

.nav-day-route {
    font-size: 0.75rem;
    color: #6c757d;
    margin-top: 0.25rem;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item i {
    width: 20px;
    margin-right: 0.75rem;
}

.actions-finales {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
    border: 1px solid #dee2e6;
}

@media (max-width: 768px) {
    .day-content {
        padding: 1.5rem;
    }
    
    .day-number {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .etape-gallery {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media print {
    .sticky-top,
    .btn,
    .modal {
        display: none !important;
    }
    
    .timeline-day-card {
        break-inside: avoid;
        margin-bottom: 1rem;
        box-shadow: none;
        border: 1px solid #ddd;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Navigation rapide
document.querySelectorAll('.nav-day-item').forEach(item => {
    item.addEventListener('click', function() {
        const target = this.getAttribute('data-target');
        const targetElement = document.querySelector(`[data-jour="${target.split('-')[1]}"]`);
        
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            
            // Highlight temporaire
            targetElement.style.background = 'rgba(255, 107, 53, 0.1)';
            setTimeout(() => {
                targetElement.style.background = '';
            }, 2000);
        }
    });
});

// Modal galerie
document.querySelectorAll('[data-bs-toggle="modal"]').forEach(item => {
    item.addEventListener('click', function() {
        const imageSrc = this.getAttribute('data-image');
        const imageTitle = this.getAttribute('data-title');
        
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModalTitle').textContent = imageTitle;
    });
});

// Tracking consultation programme complet
@auth
fetch(`/voyages/{{ $voyage->id }}/track-consultation`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({type: 'programme_complet'})
});
@endauth

// Animation au scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

document.querySelectorAll('.timeline-day-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'all 0.6s ease';
    observer.observe(card);
});
</script>
@endpush

@endsection