@extends('frontend.main_master')

@section('main')
<!-- Hero Section with Tailwind -->
<div class="relative min-h-[60vh] bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{asset('assets/img/senegal-landscape.jpg')}}');">
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
    <div class="relative container mx-auto px-4 h-full flex items-center min-h-[60vh]">
        <div class="text-white max-w-2xl">
            <h1 class="hero-title">
                Découvrez nos <span class="text-orange-400">Circuits Exceptionnels</span>
            </h1>
            <p class="text-xl mb-8 text-gray-200">
                Explorez le Sénégal authentique avec nos circuits sur mesure, des aventures culturelles aux échappées nature
            </p>
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{url('/')}}" class="text-orange-400 hover:text-orange-300 transition">Accueil</a>
                <span class="text-gray-300">/</span>
                <span class="text-gray-200">Circuits</span>
            </nav>
        </div>
    </div>
</div>

<!-- Filtres Section with Tailwind -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h2 class="filter-title">Trouvez votre circuit <span class="italic-accent">idéal</span></h2>
            <form method="GET" action="{{ route('voyages.index') }}">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Type de voyage</label>
                        <select name="type_voyage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Tous les types</option>
                            @foreach($typesVoyage as $type)
                                <option value="{{ $type->type_voyage }}" 
                                        {{ request('type_voyage') == $type->type_voyage ? 'selected' : '' }}>
                                    {{ $type->type_voyage_label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Région</label>
                        <select name="region" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Toutes les régions</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->region }}" 
                                        {{ request('region') == $region->region ? 'selected' : '' }}>
                                    {{ $region->region }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Durée</label>
                        <select name="duree" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Toutes durées</option>
                            <option value="court" {{ request('duree') == 'court' ? 'selected' : '' }}>Court (1-3 jours)</option>
                            <option value="moyen" {{ request('duree') == 'moyen' ? 'selected' : '' }}>Moyen (4-7 jours)</option>
                            <option value="long" {{ request('duree') == 'long' ? 'selected' : '' }}>Long (8+ jours)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confort</label>
                        <select name="niveau_confort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Tous niveaux</option>
                            <option value="economique" {{ request('niveau_confort') == 'economique' ? 'selected' : '' }}>Économique</option>
                            <option value="standard" {{ request('niveau_confort') == 'standard' ? 'selected' : '' }}>Standard</option>
                            <option value="superieur" {{ request('niveau_confort') == 'superieur' ? 'selected' : '' }}>Supérieur</option>
                            <option value="luxe" {{ request('niveau_confort') == 'luxe' ? 'selected' : '' }}>Luxe</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Budget</label>
                        <select name="prix" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Tous budgets</option>
                            <option value="economique" {{ request('prix') == 'economique' ? 'selected' : '' }}>Économique (-200k FCFA)</option>
                            <option value="moyen" {{ request('prix') == 'moyen' ? 'selected' : '' }}>Moyen (200k-500k FCFA)</option>
                            <option value="premium" {{ request('prix') == 'premium' ? 'selected' : '' }}>Premium (+500k FCFA)</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-center space-x-4">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-search mr-2"></i>Filtrer les circuits
                    </button>
                    <a href="{{ route('voyages.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold transition duration-300 border border-gray-300">
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Circuits Grid with Tailwind -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($voyages as $voyage)
            <div class="voyage-card">
                <!-- Image Container -->
                <div class="voyage-image">
                    <a href="{{ route('voyages.detail', $voyage->id) }}">
                        <img src="{{ asset($voyage->image_couverture) }}" alt="{{ $voyage->nom_voyage }}">
                    </a>
                    
                    <!-- Price Badge -->
                    <div class="price-badge">
                        {{ number_format($voyage->prix_base, 0, ',', ' ') }} FCFA
                    </div>
                    
                    <!-- Type Badge -->
                    <div class="type-badge">
                        {{ ucfirst(str_replace('-', ' ', $voyage->type_voyage)) }}
                    </div>
                </div>
                
                <!-- Content -->
                <div class="voyage-content">
                    <h3 class="voyage-title">
                        <a href="{{ route('voyages.detail', $voyage->id) }}">{{ $voyage->nom_voyage }}</a>
                    </h3>
                    
                    <p class="voyage-description">
                        {{ Str::limit($voyage->description_courte, 100) }}
                    </p>
                    
                    <!-- Informations -->
                    <div class="voyage-info">
                        <div class="info-row">
                            <div class="info-item">
                                📍 {{ $voyage->region }}
                            </div>
                            <div class="info-item">
                                📅 {{ $voyage->duree_jours }} jours
                            </div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-item">
                                👥 Max {{ $voyage->participants_max }}
                            </div>
                            <div class="info-item">
                                ⭐ {{ ucfirst($voyage->difficulte) }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Services -->
                    <div class="voyage-services">
                        @if($voyage->repas_inclus)
                            <span class="service-tag service-green">
                                🍽️ Repas
                            </span>
                        @endif
                        @if($voyage->guide_inclus)
                            <span class="service-tag service-blue">
                                👨‍🏫 Guide
                            </span>
                        @endif
                        @if($voyage->transports_inclus && is_array($voyage->transports_inclus) && count($voyage->transports_inclus) > 0)
                            <span class="service-tag service-purple">
                                🚗 Transport
                            </span>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="voyage-actions">
                        <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn-primary">
                            Voir détails
                        </a>
                        <a href="{{ route('voyages.programme', $voyage->id) }}" class="btn-secondary">
                            Programme
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="text-center py-16">
                    <div class="mb-6">
                        <i class="fas fa-compass text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Aucun circuit trouvé</h3>
                    <p class="text-gray-600 mb-8">Modifiez vos critères de recherche pour découvrir nos circuits</p>
                    <a href="{{ route('voyages.index') }}" 
                       class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                        Voir tous les circuits
                    </a>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($voyages->hasPages())
        <div class="flex justify-center mt-12">
            <div class="pagination-wrapper">
                {{ $voyages->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action with Tailwind -->
<section class="py-16 bg-gradient-to-r from-orange-50 to-orange-100">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center justify-between bg-white rounded-2xl p-8 shadow-xl">
            <div class="text-center lg:text-left mb-6 lg:mb-0">
                <h3 class="text-3xl font-bold text-gray-800 mb-3">Besoin d'aide pour choisir votre circuit ?</h3>
                <p class="text-lg text-gray-600">Nos experts sont là pour vous conseiller et créer le voyage de vos rêves</p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ route('contact') }}" 
                   class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-bold text-lg transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl inline-flex items-center">
                    <i class="fas fa-phone mr-3"></i>Nous contacter
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Import Google Fonts pour l'émotion */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Dancing+Script:wght@400;500;600;700&display=swap');

/* Fallback Tailwind classes critiques */
.container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
.grid { display: grid; }
.grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
.grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
.gap-8 { gap: 2rem; }
.py-12 { padding-top: 3rem; padding-bottom: 3rem; }
.px-4 { padding-left: 1rem; padding-right: 1rem; }
.bg-white { background-color: white; }
.bg-gray-50 { background-color: #f9fafb; }
.text-center { text-align: center; }
.mb-8 { margin-bottom: 2rem; }
.shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1); }
.rounded-2xl { border-radius: 1rem; }

@media (min-width: 768px) {
    .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .md\:grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
}

@media (min-width: 1024px) {
    .lg\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
}

/* Voyage Cards - Design Émotionnel */
.voyage-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    height: 100%;
    display: flex;
    flex-direction: column;
    font-family: 'Poppins', sans-serif;
}

.voyage-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
}

/* Image Container - ZERO espace gris */
.voyage-image {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
}

.voyage-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.voyage-card:hover .voyage-image img {
    transform: scale(1.08);
}

/* Badges avec plus d'impact */
.price-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(255, 255, 255, 0.98);
    padding: 8px 16px;
    border-radius: 12px;
    font-weight: 700;
    color: #ea580c;
    font-size: 15px;
    backdrop-filter: blur(8px);
    border: 1px solid rgba(234, 88, 12, 0.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.type-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

/* Content - Design émotionnel */
.voyage-content {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.voyage-title {
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 12px;
    line-height: 1.3;
    font-family: 'Poppins', sans-serif;
    letter-spacing: -0.02em;
}

.voyage-title a {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #1f2937, #1f2937);
    background-clip: text;
    -webkit-background-clip: text;
}

.voyage-title a:hover {
    background: linear-gradient(135deg, #ea580c, #f97316);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: translateY(-1px);
}

.voyage-description {
    color: #64748b;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
    font-weight: 400;
}

/* Informations avec plus d'espace */
.voyage-info {
    margin-bottom: 18px;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    padding: 14px;
    border-radius: 12px;
    border-left: 4px solid #ea580c;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    gap: 12px;
}

.info-row:last-child {
    margin-bottom: 0;
}

.info-item {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #475569;
    font-weight: 500;
    padding: 4px 8px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(2px);
    border: 1px solid rgba(234, 88, 12, 0.1);
    flex: 1;
    justify-content: center;
    text-align: center;
}

.info-item:hover {
    background: rgba(254, 243, 242, 0.9);
    border-color: rgba(234, 88, 12, 0.2);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

/* Services avec style émotionnel */
.voyage-services {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 18px;
}

.service-tag {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    transition: all 0.2s ease;
}

.service-tag:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

/* Espacement pour les emojis dans les services */
.service-tag::first-letter {
    margin-right: 6px;
    font-size: 13px;
}

.service-green { 
    background: linear-gradient(135deg, #10b981, #047857); 
    color: white;
}
.service-blue { 
    background: linear-gradient(135deg, #3b82f6, #1e40af); 
    color: white;
}
.service-purple { 
    background: linear-gradient(135deg, #8b5cf6, #7c3aed); 
    color: white;
}

/* Actions avec plus d'émotion */
.voyage-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
}

.btn-primary, .btn-secondary {
    flex: 1;
    padding: 12px 16px;
    border-radius: 12px;
    text-align: center;
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    font-family: 'Poppins', sans-serif;
    letter-spacing: 0.3px;
}

.btn-primary {
    background: linear-gradient(135deg, #ea580c, #f97316);
    color: white;
    border: none;
    box-shadow: 0 4px 15px rgba(234, 88, 12, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #dc2626, #ea580c);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 88, 12, 0.4);
}

.btn-secondary {
    background: white;
    color: #ea580c;
    border: 2px solid #ea580c;
    box-shadow: 0 2px 8px rgba(234, 88, 12, 0.1);
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #fef3f2, #fed7d7);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(234, 88, 12, 0.2);
    border-color: #f97316;
}

/* Typography émotionnelle */
.voyage-card * {
    font-family: 'Poppins', sans-serif;
}

/* Hero Title - Typography émotionnelle */
.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.1;
    font-family: 'Poppins', sans-serif;
    letter-spacing: -0.02em;
    text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
}

@media (min-width: 768px) {
    .hero-title {
        font-size: 4.5rem;
    }
}

/* Filter Title - Typography élégante */
.filter-title {
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
    color: #1f2937;
    font-family: 'Poppins', sans-serif;
    letter-spacing: -0.01em;
}

.italic-accent {
    font-family: 'Dancing Script', cursive;
    font-weight: 600;
    color: #ea580c;
    font-size: 2.2rem;
    position: relative;
}

.italic-accent::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #ea580c, transparent);
}

/* Animation d'entrée */
.voyage-card {
    animation: fadeInUp 0.6s ease-out;
}

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

/* Responsive design amélioré */
@media (max-width: 768px) {
    .voyage-card {
        margin-bottom: 20px;
    }
    
    .voyage-content {
        padding: 16px;
    }
    
    .voyage-title {
        font-size: 18px;
    }
    
    .btn-primary, .btn-secondary {
        font-size: 14px;
        padding: 10px 14px;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
}

/* Custom pagination styles for Tailwind */
.pagination-wrapper .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
}

.pagination-wrapper .pagination .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    color: #6b7280;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.pagination-wrapper .pagination .page-link:hover {
    background-color: #f97316;
    color: white;
    border-color: #f97316;
    transform: translateY(-2px);
}

.pagination-wrapper .pagination .page-item.active .page-link {
    background-color: #f97316;
    color: white;
    border-color: #f97316;
}

.pagination-wrapper .pagination .page-item.disabled .page-link {
    color: #d1d5db;
    pointer-events: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .grid-cols-2 {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@endsection