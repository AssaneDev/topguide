@extends('admin.admin_dashboard')
@section('admin')

@php
use Illuminate\Support\Carbon;

$totalExcursions = \App\Models\ExcursionRequest::count();
$totalGuides = \App\Models\Reservation::count();
$totalCircuits = \App\Models\CircuitReservation::count();

$todayExcursions = \App\Models\ExcursionRequest::where('created_at', '>=', Carbon::now()->subDay())->count();
$todayGuides     = \App\Models\Reservation::where('created_at', '>=', Carbon::now()->subDay())->count();
$todayCircuits   = \App\Models\CircuitReservation::where('created_at', '>=', Carbon::now()->subDay())->count();
@endphp


<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        <!-- Excursions -->
        <div class="col">
            <div class="card radius-10 bg-gradient-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-white">Excursions (Aujourd'hui)</p>
                            <h4 class="my-1 text-white">{{ $todayExcursions }}</h4>
                            <p class="mb-0 font-13 text-white">Total : {{ $totalExcursions }}</p>
                        </div>
                        <i class="bx bx-map text-white fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guides -->
        <div class="col">
            <div class="card radius-10 bg-gradient-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-white">Guides (Aujourd'hui)</p>
                            <h4 class="my-1 text-white">{{ $todayGuides }}</h4>
                            <p class="mb-0 font-13 text-white">Total : {{ $totalGuides }}</p>
                        </div>
                        <i class="bx bx-user-pin text-white fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Circuits -->
        <div class="col">
            <div class="card radius-10 bg-gradient-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-dark">Circuits (Aujourd'hui)</p>
                            <h4 class="my-1 text-dark">{{ $todayCircuits }}</h4>
                            <p class="mb-0 font-13 text-dark">Total : {{ $totalCircuits }}</p>
                        </div>
                        <i class="bx bx-compass text-dark fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message de bienvenue -->
    <div class="text-center my-5">
        <h1 class="badge rounded-pill bg-success" style="font-size: 60px">Bienvenue Admin de Vacance Sénégal</h1>
    </div>

    <!-- Liens rapides -->
    <div class="text-center mb-5">
        <a href="{{ route('all.destinations') }}" class="btn btn-outline-success px-4 radius-30 me-2">Destinations</a>
        <a href="{{ route('blog.category') }}" class="btn btn-outline-info px-4 radius-30 me-2">Catégories Blog</a>
        <a href="{{ route('all.blog.post') }}" class="btn btn-outline-warning px-4 radius-30">Articles Blog</a>
    </div>
</div>

@endsection
