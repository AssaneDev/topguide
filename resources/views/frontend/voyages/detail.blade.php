@extends('frontend.main_master')

@section('main')
<!-- Hero Section -->
<div class="hero-section position-relative" style="height: 70vh; background: url('{{ asset($voyage->image_principale) }}') center/cover;">
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(45deg, rgba(0,0,0,0.7), rgba(0,0,0,0.3));"></div>
    <div class="container h-100 position-relative">
        <div class="row h-100 align-items-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6 px-3 py-2">{{ $voyage->type_voyage_label }}</span>
                        <span class="badge bg-success fs-6 px-3 py-2 ms-2">{{ $voyage->duree_formatee }}</span>
                    </div>
                    <h1 class="display-4 fw-bold mb-4">{{ $voyage->nom_voyage }}</h1>
                    <p class="lead mb-4">{{ $voyage->description_courte }}</p>
                    
                    <!-- Infos rapides -->
                    <div class="row g-3 mb-4">
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                <span>{{ $voyage->region }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users me-2 text-primary"></i>
                                <span>{{ $voyage->participants_min }}-{{ $voyage->participants_max }} participants</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-mountain me-2 text-primary"></i>
                                <span>{{ $voyage->difficulte_label }}</span>
                            </div>
                        </div>
                        @if($voyage->niveau_confort)
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star me-2 text-primary"></i>
                                <span>{{ $voyage->niveau_confort_label }}</span>
                            </div>
                        </div>
                        @endif
                        @if($voyage->point_depart && $voyage->point_arrivee)
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-route me-2 text-primary"></i>
                                <span>{{ $voyage->point_depart_arrivee }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Prix et CTA -->
                    <div class="d-flex align-items-center gap-4">
                        <div class="price-display">
                            <div class="price-eur h3 mb-1 text-warning fw-bold">{{ $voyage->prix_base_eur_formate }}</div>
                            <div class="price-fcfa text-light">{{ $voyage->prix_base_formate }}</div>
                        </div>
                        <div class="cta-buttons">
                            @auth
                                <a href="{{ route('voyages.reservation', $voyage->id) }}" class="vs-btn btn-lg me-3">
                                    <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="vs-btn btn-lg me-3">
                                    <i class="fas fa-user-plus me-2"></i>S'inscrire pour réserver
                                </a>
                            @endauth
                            <a href="#programme" class="vs-btn style2 btn-lg">
                                <i class="fas fa-list me-2"></i>Voir le programme
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Tabs -->
<div class="sticky-top bg-white border-bottom">
    <div class="container">
        <nav class="nav nav-pills py-3" id="voyage-tabs">
            <a class="nav-link active" href="#description">Description</a>
            <a class="nav-link" href="#programme">Programme</a>
            <a class="nav-link" href="#activites">Activités</a>
            <a class="nav-link" href="#inclusions">Inclusions</a>
            <a class="nav-link" href="#galerie">Galerie</a>
            <a class="nav-link" href="#infos">Infos pratiques</a>
        </nav>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Description -->
            <section id="description" class="mb-5">
                <h3 class="section-title mb-4">
                    <i class="fas fa-info-circle me-2 text-primary"></i>Description du voyage
                </h3>
                <div class="content-card p-4 rounded-3 border">
                    <div class="description-content">
                        {!! nl2br(e($voyage->description_longue)) !!}
                    </div>
                </div>
            </section>

            <!-- Programme -->
            <section id="programme" class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title mb-0">
                        <i class="fas fa-route me-2 text-primary"></i>Programme détaillé
                    </h3>
                    <a href="{{ route('voyages.programme', $voyage->id) }}" class="vs-btn style2">
                        Programme complet
                    </a>
                </div>
                
                <div class="timeline-container">
                    @foreach($voyage->etapes->take(3) as $etape)
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="timeline-day">{{ $etape->numero_jour }}</div>
                        </div>
                        <div class="timeline-content">
                            <div class="content-card p-4 rounded-3 border">
                                <h5 class="mb-2">{{ $etape->titre_etape }}</h5>
                                @if($etape->heures_formatees)
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-clock me-1"></i>{{ $etape->heures_formatees }}
                                    </p>
                                @endif
                                <p class="mb-3">{{ $etape->description_etape }}</p>
                                
                                @if($etape->lieu_depart || $etape->lieu_arrivee)
                                <div class="locations mb-2">
                                    @if($etape->lieu_depart)
                                        <span class="badge bg-light text-dark me-2">
                                            <i class="fas fa-play me-1"></i>{{ $etape->lieu_depart }}
                                        </span>
                                    @endif
                                    @if($etape->lieu_arrivee)
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-stop me-1"></i>{{ $etape->lieu_arrivee }}
                                        </span>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($voyage->etapes->count() > 3)
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="timeline-more">...</div>
                        </div>
                        <div class="timeline-content">
                            <div class="content-card p-4 rounded-3 border text-center">
                                <h5 class="mb-3">Et {{ $voyage->etapes->count() - 3 }} autres étapes !</h5>
                                @guest
                                    <p class="text-muted mb-3">Connectez-vous pour découvrir le programme complet de ce voyage extraordinaire !</p>
                                    <a href="{{ route('login') }}" class="vs-btn me-2">Se connecter</a>
                                    <a href="{{ route('register') }}" class="vs-btn style2">S'inscrire</a>
                                @else
                                    <a href="{{ route('voyages.programme-complet', $voyage->id) }}" class="vs-btn">
                                        Voir le programme complet
                                    </a>
                                @endguest
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </section>

            <!-- Activités -->
            <section id="activites" class="mb-5">
                <h3 class="section-title mb-4">
                    <i class="fas fa-hiking me-2 text-primary"></i>Activités & Expériences
                </h3>
                
                @if($voyage->activitesIncluses->count() > 0)
                <div class="mb-4">
                    <h5 class="text-success mb-3">
                        <i class="fas fa-check-circle me-2"></i>Activités incluses
                    </h5>
                    <div class="row g-3">
                        @foreach($voyage->activitesIncluses as $activite)
                        <div class="col-md-6">
                            <div class="activity-card h-100 p-3 rounded-3 border border-success border-opacity-25 bg-success bg-opacity-10">
                                <h6 class="fw-bold mb-2">{{ $activite->nom_activite }}</h6>
                                <p class="mb-2 small">{{ $activite->description_activite }}</p>
                                @if($activite->duree_heures)
                                    <div class="text-muted small">
                                        <i class="fas fa-clock me-1"></i>{{ $activite->duree_formatee }}
                                    </div>
                                @endif
                                @if($activite->lieu_activite)
                                    <div class="text-muted small">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $activite->lieu_activite }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($voyage->activitesOptionnelles->count() > 0)
                <div class="mb-4">
                    <h5 class="text-warning mb-3">
                        <i class="fas fa-plus-circle me-2"></i>Activités optionnelles
                    </h5>
                    <div class="row g-3">
                        @foreach($voyage->activitesOptionnelles as $activite)
                        <div class="col-md-6">
                            <div class="activity-card h-100 p-3 rounded-3 border border-warning border-opacity-25 bg-warning bg-opacity-10">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold mb-0">{{ $activite->nom_activite }}</h6>
                                    <span class="badge bg-warning text-dark">{{ $activite->prix_eur_formate }}</span>
                                </div>
                                <p class="mb-2 small">{{ $activite->description_activite }}</p>
                                <div class="activity-details">
                                    @if($activite->duree_heures)
                                        <div class="text-muted small mb-1">
                                            <i class="fas fa-clock me-1"></i>{{ $activite->duree_formatee }}
                                        </div>
                                    @endif
                                    @if($activite->lieu_activite)
                                        <div class="text-muted small">
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $activite->lieu_activite }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </section>

            <!-- Inclusions -->
            <section id="inclusions" class="mb-5">
                <h3 class="section-title mb-4">
                    <i class="fas fa-list-check me-2 text-primary"></i>Ce qui est inclus / non inclus
                </h3>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="inclusions-card p-4 rounded-3 border border-success border-opacity-25 bg-success bg-opacity-10">
                            <h5 class="text-success mb-3">
                                <i class="fas fa-check-circle me-2"></i>Inclus
                            </h5>
                            <ul class="list-unstyled mb-0">
                                @if($voyage->repas_inclus)
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>Repas mentionnés au programme
                                    </li>
                                @endif
                                @if($voyage->guide_inclus)
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>Guide local francophone
                                    </li>
                                @endif
                                @if($voyage->transports_inclus)
                                    @foreach($voyage->transports_inclus as $transport)
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>{{ ucfirst($transport) }}
                                    </li>
                                    @endforeach
                                @endif
                                @if($voyage->hebergements_inclus)
                                    @foreach($voyage->hebergements_inclus as $hebergement)
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>{{ ucfirst($hebergement) }}
                                    </li>
                                    @endforeach
                                @endif
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>Assistance 24h/7j
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inclusions-card p-4 rounded-3 border border-danger border-opacity-25 bg-danger bg-opacity-10">
                            <h5 class="text-danger mb-3">
                                <i class="fas fa-times-circle me-2"></i>Non inclus
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-times text-danger me-2"></i>Vols internationaux
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-times text-danger me-2"></i>Visa (si nécessaire)
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-times text-danger me-2"></i>Assurance voyage
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-times text-danger me-2"></i>Dépenses personnelles
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-times text-danger me-2"></i>Pourboires
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-times text-danger me-2"></i>Activités optionnelles
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Galerie -->
            <section id="galerie" class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title mb-0">
                        <i class="fas fa-images me-2 text-primary"></i>Galerie photos
                    </h3>
                    <a href="{{ route('voyages.galerie', $voyage->id) }}" class="vs-btn style2">
                        Voir toutes les photos
                    </a>
                </div>
                
                <div class="row g-3">
                    @foreach($voyage->galeries->take(6) as $galerie)
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-item">
                            <img src="{{ asset($galerie->chemin_image) }}" 
                                 alt="Photo {{ $loop->iteration }}" 
                                 class="img-fluid rounded-3"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#galleryModal"
                                 data-image="{{ asset($galerie->chemin_image) }}"
                                 style="height: 200px; object-fit: cover; cursor: pointer;">
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Informations pratiques -->
            <section id="infos" class="mb-5">
                <h3 class="section-title mb-4">
                    <i class="fas fa-info-circle me-2 text-primary"></i>Informations pratiques
                </h3>
                
                <div class="row g-4">
                    @if($voyage->equipements_recommandes)
                    <div class="col-md-6">
                        <div class="info-card p-4 rounded-3 border">
                            <h5 class="mb-3">
                                <i class="fas fa-backpack me-2 text-warning"></i>Équipements recommandés
                            </h5>
                            <div class="equipements-content">
                                {!! nl2br(e($voyage->equipements_recommandes)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($voyage->conditions_particulieres)
                    <div class="col-md-6">
                        <div class="info-card p-4 rounded-3 border">
                            <h5 class="mb-3">
                                <i class="fas fa-exclamation-triangle me-2 text-danger"></i>Conditions particulières
                            </h5>
                            <div class="conditions-content">
                                {!! nl2br(e($voyage->conditions_particulieres)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($voyage->informations_generales)
                    <div class="col-12">
                        <div class="info-card p-4 rounded-3 border">
                            <h5 class="mb-3">
                                <i class="fas fa-info me-2 text-info"></i>Informations générales
                            </h5>
                            <div class="infos-content">
                                {!! nl2br(e($voyage->informations_generales)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 120px;">
                <!-- Carte de réservation -->
                <div class="reservation-card p-4 rounded-3 border shadow-sm mb-4">
                    <div class="text-center mb-4">
                        <div class="price-display">
                            <div class="price-eur h4 mb-1 text-primary fw-bold">{{ $voyage->prix_base_eur_formate }}</div>
                            <div class="price-fcfa text-muted">{{ $voyage->prix_base_formate }}</div>
                            @if($voyage->prix_avec_guide)
                                <div class="price-guide small text-success mt-1">
                                    Avec guide : {{ $voyage->prix_avec_guide_eur_formate }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="reservation-form">
                        @auth
                            <a href="{{ route('voyages.reservation', $voyage->id) }}" class="vs-btn w-100 mb-3">
                                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="vs-btn w-100 mb-3">
                                <i class="fas fa-user-plus me-2"></i>S'inscrire pour réserver
                            </a>
                            <a href="{{ route('login') }}" class="vs-btn style2 w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </a>
                        @endauth
                        
                        <a href="{{ route('contact') }}" class="vs-btn style3 w-100">
                            <i class="fas fa-comments me-2"></i>Demander des infos
                        </a>
                    </div>
                </div>

                <!-- Informations voyage -->
                <div class="voyage-info-card p-4 rounded-3 border shadow-sm mb-4">
                    <h5 class="mb-3">Informations voyage</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-calendar me-2 text-muted"></i>Durée :</span>
                            <strong>{{ $voyage->duree_formatee }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-users me-2 text-muted"></i>Participants :</span>
                            <strong>{{ $voyage->participants_min }}-{{ $voyage->participants_max }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-mountain me-2 text-muted"></i>Difficulté :</span>
                            <strong>{{ $voyage->difficulte_label }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-route me-2 text-muted"></i>Étapes :</span>
                            <strong>{{ $voyage->nombre_etapes }}</strong>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span><i class="fas fa-hiking me-2 text-muted"></i>Activités :</span>
                            <strong>{{ $voyage->nombre_activites }}</strong>
                        </li>
                    </ul>
                </div>

                <!-- Contact direct -->
                <div class="contact-card p-4 rounded-3 bg-primary text-white">
                    <h5 class="mb-3">Une question ?</h5>
                    <p class="mb-3">Nos experts voyage sont à votre disposition</p>
                    <div class="contact-info">
                        <div class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:+221123456789" class="text-white">+221 12 345 67 89</a>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:info@vacancesenegal.com" class="text-white">info@vacancesenegal.com</a>
                        </div>
                        <div>
                            <i class="fab fa-whatsapp me-2"></i>
                            <a href="https://wa.me/221123456789" class="text-white">WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Galerie -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img src="" alt="Photo voyage" class="img-fluid w-100" id="modalImage">
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.hero-section {
    margin-bottom: 0;
}

.nav-pills .nav-link {
    color: #666;
    background: none;
    border-radius: 8px;
    padding: 12px 20px;
    margin-right: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.nav-pills .nav-link:hover,
.nav-pills .nav-link.active {
    background-color: #FF6B35;
    color: white;
}

.section-title {
    color: #333;
    font-weight: 700;
    border-bottom: 3px solid #FF6B35;
    padding-bottom: 10px;
    display: inline-block;
}

.content-card {
    background: #fff;
    transition: all 0.3s ease;
}

.content-card:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.timeline-container {
    position: relative;
    padding-left: 30px;
}

.timeline-container::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #FF6B35, #e55a2b);
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 10px;
    z-index: 2;
}

.timeline-day {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FF6B35, #e55a2b);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.timeline-more {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
}

.timeline-content {
    margin-left: 30px;
}

.activity-card {
    transition: all 0.3s ease;
}

.activity-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.inclusions-card {
    background: rgba(var(--bs-success-rgb), 0.05);
}

.info-card {
    background: #fff;
    transition: all 0.3s ease;
}

.info-card:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.reservation-card {
    background: #fff;
    border: 2px solid #f8f9fa;
}

.voyage-info-card {
    background: #f8f9fa;
}

.contact-card {
    background: linear-gradient(135deg, #FF6B35, #e55a2b) !important;
}

.vs-btn.style3 {
    background: transparent;
    color: #6c757d;
    border: 2px solid #dee2e6;
}

.vs-btn.style3:hover {
    background: #6c757d;
    color: white;
    border-color: #6c757d;
}

.gallery-item img {
    transition: all 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
    .hero-section {
        height: 50vh;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .timeline-container {
        padding-left: 20px;
    }
    
    .timeline-content {
        margin-left: 20px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Smooth scrolling pour les ancres
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Gestion des tabs sticky
window.addEventListener('scroll', function() {
    const tabs = document.getElementById('voyage-tabs');
    const sections = document.querySelectorAll('section[id]');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 150;
        if (window.scrollY >= sectionTop) {
            current = section.getAttribute('id');
        }
    });
    
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + current) {
            link.classList.add('active');
        }
    });
});

// Modal galerie
document.querySelectorAll('[data-bs-toggle="modal"]').forEach(item => {
    item.addEventListener('click', function() {
        const imageSrc = this.getAttribute('data-image');
        document.getElementById('modalImage').src = imageSrc;
    });
});

// Tracking consultation
@auth
fetch(`/voyages/{{ $voyage->id }}/track-consultation`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({type: 'detail'})
});
@endauth
</script>
@endpush

@endsection