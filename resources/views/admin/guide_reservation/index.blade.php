@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary">👨‍🏫 Réservations de guides</h4>

            <form method="GET" action="{{ route('admin.guide_reservations.index') }}" class="d-flex align-items-center gap-2">
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
            <table id="example" class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Ville</th>
                        <th>Langue</th>
                        <th>Date</th>
                        <th>Personnes</th>
                        <th>Détails</th>
                       <th>Confirmation</th>
                        <th>Action</th>

                    </tr>
                </thead>
                  <tbody class="text-center">
    @if ($reservations->isEmpty())
        <tr>
            <td colspan="10" class="text-muted text-center">Aucune réservation trouvée.</td>
        </tr>
    @else
        @foreach($reservations as $index => $res)
        <tr>
            <td>
                {{ $res->name }}
                @if ($res->id === $latestId && \Carbon\Carbon::parse($res->created_at)->diffInHours(now()) < 24)
                    <span class="badge bg-warning text-dark ms-1">🆕 Nouveau</span>
                @endif
            </td>

            <td><a href="mailto:{{ $res->email }}">{{ $res->email }}</a></td>
            <td><a href="tel:{{ $res->phone }}">{{ $res->phone }}</a></td>
            <td>{{ $res->ville }}</td>
            <td><span class="badge bg-info text-dark">{{ $res->langue }}</span></td>
            <td>{{ \Carbon\Carbon::parse($res->date)->format('d/m/Y') }}</td>
            <td><span class="badge bg-primary">{{ $res->nb_personnes }}</span></td>
            <td>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $res->id }}">
                    <i class="bx bx-search-alt"></i> Voir
                </button>
            </td>
            <td>
                @if ($res->confirmed)
                    <span class="badge bg-success">
                        Confirmée<br>
                        <small>{{ \Carbon\Carbon::parse($res->confirmed_at)->format('d/m/Y H:i') }}</small>
                    </span>
                @else
                    <a href="{{ route('admin.guide_reservations.confirm', $res->id) }}" 
                    class="btn btn-sm btn-outline-success">
                    <i class="bx bx-check-circle"></i> Confirmer
                    </a>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.guide_reservations.destroy', $res->id) }}"
                   class="btn btn-sm btn-outline-danger" id="delete">
                   <i class="bx bx-trash"></i>
                </a>
            </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="detailsModal{{ $res->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $res->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailsModalLabel{{ $res->id }}">Détails de la réservation de {{ $res->name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item"><strong>📍 Ville :</strong> {{ $res->ville }}</li>
                            <li class="list-group-item"><strong>🗓️ Date :</strong> {{ \Carbon\Carbon::parse($res->date)->format('d/m/Y') }}</li>
                            <li class="list-group-item"><strong>🗣️ Langue :</strong> {{ $res->langue }}</li>
                            <li class="list-group-item"><strong>⏱️ Durée :</strong> {{ $res->duree }} ({{ $res->nbJours ?? 'N/A' }} jours)</li>
                            <li class="list-group-item"><strong>👥 Nombre de personnes :</strong> {{ $res->nb_personnes }}</li>
                            <li class="list-group-item"><strong>💶 Prix final :</strong> {{ $res->prix_final ? number_format($res->prix_final, 0, ',', ' ') . ' €' : 'Non précisé' }}</li>
                            @if ($res->interets)
                                <li class="list-group-item"><strong>🎯 Centres d’intérêt :</strong> {{ $res->interets }}</li>
                            @endif
                            @if ($res->details)
                                <li class="list-group-item"><strong>📝 Détails supplémentaires :</strong> {{ $res->details }}</li>
                            @endif
                            @if ($res->itineraire)
                                <li class="list-group-item">
                                    <strong>🗺️ Itinéraire :</strong>
                                    <a href="{{ asset('storage/' . $res->itineraire) }}" target="_blank" class="btn btn-sm btn-outline-secondary ms-2">
                                        Voir le PDF
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <a href="mailto:{{ $res->email }}" class="btn btn-outline-success">
                            <i class="bx bx-mail-send"></i> Répondre par email
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
        </div>
    </div>
</div>

@endsection
