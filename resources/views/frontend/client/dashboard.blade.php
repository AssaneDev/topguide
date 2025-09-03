@extends('frontend.layout.master')

@section('main')
<div class="dashboard-header bg-gradient-primary py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="text-white mb-2">Bonjour {{ $user->name }} ! 👋</h1>
                <p class="text-white-50 mb-0">Bienvenue dans votre espace personnel</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <div class="user-avatar d-inline-flex align-items-center">
                    <div class="avatar-circle me-3">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="text-white">
                        <div class="fw-semibold">{{ $user->name }}</div>
                        <small class="text-white-50">Membre depuis {{ $user->created_at->format('M Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Statistiques -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card h-100">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $stats['voyages_consultes'] }}</h3>
                    <p class="stat-label">Voyages consultés</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card h-100">
                <div class="stat-icon bg-danger">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $stats['voyages_favoris'] }}</h3>
                    <p class="stat-label">Favoris</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card h-100">
                <div class="stat-icon bg-success">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $stats['reservations'] }}</h3>
                    <p class="stat-label">Réservations</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card h-100">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-route"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $stats['voyage_en_cours'] ? '1' : '0' }}</h3>
                    <p class="stat-label">Voyage en cours</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Contenu principal -->
        <div class="col-lg-8">
            <!-- Derniers voyages consultés -->
            @if($derniersVoyages->count() > 0)
            <div class="dashboard-section mb-5">
                <div class="section-header d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        <i class="fas fa-history me-2 text-primary"></i>Derniers voyages consultés
                    </h4>
                    <a href="{{ route('client.voyages') }}" class="btn btn-outline-primary btn-sm">
                        Voir tout
                    </a>
                </div>
                
                <div class="voyages-consultes">
                    @foreach($derniersVoyages->take(3) as $voyage)
                    <div class="voyage-consulte-item mb-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3">
                                <div class="voyage-thumb">
                                    <img src="{{ asset($voyage->image_couverture) }}" 
                                         alt="{{ $voyage->nom_voyage }}"
                                         class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-1">{{ $voyage->nom_voyage }}</h6>
                                <p class="text-muted mb-2 small">{{ Str::limit($voyage->description_courte, 80) }}</p>
                                <div class="voyage-meta">
                                    <span class="badge bg-light text-dark me-2">{{ $voyage->duree_formatee }}</span>
                                    <span class="badge bg-light text-dark me-2">{{ $voyage->region }}</span>
                                    <span class="badge bg-light text-dark">{{ $voyage->prix_base_eur_formate }}</span>
                                </div>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-primary btn-sm mb-2">
                                    Revoir
                                </a>
                                <div class="small text-muted">
                                    Consulté récemment
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recommandations personnalisées -->
            @if($recommendations->count() > 0)
            <div class="dashboard-section mb-5">
                <div class="section-header mb-4">
                    <h4 class="mb-2">
                        <i class="fas fa-magic me-2 text-warning"></i>Recommandé pour vous
                    </h4>
                    <p class="text-muted mb-0">Basé sur vos consultations précédentes</p>
                </div>
                
                <div class="row g-3">
                    @foreach($recommendations as $voyage)
                    <div class="col-md-4">
                        <div class="recommendation-card h-100">
                            <div class="card-image">
                                <img src="{{ asset($voyage->image_couverture) }}" 
                                     alt="{{ $voyage->nom_voyage }}"
                                     class="img-fluid">
                                <div class="card-overlay">
                                    <div class="price-tag">{{ $voyage->prix_base_eur_formate }}</div>
                                </div>
                            </div>
                            <div class="card-content p-3">
                                <h6 class="mb-2">{{ Str::limit($voyage->nom_voyage, 40) }}</h6>
                                <div class="card-meta mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $voyage->region }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-calendar me-1"></i>{{ $voyage->duree_formatee }}
                                    </small>
                                </div>
                                <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-outline-primary btn-sm w-100">
                                    Découvrir
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Nouvelles offres -->
            @if($nouvellesOffres->count() > 0)
            <div class="dashboard-section">
                <div class="section-header mb-4">
                    <h4 class="mb-2">
                        <i class="fas fa-sparkles me-2 text-success"></i>Nouvelles offres
                    </h4>
                    <p class="text-muted mb-0">Découvrez nos derniers voyages</p>
                </div>
                
                <div class="row g-3">
                    @foreach($nouvellesOffres->take(2) as $voyage)
                    <div class="col-md-6">
                        <div class="nouvelle-offre-card">
                            <div class="row g-0 h-100">
                                <div class="col-4">
                                    <div class="offre-image">
                                        <img src="{{ asset($voyage->image_couverture) }}" 
                                             alt="{{ $voyage->nom_voyage }}"
                                             class="img-fluid h-100 w-100">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="offre-content p-3">
                                        <div class="nouveau-badge mb-2">
                                            <span class="badge bg-success">Nouveau</span>
                                        </div>
                                        <h6 class="mb-2">{{ Str::limit($voyage->nom_voyage, 35) }}</h6>
                                        <div class="offre-price mb-2">
                                            <span class="price-eur fw-bold text-primary">{{ $voyage->prix_base_eur_formate }}</span>
                                        </div>
                                        <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-sm btn-primary">
                                            Voir détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Menu de navigation -->
            <div class="dashboard-nav-card mb-4">
                <h5 class="card-title mb-3">Navigation</h5>
                <nav class="dashboard-nav">
                    <a href="{{ route('client.dashboard') }}" class="nav-item active">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('client.voyages') }}" class="nav-item">
                        <i class="fas fa-route me-2"></i>Mes voyages
                        @if($stats['voyages_consultes'] > 0)
                            <span class="badge">{{ $stats['voyages_consultes'] }}</span>
                        @endif
                    </a>
                    <a href="{{ route('client.reservations') }}" class="nav-item">
                        <i class="fas fa-calendar-check me-2"></i>Mes réservations
                        @if($stats['reservations'] > 0)
                            <span class="badge">{{ $stats['reservations'] }}</span>
                        @endif
                    </a>
                    <a href="{{ route('client.profil') }}" class="nav-item">
                        <i class="fas fa-user me-2"></i>Mon profil
                    </a>
                    <a href="{{ route('voyages.index') }}" class="nav-item">
                        <i class="fas fa-search me-2"></i>Découvrir
                    </a>
                </nav>
            </div>

            <!-- Profil rapide -->
            <div class="profile-quick-card mb-4">
                <div class="profile-header text-center mb-3">
                    <div class="profile-avatar mx-auto mb-2">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h6 class="mb-1">{{ $user->name }}</h6>
                    <small class="text-muted">{{ $user->email }}</small>
                </div>
                
                <div class="profile-completion mb-3">
                    @php
                        $completion = 40; // Calcul basique
                        if($user->phone) $completion += 20;
                        if($user->address) $completion += 20;
                        if($user->date_naissance) $completion += 20;
                    @endphp
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small">Profil complété</span>
                        <span class="small fw-bold">{{ $completion }}%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ $completion }}%"></div>
                    </div>
                </div>
                
                <a href="{{ route('client.profil') }}" class="btn btn-outline-primary btn-sm w-100">
                    Compléter mon profil
                </a>
            </div>

            <!-- Actions rapides -->
            <div class="quick-actions-card mb-4">
                <h6 class="mb-3">Actions rapides</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('voyages.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-search me-2"></i>Chercher un voyage
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-headset me-2"></i>Support client
                    </a>
                </div>
            </div>

            <!-- Conseils du jour -->
            <div class="tips-card">
                <h6 class="mb-3">
                    <i class="fas fa-lightbulb me-2 text-warning"></i>Conseil du jour
                </h6>
                <div class="tip-content">
                    <p class="small mb-3">💡 Saviez-vous que réserver votre voyage 2 mois à l'avance vous permet souvent d'obtenir les meilleurs tarifs ?</p>
                    <a href="{{ route('blog.list') }}" class="btn btn-link btn-sm p-0">
                        Lire nos conseils voyage →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #FF6B35, #e55a2b);
}

.avatar-circle, .profile-avatar {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    color: white;
}

.profile-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #FF6B35, #e55a2b);
    font-size: 1.5rem;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #FF6B35, #e55a2b);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    color: white;
    font-size: 1.2rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #333;
}

.stat-label {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

.dashboard-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.section-header h4 {
    color: #333;
    font-weight: 600;
}

.voyage-consulte-item {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1rem;
    transition: all 0.3s ease;
}

.voyage-consulte-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.voyage-thumb img {
    height: 80px;
    width: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.recommendation-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.recommendation-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.card-image {
    position: relative;
    height: 150px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
}

.recommendation-card:hover .card-image img {
    transform: scale(1.1);
}

.card-overlay {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(0,0,0,0.3), transparent);
}

.price-tag {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.95);
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #FF6B35;
}

.nouvelle-offre-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
    height: 120px;
}

.nouvelle-offre-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.offre-image img {
    object-fit: cover;
}

.dashboard-nav-card,
.profile-quick-card,
.quick-actions-card,
.tips-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.dashboard-nav .nav-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 0;
    color: #666;
    text-decoration: none;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.dashboard-nav .nav-item:last-child {
    border-bottom: none;
}

.dashboard-nav .nav-item:hover,
.dashboard-nav .nav-item.active {
    color: #FF6B35;
    transform: translateX(5px);
}

.dashboard-nav .nav-item .badge {
    background: #FF6B35;
    color: white;
    font-size: 0.7rem;
    padding: 2px 6px;
    border-radius: 10px;
}

.progress-bar {
    border-radius: 3px;
}

.tips-card {
    background: linear-gradient(135deg, #fff7ed, #fff);
    border: 1px solid #fed7aa;
}

@media (max-width: 768px) {
    .dashboard-header {
        text-align: center;
    }
    
    .avatar-circle {
        width: 50px;
        height: 50px;
        font-size: 1rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .dashboard-section {
        padding: 1.5rem;
    }
    
    .voyage-consulte-item .col-md-3:first-child {
        margin-bottom: 1rem;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card,
.dashboard-section,
.recommendation-card {
    animation: fadeInUp 0.6s ease forwards;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }
</style>
@endpush

@push('scripts')
<script>
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

// Observer les sections du dashboard
document.querySelectorAll('.dashboard-section').forEach(section => {
    section.style.opacity = '0';
    section.style.transform = 'translateY(20px)';
    section.style.transition = 'all 0.6s ease';
    observer.observe(section);
});

// Ajout des tooltips Bootstrap si disponible
if (typeof bootstrap !== 'undefined') {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Suivi d'engagement dashboard
console.log('Dashboard chargé pour l\'utilisateur {{ $user->id }}');
</script>
@endpush

@endsection