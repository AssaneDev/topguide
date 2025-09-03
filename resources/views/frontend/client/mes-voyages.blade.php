<!-- resources/views/frontend/client/mes-voyages.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Voyages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Mes Voyages</h1>
        
        <nav>
            <div class="nav nav-tabs" role="tablist">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#consultes">Voyages Consultés</button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#favoris">Mes Favoris</button>
            </div>
        </nav>
        
        <div class="tab-content mt-3">
            <!-- Voyages consultés -->
            <div class="tab-pane fade show active" id="consultes">
                @if($voyagesConsultes->count() > 0)
                    <div class="row">
                        @foreach($voyagesConsultes as $voyage)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="{{ asset($voyage->image_couverture ?? 'images/default.jpg') }}" class="card-img-top" alt="{{ $voyage->nom_voyage }}">
                                    <div class="card-body">
                                        <h6>{{ $voyage->nom_voyage }}</h6>
                                        <p class="small">{{ Str::limit($voyage->description_courte, 80) }}</p>
                                        <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-primary btn-sm">Revoir</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Aucun voyage consulté.</p>
                @endif
            </div>
            
            <!-- Favoris -->
            <div class="tab-pane fade" id="favoris">
                @if($voyagesFavoris->count() > 0)
                    <div class="row">
                        @foreach($voyagesFavoris as $voyage)
                            <div class="col-md-4 mb-3">
                                <div class="card border-warning">
                                    <img src="{{ asset($voyage->image_couverture ?? 'images/default.jpg') }}" class="card-img-top" alt="{{ $voyage->nom_voyage }}">
                                    <div class="card-body">
                                        <h6>{{ $voyage->nom_voyage }}</h6>
                                        <p class="small">{{ Str::limit($voyage->description_courte, 80) }}</p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-primary btn-sm">Voir</a>
                                            <button class="btn btn-warning btn-sm">⭐ Favori</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Aucun voyage en favori.</p>
                @endif
            </div>
        </div>
        
        <a href="{{ route('client.dashboard') }}" class="btn btn-secondary mt-3">Retour au tableau de bord</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- resources/views/frontend/client/mes-reservations.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Mes Réservations</h1>
        
        @if($reservations->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Voyage</th>
                            <th>Date de réservation</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->voyage_nom ?? 'Voyage' }}</td>
                                <td>{{ $reservation->created_at ?? now() }}</td>
                                <td><span class="badge bg-info">En attente</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Voir détails</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <h4>Aucune réservation trouvée</h4>
                <p>Vous n'avez pas encore effectué de réservation.</p>
                <a href="{{ route('voyages.index') }}" class="btn btn-primary">Découvrir nos voyages</a>
            </div>
        @endif
        
        <a href="{{ route('client.dashboard') }}" class="btn btn-secondary mt-3">Retour au tableau de bord</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- resources/views/frontend/client/profil.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Mon Profil</h1>
        
        @if(session('message'))
            <div class="alert alert-{{ session('alert-type', 'info') }} alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="row">
            <!-- Informations personnelles -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Informations personnelles</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('client.profil.update') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom complet</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Téléphone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="date_naissance" class="form-label">Date de naissance</label>
                                    <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                           id="date_naissance" name="date_naissance" 
                                           value="{{ old('date_naissance', $user->date_naissance?->format('Y-m-d')) }}">
                                    @error('date_naissance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Adresse</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="3">{{ old('address', $user->address ?? '') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Préférences de voyage</label>
                                <div class="row">
                                    @php
                                        $preferences = old('preferences_voyage', $user->preferences_voyage ?? []);
                                        $options = ['culturel', 'aventure', 'detente', 'famille', 'eco-tourisme', 'decouverte'];
                                    @endphp
                                    @foreach($options as $option)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="preferences_voyage[]" value="{{ $option }}" 
                                                       id="pref_{{ $option }}"
                                                       {{ in_array($option, $preferences) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pref_{{ $option }}">
                                                    {{ ucfirst($option) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Mettre à jour le profil</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Changer le mot de passe -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Changer le mot de passe</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('client.profil.password') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>
                            
                            <button type="submit" class="btn btn-warning w-100">Changer le mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="{{ route('client.dashboard') }}" class="btn btn-secondary mt-3">Retour au tableau de bord</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>