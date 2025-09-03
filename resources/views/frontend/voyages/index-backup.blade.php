@extends('frontend.main_master')

@section('main')

<!-- Hero Section Simple -->
<section style="background: linear-gradient(135deg, #ea580c, #f97316); color: white; padding: 4rem 0; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; margin-bottom: 1rem; font-weight: bold;">
            Découvrez nos <span style="color: #fed7aa;">Circuits Exceptionnels</span>
        </h1>
        <p style="font-size: 1.2rem; margin-bottom: 2rem;">
            Explorez le Sénégal authentique avec nos voyages sur mesure
        </p>
    </div>
</section>

<!-- Circuits Grid Simple -->
<section style="padding: 3rem 0; background: white;">
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; color: #1f2937;">
            Nos Voyages Disponibles
        </h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
            @forelse($voyages as $voyage)
            <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08); transition: all 0.3s ease;">
                <!-- Image -->
                <div style="position: relative; height: 220px; overflow: hidden;">
                    <a href="{{ route('voyages.detail', $voyage->id) }}">
                        <img src="{{ asset($voyage->image_couverture) }}" 
                             alt="{{ $voyage->nom_voyage }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </a>
                    
                    <!-- Price -->
                    <div style="position: absolute; top: 12px; right: 12px; background: rgba(255, 255, 255, 0.95); padding: 8px 16px; border-radius: 12px; font-weight: bold; color: #ea580c;">
                        {{ number_format($voyage->prix_base, 0, ',', ' ') }} FCFA
                    </div>
                    
                    <!-- Type -->
                    <div style="position: absolute; top: 12px; left: 12px; background: #1e40af; color: white; padding: 6px 12px; border-radius: 8px; font-size: 13px; font-weight: 600;">
                        {{ ucfirst(str_replace('-', ' ', $voyage->type_voyage)) }}
                    </div>
                </div>
                
                <!-- Content -->
                <div style="padding: 20px;">
                    <h3 style="font-size: 20px; font-weight: 700; color: #1f2937; margin-bottom: 12px; line-height: 1.3;">
                        <a href="{{ route('voyages.detail', $voyage->id) }}" style="text-decoration: none; color: inherit;">
                            {{ $voyage->nom_voyage }}
                        </a>
                    </h3>
                    
                    <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 16px;">
                        {{ Str::limit($voyage->description_courte ?? 'Description non disponible', 100) }}
                    </p>
                    
                    <!-- Info -->
                    <div style="background: #f8fafc; padding: 12px; border-radius: 10px; margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 13px; color: #475569;">📍 {{ $voyage->region }}</span>
                            <span style="font-size: 13px; color: #475569;">📅 {{ $voyage->duree_jours }} jours</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="font-size: 13px; color: #475569;">👥 Max {{ $voyage->participants_max }}</span>
                            <span style="font-size: 13px; color: #475569;">⭐ {{ ucfirst($voyage->difficulte) }}</span>
                        </div>
                    </div>
                    
                    <!-- Services -->
                    <div style="margin-bottom: 18px;">
                        @if($voyage->repas_inclus)
                            <span style="display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: linear-gradient(135deg, #10b981, #047857); color: white; margin-right: 6px;">
                                🍽️ Repas
                            </span>
                        @endif
                        @if($voyage->guide_inclus)
                            <span style="display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: linear-gradient(135deg, #3b82f6, #1e40af); color: white; margin-right: 6px;">
                                👨‍🏫 Guide
                            </span>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('voyages.detail', $voyage->id) }}" 
                           style="flex: 1; padding: 12px 16px; background: linear-gradient(135deg, #ea580c, #f97316); color: white; text-decoration: none; border-radius: 12px; text-align: center; font-weight: 600; transition: all 0.3s ease;">
                            Voir détails
                        </a>
                        <a href="{{ route('voyages.programme', $voyage->id) }}" 
                           style="flex: 1; padding: 12px 16px; background: white; color: #ea580c; border: 2px solid #ea580c; text-decoration: none; border-radius: 12px; text-align: center; font-weight: 600; transition: all 0.3s ease;">
                            Programme
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 2rem;">
                <h3>Aucun voyage disponible</h3>
                <p>Nos circuits sont en cours de préparation. Revenez bientôt !</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div style="margin-top: 3rem; text-align: center;">
            {{ $voyages->links() }}
        </div>
    </div>
</section>

@endsection