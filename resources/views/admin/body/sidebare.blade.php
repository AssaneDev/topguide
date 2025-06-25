<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SoluGuide</h4>
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
                <li><a href="{{ route('all.destinations') }}"><i class='bx bx-radio-circle'></i>Circuits</a></li>
                <li><a href="{{ route('all.excursion') }}"><i class='bx bx-radio-circle'></i>Excursions</a></li>
                <li><a href="{{ route('all.voyage') }}"><i class='bx bx-radio-circle'></i>Voyage de Groupes</a></li>
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
