@extends('frontend.main_master')

@section('main')
<div class="breadcumb-wrapper" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset($voyage->image_principale) }}');">
    <div class="container">
        <div class="breadcumb-content text-center">
            <h1 class="breadcumb-title text-white">Programme détaillé</h1>
            <h2 class="text-white-50 mb-3">{{ $voyage->nom_voyage }}</h2>
            <ul class="breadcumb-menu justify-content-center">
                <li><a href="{{url('/')}}">Accueil</a></li>
                <li><a href="{{ route('voyages.index') }}">Voyages</a></li>
                <li><a href="{{ route('voyages.detail', $voyage->id) }}">{{ Str::limit($voyage->nom_voyage, 30) }}</a></li>
                <li>Programme</li>
            </ul>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- En-tête du programme -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <div class="programme-header p-4 rounded-3 bg-light">
                <h2 class="mb-3">Programme de {{ $voyage->duree_jours }} jours</h2>
                <div class="row g-3 justify-content-center">
                    <div class="col-auto">
                        <span class="badge bg-primary fs-6 px-3 py-2">{{ $voyage->type_voyage_label }}</span>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-success fs-6 px-3 py-2">{{ $voyage->region }}</span>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2">{{ $voyage->difficulte_label }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Programme Timeline -->
            <div class="programme-timeline">
                @foreach($voyage->etapes as $etape)
                <div class="timeline-item {{ $loop->iteration > 3 && !auth()->check() ? 'timeline-locked' : '' }}" data-jour="{{ $etape->numero_jour }}">
                    <div class="timeline-marker">
                        <div class="timeline-day {{ $loop->iteration > 3 && !auth()->check() ? 'locked' : '' }}">
                            @if($loop->iteration > 3 && !auth()->check())
                                <i class="fas fa-lock"></i>
                            @else
                                {{ $etape->numero_jour }}
                            @endif
                        </div>
                    </div>
                    
                    <div class="timeline-content">
                        <div class="etape-card {{ $loop->iteration > 3 && !auth()->check() ? 'locked-content' : '' }}">
                            @if($loop->iteration <= 3 || auth()->check())
                            <!-- Contenu complet de l'étape -->
                            <div class="etape-header d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h4 class="etape-title mb-2">
                                        <span class="jour-badge">Jour {{ $etape->numero_jour }}</span>
                                        {{ $etape->titre_etape }}
                                    </h4>
                                    @if($etape->heures_formatees)
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-clock me-2"></i>{{ $etape->heures_formatees }}
                                        </p>
                                    @endif
                                </div>
                                @if($etape->duree_etape)
                                <span class="badge bg-info">{{ $etape->duree_etape }}h</span>
                                @endif
                            </div>

                            <div class="etape-description mb-4">
                                <p>{{ $etape->description_etape }}</p>
                            </div>

                            <!-- Lieux de départ et d'arrivée -->
                            @if($etape->lieu_depart || $etape->lieu_arrivee)
                            <div class="etape-lieux mb-4">
                                <div class="row g-2">
                                    @if($etape->lieu_depart)
                                    <div class="col-sm-6">
                                        <div class="lieu-card p-3 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25">
                                            <div class="d-flex align-items-center">
                                                <div class="lieu-icon me-3">
                                                    <i class="fas fa-play-circle text-success"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">Départ</div>
                                                    <div class="text-muted small">{{ $etape->lieu_depart }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($etape->lieu_arrivee)
                                    <div class="col-sm-6">
                                        <div class="lieu-card p-3 rounded-3 bg-danger bg-opacity-10 border border-danger border-opacity-25">
                                            <div class="d-flex align-items-center">
                                                <div class="lieu-icon me-3">
                                                    <i class="fas fa-stop-circle text-danger"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">Arrivée</div>
                                                    <div class="text-muted small">{{ $etape->lieu_arrivee }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Activités du jour -->
                            @if($etape->activites_jour && count($etape->activites_jour) > 0)
                            <div class="etape-activites mb-4">
                                <h6 class="mb-3">
                                    <i class="fas fa-hiking me-2 text-primary"></i>Activités prévues
                                </h6>
                                <div class="activites-list">
                                    @foreach($etape->activites_jour as $activite)
                                    <div class="activite-item d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span>{{ $activite }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Hébergement -->
                            @if($etape->hebergement_etape)
                            <div class="etape-hebergement mb-4">
                                <h6 class="mb-2">
                                    <i class="fas fa-bed me-2 text-warning"></i>Hébergement
                                </h6>
                                <div class="hebergement-card p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-25">
                                    <span>{{ $etape->hebergement_etape }}</span>
                                </div>
                            </div>
                            @endif

                            <!-- Notes spéciales -->
                            @if($etape->notes_speciales)
                            <div class="etape-notes">
                                <h6 class="mb-2">
                                    <i class="fas fa-sticky-note me-2 text-info"></i>Notes importantes
                                </h6>
                                <div class="notes-card p-3 rounded-3 bg-info bg-opacity-10 border border-info border-opacity-25">
                                    {{ $etape->notes_speciales }}
                                </div>
                            </div>
                            @endif

                            @else
                            <!-- Contenu verrouillé -->
                            <div class="locked-overlay text-center py-5">
                                <div class="lock-icon mb-3">
                                    <i class="fas fa-lock fa-3x text-muted"></i>
                                </div>
                                <h5 class="mb-3">Jour {{ $etape->numero_jour }} - {{ $etape->titre_etape }}</h5>
                                <p class="text-muted mb-4">Cette partie du programme est réservée aux membres inscrits</p>
                                <div class="blur-preview p-3 rounded bg-light position-relative">
                                    <div class="blur-content">
                                        {{ Str::limit($etape->description_etape, 100) }}...
                                    </div>
                                    <div class="blur-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                        <div class="unlock-buttons">
                                            <a href="{{ route('login') }}" class="vs-btn me-2">
                                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                            </a>
                                            <a href="{{ route('register') }}" class="vs-btn style2">
                                                <i class="fas fa-user-plus me-2"></i>S'inscrire gratuitement
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Message d'encouragement pour l'inscription -->
            @if($needsAuth)
            <div class="inscription-cta mt-5">
                <div class="cta-card p-5 rounded-3 text-center" style="background: linear-gradient(135deg, #FF6B35, #e55a2b); color: white;">
                    <div class="cta-icon mb-4">
                        <i class="fas fa-map-marked-alt fa-4x opacity-75"></i>
                    </div>
                    <h3 class="mb-3">Découvrez le programme complet !</h3>
                    <p class="mb-4 fs-5">
                        Encore {{ $voyage->etapes->count() - 3 }} jours d'aventures vous attendent dans ce voyage exceptionnel. 
                        Inscrivez-vous gratuitement pour accéder à tous les détails.
                    </p>
                    <div class="cta-benefits mb-4">
                        <div class="row g-3 justify-content-center">
                            <div class="col-auto">
                                <div class="benefit-item">
                                    <i class="fas fa-eye me-2"></i>Programme détaillé complet
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="benefit-item">
                                    <i class="fas fa-calendar-check me-2"></i>Possibilité de réservation
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="benefit-item">
                                    <i class="fas fa-headset me-2"></i>Support client personnalisé
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cta-buttons">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3">
                            <i class="fas fa-user-plus me-2"></i>S'inscrire gratuitement
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>J'ai déjà un compte
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 120px;">
                <!-- Résumé du voyage -->
                <div class="voyage-summary-card p-4 rounded-3 border shadow-sm mb-4">
                    <h5 class="mb-3">Résumé du voyage</h5>
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-calendar me-2 text-muted"></i>Durée :</span>
                            <strong>{{ $voyage->duree_formatee }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-route me-2 text-muted"></i>Étapes :</span>
                            <strong>{{ $voyage->etapes->count() }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-users me-2 text-muted"></i>Participants :</span>
                            <strong>{{ $voyage->participants_min }}-{{ $voyage->participants_max }}</strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-mountain me-2 text-muted"></i>Difficulté :</span>
                            <strong>{{ $voyage->difficulte_label }}</strong>
                        </li>
                    </ul>
                    
                    <div class="price-display text-center mb-4">
                        <div class="price-eur h4 mb-1 text-primary fw-bold">{{ $voyage->prix_base_eur_formate }}</div>
                        <div class="price-fcfa text-muted">{{ $voyage->prix_base_formate }}</div>
                    </div>
                    
                    @auth
                        <a href="{{ route('voyages.reservation', $voyage->id) }}" class="vs-btn w-100">
                            <i class="fas fa-calendar-check me-2"></i>Réserver ce voyage
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="vs-btn w-100">
                            <i class="fas fa-user-plus me-2"></i>S'inscrire pour réserver
                        </a>
                    @endauth
                </div>

                <!-- Navigation du programme -->
                <div class="programme-nav-card p-4 rounded-3 border shadow-sm mb-4">
                    <h6 class="mb-3">Navigation rapide</h6>
                    <div class="nav-list">
                        @foreach($voyage->etapes as $etape)
                        <div class="nav-item {{ $loop->iteration > 3 && !auth()->check() ? 'nav-locked' : '' }}" 
                             data-target="jour-{{ $etape->numero_jour }}">
                            <div class="d-flex align-items-center p-2 rounded cursor-pointer nav-link-item">
                                @if($loop->iteration > 3 && !auth()->check())
                                    <i class="fas fa-lock me-2 text-muted"></i>
                                @else
                                    <div class="nav-day-number me-2">{{ $etape->numero_jour }}</div>
                                @endif
                                <div class="nav-content">
                                    <div class="nav-title">{{ Str::limit($etape->titre_etape, 25) }}</div>
                                    @if($loop->iteration > 3 && !auth()->check())
                                        <div class="nav-subtitle text-muted small">Contenu verrouillé</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="quick-actions-card p-4 rounded-3 bg-light">
                    <h6 class="mb-3">Actions rapides</h6>
                    <div class="d-grid gap-2">
                        <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Retour aux détails
                        </a>
                        <a href="{{ route('voyages.galerie', $voyage->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-images me-2"></i>Voir la galerie
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-info">
                            <i class="fas fa-comments me-2"></i>Poser une question
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.programme-timeline {
    position: relative;
    padding-left: 40px;
}

.programme-timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(to bottom, #FF6B35, #e55a2b, #FF6B35);
}

.timeline-item {
    position: relative;
    margin-bottom: 40px;
}

.timeline-marker {
    position: absolute;
    left: -28px;
    top: 0;
    z-index: 2;
}

.timeline-day {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FF6B35, #e55a2b);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
    border: 4px solid white;
}

.timeline-day.locked {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
}

.timeline-content {
    margin-left: 40px;
}

.etape-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.etape-card:hover:not(.locked-content) {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.locked-content {
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
    opacity: 0.8;
}

.jour-badge {
    background: linear-gradient(135deg, #FF6B35, #e55a2b);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.lieu-card {
    transition: all 0.3s ease;
}

.lieu-card:hover {
    transform: translateX(5px);
}

.activite-item {
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fa;
}

.activite-item:last-child {
    border-bottom: none;
}

.locked-overlay {
    background: rgba(248, 249, 250, 0.95);
    border-radius: 15px;
    border: 2px dashed #dee2e6;
}

.blur-preview {
    filter: blur(3px);
    pointer-events: none;
}

.blur-overlay {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(5px);
    border-radius: inherit;
}

.cta-card {
    box-shadow: 0 20px 60px rgba(255, 107, 53, 0.3);
}

.benefit-item {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
}

.nav-link-item {
    transition: all 0.3s ease;
    cursor: pointer;
}

.nav-link-item:hover:not(.nav-locked .nav-link-item) {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.nav-locked .nav-link-item {
    opacity: 0.6;
    cursor: not-allowed;
}

.nav-day-number {
    width: 24px;
    height: 24px;
    background: #FF6B35;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
}

.nav-title {
    font-weight: 600;
    font-size: 0.9rem;
}

.nav-subtitle {
    font-size: 0.75rem;
}

.voyage-summary-card,
.programme-nav-card,
.quick-actions-card {
    background: white;
    border: 1px solid #e9ecef;
}

@media (max-width: 768px) {
    .programme-timeline {
        padding-left: 30px;
    }
    
    .timeline-content {
        margin-left: 30px;
    }
    
    .timeline-day {
        width: 44px;
        height: 44px;
        font-size: 14px;
    }
    
    .timeline-marker {
        left: -22px;
    }
    
    .etape-card {
        padding: 20px;
    }
    
    .cta-benefits .col-auto {
        flex: 0 0 auto;
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Smooth scrolling pour la navigation rapide
document.querySelectorAll('.nav-link-item').forEach(item => {
    item.addEventListener('click', function() {
        if (this.closest('.nav-locked')) return;
        
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

document.querySelectorAll('.timeline-item').forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(30px)';
    item.style.transition = 'all 0.6s ease';
    observer.observe(item);
});

// Tracking consultation pour utilisateurs connectés
@auth
fetch(`/voyages/{{ $voyage->id }}/track-consultation`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({type: 'programme'})
});
@endauth

// Tracking des tentatives d'accès aux contenus verrouillés
document.querySelectorAll('.locked-content').forEach(item => {
    item.addEventListener('click', function() {
        // Analytics ou tracking des clics sur contenu verrouillé
        console.log('Tentative d\'accès au contenu verrouillé');
        
        // Optionnel: afficher une modal d'inscription
        if (confirm('Ce contenu est réservé aux membres. Souhaitez-vous vous inscrire gratuitement ?')) {
            window.location.href = '{{ route("register") }}';
        }
    });
});
</script>
@endpush

@endsection