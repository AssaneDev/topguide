@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary">🗓️ Réservations d’excursions</h4>
        </div>
        <div class="card-body table-responsive">
            <table id="example" class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Destination</th>
                        <th>Personnes</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                @forelse ($requests as $req)
    <tr>
        <td>{{ $req->nom }}</td>
        <td>{{ $req->email }}</td>
        <td>{{ $req->tel }}</td>
        <td>{{ $req->destination }}</td>
        <td><span class="badge bg-info">{{ $req->nbr_Pax }}</span></td>
        <td>{{ $req->date->format('d/m/Y') }}</td>
        <td class="text-center">
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#messageModal{{ $req->id }}">
                Voir
            </button>
        </td>
        <td>
            @if ($req->confirmed)
                <span class="badge bg-success">Confirmée</span>
            @else
                <span class="badge bg-warning text-dark">En attente</span>
            @endif
        </td>
        <td>
            <a href="{{ route('admin.excursion_requests.destroy', $req->id) }}"
               class="btn btn-sm btn-outline-danger"
               id="delete">
               <i class="bx bx-trash"></i>
            </a>
        </td>
    </tr>

    <!-- ✅ Modal doit être ici, dans la boucle -->
    <div class="modal fade" id="messageModal{{ $req->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $req->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="messageModalLabel{{ $req->id }}">Message de {{ $req->nom }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
          </div>
          <div class="modal-body text-start">
            {{ $req->message }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
@empty
    <tr>
        <td colspan="9" class="text-muted text-center">Aucune réservation pour le moment.</td>
    </tr>
@endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
