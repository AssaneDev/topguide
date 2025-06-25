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
                            <td class="text-start" style="max-width: 250px;">{{ Str::limit($req->message, 80) }}</td>
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
