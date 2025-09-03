{{-- resources/views/admin/hebergements/index.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Hébergements</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gestion Hébergements</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.hebergements.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Ajouter Hébergement
            </a>
        </div>
    </div>

    {{-- Statistiques rapides --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">
        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-gradient-info text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Total Hébergements</h6>
                        <h3 class="fw-bold">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="icon-box rounded-circle p-3" style="background: rgba(255,255,255,0.2)">
                        <i class="bx bx-home-heart fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-gradient-success text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Actifs</h6>
                        <h3 class="fw-bold">{{ $stats['actifs'] }}</h3>
                    </div>
                    <div class="icon-box rounded-circle p-3" style="background: rgba(255,255,255,0.2)">
                        <i class="bx bx-check-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-gradient-warning text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">En Vedette</h6>
                        <h3 class="fw-bold">{{ $stats['featured'] }}</h3>
                    </div>
                    <div class="icon-box rounded-circle p-3" style="background: rgba(255,255,255,0.2)">
                        <i class="bx bx-star fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-gradient-danger text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Commentaires</h6>
                        <h3 class="fw-bold">{{ $stats['commentaires_en_attente'] }}</h3>
                        <small>En attente</small>
                    </div>
                    <div class="icon-box rounded-circle p-3" style="background: rgba(255,255,255,0.2)">
                        <i class="bx bx-message-dots fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tableau des hébergements --}}
    <div class="card">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
            <h5 class="mb-0">🏨 Liste des Hébergements</h5>
            <div>
                <a href="{{ route('admin.hebergements.commentaires') }}" class="btn btn-outline-primary btn-sm me-2">
                    <i class="bx bx-message"></i> Gérer Commentaires
                </a>
                <a href="{{ route('admin.hebergements.statistiques') }}" class="btn btn-outline-info btn-sm">
                    <i class="bx bx-chart"></i> Statistiques
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="hebergementsTable" class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Région</th>
                            <th>Tarif</th>
                            <th>Note Admin</th>
                            <th>Note Client</th>
                            <th>Statut</th>
                            <th>Vedette</th>
                            <th>Vues</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-hebergements">
                        @foreach($hebergements as $hebergement)
                        <tr data-id="{{ $hebergement->id }}">
                            <td>
                                <img src="{{ asset($hebergement->image_principale) }}" 
                                     class="rounded" width="60" height="45" style="object-fit: cover;"
                                     alt="{{ $hebergement->nom }}">
                            </td>
                            
                            <td>
                                <div>
                                    <h6 class="mb-0">{{ $hebergement->nom }}</h6>
                                    <small class="text-muted">{{ $hebergement->lieu_touristique }}</small>
                                </div>
                            </td>
                            
                            <td>
                                <span class="badge bg-light text-dark">{{ $hebergement->region }}</span>
                                <br><small class="text-muted">{{ $hebergement->departement }}</small>
                            </td>
                            
                            <td>
                                <small>{{ $hebergement->tarif_format }}</small>
                            </td>
                            
                            <td class="text-center">
                                @if($hebergement->note_admin)
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= $hebergement->note_admin ? 'text-warning' : 'text-muted' }}">★</span>
                                        @endfor
                                    </div>
                                    <small class="d-block text-muted">{{ $hebergement->note_admin }}/5</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            
                            <td class="text-center">
                                @if($hebergement->nombre_commentaires > 0)
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= round($hebergement->note_client_moyenne) ? 'text-warning' : 'text-muted' }}">★</span>
                                        @endfor
                                    </div>
                                    <small class="d-block text-muted">
                                        {{ number_format($hebergement->note_client_moyenne, 1) }}/5
                                        ({{ $hebergement->nombre_commentaires }})
                                    </small>
                                @else
                                    <span class="text-muted">Aucun avis</span>
                                @endif
                            </td>
                            
                            <td>
                                @switch($hebergement->statut)
                                    @case('actif')
                                        <span class="badge bg-success">Actif</span>
                                        @break
                                    @case('inactif')
                                        <span class="badge bg-secondary">Inactif</span>
                                        @break
                                    @case('en_cours')
                                        <span class="badge bg-warning">En cours</span>
                                        @break
                                @endswitch
                            </td>
                            
                            <td class="text-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-featured" 
                                           type="checkbox" 
                                           data-id="{{ $hebergement->id }}"
                                           {{ $hebergement->featured ? 'checked' : '' }}>
                                </div>
                            </td>
                            
                            <td class="text-center">
                                <span class="badge bg-info">{{ number_format($hebergement->vues) }}</span>
                            </td>
                            
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                            type="button" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.hebergements.show', $hebergement) }}">
                                                <i class="bx bx-show"></i> Voir Détails
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.hebergements.edit', $hebergement) }}">
                                                <i class="bx bx-edit"></i> Modifier
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" 
                                               href="{{ route('admin.hebergements.destroy', $hebergement) }}"
                                               id="delete">
                                                <i class="bx bx-trash"></i> Supprimer
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $hebergements->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    // DataTable avec recherche et tri
    $('#hebergementsTable').DataTable({
        "order": [[ 1, "asc" ]],
        "pageLength": 25,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
        }
    });

    // Toggle Featured
    $('.toggle-featured').change(function() {
        const hebergementId = $(this).data('id');
        const isChecked = $(this).is(':checked');
        
        $.ajax({
            url: `/admin/hebergements/${hebergementId}/toggle-featured`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function() {
                toastr.error('Erreur lors de la mise à jour');
                // Remettre l'état précédent
                this.checked = !isChecked;
            }
        });
    });

    // Tri par glisser-déposer
    new Sortable(document.getElementById('sortable-hebergements'), {
        animation: 150,
        onEnd: function(evt) {
            let ordres = {};
            $('#sortable-hebergements tr').each(function(index) {
                const id = $(this).data('id');
                ordres[id] = index + 1;
            });
            
            $.ajax({
                url: '{{ route("admin.hebergements.update-ordre") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ordres: ordres
                },
                success: function() {
                    toastr.success('Ordre mis à jour');
                }
            });
        }
    });
});
</script>
@endpush

@endsection