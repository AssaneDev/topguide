<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopGuide - Test Standalone</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0; 
            padding: 20px; 
            background: #f9fafb;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { 
            background: linear-gradient(135deg, #ea580c, #f97316); 
            color: white; 
            padding: 2rem; 
            border-radius: 16px; 
            text-align: center; 
            margin-bottom: 2rem;
        }
        .grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); 
            gap: 2rem; 
        }
        .card { 
            background: white; 
            border-radius: 16px; 
            overflow: hidden; 
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover { 
            transform: translateY(-5px); 
        }
        .card img { 
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
        }
        .card-content { 
            padding: 1.5rem; 
        }
        .card-title { 
            font-size: 1.25rem; 
            font-weight: bold; 
            margin-bottom: 0.5rem; 
            color: #1f2937;
        }
        .card-text { 
            color: #6b7280; 
            line-height: 1.6; 
            margin-bottom: 1rem;
        }
        .info-grid { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 0.5rem; 
            margin-bottom: 1rem;
        }
        .info-item { 
            background: #f3f4f6; 
            padding: 0.5rem; 
            border-radius: 8px; 
            text-align: center;
            font-size: 0.875rem;
        }
        .actions { 
            display: flex; 
            gap: 0.5rem; 
        }
        .btn { 
            flex: 1; 
            padding: 0.75rem; 
            border-radius: 8px; 
            text-decoration: none; 
            text-align: center; 
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-primary { 
            background: #ea580c; 
            color: white; 
        }
        .btn-secondary { 
            background: white; 
            color: #ea580c; 
            border: 2px solid #ea580c; 
        }
        .btn:hover { 
            transform: translateY(-1px); 
        }
        .debug { 
            background: #f0f0f0; 
            padding: 1rem; 
            margin-top: 2rem; 
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌍 TopGuide - Nos Voyages</h1>
            <p>Test page standalone - Diagnostic page blanche</p>
        </div>
        
        <div class="grid">
            @forelse($voyages as $voyage)
            <div class="card">
                @if($voyage->image_couverture)
                    <img src="{{ asset($voyage->image_couverture) }}" alt="{{ $voyage->nom_voyage }}">
                @else
                    <div style="height: 200px; background: #e5e7eb; display: flex; align-items: center; justify-content: center; color: #6b7280;">
                        📷 Image non disponible
                    </div>
                @endif
                
                <div class="card-content">
                    <h3 class="card-title">{{ $voyage->nom_voyage }}</h3>
                    <p class="card-text">{{ Str::limit($voyage->description_courte ?? 'Aucune description', 100) }}</p>
                    
                    <div class="info-grid">
                        <div class="info-item">📍 {{ $voyage->region }}</div>
                        <div class="info-item">📅 {{ $voyage->duree_jours }} jours</div>
                        <div class="info-item">👥 {{ $voyage->participants_max }} max</div>
                        <div class="info-item">💰 {{ number_format($voyage->prix_base) }} FCFA</div>
                    </div>
                    
                    <div class="actions">
                        <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-primary">Voir détails</a>
                        <a href="{{ route('voyages.programme', $voyage->id) }}" class="btn btn-secondary">Programme</a>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: white; border-radius: 16px;">
                <h2>🚧 Aucun voyage disponible</h2>
                <p>Nos circuits sont en cours de préparation.</p>
            </div>
            @endforelse
        </div>
        
        <div class="debug">
            <h3>🔍 Informations de diagnostic</h3>
            <p><strong>Voyages trouvés:</strong> {{ $voyages->count() }}</p>
            <p><strong>Environment:</strong> {{ app()->environment() }}</p>
            <p><strong>Debug:</strong> {{ config('app.debug') ? 'ON' : 'OFF' }}</p>
            <p><strong>Route actuelle:</strong> {{ Route::currentRouteName() }}</p>
            <p><strong>URL:</strong> {{ url()->current() }}</p>
            
            @if($voyages->count() > 0)
                <p><strong>Premier voyage:</strong></p>
                <ul>
                    <li>ID: {{ $voyages->first()->id }}</li>
                    <li>Nom: {{ $voyages->first()->nom_voyage }}</li>
                    <li>Statut: {{ $voyages->first()->statut }}</li>
                    <li>Image: {{ $voyages->first()->image_couverture ?? 'Non définie' }}</li>
                </ul>
            @endif
        </div>
    </div>
</body>
</html>