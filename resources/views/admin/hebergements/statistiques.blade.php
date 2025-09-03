{{-- resources/views/admin/hebergements/statistiques.blade.php --}}
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
                    <li class="breadcrumb-item active" aria-current="page">Statistiques</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.hebergements.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Retour
                </a>
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="bx bx-printer"></i> Imprimer
                </button>
                <a href="{{ route('admin.hebergements.export') }}" class="btn btn-success">
                    <i class="bx bx-export"></i> Exporter
                </a>
            </div>
        </div>
    </div>

    {{-- Vue d'ensemble --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">📊 Vue d'ensemble des Hébergements</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center g-4">
                        <div class="col-md-3">
                            <div class="stat-item">
                                <i class="bx bx-home-heart text-primary fs-2"></i>
                                <h3 class="text-primary">{{ $stats['hebergements_par_region']->sum() }}</h3>
                                <p class="text-muted">Total Hébergements</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <i class="bx bx-map text-info fs-2"></i>
                                <h3 class="text-info">{{ $stats['hebergements_par_region']->count() }}</h3>
                                <p class="text-muted">Régions Couvertes</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <i class="bx bx-money text-success fs-2"></i>
                                <h3 class="text-success">{{ number_format($stats['moyenne_tarifs'], 0) }}</h3>
                                <p class="text-muted">Tarif Moyen (XOF)</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <i class="bx bx-trending-up text-warning fs-2"></i>
                                <h3 class="text-warning">+{{ $stats['evolution_mensuelle']->sum('count') }}</h3>
                                <p class="text-muted">Ajouts cette année</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Répartition par région --}}
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">🗺️ Répartition par Région</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartRegions" height="300"></canvas>
                    
                    {{-- Tableau détaillé --}}
                    <div class="table-responsive mt-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Région</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['hebergements_par_region'] as $region => $count)
                                    @php $percentage = ($count / $stats['hebergements_par_region']->sum()) * 100; @endphp
                                    <tr>
                                        <td>{{ $region }}</td>
                                        <td class="text-center">{{ $count }}</td>
                                        <td class="text-center">{{ number_format($percentage, 1) }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Équipements populaires --}}
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">🏊‍♀️ Équipements les plus Populaires</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartAmenities" height="300"></canvas>
                    
                    {{-- Top équipements --}}
                    <div class="mt-3">
                        @foreach(array_slice($stats['amenities_populaires'], 0, 8, true) as $amenity => $count)
                            @php 
                                $percentage = ($count / $stats['hebergements_par_region']->sum()) * 100;
                                $amenityLabel = \App\Models\Hebergement::getAmenitiesDisponibles()[$amenity] ?? $amenity;
                            @endphp
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small">{{ $amenityLabel }}</span>
                                <div class="d-flex align-items-center">
                                    <div class="progress me-2" style="width: 100px; height: 8px;">
                                        <div class="progress-bar bg-primary" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="small text-muted">{{ $count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Évolution mensuelle --}}
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">📈 Évolution des Ajouts ({{ now()->year }})</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartEvolution" height="250"></canvas>
                </div>
            </div>
        </div>

        {{-- Indicateurs clés --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">🎯 Indicateurs Clés</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Taux de remplissage:</span>
                        <div class="text-end">
                            <div class="progress" style="width: 80px; height: 8px;">
                                <div class="progress-bar bg-success" style="width: 85%"></div>
                            </div>
                            <small class="text-muted">85%</small>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Note moyenne:</span>
                        <div class="text-end">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= 4 ? 'text-warning' : 'text-muted' }}">★</span>
                                @endfor
                            </div>
                            <small class="text-muted">4.2/5</small>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Hébergements vedettes:</span>
                        <span class="badge bg-warning">12</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Commentaires en attente:</span>
                        <span class="badge bg-danger">5</span>
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                        <h6 class="text-muted">Hébergement le plus populaire</h6>
                        <p class="fw-bold">Lodge du Lac Rose</p>
                        <small class="text-muted">1,247 vues ce mois</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Analyse des tarifs --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">💰 Analyse des Tarifs</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="chartTarifs" height="200"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="tarifs-stats">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="stat-box p-3 border rounded">
                                            <h4 class="text-success">15,000</h4>
                                            <small class="text-muted">Tarif Min</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-box p-3 border rounded">
                                            <h4 class="text-primary">{{ number_format($stats['moyenne_tarifs'], 0) }}</h4>
                                            <small class="text-muted">Moyenne</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-box p-3 border rounded">
                                            <h4 class="text-warning">150,000</h4>
                                            <small class="text-muted">Tarif Max</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <h6>Répartition par gamme de prix:</h6>
                                    <div class="price-ranges">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Budget (< 25,000 XOF)</span>
                                            <span class="badge bg-success">12</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Moyen (25,000 - 50,000 XOF)</span>
                                            <span class="badge bg-primary">18</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Haut de gamme (50,000 - 100,000 XOF)</span>
                                            <span class="badge bg-warning">8</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Luxe (> 100,000 XOF)</span>
                                            <span class="badge bg-danger">3</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Top hébergements --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">🏆 Top Hébergements</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Plus populaires --}}
                        <div class="col-md-4">
                            <h6 class="text-primary">👁️ Plus Consultés</h6>
                            <div class="top-list">
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Lodge du Lac Rose</strong>
                                        <br><small class="text-muted">Thiès</small>
                                    </div>
                                    <span class="badge bg-primary">1,247</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Hôtel Teranga</strong>
                                        <br><small class="text-muted">Dakar</small>
                                    </div>
                                    <span class="badge bg-primary">892</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Campement Saly</strong>
                                        <br><small class="text-muted">Thiès</small>
                                    </div>
                                    <span class="badge bg-primary">654</span>
                                </div>
                            </div>
                        </div>

                        {{-- Mieux notés --}}
                        <div class="col-md-4">
                            <h6 class="text-warning">⭐ Mieux Notés</h6>
                            <div class="top-list">
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Villa Saly Premium</strong>
                                        <br><small class="text-muted">Thiès</small>
                                    </div>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="text-warning">★</span>
                                        @endfor
                                        <small class="ms-1">5.0</small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Ecolodge Bandia</strong>
                                        <br><small class="text-muted">Thiès</small>
                                    </div>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 4; $i++)
                                            <span class="text-warning">★</span>
                                        @endfor
                                        <span class="text-muted">★</span>
                                        <small class="ms-1">4.8</small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Résidence Almadies</strong>
                                        <br><small class="text-muted">Dakar</small>
                                    </div>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 4; $i++)
                                            <span class="text-warning">★</span>
                                        @endfor
                                        <span class="text-muted">★</span>
                                        <small class="ms-1">4.7</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Plus récents --}}
                        <div class="col-md-4">
                            <h6 class="text-success">🆕 Récemment Ajoutés</h6>
                            <div class="top-list">
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Auberge Saint-Louis</strong>
                                        <br><small class="text-muted">Saint-Louis</small>
                                    </div>
                                    <small class="text-muted">Il y a 2 jours</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Lodge Sine Saloum</strong>
                                        <br><small class="text-muted">Fatick</small>
                                    </div>
                                    <small class="text-muted">Il y a 5 jours</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <strong>Gîte Cap Skiring</strong>
                                        <br><small class="text-muted">Ziguinchor</small>
                                    </div>
                                    <small class="text-muted">Il y a 1 semaine</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Données pour les graphiques
    const regionsData = @json($stats['hebergements_par_region']);
    const amenitiesData = @json($stats['amenities_populaires']);
    const evolutionData = @json($stats['evolution_mensuelle']);
    
    // Graphique Répartition par Région
    const ctxRegions = document.getElementById('chartRegions').getContext('2d');
    new Chart(ctxRegions, {
        type: 'doughnut',
        data: {
            labels: Object.keys(regionsData),
            datasets: [{
                data: Object.values(regionsData),
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                    '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Graphique Équipements Populaires
    const ctxAmenities = document.getElementById('chartAmenities').getContext('2d');
    const topAmenities = Object.entries(amenitiesData).slice(0, 6);
    
    new Chart(ctxAmenities, {
        type: 'bar',
        data: {
            labels: topAmenities.map(([key, value]) => {
                const amenities = @json(\App\Models\Hebergement::getAmenitiesDisponibles());
                return amenities[key] || key;
            }),
            datasets: [{
                label: 'Nombre d\'hébergements',
                data: topAmenities.map(([key, value]) => value),
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Graphique Évolution Mensuelle
    const ctxEvolution = document.getElementById('chartEvolution').getContext('2d');
    const mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
    
    // Préparer les données d'évolution
    const evolutionArray = new Array(12).fill(0);
    evolutionData.forEach(item => {
        evolutionArray[item.month - 1] = item.count;
    });
    
    new Chart(ctxEvolution, {
        type: 'line',
        data: {
            labels: mois,
            datasets: [{
                label: 'Nouveaux hébergements',
                data: evolutionArray,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Graphique Répartition des Tarifs
    const ctxTarifs = document.getElementById('chartTarifs').getContext('2d');
    new Chart(ctxTarifs, {
        type: 'pie',
        data: {
            labels: ['Budget', 'Moyen', 'Haut de gamme', 'Luxe'],
            datasets: [{
                data: [12, 18, 8, 3],
                backgroundColor: [
                    '#28a745', '#007bff', '#ffc107', '#dc3545'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endpush

@endsection