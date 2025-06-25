@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary">🛍️ Réservations de circuits</h4>
            <form method="GET" action="{{ route('admin.circuit_reservations.index') }}" class="d-flex align-items-center gap-2">
                <label class="me-2 mb-0 text-muted small">Filtrer :</label>
                <select name="filter" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="" {{ empty($filter) ? 'selected' : '' }}>Toutes</option>
                    <option value="today" {{ $filter === 'today' ? 'selected' : '' }}>Aujourd’hui</option>
                    <option value="week" {{ $filter === 'week' ? 'selected' : '' }}>Cette semaine</option>
                    <option value="unconfirmed" {{ $filter === 'unconfirmed' ? 'selected' : '' }}>Non confirmées</option>
                </select>
            </form>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Tél</th>
                        <th>Destination</th>
                        <th>Participants</th>
                        <th>Offre</th>
                        <th>Message</th>
                        <th>Confirmation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @if ($reservations->isEmpty())
                        <tr>
                            <td colspan="9" class="text-muted text-center">Aucune réservation trouvée.</td>
                        </tr>
                    @else
                        @foreach($reservations as $res)
                        <tr>
                            <td>
                                {{ $res->nom }}
                                @if ($res->id === $latestId && $res->created_at->diffInHours(now()) < 24)
                                    <span class="badge bg-warning text-dark ms-1">🆕 Nouveau</span>
                                @endif
                            </td>
                            <td><a href="mailto:{{ $res->email }}">{{ $res->email }}</a></td>
                            <td><a href="tel:{{ $res->tel }}">{{ $res->tel }}</a></td>
                            <td>{{ $res->destination }}</td>
                            <td><span class="badge bg-info">{{ $res->nbr_Pax }}</span></td>
                            <td>{{ $res->offre }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $res->id }}">
                                    Voir
                                </button>
                            </td>
                            <td>
                                @if ($res->confirmed_at)
                                    <span class="badge bg-success">
                                        Confirmée<br>
                                        <small>{{ $res->confirmed_at->format('d/m/Y H:i') }}</small>
                                    </span>
                                @else
                                    <a href="{{ route('admin.circuit_reservations.confirm', $res->id) }}" class="btn btn-sm btn-outline-success">
                                        <i class="bx bx-check-circle"></i> Confirmer
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.circuit_reservations.destroy', $res->id) }}" class="btn btn-sm btn-outline-danger" id="delete">
                                    <i class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="detailsModal{{ $res->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $res->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="detailsModalLabel{{ $res->id }}">Détails de la réservation</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <p><strong>Nom :</strong> {{ $res->nom }}</p>
                                        <p><strong>Email :</strong> {{ $res->email }}</p>
                                        <p><strong>Téléphone :</strong> {{ $res->tel }}</p>
                                        <p><strong>Destination :</strong> {{ $res->destination }}</p>
                                        <p><strong>Nombre de participants :</strong> {{ $res->nbr_Pax }}</p>
                                        <p><strong>Offre choisie :</strong> {{ $res->offre }}</p>
                                        <p><strong>Message :</strong><br> {{ $res->message }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="mailto:{{ $res->email }}" class="btn btn-outline-success">
                                            <i class="bx bx-mail-send"></i> Répondre
                                        </a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="mt-3">
                {{ $reservations->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
