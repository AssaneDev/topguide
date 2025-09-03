@extends('frontend.main_master')

@section('main')
<!-- Hero Section avec Tailwind -->
<div class="relative h-screen min-h-[600px] bg-gradient-to-br from-orange-500 via-orange-600 to-orange-700 overflow-hidden flex items-center">
    @if($voyage->image_principale)
        <img src="{{ asset($voyage->image_principale) }}" alt="{{ $voyage->nom_voyage }}" 
             class="absolute inset-0 w-full h-full object-cover opacity-30 z-0">
    @endif
    
    <!-- Overlay subtil -->
    <div class="absolute inset-0 bg-gradient-to-br from-orange-600/90 via-orange-500/80 to-orange-700/85 z-10"></div>
    
    <!-- Contenu du hero -->
    <div class="relative z-20 w-full max-w-7xl mx-auto px-6 text-white">
        <!-- Breadcrumb moderne -->
        <nav class="inline-flex items-center space-x-2 mb-8 px-6 py-3 bg-white/10 backdrop-blur-md rounded-full border border-white/20">
            <a href="{{ url('/') }}" class="text-white/80 hover:text-white transition-colors duration-300">🏠 Accueil</a>
            <span class="text-white/50">→</span>
            <a href="{{ route('voyages.index') }}" class="text-white/80 hover:text-white transition-colors duration-300">✈️ Voyages</a>
            <span class="text-white/50">→</span>
            <span class="text-white font-medium">{{ Str::limit($voyage->nom_voyage, 30) }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Contenu principal -->
            <div class="space-y-8">
                <!-- Badges -->
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium border border-white/30">
                        {{ $voyage->type_voyage }}
                    </span>
                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium border border-white/30">
                        📍 {{ $voyage->region }}
                    </span>
                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium border border-white/30">
                        ⭐ {{ $voyage->difficulte_label ?? 'Standard' }}
                    </span>
                </div>

                <!-- Titre et description -->
                <div>
                    <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-6 text-white drop-shadow-lg">
                        {{ $voyage->nom_voyage }}
                    </h1>
                    <p class="text-xl text-white/90 leading-relaxed max-w-2xl">
                        {{ $voyage->description_courte }}
                    </p>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-wrap gap-4">
                    @auth
                        <a href="{{ route('voyages.reservation', $voyage->id) }}" 
                           class="inline-flex items-center px-8 py-4 bg-white text-orange-600 rounded-full font-semibold hover:bg-orange-50 hover:scale-105 transition-all duration-300 shadow-lg">
                            ✨ Réserver maintenant
                        </a>
                    @else
                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center px-8 py-4 bg-white text-orange-600 rounded-full font-semibold hover:bg-orange-50 hover:scale-105 transition-all duration-300 shadow-lg">
                            🚀 S'inscrire pour réserver
                        </a>
                    @endauth
                    
                    <a href="{{ route('voyages.programme', $voyage->id) }}" 
                       class="inline-flex items-center px-8 py-4 bg-white/20 text-white border-2 border-white/30 rounded-full font-semibold hover:bg-white/30 hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                        📋 Voir le programme
                    </a>
                </div>
            </div>

            <!-- Statistiques en cartes -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 text-center border border-white/20 hover:scale-105 transition-transform duration-300">
                    <div class="text-4xl mb-3">📅</div>
                    <div class="text-2xl font-bold text-white">{{ $voyage->duree_jours }}</div>
                    <div class="text-white/80 text-sm">jours</div>
                </div>
                
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 text-center border border-white/20 hover:scale-105 transition-transform duration-300">
                    <div class="text-4xl mb-3">👥</div>
                    <div class="text-2xl font-bold text-white">{{ $voyage->participants_max }}</div>
                    <div class="text-white/80 text-sm">max</div>
                </div>
                
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 text-center border border-white/20 hover:scale-105 transition-transform duration-300">
                    <div class="text-4xl mb-3">💰</div>
                    <div class="text-lg font-bold text-white">{{ number_format($voyage->prix_base) }}</div>
                    <div class="text-white/80 text-xs">FCFA</div>
                </div>
                
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 text-center border border-white/20 hover:scale-105 transition-transform duration-300">
                    <div class="text-4xl mb-3">🎯</div>
                    <div class="text-lg font-bold text-white">{{ $voyage->difficulte_label ?? 'Standard' }}</div>
                    <div class="text-white/80 text-xs">niveau</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contenu principal avec Tailwind -->
<div class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Colonne principale -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Description -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-8 text-center">
                        <h2 class="text-3xl font-bold mb-2">✨ Découvrez votre aventure</h2>
                        <p class="text-orange-100">Une expérience authentique vous attend</p>
                    </div>
                    <div class="p-8">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {{ $voyage->description_longue }}
                        </div>
                        
                        @if($voyage->points_forts)
                            <div class="mt-8 p-6 bg-gradient-to-r from-amber-50 to-yellow-50 border-l-4 border-amber-400 rounded-r-2xl">
                                <h4 class="text-xl font-semibold text-gray-800 mb-3 flex items-center">
                                    <span class="mr-2">🌟</span> Points forts de ce voyage
                                </h4>
                                <p class="text-gray-700">{{ $voyage->points_forts }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Activités -->
                @if($voyage->activites && $voyage->activites->count() > 0)
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-8 text-center">
                        <h2 class="text-3xl font-bold mb-2">🎭 Activités incluses</h2>
                        <p class="text-orange-100">Des expériences uniques vous attendent</p>
                    </div>
                    <div class="p-8">
                        <div class="grid md:grid-cols-2 gap-6">
                            @foreach($voyage->activites as $activite)
                            <div class="bg-gray-50 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
                                <div class="h-32 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-5xl text-white">
                                    🎯
                                </div>
                                <div class="p-6">
                                    <h4 class="text-xl font-semibold text-gray-800 mb-3">{{ $activite->nom_activite }}</h4>
                                    <p class="text-gray-600">{{ $activite->description }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Inclusions -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 text-center">
                        <h2 class="text-3xl font-bold mb-2">✅ Ce qui est inclus</h2>
                        <p class="text-green-100">Tout est prévu pour votre confort</p>
                    </div>
                    <div class="p-8">
                        <div class="space-y-4">
                            @if($voyage->repas_inclus)
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <span class="text-2xl mr-4">🍽️</span>
                                <span class="text-gray-800">Repas selon programme</span>
                            </div>
                            @endif
                            
                            @if($voyage->guide_inclus)
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <span class="text-2xl mr-4">👨‍🎓</span>
                                <span class="text-gray-800">Guide local francophone</span>
                            </div>
                            @endif
                            
                            @if($voyage->transports_inclus)
                                @if(is_array($voyage->transports_inclus))
                                    @foreach($voyage->transports_inclus as $transport)
                                    <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                        <span class="text-2xl mr-4">🚗</span>
                                        <span class="text-gray-800">{{ ucfirst($transport) }}</span>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                        <span class="text-2xl mr-4">🚗</span>
                                        <span class="text-gray-800">{{ $voyage->transports_inclus }}</span>
                                    </div>
                                @endif
                            @endif
                            
                            @if($voyage->hebergements_inclus)
                                @if(is_array($voyage->hebergements_inclus))
                                    @foreach($voyage->hebergements_inclus as $hebergement)
                                    <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                        <span class="text-2xl mr-4">🏨</span>
                                        <span class="text-gray-800">{{ ucfirst($hebergement) }}</span>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                        <span class="text-2xl mr-4">🏨</span>
                                        <span class="text-gray-800">{{ $voyage->hebergements_inclus }}</span>
                                    </div>
                                @endif
                            @endif
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <span class="text-2xl mr-4">📞</span>
                                <span class="text-gray-800">Assistance 24h/7j</span>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <span class="text-2xl mr-4">🛡️</span>
                                <span class="text-gray-800">Assurance voyage</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar prix -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <!-- Carte de prix -->
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                        <div class="bg-gradient-to-r from-slate-800 to-slate-700 text-white p-8 text-center">
                            <div class="text-4xl font-bold text-amber-400 mb-2">
                                {{ number_format($voyage->prix_base) }} FCFA
                            </div>
                            <div class="text-slate-300">par personne</div>
                            
                            @if($voyage->participants_min && $voyage->participants_max)
                                <div class="mt-4 px-4 py-2 bg-white/10 rounded-xl">
                                    <span class="text-sm">👥 Groupe {{ $voyage->participants_min }}-{{ $voyage->participants_max }} personnes</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-8 space-y-4">
                            @auth
                                <a href="{{ route('voyages.reservation', $voyage->id) }}" 
                                   class="w-full inline-flex items-center justify-center px-6 py-4 bg-orange-500 text-white rounded-2xl font-semibold hover:bg-orange-600 hover:scale-105 transition-all duration-300 shadow-lg">
                                    ✨ Réserver maintenant
                                </a>
                            @else
                                <a href="{{ route('register') }}" 
                                   class="w-full inline-flex items-center justify-center px-6 py-4 bg-orange-500 text-white rounded-2xl font-semibold hover:bg-orange-600 hover:scale-105 transition-all duration-300 shadow-lg">
                                    🚀 Créer un compte
                                </a>
                            @endauth
                            
                            <a href="{{ route('voyages.programme', $voyage->id) }}" 
                               class="w-full inline-flex items-center justify-center px-6 py-4 bg-gray-100 text-gray-800 rounded-2xl font-semibold hover:bg-gray-200 hover:scale-105 transition-all duration-300">
                                📋 Voir le programme détaillé
                            </a>

                            <!-- Garanties -->
                            <div class="pt-6 border-t border-gray-200 space-y-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-3">🛡️</span>
                                    <span>Annulation gratuite 48h avant</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-3">💳</span>
                                    <span>Paiement sécurisé</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-3">📞</span>
                                    <span>Support client 7j/7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Informations détaillées -->
<div class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Description longue -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">✨ Votre aventure en détail</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Plongez dans les détails de cette expérience unique au Sénégal</p>
            </div>
            
            <div class="bg-gray-50 rounded-3xl p-12">
                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! str_replace(['<p>', '</p>', '<br>', '<br/>', '<br />'], ['<p class="mb-6">', '</p>', ' ', ' ', ' '], $voyage->description_longue) !!}
                </div>
            </div>
        </div>

        <!-- Informations pratiques -->
        @if($voyage->niveau_confort || $voyage->point_depart || $voyage->point_arrivee)
        <div class="grid md:grid-cols-3 gap-8">
            @if($voyage->niveau_confort)
            <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-3xl hover:shadow-lg transition-all duration-300">
                <div class="text-6xl mb-4">🏨</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Niveau de confort</h3>
                <p class="text-gray-600">{{ $voyage->niveau_confort_label ?? $voyage->niveau_confort }}</p>
            </div>
            @endif
            
            @if($voyage->point_depart)
            <div class="text-center p-8 bg-gradient-to-br from-green-50 to-emerald-100 rounded-3xl hover:shadow-lg transition-all duration-300">
                <div class="text-6xl mb-4">🛫</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Point de départ</h3>
                <p class="text-gray-600">{{ $voyage->point_depart }}</p>
            </div>
            @endif
            
            @if($voyage->point_arrivee)
            <div class="text-center p-8 bg-gradient-to-br from-purple-50 to-purple-100 rounded-3xl hover:shadow-lg transition-all duration-300">
                <div class="text-6xl mb-4">🛬</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Point d'arrivée</h3>
                <p class="text-gray-600">{{ $voyage->point_arrivee }}</p>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>

<!-- CTA Final -->
<div class="bg-gradient-to-r from-orange-500 via-orange-600 to-orange-700 py-20">
    <div class="max-w-4xl mx-auto text-center px-6">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
            🌍 Prêt pour l'aventure ?
        </h2>
        <p class="text-xl text-orange-100 mb-10 max-w-2xl mx-auto">
            Rejoignez-nous pour une expérience authentique au cœur du Sénégal
        </p>
        
        <div class="flex flex-wrap gap-6 justify-center">
            @auth
                <a href="{{ route('voyages.reservation', $voyage->id) }}" 
                   class="inline-flex items-center px-10 py-5 bg-white text-orange-600 rounded-full text-lg font-semibold hover:bg-orange-50 hover:scale-110 transition-all duration-300 shadow-2xl">
                    ✨ Réserver maintenant
                </a>
            @else
                <a href="{{ route('register') }}" 
                   class="inline-flex items-center px-10 py-5 bg-white text-orange-600 rounded-full text-lg font-semibold hover:bg-orange-50 hover:scale-110 transition-all duration-300 shadow-2xl">
                    🚀 Créer mon compte
                </a>
            @endauth
            
            <a href="{{ route('contact') }}" 
               class="inline-flex items-center px-10 py-5 bg-white/20 text-white border-2 border-white/30 rounded-full text-lg font-semibold hover:bg-white/30 hover:scale-110 transition-all duration-300 backdrop-blur-sm">
                💬 Une question ?
            </a>
        </div>
    </div>
</div>

@endsection