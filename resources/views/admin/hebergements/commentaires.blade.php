{{-- resources/views/admin/hebergements/commentaires.blade.php --}}
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
                    <li class="breadcrumb-item active" aria-current="page">Gestion Commentaires</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.hebergements.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Retour aux Hébergements
            </a>
        </div>
    </div>

    {{-- Statistiques rapides --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mb-4">
        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-gradient-warning text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">En Attente</h6>
                        <h3 class="fw-bold">{{ $stats['en_attente'] }}</h3>
                        <small>Commentaires à modérer</small>
                    </div>
                    <div class="icon-box rounded-circle p-3" style="background: rgba(255,255,255,0.2)">
                        <i class="bx bx-time fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-gradient-success text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Approuvés</h6>
                        <h3 class="fw-bold">{{ $stats['approuves'] }}</h3>
                        <small>Commentaires publiés</small>
                    </div>
                    <div class="icon-box rounded-circle p-3" style="background: rgba(255,255,255,0.2)">
                        <i class="bx bx-check-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-0 shadow-sm bg-gradient-danger text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Rejetés</h6>
                        <h3 class="fw-bold">{{ $stats['rejetes'] }}</h3>
                        <small>Commentaires refusés</small>
                    </div>
                    <div class="icon-box rounded-circle p-3" style="background: rgba(255,255,255,0.2)">
                        <i class="bx bx-x-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtres --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select name="statut" id="statut" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="approuve" {{ request('statut') == 'approuve' ? 'selected' : '' }}>Approuvé</option>
                        <option value="rejete" {{ request('statut') == 'rejete' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="hebergement" class="form-label">Hébergement</label>
                    <select name="hebergement" id="hebergement" class="form-select">
                        <option value="">Tous les hébergements</option>
                        {{-- Les options seront ajoutées via le contrôleur --}}
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="note" class="form-label">Note</label>
                    <select name="note" id="note" class="form-select">
                        <option value="">Toutes les notes</option>
                        <option value="5" {{ request('note') == '5' ? 'selected' : '' }}>5 étoiles</option>
                        <option value="4" {{ request('note') == '4' ? 'selected' : '' }}>4 étoiles</option>
                        <option value="3" {{ request('note') == '3' ? 'selected' : '' }}>3 étoiles</option>
                        <option value="2" {{ request('note') == '2' ? 'selected' : '' }}>2 étoiles</option>
                        <option value="1" {{ request('note') == '1' ? 'selected' : '' }}>1 étoile</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bx bx-search"></i> Filtrer
                    </button>
                    <a href="{{ route('admin.hebergements.commentaires') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-refresh"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tableau des commentaires --}}
    <div class="card">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
            <h5 class="mb-0">💬 Liste des Commentaires</h5>
            <div>
                @if(request('statut') == 'en_attente' || !request('statut'))
                    <button class="btn btn-success btn-sm me-2" onclick="approuverTous()">
                        <i class="bx bx-check"></i> Approuver la sélection
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="rejeterTous()">
                        <i class="bx bx-x"></i> Rejeter la sélection
                    </button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="commentairesTable" class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="30">
                                <input type="checkbox" id="selectAll" class="form-check-input">
                            </th>
                            <th>Client</th>
                            <th>Hébergement</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commentaires as $commentaire)
                        <tr data-id="{{ $commentaire->id }}">
                            <td>
                                <input type="checkbox" class="form-check-input commentaire-checkbox" value="{{ $commentaire->id }}">
                            </td>
                            
                            <td>
                                <div>
                                    <h6 class="mb-1">{{ $commentaire->nom_client }}</h6>
                                    <small class="text-muted">{{ $commentaire->email_client }}</small>
                                </div>
                            </td>
                            
                            <td>
                                <a href="{{ route('admin.hebergements.show', $commentaire->hebergement) }}" class="text-decoration-none">
                                    <strong>{{ $commentaire->hebergement->nom }}</strong>
                                </a>
                                <br>
                                <small class="text-muted">{{ $commentaire->hebergement->region }}</small>
                            </td>
                            
                            <td class="text-center">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $commentaire->note_client ? 'text-warning' : 'text-muted' }}">★</span>
                                    @endfor
                                </div>
                                <small class="d-block text-muted">{{ $commentaire->note_client }}/5</small>
                            </td>
                            
                            <td>
                                <div class="commentaire-preview">
                                    <p class="mb-0" title="{{ $commentaire->commentaire }}">
                                        {{ Str::limit($commentaire->commentaire, 100) }}
                                    </p>
                                    @if(strlen($commentaire->commentaire) > 100)
                                        <button class="btn btn-link btn-sm p-0" onclick="voirCommentaireComplet({{ $commentaire->id }})">
                                            Voir plus...
                                        </button>
                                    @endif
                                </div>
                            </td>
                            
                            <td>
                                @switch($commentaire->statut)
                                    @case('en_attente')
                                        <span class="badge bg-warning">En attente</span>
                                        @break
                                    @case('approuve')
                                        <span class="badge bg-success">Approuvé</span>
                                        @break
                                    @case('rejete')
                                        <span class="badge bg-danger">Rejeté</span>
                                        @break
                                @endswitch
                            </td>
                            
                            <td>
                                <small>{{ $commentaire->created_at->format('d/m/Y') }}</small>
                                <br>
                                <small class="text-muted">{{ $commentaire->created_at->format('H:i') }}</small>
                            </td>
                            
                            <td>
                                @if($commentaire->statut == 'en_attente')
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-sm" 
                                                onclick="approuverCommentaire({{ $commentaire->id }})"
                                                title="Approuver">
                                            <i class="bx bx-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="rejeterCommentaire({{ $commentaire->id }})"
                                                title="Rejeter">
                                            <i class="bx bx-x"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if($commentaire->statut == 'rejete')
                                                <li>
                                                    <a class="dropdown-item" href="#" onclick="approuverCommentaire({{ $commentaire->id }})">
                                                        <i class="bx bx-check text-success"></i> Approuver
                                                    </a>
                                                </li>
                                            @endif
                                            @if($commentaire->statut == 'approuve')
                                                <li>
                                                    <a class="dropdown-item" href="#" onclick="rejeterCommentaire({{ $commentaire->id }})">
                                                        <i class="bx bx-x text-danger"></i> Rejeter
                                                    </a>
                                                </li>
                                            @endif
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" onclick="supprimerCommentaire({{ $commentaire->id }})">
                                                    <i class="bx bx-trash"></i> Supprimer
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $commentaires->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Modal Commentaire Complet --}}
<div class="modal fade" id="commentaireModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Commentaire Complet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="commentaire-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const commentaires = @json($commentaires->items());

$(document).ready(function() {
    // DataTable
    $('#commentairesTable').DataTable({
        "order": [[ 6, "desc" ]],
        "pageLength": 25,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
        },
        "columnDefs": [
            { "orderable": false, "targets": [0, 7] }
        ]
    });

    // Sélection multiple
    $('#selectAll').change(function() {
        $('.commentaire-checkbox').prop('checked', $(this).is(':checked'));
    });

    $('.commentaire-checkbox').change(function() {
        if (!$(this).is(':checked')) {
            $('#selectAll').prop('checked', false);
        }
    });
});

function approuverCommentaire(id) {
    $.ajax({
        url: `/admin/commentaires/${id}/approuver`,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            toastr.success(response.message);
            location.reload();
        },
        error: function() {
            toastr.error('Erreur lors de l\'approbation');
        }
    });
}

function rejeterCommentaire(id) {
    $.ajax({
        url: `/admin/commentaires/${id}/rejeter`,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            toastr.success(response.message);
            location.reload();
        },
        error: function() {
            toastr.error('Erreur lors du rejet');
        }
    });
}

function supprimerCommentaire(id) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            // TODO: Implémenter la suppression
            toastr.info('Fonction de suppression à implémenter');
        }
    });
}

function approuverTous() {
    const selectedIds = $('.commentaire-checkbox:checked').map(function() {
        return $(this).val();
    }).get();

    if (selectedIds.length === 0) {
        toastr.warning('Veuillez sélectionner au moins un commentaire');
        return;
    }

    Swal.fire({
        title: 'Approuver les commentaires sélectionnés ?',
        text: `${selectedIds.length} commentaire(s) seront approuvés`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Approuver',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            // TODO: Implémenter l'approbation multiple
            toastr.info('Fonction d\'approbation multiple à implémenter');
        }
    });
}

function rejeterTous() {
    const selectedIds = $('.commentaire-checkbox:checked').map(function() {
        return $(this).val();
    }).get();

    if (selectedIds.length === 0) {
        toastr.warning('Veuillez sélectionner au moins un commentaire');
        return;
    }

    Swal.fire({
        title: 'Rejeter les commentaires sélectionnés ?',
        text: `${selectedIds.length} commentaire(s) seront rejetés`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Rejeter',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            // TODO: Implémenter le rejet multiple
            toastr.info('Fonction de rejet multiple à implémenter');
        }
    });
}

function voirCommentaireComplet(id) {
    const commentaire = commentaires.find(c => c.id === id);
    if (commentaire) {
        $('#commentaire-content').html(`
            <div class="mb-3">
                <strong>Client:</strong> ${commentaire.nom_client}<br>
                <strong>Email:</strong> ${commentaire.email_client}<br>
                <strong>Note:</strong> ${commentaire.note_client}/5<br>
                <strong>Date:</strong> ${new Date(commentaire.created_at).toLocaleDateString('fr-FR')}
            </div>
            <div class="border p-3 rounded bg-light">
                <p class="mb-0">${commentaire.commentaire}</p>
            </div>
        `);
        $('#commentaireModal').modal('show');
    }
}
</script>
@endpush

@endsection