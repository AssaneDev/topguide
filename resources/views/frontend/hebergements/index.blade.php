{{-- Integration Google Maps dans le frontend --}}

{{-- Dans votre vue frontend/hebergements/index.blade.php, remplacez la section carte par : --}}

{{-- Widget Carte avec Google Maps --}}
<div class="map-widget">
    <h4 class="widget-title">Localisation</h4>
    <div id="mini-carte" class="mini-map"></div>
    <button class="map-full-btn" data-bs-toggle="modal" data-bs-target="#carteModal">
        <i class="fas fa-expand"></i>
        Voir en plein écran
    </button>
</div>

{{-- Modal Carte Complète --}}
<div class="modal fade" id="carteModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carte des Hébergements</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div id="carte-complete" style="height: 500px;"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script async defer 
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initFrontendMaps">
</script>

<script>
let miniMap;
let fullMap;
let markers = [];

function initFrontendMaps() {
    initMiniCarte();
    
    // Initialiser la carte complète quand le modal s'ouvre
    $('#carteModal').on('shown.bs.modal', function() {
        initCarteComplete();
    });
}

function initMiniCarte() {
    // Carte miniature centrée sur le Sénégal
    miniMap = new google.maps.Map(document.getElementById('mini-carte'), {
        zoom: 6,
        center: { lat: 14.6928, lng: -17.4467 },
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
        zoomControl: true,
        styles: [
            {
                featureType: "poi",
                elementType: "labels",
                stylers: [{ visibility: "off" }]
            }
        ]
    });
    
    // Ajouter les marqueurs pour les hébergements visibles
    @foreach($hebergements->take(10) as $hebergement)
        @if($hebergement->latitude && $hebergement->longitude)
            addMarkerToMiniMap(
                {{ $hebergement->latitude }}, 
                {{ $hebergement->longitude }}, 
                `{!! addslashes($hebergement->nom) !!}`,
                `{!! addslashes($hebergement->tarif_format) !!}`
            );
        @endif
    @endforeach
}

function addMarkerToMiniMap(lat, lng, nom, tarif) {
    const marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: miniMap,
        title: nom,
        icon: {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 30 40">
                    <path fill="#2563eb" stroke="#ffffff" stroke-width="2" d="M15 0C6.7 0 0 6.7 0 15c0 15 15 25 15 25s15-10 15-25C30 6.7 23.3 0 15 0z"/>
                    <circle fill="#ffffff" cx="15" cy="15" r="8"/>
                    <text x="15" y="19" text-anchor="middle" font-family="Arial" font-size="10" fill="#2563eb">🏨</text>
                </svg>
            `),
            scaledSize: new google.maps.Size(30, 40),
            anchor: new google.maps.Point(15, 40)
        }
    });
    
    const infoWindow = new google.maps.InfoWindow({
        content: `
            <div style="padding: 10px; min-width: 200px;">
                <h6 style="margin: 0 0 5px 0; font-weight: 600;">${nom}</h6>
                <p style="margin: 0; color: #666; font-size: 14px;">${tarif}</p>
            </div>
        `
    });
    
    marker.addListener('click', function() {
        infoWindow.open(miniMap, marker);
    });
}

function initCarteComplete() {
    if (fullMap) return; // Déjà initialisée
    
    fullMap = new google.maps.Map(document.getElementById('carte-complete'), {
        zoom: 7,
        center: { lat: 14.6928, lng: -17.4467 },
        mapTypeControl: true,
        streetViewControl: true,
        fullscreenControl: true
    });
    
    // Charger tous les hébergements via API
    fetch('{{ route("hebergements.api.carte") }}')
        .then(response => response.json())
        .then(data => {
            data.forEach(hebergement => {
                addMarkerToFullMap(hebergement);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des hébergements:', error);
        });
}

function addMarkerToFullMap(hebergement) {
    const marker = new google.maps.Marker({
        position: { lat: hebergement.lat, lng: hebergement.lng },
        map: fullMap,
        title: hebergement.nom,
        icon: {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" viewBox="0 0 40 50">
                    <path fill="#2563eb" stroke="#ffffff" stroke-width="2" d="M20 0C8.95 0 0 8.95 0 20c0 20 20 30 20 30s20-10 20-30C40 8.95 31.05 0 20 0z"/>
                    <circle fill="#ffffff" cx="20" cy="20" r="12"/>
                    <text x="20" y="26" text-anchor="middle" font-family="Arial" font-size="12" fill="#2563eb">🏨</text>
                </svg>
            `),
            scaledSize: new google.maps.Size(40, 50),
            anchor: new google.maps.Point(20, 50)
        }
    });
    
    const infoWindow = new google.maps.InfoWindow({
        content: `
            <div style="padding: 15px; min-width: 250px; max-width: 300px;">
                <img src="${hebergement.image}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                <h6 style="margin: 0 0 8px 0; font-weight: 600; color: #333;">${hebergement.nom}</h6>
                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">${hebergement.tarif}</p>
                <a href="${hebergement.url}" style="
                    background: #2563eb;
                    color: white;
                    padding: 8px 16px;
                    border-radius: 6px;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                    display: inline-block;
                    transition: background 0.3s ease;
                " onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                    Voir les détails
                </a>
            </div>
        `
    });
    
    marker.addListener('click', function() {
        // Fermer tous les autres infoWindows
        markers.forEach(m => {
            if (m.infoWindow) {
                m.infoWindow.close();
            }
        });
        
        infoWindow.open(fullMap, marker);
    });
    
    // Stocker le marqueur et son infoWindow
    marker.infoWindow = infoWindow;
    markers.push(marker);
}

// Fonction d'erreur pour Google Maps
function initFrontendMapsError() {
    console.error('Erreur lors du chargement de Google Maps');
    $('#mini-carte').html(`
        <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted">
            <div class="text-center">
                <i class="fas fa-map fs-1 mb-2"></i><br>
                Carte non disponible<br>
                <small>Problème de connexion</small>
            </div>
        </div>
    `);
}

// Gestionnaires d'erreur globaux
window.initFrontendMaps = initFrontendMaps;
window.gm_authFailure = initFrontendMapsError;
</script>
@endpush