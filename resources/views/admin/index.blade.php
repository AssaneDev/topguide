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

        {{-- Card Excursions --}}
        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-light">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Excursions Aujourd'hui</h6>
                        <h3 class="fw-bold text-success">{{ $todayExcursions }}</h3>
                        <small class="text-muted">Total : {{ $totalExcursions }}</small>
                    </div>
                    <div class="icon-box bg-success text-white rounded-circle p-3">
                        <i class="bx bx-map fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Guides --}}
        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-light">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Guides Aujourd'hui</h6>
                        <h3 class="fw-bold text-primary">{{ $todayGuides }}</h3>
                        <small class="text-muted">Total : {{ $totalGuides }}</small>
                    </div>
                    <div class="icon-box bg-primary text-white rounded-circle p-3">
                        <i class="bx bx-user-pin fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Circuits --}}
        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-light">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Circuits Aujourd'hui</h6>
                        <h3 class="fw-bold text-warning">{{ $todayCircuits }}</h3>
                        <small class="text-muted">Total : {{ $totalCircuits }}</small>
                    </div>
                    <div class="icon-box bg-warning text-dark rounded-circle p-3">
                        <i class="bx bx-compass fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- Liste des Visiteurs Récents --}}
<div class="card mt-5">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-dark">🌍 Visiteurs récents</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>IP</th>
                    <th>Pays</th>
                    <th>Ville</th>
                    <th>Page visitée</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\Visiteur::latest()->take(10)->get() as $visiteur)
                    <tr>
                        <td>{{ $visiteur->ip }}</td>
                        <td>{{ $visiteur->pays ?? 'N/A' }}</td>
                        <td>{{ $visiteur->ville ?? 'N/A' }}</td>
                        <td><code>{{ $visiteur->url }}</code></td>
                        <td>{{ \Carbon\Carbon::parse($visiteur->visited_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>

@endsection
