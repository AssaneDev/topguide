@extends('frontend.main_master')

@section('main')
<!-- Hero Section with Tailwind -->
<div class="relative min-h-[60vh] bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{asset('assets/img/senegal-landscape.jpg')}}');">
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
    <div class="relative container mx-auto px-4 h-full flex items-center min-h-[60vh]">
        <div class="text-white max-w-2xl">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
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
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Trouvez votre circuit idéal</h2>
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
            <div class="group">
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col circuit-card">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden h-64">
                        <a href="{{ route('voyages.detail', $voyage->id) }}">
                            <img src="{{ asset($voyage->image_couverture) }}" 
                                 alt="{{ $voyage->nom_voyage }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </a>
                        
                        <!-- Price Badge -->
                        <div class="absolute top-3 right-3">
                            <div class="bg-white/90 backdrop-blur rounded-lg px-3 py-1 shadow-sm">
                                <div class="text-sm font-bold text-orange-600">{{ $voyage->prix_base_eur_formate ?? $voyage->prix_base_formate }}</div>
                            </div>
                        </div>
                        
                        <!-- Type Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="bg-blue-600/90 text-white px-2 py-1 rounded-md text-xs font-medium backdrop-blur">
                                {{ $voyage->type_voyage_label ?? $voyage->type_voyage }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Content (réduit le padding) -->
                    <div class="px-4 pt-3 pb-4 flex-1 flex flex-col content-section">
                        <!-- Titre -->
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-orange-600 transition">
                            <a href="{{ route('voyages.detail', $voyage->id) }}">{{ $voyage->nom_voyage }}</a>
                        </h3>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2 flex-1">
                            {{ Str::limit($voyage->description_courte, 100) }}
                        </p>
                        
                        <!-- Informations clés (très compact) -->
                        <div class="space-y-1 mb-3">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-1 text-orange-500"></i>
                                    {{ $voyage->region }}
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-calendar-alt mr-1 text-orange-500"></i>
                                    {{ $voyage->duree_jours ?? $voyage->duree_formatee }} jours
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-users mr-1 text-orange-500"></i>
                                    Max {{ $voyage->participants_max ?? '8' }}
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-star mr-1 text-orange-500"></i>
                                    {{ $voyage->difficulte_label ?? $voyage->difficulte ?? 'Modéré' }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Services inclus (très compact) -->
                        <div class="flex flex-wrap gap-1 mb-3">
                            @if($voyage->repas_inclus ?? false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-green-100 text-green-700">
                                    <i class="fas fa-utensils mr-1"></i>Repas
                                </span>
                            @endif
                            @if($voyage->guide_inclus ?? false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-blue-100 text-blue-700">
                                    <i class="fas fa-user-tie mr-1"></i>Guide
                                </span>
                            @endif
                            @if($voyage->transports_inclus)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-purple-100 text-purple-700">
                                    <i class="fas fa-car mr-1"></i>Transport
                                </span>
                            @endif
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex gap-2 mt-auto">
                            <a href="{{ route('voyages.detail', $voyage->id) }}" 
                               class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 px-3 rounded-lg font-medium text-center text-sm transition duration-200 transform hover:scale-[1.02]">
                                Voir détails
                            </a>
                            <a href="{{ route('voyages.programme', $voyage->id) }}" 
                               class="flex-1 bg-white border border-orange-500 text-orange-500 hover:bg-orange-50 py-2 px-3 rounded-lg font-medium text-center text-sm transition duration-200">
                                Programme
                            </a>
                        </div>
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
/* Custom Tailwind utilities for circuit cards */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.3;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
}

/* Éliminer complètement l'espace entre image et contenu */
.circuit-card .content-section {
    margin-top: 0;
    padding-top: 0.75rem;
}

.circuit-card {
    background: white;
    display: flex;
    flex-direction: column;
}

/* S'assurer qu'il n'y a pas d'espace dans le container */
.circuit-card .relative {
    flex-shrink: 0;
}

/* Améliorer l'affichage des informations */
.circuit-card .content-section {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Améliorer les transitions */
.circuit-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
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