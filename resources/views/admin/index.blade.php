@extends('admin.admin_dashboard')
@section('admin')

@php
$totalExcursions = \App\Models\ExcursionRequest::count();
$totalGuides = \App\Models\Reservation::count();
$totalCircuits = \App\Models\CircuitReservation::count();

$todayExcursions = \App\Models\ExcursionRequest::whereDate('created_at', today())->count();
$todayGuides = \App\Models\Reservation::whereDate('created_at', today())->count();
$todayCircuits = \App\Models\CircuitReservation::whereDate('created_at', today())->count();
@endphp

<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10 bg-gradient-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-white">Réservations Excursions (Aujourd'hui)</p>
                            <h4 class="my-1 text-white">{{ $todayExcursions }}</h4>
                            <p class="mb-0 font-13 text-white">Total : {{ $totalExcursions }}</p>
                        </div>
                        <i class="bx bx-map text-white fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-gradient-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-white">Réservations Guides (Aujourd'hui)</p>
                            <h4 class="my-1 text-white">{{ $todayGuides }}</h4>
                            <p class="mb-0 font-13 text-white">Total : {{ $totalGuides }}</p>
                        </div>
                        <i class="bx bx-user-pin text-white fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-gradient-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-dark">Réservations Circuits (Aujourd'hui)</p>
                            <h4 class="my-1 text-dark">{{ $todayCircuits }}</h4>
                            <p class="mb-0 font-13 text-dark">Total : {{ $totalCircuits }}</p>
                        </div>
                        <i class="bx bx-compass text-dark fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center my-4">
        <h1 class="badge rounded-pill bg-success" style="font-size: 60px">Bienvenue Admin de Top Guide</h1>
    </div>

    <div class="text-center mb-5">
        <a href="{{ route('all.destinations') }}" class="btn btn-outline-success px-4 radius-30 me-2">Liste Destinations</a>
        <a href="{{ route('blog.category') }}" class="btn btn-outline-info px-4 radius-30 me-2">Liste Catégories Blog</a>
        <a href="{{ route('all.blog.post') }}" class="btn btn-outline-warning px-4 radius-30">Liste Articles Blog</a>
    </div>
</div>

@endsection
