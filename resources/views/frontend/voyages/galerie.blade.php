@extends('frontend.main_master')

@section('main')
<div class="breadcumb-wrapper" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('{{ asset($voyage->image_principale) }}');">
    <div class="container">
        <div class="breadcumb-content text-center">
            <h1 class="breadcumb-title text-white">Galerie Photos</h1>
            <h2 class="text-white-50 mb-3">{{ $voyage->nom_voyage }}</h2>
            <p class="text-white-75 mb-4">Découvrez en images ce voyage exceptionnel</p>
            <ul class="breadcumb-menu justify-content-center">
                <li><a href="{{url('/')}}">Accueil</a></li>
                <li><a href="{{ route('voyages.index') }}">Voyages</a></li>
                <li><a href="{{ route('voyages.detail', $voyage->id) }}">{{ Str::limit($voyage->nom_voyage, 30) }}</a></li>
                <li>Galerie</li>
            </ul>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- En-tête de la galerie -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <div class="galerie-header">
                <h2 class="mb-3">{{ $voyage->galeries->count() }} Photos</h2>
                <p class="text-muted mb-4">Plongez dans l'univers de ce voyage à travers notre collection de photos authentiques.</p>
                
                <!-- Filtres -->
                <div class="galerie-filters mb-4">
                    <button class="filter-btn active" data-filter="all">
                        <i class="fas fa-images me-2"></i>Toutes ({{ $voyage->galeries->count() }})
                    </button>
                    <button class="filter-btn" data-filter="galerie">
                        <i class="fas fa-camera me-2"></i>Générales ({{ $voyage->galeries->where('type_image', 'galerie')->count() }})
                    </button>
                    <button class="filter-btn" data-filter="etape_specifique">
                        <i class="fas fa-route me-2"></i>Par étapes ({{ $voyage->galeries->where('type_image', 'etape_specifique')->count() }})
                    </button>
                    <button class="filter-btn" data-filter="activite">
                        <i class="fas fa-hiking me-2"></i>Activités ({{ $voyage->galeries->where('type_image', 'activite')->count() }})
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Galerie principale -->
    <div class="galerie-container">
        <div class="row g-3" id="galerieGrid">
            @forelse($voyage->galeries as $index => $image)
            <div class="col-lg-4 col-md-6 galerie-item" data-type="{{ $image->type_image }}" data-index="{{ $index }}">
                <div class="galerie-card">
                    <div class="image-container">
                        <img src="{{ asset($image->chemin_image) }}" 
                             alt="{{ $image->alt_image ?? 'Photo du voyage' }}"
                             class="galerie-image"
                             loading="lazy"
                             data-bs-toggle="modal"
                             data-bs-target="#galerieModal"
                             data-index="{{ $index }}">
                        
                        <!-- Overlay avec informations -->
                        <div class="image-overlay">
                            <div class="image-info">
                                <div class="image-type">
                                    @switch($image->type_image)
                                        @case('galerie')
                                            <i class="fas fa-camera me-1"></i>Générale
                                            @break
                                        @case('etape_specifique')
                                            <i class="fas fa-map-marker-alt me-1"></i>Jour {{ $image->numero_jour }}
                                            @break
                                        @case('activite')
                                            <i class="fas fa-hiking me-1"></i>{{ $image->activite?->nom_activite ?? 'Activité' }}
                                            @break
                                        @default
                                            <i class="fas fa-image me-1"></i>Photo
                                    @endswitch
                                </div>
                                @if($image->type_image === 'etape_specifique' && $image->numero_jour)
                                    @php
                                        $etape = $voyage->etapes->where('numero_jour', $image->numero_jour)->first();
                                    @endphp
                                    @if($etape)
                                        <div class="image-title">{{ $etape->titre_etape }}</div>
                                    @endif
                                @elseif($image->type_image === 'activite' && $image->activite)
                                    <div class="image-title">{{ $image->activite->nom_activite }}</div>
                                @else
                                    <div class="image-title">{{ $voyage->nom_voyage }}</div>
                                @endif
                            </div>
                            <div class="image-actions">
                                <button class="action-btn zoom-btn" data-bs-toggle="modal" data-bs-target="#galerieModal" data-index="{{ $index }}">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                                <button class="action-btn download-btn" onclick="downloadImage('{{ asset($image->chemin_image) }}', '{{ $voyage->nom_voyage }}_{{ $index + 1 }}')">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="no-images-message text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-images fa-4x text-muted"></i>
                    </div>
                    <h4>Aucune photo disponible</h4>
                    <p class="text-muted">Les photos de ce voyage seront bientôt disponibles.</p>
                    <a href="{{ route('voyages.detail', $voyage->id) }}" class="btn btn-primary">
                        Retour aux détails du voyage
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Call to Action -->
    @if($voyage->galeries->count() > 0)
    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="cta-section text-center p-4 rounded-3 bg-light">
                <h4 class="mb-3">Ces images vous inspirent ?</h4>
                <p class="text-muted mb-4">Vivez cette expérience unique en réservant votre voyage dès maintenant.</p>
                <div class="cta-buttons">
                    @auth
                        <a href="{{ route('voyages.reservation', $voyage->id) }}" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-calendar-check me-2"></i>Réserver ce voyage
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-user-plus me-2"></i>S'inscrire pour réserver
                        </a>
                    @endauth
                    <a href="{{ route('voyages.programme', $voyage->id) }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-route me-2"></i>Voir le programme
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal Galerie avec navigation -->
<div class="modal fade" id="galerieModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0 text-white">
                <h5 class="modal-title" id="modalImageTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0 position-relative">
                <!-- Image principale -->
                <div class="modal-image-container">
                    <img src="" alt="" class="modal-image" id="modalImage">
                    
                    <!-- Boutons de navigation -->
                    <button class="nav-btn nav-prev" id="prevImage">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="nav-btn nav-next" id="nextImage">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    
                    <!-- Compteur -->
                    <div class="image-counter">
                        <span id="currentImageIndex">1</span> / <span id="totalImages">{{ $voyage->galeries->count() }}</span>
                    </div>
                </div>
                
                <!-- Informations de l'image -->
                <div class="modal-image-info">
                    <div class="container">
                        <div class="row align-items-center py-3">
                            <div class="col-md-8">
                                <div class="image-details text-white">
                                    <div class="image-type-modal mb-1" id="modalImageType"></div>
                                    <div class="image-title-modal" id="modalImageDescription"></div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <button class="btn btn-outline-light btn-sm me-2" onclick="downloadCurrentImage()">
                                    <i class="fas fa-download me-1"></i>Télécharger
                                </button>
                                <button class="btn btn-outline-light btn-sm" onclick="shareCurrentImage()">
                                    <i class="fas fa-share me-1"></i>Partager
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Miniatures -->
                <div class="modal-thumbnails">
                    <div class="thumbnails-container" id="modalThumbnails">
                        @foreach($voyage->galeries as $index => $image)
                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                            <img src="{{ asset($image->chemin_image) }}" alt="Miniature {{ $index + 1 }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.galerie-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.5rem;
}

.filter-btn {
    background: white;
    border: 2px solid #e9ecef;
    color: #6c757d;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-btn:hover,
.filter-btn.active {
    background: #FF6B35;
    border-color: #FF6B35;
    color: white;
    transform: translateY(-2px);
}

.galerie-item {
    transition: all 0.3s ease;
}

.galerie-item.hidden {
    opacity: 0;
    transform: scale(0.8);
    height: 0;
    overflow: hidden;
    margin: 0;
    padding: 0;
}

.galerie-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.galerie-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.image-container {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.galerie-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
    cursor: pointer;
}

.galerie-card:hover .galerie-image {
    transform: scale(1.1);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(0,0,0,0.7), transparent, rgba(0,0,0,0.3));
    opacity: 0;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 1rem;
}

.galerie-card:hover .image-overlay {
    opacity: 1;
}

.image-info {
    color: white;
}

.image-type {
    background: rgba(255, 107, 53, 0.9);
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 0.5rem;
}

.image-title {
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.2;
}

.image-actions {
    display: flex;
    gap: 0.5rem;
    align-self: flex-end;
}

.action-btn {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    cursor: pointer;
}

.action-btn:hover {
    background: rgba(255, 107, 53, 0.8);
    border-color: rgba(255, 107, 53, 0.8);
    transform: scale(1.1);
}

/* Modal Styles */
.modal-content.bg-dark {
    background: #1a1a1a !important;
    border: none;
}

.modal-image-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 60vh;
    background: #000;
}

.modal-image {
    max-width: 100%;
    max-height: 70vh;
    object-fit: contain;
}

.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    cursor: pointer;
    z-index: 10;
}

.nav-btn:hover {
    background: rgba(255, 107, 53, 0.8);
    transform: translateY(-50%) scale(1.1);
}

.nav-prev {
    left: 20px;
}

.nav-next {
    right: 20px;
}

.image-counter {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.modal-image-info {
    background: rgba(0, 0, 0, 0.8);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.image-type-modal {
    color: #FF6B35;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.image-title-modal {
    font-size: 1.1rem;
    font-weight: 500;
}

.modal-thumbnails {
    background: rgba(0, 0, 0, 0.9);
    padding: 1rem 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.thumbnails-container {
    display: flex;
    gap: 0.5rem;
    padding: 0 1rem;
    overflow-x: auto;
    scrollbar-width: thin;
    scrollbar-color: #FF6B35 transparent;
}

.thumbnail-item {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.thumbnail-item.active {
    border-color: #FF6B35;
    transform: scale(1.1);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-images-message {
    background: #f8f9fa;
    border-radius: 15px;
    margin: 2rem 0;
}

.cta-section {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
    border: 1px solid #dee2e6;
}

@media (max-width: 768px) {
    .galerie-filters {
        flex-direction: column;
        align-items: center;
    }
    
    .filter-btn {
        width: 100%;
        max-width: 200px;
    }
    
    .image-container {
        height: 250px;
    }
    
    .nav-btn {
        width: 40px;
        height: 40px;
    }
    
    .nav-prev {
        left: 10px;
    }
    
    .nav-next {
        right: 10px;
    }
    
    .modal-thumbnails {
        display: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Variables globales
let currentImageIndex = 0;
const images = @json($voyage->galeries->values()->toArray());
let filteredImages = [...images];

// Filtrage des images
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Mise à jour des boutons actifs
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.getAttribute('data-filter');
        filterImages(filter);
    });
});

function filterImages(type) {
    const items = document.querySelectorAll('.galerie-item');
    
    items.forEach(item => {
        const itemType = item.getAttribute('data-type');
        
        if (type === 'all' || itemType === type) {
            item.classList.remove('hidden');
        } else {
            item.classList.add('hidden');
        }
    });
    
    // Mettre à jour la liste filtrée pour le modal
    if (type === 'all') {
        filteredImages = [...images];
    } else {
        filteredImages = images.filter(img => img.type_image === type);
    }
}

// Modal galerie
const modal = document.getElementById('galerieModal');
const modalImage = document.getElementById('modalImage');
const modalTitle = document.getElementById('modalImageTitle');
const currentIndexSpan = document.getElementById('currentImageIndex');
const totalImagesSpan = document.getElementById('totalImages');
const modalImageType = document.getElementById('modalImageType');
const modalImageDescription = document.getElementById('modalImageDescription');

// Ouvrir le modal
document.querySelectorAll('[data-bs-target="#galerieModal"]').forEach(trigger => {
    trigger.addEventListener('click', function() {
        const index = parseInt(this.getAttribute('data-index'));
        openModal(index);
    });
});

function openModal(index) {
    currentImageIndex = index;
    showImage(index);
    updateThumbnails();
}

function showImage(index) {
    if (index < 0 || index >= images.length) return;
    
    const image = images[index];
    modalImage.src = `{{ asset('') }}${image.chemin_image}`;
    modalImage.alt = image.alt_image || 'Photo du voyage';
    
    // Mise à jour des informations
    currentIndexSpan.textContent = index + 1;
    totalImagesSpan.textContent = images.length;
    
    // Type d'image
    let typeText = '';
    switch(image.type_image) {
        case 'galerie':
            typeText = 'Photo générale';
            break;
        case 'etape_specifique':
            typeText = `Jour ${image.numero_jour}`;
            break;
        case 'activite':
            typeText = 'Activité';
            break;
    }
    modalImageType.textContent = typeText;
    
    // Description
    modalImageDescription.textContent = getImageDescription(image);
}

function getImageDescription(image) {
    if (image.type_image === 'etape_specifique' && image.numero_jour) {
        // Trouver l'étape correspondante
        const etape = @json($voyage->etapes->toArray()).find(e => e.numero_jour == image.numero_jour);
        return etape ? etape.titre_etape : 'Étape du voyage';
    } else if (image.type_image === 'activite' && image.activite) {
        return image.activite.nom_activite;
    }
    return '{{ $voyage->nom_voyage }}';
}

// Navigation dans le modal
document.getElementById('prevImage').addEventListener('click', () => {
    currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : images.length - 1;
    showImage(currentImageIndex);
    updateThumbnails();
});

document.getElementById('nextImage').addEventListener('click', () => {
    currentImageIndex = currentImageIndex < images.length - 1 ? currentImageIndex + 1 : 0;
    showImage(currentImageIndex);
    updateThumbnails();
});

// Navigation clavier
document.addEventListener('keydown', function(e) {
    if (modal.classList.contains('show')) {
        if (e.key === 'ArrowLeft') {
            document.getElementById('prevImage').click();
        } else if (e.key === 'ArrowRight') {
            document.getElementById('nextImage').click();
        } else if (e.key === 'Escape') {
            bootstrap.Modal.getInstance(modal).hide();
        }
    }
});

// Miniatures
function updateThumbnails() {
    document.querySelectorAll('.thumbnail-item').forEach((thumb, index) => {
        thumb.classList.toggle('active', index === currentImageIndex);
    });
    
    // Scroll vers la miniature active
    const activeThumb = document.querySelector('.thumbnail-item.active');
    if (activeThumb) {
        activeThumb.scrollIntoView({ behavior: 'smooth', inline: 'center' });
    }
}

document.querySelectorAll('.thumbnail-item').forEach((thumb, index) => {
    thumb.addEventListener('click', () => {
        currentImageIndex = index;
        showImage(index);
        updateThumbnails();
    });
});

// Téléchargement d'images
function downloadImage(imageUrl, filename) {
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = filename || 'image';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function downloadCurrentImage() {
    const currentImage = images[currentImageIndex];
    const filename = `{{ $voyage->nom_voyage }}_${currentImageIndex + 1}`;
    downloadImage(`{{ asset('') }}${currentImage.chemin_image}`, filename);
}

function shareCurrentImage() {
    const currentImage = images[currentImageIndex];
    const imageUrl = `{{ asset('') }}${currentImage.chemin_image}`;
    
    if (navigator.share) {
        navigator.share({
            title: '{{ $voyage->nom_voyage }}',
            text: 'Découvrez cette photo du voyage',
            url: imageUrl
        });
    } else {
        // Fallback: copier l'URL
        navigator.clipboard.writeText(imageUrl).then(() => {
            alert('Lien de l\'image copié dans le presse-papiers !');
        });
    }
}

// Animation au chargement
window.addEventListener('load', function() {
    document.querySelectorAll('.galerie-item').forEach((item, index) => {
        setTimeout(() => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, 100);
        }, index * 100);
    });
});

// Lazy loading amélioré
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        imageObserver.observe(img);
    });
}
</script>
@endpush

@endsection