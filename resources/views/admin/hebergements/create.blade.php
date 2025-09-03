{{-- resources/views/admin/hebergements/create.blade.php - Version avec Google Maps --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Hébergements</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hebergements.index') }}">Hébergements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.hebergements.store') }}" enctype="multipart/form-data" id="hebergement-form">
        @csrf
        
        <div class="row">
            {{-- Informations principales --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">🏨 Informations Principales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nom" class="form-label">Nom de l'hébergement *</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" name="nom" value="{{ old('nom') }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="myeditorinstance" name="description" rows="6">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="adresse" class="form-label">Adresse complète *</label>
                                <div class="input-group">
                                    <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                              id="adresse" name="adresse" rows="2" required 
                                              placeholder="Saisissez l'adresse complète...">{{ old('adresse') }}</textarea>
                                    <button type="button" class="btn btn-outline-primary" id="geocode-btn">
                                        <i class="bx bx-map"></i> Localiser
                                    </button>
                                    <button type="button" class="btn btn-warning" onclick="testSimple()">
    🧪 TEST SIMPLE
</button>
<button type="button" class="btn btn-success" onclick="debugGeocode()">
    🔍 DEBUG GÉOCODAGE
</button>
                                </div>
                                <div class="form-text">
                                    Saisissez l'adresse et cliquez sur "Localiser" pour obtenir les coordonnées automatiquement.
                                </div>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="region" class="form-label">Région *</label>
                                <select class="form-select @error('region') is-invalid @enderror" 
                                        id="region" name="region" required>
                                    <option value="">Sélectionner une région</option>
                                    @foreach($regions as $key => $region)
                                        <option value="{{ $key }}" {{ old('region') == $key ? 'selected' : '' }}>
                                            {{ $region }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="departement" class="form-label">Département *</label>
                                <input type="text" class="form-control @error('departement') is-invalid @enderror" 
                                       id="departement" name="departement" value="{{ old('departement') }}" required>
                                @error('departement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="lieu_touristique" class="form-label">Lieu touristique</label>
                                <input type="text" class="form-control" 
                                       id="lieu_touristique" name="lieu_touristique" 
                                       value="{{ old('lieu_touristique') }}"
                                       placeholder="Ex: Île de Gorée, Lac Rose, Saly...">
                            </div>

                            {{-- Coordonnées GPS --}}
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="number" step="any" class="form-control" 
                                       id="latitude" name="latitude" value="{{ old('latitude') }}" 
                                       placeholder="14.6928" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="number" step="any" class="form-control" 
                                       id="longitude" name="longitude" value="{{ old('longitude') }}" 
                                       placeholder="-17.4467" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Carte Google Maps --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">🗺️ Localisation sur la carte</h5>
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-info" id="current-location-btn">
                                <i class="bx bx-current-location"></i> Ma position
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="reset-map-btn">
                                <i class="bx bx-refresh"></i> Réinitialiser
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="google-map" style="height: 400px; border-radius: 8px;"></div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-info-circle text-info me-2"></i>
                                        <small class="text-muted">Cliquez sur la carte pour placer le marqueur</small>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div id="map-coordinates" class="text-muted">
                                        <small>Coordonnées: <span id="coord-display">Non définies</span></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tarifs et Contact --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">💰 Tarifs et Contact</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tarif_min" class="form-label">Tarif minimum (XOF)</label>
                                <input type="number" class="form-control @error('tarif_min') is-invalid @enderror" 
                                       id="tarif_min" name="tarif_min" value="{{ old('tarif_min') }}" min="0">
                                @error('tarif_min')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tarif_max" class="form-label">Tarif maximum (XOF)</label>
                                <input type="number" class="form-control @error('tarif_max') is-invalid @enderror" 
                                       id="tarif_max" name="tarif_max" value="{{ old('tarif_max') }}" min="0">
                                @error('tarif_max')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" 
                                       id="telephone" name="telephone" value="{{ old('telephone') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="site_web" class="form-label">Site Web</label>
                                <input type="url" class="form-control @error('site_web') is-invalid @enderror" 
                                       id="site_web" name="site_web" value="{{ old('site_web') }}"
                                       placeholder="https://example.com">
                                @error('site_web')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Images --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">📸 Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="images" class="form-label">Images de l'hébergement</label>
                            <input type="file" class="form-control @error('images.*') is-invalid @enderror" 
                                   id="images" name="images[]" multiple accept="image/*">
                            <div class="form-text">Formats acceptés: JPG, PNG, WebP. Taille max: 2MB par image.</div>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div id="image-preview" class="row g-2"></div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Note Admin --}}
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">⭐ Évaluation Interne</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="note_admin" class="form-label">Note administrative</label>
                            <select class="form-select" id="note_admin" name="note_admin">
                                <option value="">Pas de note</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('note_admin') == $i ? 'selected' : '' }}>
                                        {{ $i }} étoile{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="commentaire_admin" class="form-label">Commentaire interne</label>
                            <textarea class="form-control" id="commentaire_admin" name="commentaire_admin" 
                                      rows="3" placeholder="Notes internes...">{{ old('commentaire_admin') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Statut et Options --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">⚙️ Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" name="statut">
                                <option value="actif" {{ old('statut', 'actif') == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                   {{ old('featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">
                                Mettre en vedette
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Équipements --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">🏊‍♀️ Équipements</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($amenities as $key => $label)
                                <div class="col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               id="amenity_{{ $key }}" name="amenities[]" value="{{ $key }}"
                                               {{ in_array($key, old('amenities', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="amenity_{{ $key }}">
                                            {{ $label }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Badges --}}
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">🎖️ Badges</h5>
                    </div>
                    <div class="card-body">
                        @foreach($badges as $key => $label)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" 
                                       id="badge_{{ $key }}" name="badges[]" value="{{ $key }}"
                                       {{ in_array($key, old('badges', [])) ? 'checked' : '' }}>
                                <label class="form-check-label small" for="badge_{{ $key }}">
                                    {{ $label }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Actions --}}
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" id="btn-submit">
                            <i class="bx bx-save"></i> <span id="btn-text">Créer l'Hébergement</span>
                        </button>
                        <a href="{{ route('admin.hebergements.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bx bx-arrow-back"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Ajoutez ce bouton de test TEMPORAIRE dans votre formulaire, juste après le bouton "Localiser" --}}

<button type="button" class="btn btn-warning" onclick="testSimple()">
    🧪 TEST SIMPLE
</button>

@push('scripts')

<script>
// Variables globales pour Google Maps
let map, marker, geocoder;
const defaultLocation = { lat: 14.6928, lng: -17.4467 };

// Fonction initMap DOIT être globale pour Google Maps callback
window.initMap = function() {
    console.log('🗺️ Initialisation Google Maps...');
    
    try {
        const mapElement = document.getElementById('google-map');
        if (!mapElement) {
            console.error('❌ Élément #google-map non trouvé');
            return;
        }

        // Initialiser la carte
        map = new google.maps.Map(mapElement, {
            zoom: 10,
            center: defaultLocation,
            mapTypeControl: true,
            streetViewControl: true,
            fullscreenControl: true
        });

        // Initialiser le géocodeur
        geocoder = new google.maps.Geocoder();
        
        // Créer le marqueur
        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true,
            title: 'Position de l\'hébergement'
        });

        // Événements de la carte
        map.addListener('click', function(event) {
            console.log('Clic sur la carte:', event.latLng.toString());
            updateMarkerPosition(event.latLng);
        });

        marker.addListener('dragend', function(event) {
            console.log('Marqueur déplacé:', event.latLng.toString());
            updateMarkerPosition(event.latLng);
        });

        console.log('✅ Google Maps initialisé avec succès');
        
        // Maintenant qu'on a Google Maps, activer les boutons
        setupMapButtons();
        
    } catch (error) {
        console.error('❌ Erreur initMap:', error);
        $('#google-map').html(`
            <div class="alert alert-danger">
                <h6>Erreur Google Maps</h6>
                <p>${error.message}</p>
            </div>
        `);
    }
};

function setupMapButtons() {
    console.log('🎯 Configuration des boutons...');
    
    // Activer les boutons
    $('#geocode-btn, #current-location-btn, #reset-map-btn').prop('disabled', false);
    
    // Attacher l'événement au bouton Localiser
    $('#geocode-btn').off('click.geocode').on('click.geocode', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('🖱️ CLIC BOUTON LOCALISER !');
        geocodeAddress();
    });
    
    // Bouton Ma position
    $('#current-location-btn').off('click.geoloc').on('click.geoloc', function(e) {
        e.preventDefault();
        console.log('🖱️ Clic bouton Ma position');
        getCurrentLocation();
    });
    
    // Bouton Réinitialiser
    $('#reset-map-btn').off('click.reset').on('click.reset', function(e) {
        e.preventDefault();
        console.log('🖱️ Clic bouton Réinitialiser');
        resetMap();
    });
    
    console.log('✅ Événements des boutons configurés');
}

function updateMarkerPosition(latLng) {
    try {
        const lat = typeof latLng.lat === 'function' ? latLng.lat() : latLng.lat;
        const lng = typeof latLng.lng === 'function' ? latLng.lng() : latLng.lng;
        
        marker.setPosition({ lat, lng });
        
        // Mettre à jour les champs
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
        
        // Mettre à jour l'affichage
        const coordDisplay = document.getElementById('coord-display');
        if (coordDisplay) {
            coordDisplay.textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        }
        
        console.log('Position mise à jour:', lat.toFixed(6), lng.toFixed(6));
    } catch (error) {
        console.error('Erreur updateMarkerPosition:', error);
    }
}

function geocodeAddress() {
    console.log('🔍 DÉBUT GÉOCODAGE !');
    
    if (!geocoder) {
        console.error('❌ Géocodeur non initialisé');
        toastr.error('Carte non initialisée. Rechargez la page.');
        return;
    }
    
    const addressInput = document.getElementById('adresse');
    if (!addressInput) {
        console.error('❌ Champ adresse non trouvé');
        return;
    }
    
    const address = addressInput.value.trim();
    if (!address) {
        toastr.warning('Veuillez saisir une adresse');
        addressInput.focus();
        return;
    }

    console.log('Adresse à géocoder:', address);
    
    const btn = document.getElementById('geocode-btn');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Localisation...';
    btn.disabled = true;

    const searchQuery = address + ', Sénégal';
    console.log('Requête complète:', searchQuery);

    geocoder.geocode({ 
        address: searchQuery,
        region: 'SN',
        componentRestrictions: { country: 'SN' }
    }, function(results, status) {
        console.log('📍 Statut géocodage:', status);
        console.log('Résultats reçus:', results ? results.length : 0);
        
        btn.innerHTML = originalText;
        btn.disabled = false;

        if (status === 'OK' && results && results.length > 0) {
            const result = results[0];
            const location = result.geometry.location;
            
            console.log('✅ SUCCÈS ! Position trouvée:', location.toString());
            console.log('Adresse formatée:', result.formatted_address);
            
            updateMarkerPosition(location);
            map.setCenter(location);
            map.setZoom(15);
            
            toastr.success('🎉 Adresse localisée avec succès !');
            
        } else {
            console.error('❌ Échec géocodage:', status);
            
            let message = 'Adresse non trouvée';
            switch(status) {
                case 'ZERO_RESULTS':
                    message = 'Aucun résultat pour cette adresse';
                    break;
                case 'REQUEST_DENIED':
                    message = 'Erreur de clé API ou restrictions';
                    break;
                case 'OVER_QUERY_LIMIT':
                    message = 'Quota API dépassé';
                    break;
                case 'INVALID_REQUEST':
                    message = 'Requête invalide';
                    break;
            }
            
            toastr.error('❌ ' + message);
        }
    });
}

function getCurrentLocation() {
    if (!navigator.geolocation) {
        toastr.error('Géolocalisation non supportée');
        return;
    }

    const btn = document.getElementById('current-location-btn');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Localisation...';
    btn.disabled = true;

    navigator.geolocation.getCurrentPosition(
        function(position) {
            const location = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            
            updateMarkerPosition(location);
            map.setCenter(location);
            map.setZoom(15);
            
            btn.innerHTML = originalText;
            btn.disabled = false;
            
            toastr.success('📍 Position actuelle détectée !');
        },
        function(error) {
            btn.innerHTML = originalText;
            btn.disabled = false;
            toastr.error('Impossible d\'obtenir votre position');
        }
    );
}

function resetMap() {
    updateMarkerPosition(defaultLocation);
    map.setCenter(defaultLocation);
    map.setZoom(10);
    toastr.info('🔄 Carte réinitialisée');
}

// Fonction de test
window.testGeocode = function() {
    console.log('🧪 Test géocodage manuel');
    document.getElementById('adresse').value = 'Place de l\'Indépendance, Dakar';
    geocodeAddress();
};

console.log('🚀 Fonctions Google Maps définies');
</script>

{{-- CHARGEMENT FORCÉ de Google Maps (sans condition) --}}
<script>
    console.log('🔑 Chargement FORCÉ de Google Maps API...');
    console.log('Clé API détectée:', '{{ env("GOOGLE_MAPS_API_KEY") }}' ? 'OUI' : 'NON');
</script>

{{-- TOUJOURS charger Google Maps avec config() --}}
<script async defer 
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=places&callback=initMap&v=3">
</script>

{{-- Fallback si pas de clé --}}
<script>
// Vérification après tentative de chargement
setTimeout(function() {
    if (typeof google === 'undefined') {
        console.error('❌ Google Maps n\'a pas pu se charger');
        $('#google-map').html(`
            <div class="alert alert-danger">
                <h6>❌ Erreur de chargement Google Maps</h6>
                <p>Vérifiez votre clé API: <code>{{ env('GOOGLE_MAPS_API_KEY') }}</code></p>
                <p>Longueur de la clé: {{ strlen(env('GOOGLE_MAPS_API_KEY')) }} caractères</p>
            </div>
        `);
    }
}, 5000);
</script>

{{-- Document ready pour initialisation --}}
<script>
$(document).ready(function() {
    console.log('📄 Document ready - Version avec debug clé API');
    console.log('jQuery version:', $.fn.jquery);
    console.log('Clé API dans template:', '{{ env("GOOGLE_MAPS_API_KEY") }}');
    
    // Désactiver boutons au début
    $('#geocode-btn, #current-location-btn, #reset-map-btn').prop('disabled', true);
    console.log('Boutons désactivés en attente de Google Maps');
    
    // Diagnostic après quelques secondes
    setTimeout(function() {
        console.log('=== DIAGNOSTIC FINAL ===');
        console.log('Google Maps chargé:', typeof google !== 'undefined');
        console.log('initMap définie:', typeof window.initMap === 'function');
        console.log('Carte initialisée:', typeof map !== 'undefined' && map !== null);
        console.log('Boutons trouvés:', $('#geocode-btn').length);
        console.log('Boutons activés:', !$('#geocode-btn').prop('disabled'));
        
        if (typeof google !== 'undefined' && map) {
            console.log('🎉 TOUT EST PRÊT !');
        }
    }, 5000);
});
</script>

{{-- Et ajoutez ce script à la fin de votre @push('scripts') --}}

<script>
// Fonction de debug globale
window.debugGeocode = function() {
    console.log('🔍 DEBUG GÉOCODAGE MANUEL');
    
    // Tests de base
    console.log('1. Géocodeur initialisé:', !!geocoder);
    console.log('2. Google Maps chargé:', typeof google !== 'undefined');
    console.log('3. Carte initialisée:', !!map);
    
    // Test du champ adresse
    const adresseField = document.getElementById('adresse');
    console.log('4. Champ adresse trouvé:', !!adresseField);
    
    if (adresseField) {
        console.log('   Valeur actuelle:', adresseField.value);
        
        // Forcer une valeur de test
        adresseField.value = 'Place de l\'Indépendance, Dakar';
        console.log('   Valeur forcée:', adresseField.value);
    }
    
    // Test du bouton
    const bouton = document.getElementById('geocode-btn');
    console.log('5. Bouton trouvé:', !!bouton);
    console.log('   Bouton désactivé:', bouton ? bouton.disabled : 'N/A');
    
    // Test du géocodeur
    if (geocoder && adresseField && adresseField.value) {
        console.log('6. 🚀 LANCEMENT DU GÉOCODAGE DE TEST...');
        
        geocoder.geocode({
            address: adresseField.value + ', Sénégal'
        }, function(results, status) {
            console.log('📍 Résultat debug:', status);
            console.log('📍 Résultats:', results);
            
            if (status === 'OK') {
                console.log('✅ GÉOCODAGE RÉUSSI !');
                alert('✅ Le géocodage fonctionne ! Position: ' + results[0].geometry.location.toString());
            } else {
                console.log('❌ GÉOCODAGE ÉCHOUÉ:', status);
                alert('❌ Géocodage échoué: ' + status);
            }
        });
    } else {
        console.log('❌ Impossible de tester - éléments manquants');
        alert('❌ Éléments manquants pour le test');
    }
};

// Test automatique du bouton au chargement
$(document).ready(function() {
    setTimeout(function() {
        console.log('🔧 TEST AUTOMATIQUE DU BOUTON...');
        
        const btn = $('#geocode-btn');
        console.log('Bouton trouvé:', btn.length);
        console.log('Bouton visible:', btn.is(':visible'));
        console.log('Bouton activé:', !btn.prop('disabled'));
        
        // Vérifier les événements attachés
        const events = $._data(btn[0], 'events');
        console.log('Événements attachés:', events);
        
        // Test de clic programmatique
        console.log('Test clic programmatique...');
        btn.click();
        
    }, 3000);
});

// Alternative: Attacher l'événement différemment
$(document).ready(function() {
    // Méthode alternative d'attachement
    $('#geocode-btn').on('click', function(e) {
        e.preventDefault();
        console.log('🖱️ ÉVÉNEMENT ALTERNATIF DÉCLENCHÉ !');
        
        // Appeler directement la fonction
        if (typeof geocodeAddress === 'function') {
            geocodeAddress();
        } else {
            console.error('❌ Fonction geocodeAddress non trouvée');
            alert('❌ Fonction geocodeAddress non disponible');
        }
    });
});
</script>

@endpush
@endsection