@extends('frontend.main_master')

@section('main')
<!-- Hero Section Émotionnel -->
<div class="programme-hero">
    <div class="hero-background" style="background-image: url('{{ asset($voyage->image_principale) }}')"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="hero-text">
                <h1 class="hero-title">Programme détaillé</h1>
                <h2 class="hero-subtitle">{{ $voyage->nom_voyage }}</h2>
                <div class="hero-badges">
                    <span class="hero-badge">📅 {{ $voyage->duree_jours }} jours</span>
                    <span class="hero-badge">📍 {{ $voyage->region }}</span>
                    <span class="hero-badge">⭐ {{ $voyage->difficulte_label }}</span>
                </div>
                <nav class="hero-breadcrumb">
                    <a href="{{url('/')}}">🏠 Accueil</a>
                    <span>→</span>
                    <a href="{{ route('voyages.index') }}">✈️ Voyages</a>
                    <span>→</span>
                    <a href="{{ route('voyages.detail', $voyage->id) }}">{{ Str::limit($voyage->nom_voyage, 30) }}</a>
                    <span>→</span>
                    <span>📋 Programme</span>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- En-tête du programme moderne -->
    <div class="programme-intro">
        <div class="intro-card">
            <h2 class="intro-title">
                Votre aventure de <span class="accent-text">{{ $voyage->duree_jours }} jours</span>
            </h2>
            <p class="intro-description">
                Découvrez chaque moment de votre voyage au Sénégal, minutieusement planifié pour vous offrir une expérience inoubliable
            </p>
            <div class="intro-stats">
                <div class="stat-item">
                    <div class="stat-icon">🗺️</div>
                    <div class="stat-text">{{ $voyage->type_voyage_label }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">🌍</div>
                    <div class="stat-text">{{ $voyage->region }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">⚡</div>
                    <div class="stat-text">{{ $voyage->difficulte_label }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Timeline Moderne des Étapes -->
            <div class="etapes-container">
                @foreach($voyage->etapes as $etape)
                <div class="etape-card {{ $loop->iteration > 3 && !auth()->check() ? 'etape-locked' : '' }}" data-day="{{ $etape->numero_jour }}">
                    <div class="etape-timeline-marker">
                        <div class="day-circle {{ $loop->iteration > 3 && !auth()->check() ? 'locked' : '' }}">
                            @if($loop->iteration > 3 && !auth()->check())
                                🔒
                            @else
                                {{ $etape->numero_jour }}
                            @endif
                        </div>
                        @if(!$loop->last)
                            <div class="timeline-connector"></div>
                        @endif
                    </div>
                    
                    <div class="etape-content">
                        @if($loop->iteration <= 3 || auth()->check())
                        <!-- Contenu accessible -->
                        <div class="etape-header">
                            <div class="day-badge">Jour {{ $etape->numero_jour }}</div>
                            <h3 class="etape-title">{{ $etape->titre_etape }}</h3>
                            @if($etape->heures_formatees)
                                <div class="etape-timing">🕐 {{ $etape->heures_formatees }}</div>
                            @endif
                            @if($etape->duree_etape)
                                <div class="etape-duration">⏱️ {{ $etape->duree_etape }}h</div>
                            @endif
                        </div>

                        <div class="etape-description">
                            {{ $etape->description_etape }}
                        </div>

                        <!-- Lieux -->
                        @if($etape->lieu_depart || $etape->lieu_arrivee)
                        <div class="etape-lieux">
                            @if($etape->lieu_depart)
                                <div class="lieu-item lieu-depart">
                                    <div class="lieu-icon">🚀</div>
                                    <div class="lieu-info">
                                        <div class="lieu-label">Point de départ</div>
                                        <div class="lieu-name">{{ $etape->lieu_depart }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($etape->lieu_arrivee)
                                <div class="lieu-item lieu-arrivee">
                                    <div class="lieu-icon">🏁</div>
                                    <div class="lieu-info">
                                        <div class="lieu-label">Point d'arrivée</div>
                                        <div class="lieu-name">{{ $etape->lieu_arrivee }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @endif

                        <!-- Activités -->
                        @if($etape->activites_jour && count($etape->activites_jour) > 0)
                        <div class="etape-activites">
                            <h4 class="section-title">🎯 Activités prévues</h4>
                            <div class="activites-grid">
                                @foreach($etape->activites_jour as $activite)
                                    <div class="activite-card">
                                        <div class="activite-check">✅</div>
                                        <div class="activite-text">{{ $activite }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Hébergement -->
                        @if($etape->hebergement_etape)
                        <div class="etape-hebergement">
                            <h4 class="section-title">🏨 Hébergement</h4>
                            <div class="hebergement-card">
                                <div class="hebergement-icon">🛏️</div>
                                <div class="hebergement-name">{{ $etape->hebergement_etape }}</div>
                            </div>
                        </div>
                        @endif

                        <!-- Notes spéciales -->
                        @if($etape->notes_speciales)
                        <div class="etape-notes">
                            <h4 class="section-title">📝 À noter</h4>
                            <div class="notes-card">
                                <div class="notes-icon">💡</div>
                                <div class="notes-text">{{ $etape->notes_speciales }}</div>
                            </div>
                        </div>
                        @endif

                        @else
                        <!-- Contenu verrouillé moderne -->
                        <div class="locked-content">
                            <div class="locked-header">
                                <div class="lock-icon">🔐</div>
                                <h3 class="locked-title">Jour {{ $etape->numero_jour }} - {{ $etape->titre_etape }}</h3>
                                <p class="locked-subtitle">Contenu exclusif pour nos membres</p>
                            </div>
                            
                            <div class="locked-preview">
                                <div class="preview-text">
                                    {{ Str::limit($etape->description_etape, 80) }}...
                                </div>
                                <div class="unlock-overlay">
                                    <div class="unlock-content">
                                        <h5>🎁 Débloquez ce contenu</h5>
                                        <p>Inscription gratuite et instantanée</p>
                                        <div class="unlock-actions">
                                            <a href="{{ route('register') }}" class="unlock-btn primary">
                                                ✨ S'inscrire gratuitement
                                            </a>
                                            <a href="{{ route('login') }}" class="unlock-btn secondary">
                                                🔑 Se connecter
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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

        <!-- Sidebar Moderne -->
        <div class="col-lg-4">
            <div class="sidebar-sticky">
                <!-- Résumé du voyage -->
                <div class="summary-card">
                    <h4 class="summary-title">🎯 Résumé du voyage</h4>
                    <div class="summary-stats">
                        <div class="stat-row">
                            <div class="stat-label">📅 Durée</div>
                            <div class="stat-value">{{ $voyage->duree_formatee }}</div>
                        </div>
                        <div class="stat-row">
                            <div class="stat-label">🗺️ Étapes</div>
                            <div class="stat-value">{{ $voyage->etapes->count() }}</div>
                        </div>
                        <div class="stat-row">
                            <div class="stat-label">👥 Participants</div>
                            <div class="stat-value">{{ $voyage->participants_min }}-{{ $voyage->participants_max }}</div>
                        </div>
                        <div class="stat-row">
                            <div class="stat-label">⚡ Difficulté</div>
                            <div class="stat-value">{{ $voyage->difficulte_label }}</div>
                        </div>
                    </div>
                    
                    <div class="price-section">
                        <div class="price-main">{{ $voyage->prix_base_eur_formate }}</div>
                        <div class="price-secondary">{{ $voyage->prix_base_formate }}</div>
                        <div class="price-note">Prix par personne</div>
                    </div>
                    
                    <div class="cta-section">
                        @auth
                            <a href="{{ route('voyages.reservation', $voyage->id) }}" class="cta-btn primary">
                                🎟️ Réserver maintenant
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="cta-btn primary">
                                ✨ S'inscrire pour réserver
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Navigation du programme -->
                <div class="navigation-card">
                    <h4 class="nav-title">🧭 Navigation rapide</h4>
                    <div class="days-navigator">
                        @foreach($voyage->etapes as $etape)
                        <div class="day-nav-item {{ $loop->iteration > 3 && !auth()->check() ? 'nav-locked' : '' }}" 
                             onclick="scrollToDay({{ $etape->numero_jour }})">
                            <div class="day-nav-circle">
                                @if($loop->iteration > 3 && !auth()->check())
                                    🔒
                                @else
                                    {{ $etape->numero_jour }}
                                @endif
                            </div>
                            <div class="day-nav-info">
                                <div class="day-nav-title">{{ Str::limit($etape->titre_etape, 20) }}</div>
                                @if($loop->iteration > 3 && !auth()->check())
                                    <div class="day-nav-lock">🔐 Verrouillé</div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="actions-card">
                    <h4 class="actions-title">⚡ Actions rapides</h4>
                    <div class="quick-actions">
                        <a href="{{ route('voyages.detail', $voyage->id) }}" class="action-btn">
                            ⬅️ Détails du voyage
                        </a>
                        <a href="{{ route('voyages.galerie', $voyage->id) }}" class="action-btn">
                            🖼️ Galerie photos
                        </a>
                        <a href="{{ route('contact') }}" class="action-btn">
                            💬 Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Import des polices émotionnelles */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap');

/* Variables de couleur inspirantes */
:root {
    --primary-orange: #ea580c;
    --warm-orange: #f97316;
    --soft-orange: #fed7aa;
    --trust-blue: #1e40af;
    --success-green: #059669;
    --warm-gray: #64748b;
    --light-gray: #f8fafc;
    --gradient-primary: linear-gradient(135deg, #ea580c, #f97316);
    --gradient-trust: linear-gradient(135deg, #1e40af, #3b82f6);
    --shadow-soft: 0 4px 20px rgba(0, 0, 0, 0.08);
    --shadow-hover: 0 12px 40px rgba(0, 0, 0, 0.15);
}

/* Hero Section Émotionnel */
.programme-hero {
    position: relative;
    height: 70vh;
    min-height: 500px;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-size: cover;
    background-position: center;
    filter: brightness(0.7);
    transition: transform 0.8s ease;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(234, 88, 12, 0.8), rgba(30, 64, 175, 0.6));
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
    text-align: center;
    width: 100%;
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.02em;
}

.hero-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 1.8rem;
    font-weight: 300;
    margin-bottom: 2rem;
    opacity: 0.95;
    font-style: italic;
}

.hero-badges {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.hero-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1.2rem;
    border-radius: 25px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    font-weight: 500;
    font-size: 0.9rem;
}

.hero-breadcrumb {
    font-family: 'Inter', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    opacity: 0.9;
}

.hero-breadcrumb a {
    color: white;
    text-decoration: none;
    transition: color 0.2s ease;
}

.hero-breadcrumb a:hover {
    color: var(--soft-orange);
}

/* Section Intro */
.programme-intro {
    margin: 3rem auto;
    max-width: 800px;
}

.intro-card {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: var(--shadow-soft);
    text-align: center;
    border: 1px solid rgba(234, 88, 12, 0.1);
}

.intro-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    color: #1f2937;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.accent-text {
    color: var(--primary-orange);
    font-weight: 600;
}

.intro-description {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    color: var(--warm-gray);
    line-height: 1.6;
    margin-bottom: 2rem;
}

.intro-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: var(--light-gray);
    border-radius: 12px;
    min-width: 120px;
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
    background: var(--soft-orange);
}

.stat-icon {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.stat-text {
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

/* Timeline des Étapes */
.etapes-container {
    position: relative;
}

.etapes-container::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 4px;
    background: var(--gradient-primary);
    border-radius: 2px;
    opacity: 0.8;
}

.etape-card {
    position: relative;
    margin-bottom: 3rem;
    display: flex;
    align-items: flex-start;
    gap: 2rem;
}

.etape-timeline-marker {
    position: relative;
    z-index: 2;
}

.day-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 700;
    color: white;
    box-shadow: 0 8px 25px rgba(234, 88, 12, 0.3);
    border: 4px solid white;
    font-family: 'Inter', sans-serif;
}

.day-circle.locked {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    box-shadow: 0 8px 25px rgba(107, 114, 128, 0.3);
}

.timeline-connector {
    position: absolute;
    top: 60px;
    left: 50%;
    transform: translateX(-50%);
    width: 2px;
    height: 60px;
    background: var(--gradient-primary);
    opacity: 0.6;
}

.etape-content {
    flex: 1;
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: var(--shadow-soft);
    border: 1px solid rgba(234, 88, 12, 0.1);
    transition: all 0.4s ease;
}

.etape-content:hover:not(.etape-locked .etape-content) {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.etape-header {
    margin-bottom: 1.5rem;
}

.day-badge {
    display: inline-block;
    background: var(--gradient-trust);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
}

.etape-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.etape-timing, .etape-duration {
    display: inline-block;
    background: var(--light-gray);
    padding: 0.3rem 0.8rem;
    border-radius: 10px;
    font-size: 0.85rem;
    color: var(--warm-gray);
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.etape-description {
    font-family: 'Inter', sans-serif;
    font-size: 1.05rem;
    line-height: 1.7;
    color: #374151;
    margin-bottom: 1.5rem;
    font-weight: 400;
}

/* Lieux */
.etape-lieux {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.lieu-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 15px;
    background: var(--light-gray);
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.lieu-depart {
    border-color: var(--success-green);
    background: rgba(5, 150, 105, 0.05);
}

.lieu-arrivee {
    border-color: var(--primary-orange);
    background: rgba(234, 88, 12, 0.05);
}

.lieu-item:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.lieu-icon {
    font-size: 1.5rem;
    margin-right: 1rem;
}

.lieu-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--warm-gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.lieu-name {
    font-size: 1.1rem;
    font-weight: 500;
    color: #1f2937;
    margin-top: 0.2rem;
}

/* Activités */
.etape-activites {
    margin-bottom: 1.5rem;
}

.section-title {
    font-family: 'Inter', sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.activites-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.8rem;
}

.activite-card {
    display: flex;
    align-items: center;
    padding: 0.8rem 1rem;
    background: rgba(5, 150, 105, 0.05);
    border-radius: 12px;
    border-left: 4px solid var(--success-green);
    transition: all 0.3s ease;
}

.activite-card:hover {
    transform: translateX(5px);
    background: rgba(5, 150, 105, 0.1);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.15);
}

.activite-check {
    margin-right: 0.8rem;
    font-size: 1.1rem;
}

.activite-text {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    color: #374151;
    font-weight: 500;
}

/* Hébergement */
.etape-hebergement {
    margin-bottom: 1.5rem;
}

.hebergement-card {
    display: flex;
    align-items: center;
    padding: 1.2rem;
    background: rgba(251, 146, 60, 0.05);
    border-radius: 15px;
    border: 2px solid rgba(251, 146, 60, 0.2);
    transition: all 0.3s ease;
}

.hebergement-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(251, 146, 60, 0.15);
}

.hebergement-icon {
    font-size: 1.5rem;
    margin-right: 1rem;
}

.hebergement-name {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1f2937;
}

/* Notes spéciales */
.etape-notes {
    margin-bottom: 1rem;
}

.notes-card {
    display: flex;
    align-items: flex-start;
    padding: 1.2rem;
    background: rgba(14, 165, 233, 0.05);
    border-radius: 15px;
    border: 2px solid rgba(14, 165, 233, 0.2);
    transition: all 0.3s ease;
}

.notes-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(14, 165, 233, 0.15);
}

.notes-icon {
    font-size: 1.2rem;
    margin-right: 1rem;
    margin-top: 0.2rem;
}

.notes-text {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    line-height: 1.6;
    color: #374151;
}

/* Contenu verrouillé */
.locked-content {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border: 2px dashed #cbd5e1;
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
}

.locked-header {
    margin-bottom: 1.5rem;
}

.lock-icon {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.locked-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: #475569;
    margin-bottom: 0.5rem;
}

.locked-subtitle {
    color: #64748b;
    font-style: italic;
}

.locked-preview {
    position: relative;
    background: white;
    padding: 1.5rem;
    border-radius: 15px;
    margin-bottom: 1.5rem;
}

.preview-text {
    filter: blur(2px);
    color: #94a3b8;
    line-height: 1.6;
}

.unlock-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(5px);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.unlock-content h5 {
    color: var(--primary-orange);
    margin-bottom: 0.5rem;
}

.unlock-content p {
    color: #64748b;
    margin-bottom: 1rem;
}

.unlock-actions {
    display: flex;
    gap: 0.8rem;
    flex-wrap: wrap;
    justify-content: center;
}

.unlock-btn {
    padding: 0.6rem 1.2rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.unlock-btn.primary {
    background: var(--gradient-primary);
    color: white;
    box-shadow: 0 4px 15px rgba(234, 88, 12, 0.3);
}

.unlock-btn.primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 88, 12, 0.4);
}

.unlock-btn.secondary {
    background: white;
    color: var(--primary-orange);
    border: 2px solid var(--primary-orange);
}

.unlock-btn.secondary:hover {
    background: var(--primary-orange);
    color: white;
}

/* SIDEBAR MODERNE */
.sidebar-sticky {
    position: sticky;
    top: 120px;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Carte Résumé */
.summary-card {
    background: white;
    border-radius: 20px;
    padding: 1.8rem;
    box-shadow: var(--shadow-soft);
    border: 1px solid rgba(234, 88, 12, 0.1);
}

.summary-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    color: #1f2937;
    margin-bottom: 1.5rem;
    text-align: center;
}

.summary-stats {
    margin-bottom: 1.8rem;
}

.stat-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.8rem;
    margin-bottom: 0.5rem;
    background: var(--light-gray);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.stat-row:hover {
    background: var(--soft-orange);
    transform: translateX(3px);
}

.stat-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    color: var(--warm-gray);
    font-weight: 500;
}

.stat-value {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    color: #1f2937;
}

.price-section {
    text-align: center;
    padding: 1.5rem;
    background: var(--gradient-primary);
    border-radius: 15px;
    margin-bottom: 1.5rem;
    color: white;
}

.price-main {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.price-secondary {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 0.5rem;
}

.price-note {
    font-size: 0.85rem;
    opacity: 0.8;
    font-style: italic;
}

.cta-section .cta-btn {
    display: block;
    width: 100%;
    padding: 1rem;
    background: white;
    color: var(--primary-orange);
    text-decoration: none;
    border-radius: 15px;
    font-weight: 700;
    font-size: 1.1rem;
    text-align: center;
    border: 2px solid var(--primary-orange);
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(234, 88, 12, 0.2);
}

.cta-btn:hover {
    background: var(--primary-orange);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(234, 88, 12, 0.3);
}

/* Navigation Card */
.navigation-card {
    background: white;
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: var(--shadow-soft);
    border: 1px solid rgba(30, 64, 175, 0.1);
}

.nav-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: #1f2937;
    margin-bottom: 1.2rem;
    text-align: center;
}

.days-navigator {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.day-nav-item {
    display: flex;
    align-items: center;
    padding: 0.8rem;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--light-gray);
}

.day-nav-item:hover:not(.nav-locked) {
    background: var(--soft-orange);
    transform: translateX(5px);
}

.day-nav-item.nav-locked {
    opacity: 0.6;
    cursor: not-allowed;
}

.day-nav-item.active {
    background: var(--soft-orange);
    border: 2px solid var(--primary-orange);
    box-shadow: 0 4px 15px rgba(234, 88, 12, 0.2);
}

.day-nav-item.active .day-nav-circle {
    background: var(--gradient-primary);
    box-shadow: 0 4px 15px rgba(234, 88, 12, 0.3);
}

.day-nav-circle {
    width: 35px;
    height: 35px;
    background: var(--gradient-trust);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    margin-right: 1rem;
}

.day-nav-info {
    flex: 1;
}

.day-nav-title {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.9rem;
}

.day-nav-lock {
    font-size: 0.75rem;
    color: #64748b;
    font-style: italic;
}

/* Actions Card */
.actions-card {
    background: white;
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: var(--shadow-soft);
    border: 1px solid rgba(5, 150, 105, 0.1);
}

.actions-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: #1f2937;
    margin-bottom: 1.2rem;
    text-align: center;
}

.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.action-btn {
    display: block;
    padding: 1rem;
    background: var(--light-gray);
    border: 2px solid transparent;
    border-radius: 12px;
    text-decoration: none;
    color: #374151;
    font-weight: 600;
    transition: all 0.3s ease;
    text-align: center;
}

.action-btn:hover {
    background: var(--success-green);
    color: white;
    border-color: var(--success-green);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(5, 150, 105, 0.25);
}

/* Responsive Design */
@media (max-width: 992px) {
    .sidebar-sticky {
        position: static;
        margin-top: 3rem;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
    }
    
    .etape-card {
        flex-direction: column;
        gap: 1rem;
    }
    
    .etapes-container::before {
        display: none;
    }
    
    .etape-content {
        padding: 1.5rem;
    }
    
    .intro-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .stat-item {
        width: 100%;
    }
}
@endpush

@push('scripts')
<script>
// Smooth scrolling pour la navigation moderne
function scrollToDay(dayNumber) {
    const targetElement = document.querySelector(`[data-day="${dayNumber}"]`);
    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
        
        // Animation de highlight
        targetElement.style.transform = 'scale(1.02)';
        targetElement.style.transition = 'transform 0.3s ease';
        
        setTimeout(() => {
            targetElement.style.transform = '';
        }, 500);
    }
}

// Animation d'entrée des cartes au scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const cardObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }, index * 200); // Animation en cascade
        }
    });
}, observerOptions);

// Observer pour les cartes étapes
document.querySelectorAll('.etape-card').forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(50px)';
    card.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    cardObserver.observe(card);
});

// Animation du hero background
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero-background');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// Micro-interactions pour les éléments interactifs
document.querySelectorAll('.lieu-item, .activite-card, .hebergement-card, .notes-card').forEach(item => {
    item.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    });
});

// Animation des badges au hover
document.querySelectorAll('.stat-item').forEach(item => {
    item.addEventListener('mouseenter', function() {
        const icon = this.querySelector('.stat-icon');
        if (icon) {
            icon.style.transform = 'scale(1.2) rotate(10deg)';
            icon.style.transition = 'transform 0.3s ease';
        }
    });
    
    item.addEventListener('mouseleave', function() {
        const icon = this.querySelector('.stat-icon');
        if (icon) {
            icon.style.transform = 'scale(1) rotate(0deg)';
        }
    });
});

// Navigation active state
window.addEventListener('scroll', () => {
    const navItems = document.querySelectorAll('.day-nav-item');
    const etapeCards = document.querySelectorAll('.etape-card');
    
    etapeCards.forEach((card, index) => {
        const rect = card.getBoundingClientRect();
        if (rect.top <= 200 && rect.bottom >= 200) {
            navItems.forEach(nav => nav.classList.remove('active'));
            if (navItems[index] && !navItems[index].classList.contains('nav-locked')) {
                navItems[index].classList.add('active');
            }
        }
    });
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
}).catch(e => console.log('Tracking error:', e));
@endauth

// Interaction avec contenu verrouillé
document.querySelectorAll('.locked-content').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Animation d'attention
        this.style.transform = 'scale(1.02)';
        this.style.transition = 'transform 0.2s ease';
        
        setTimeout(() => {
            this.style.transform = '';
        }, 200);
        
        // Notification moderne
        if (confirm('🔐 Ce contenu exclusif est réservé à nos membres.\n✨ L\'inscription est gratuite et instantanée!\n\nSouhaitez-vous vous inscrire maintenant ?')) {
            window.location.href = '{{ route("register") }}';
        }
    });
});
</script>
@endpush

@endsection