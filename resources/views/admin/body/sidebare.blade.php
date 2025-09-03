{{-- resources/views/admin/body/sidebar.blade.php - VERSION MISE À JOUR --}}
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Vacance Sénégal</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i></div>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">
        
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">Programmes</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i></div>
                <div class="menu-title">Circuits et Excursions</div>
            </a>
            <ul>
                <li><a href="{{ route('circuits.dashboard') }}"><i class='bx bx-radio-circle'></i>Circuits</a></li>
                <li><a href="{{ route('all.excursion') }}"><i class='bx bx-radio-circle'></i>Excursions</a></li>
            </ul>
        </li>

        {{-- NOUVEAU : SECTION HÉBERGEMENTS --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-heart'></i></div>
                <div class="menu-title">Hébergements</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.hebergements.index') }}"><i class='bx bx-radio-circle'></i>Tous les Hébergements</a></li>
                <li><a href="{{ route('admin.hebergements.create') }}"><i class='bx bx-radio-circle'></i>Ajouter Hébergement</a></li>
                <li><a href="{{ route('admin.hebergements.commentaires') }}"><i class='bx bx-radio-circle'></i>Gérer Commentaires
                    @php
                        $commentairesEnAttente = \App\Models\HebergementCommentaire::where('statut', 'en_attente')->count();
                    @endphp
                    @if($commentairesEnAttente > 0)
                        <span class="badge bg-danger ms-2">{{ $commentairesEnAttente }}</span>
                    @endif
                </a></li>
                <li><a href="{{ route('admin.hebergements.statistiques') }}"><i class='bx bx-radio-circle'></i>Statistiques</a></li>
            </ul>
        </li>

        {{-- SECTION COORDINATION ÉQUIPE --}}
        <li class="menu-label">Communication</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-camera'></i></div>
                <div class="menu-title">Coordination Équipe</div>
            </a>
            <ul>
                <li><a href="{{ route('circuits.dashboard') }}"><i class='bx bx-radio-circle'></i>Gestion Circuits</a></li>
                <li><a href="{{ route('equipe.dashboard') }}"><i class='bx bx-radio-circle'></i>Équipes Terrain</a></li>
                <li><a href="{{ route('templates.index') }}"><i class='bx bx-radio-circle'></i>Templates Consignes</a></li>
            </ul>
        </li>

        <li class="menu-label">Programmes</li>
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-cart'></i></div>
        <div class="menu-title">Circuits et Excursions</div>
    </a>
    <ul>
        <li><a href="{{ route('circuits.dashboard') }}"><i class='bx bx-radio-circle'></i>Circuits</a></li>
        <li><a href="{{ route('all.excursion') }}"><i class='bx bx-radio-circle'></i>Excursions</a></li>
    </ul>
</li>

<!-- NOUVEAU : Ajoutez ici le menu Voyages Détaillés -->
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-map'></i></div>
        <div class="menu-title">Voyages Détaillés</div>
    </a>
    <ul>
        <li><a href="{{ route('admin.voyages.index') }}"><i class='bx bx-radio-circle'></i>Tous les Voyages</a></li>
        <li><a href="{{ route('admin.voyages.create') }}"><i class='bx bx-radio-circle'></i>Ajouter Voyage</a></li>
        <li><a href="{{ route('admin.voyages.index') }}?statut=brouillon"><i class='bx bx-radio-circle'></i>Brouillons</a></li>
        <li><a href="{{ route('admin.voyages.index') }}?statut=publie"><i class='bx bx-radio-circle'></i>Voyages Publiés</a></li>
    </ul>
</li>


        <li class="menu-label">Blog</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i></div>
                <div class="menu-title">Article Blog</div>
            </a>
            <ul>
                <li><a href="{{ route('blog.category') }}"><i class='bx bx-radio-circle'></i>Catégories</a></li>
                <li><a href="{{ route('all.blog.post') }}"><i class='bx bx-radio-circle'></i>Tous les articles</a></li>
                <li><a href="{{ url('/optimize') }}"><i class='bx bx-radio-circle'></i>Clear Cache</a></li>
            </ul>
        </li>

        <li class="menu-label">Réservations</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-calendar-check'></i></div>
                <div class="menu-title">Gestion des Réservations</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.excursion_requests.index') }}"><i class='bx bx-radio-circle'></i>Résa Excursions</a></li>
                <li><a href="{{ route('admin.guide_reservations.index') }}"><i class='bx bx-radio-circle'></i>Résa Guides</a></li>
                <li><a href="{{ route('admin.circuit_reservations.index') }}"><i class='bx bx-radio-circle'></i>Résa Circuits</a></li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>