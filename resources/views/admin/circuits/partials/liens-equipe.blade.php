{{-- resources/views/admin/circuits/partials/liens-equipe.blade.php --}}
<div class="row g-3">
    <div class="col-12">
        <h6>🔗 Liens d'accès équipe pour : {{ $circuit->nom }}</h6>
    </div>
    
    @foreach($liens as $lien)
    <div class="col-12">
        <label class="form-label fw-bold">
            {{ $lien['role'] === 'photographe' ? '📸' : '✍️' }} {{ $lien['nom'] }}
        </label>
        <div class="input-group">
            <input type="text" value="{{ $lien['lien'] }}" class="form-control" readonly>
            <button class="btn btn-outline-secondary" onclick="copierLien(this)">
                <i class="bx bx-copy"></i>
            </button>
        </div>
    </div>
    @endforeach
    
    <div class="col-12">
        <div class="alert alert-info">
            <i class="bx bx-info-circle"></i>
            <strong>Info :</strong> Ces liens permettent à votre équipe d'accéder directement au programme du jour.
        </div>
    </div>
</div>

<script>
function copierLien(button) {
    const input = button.previousElementSibling;
    input.select();
    navigator.clipboard.writeText(input.value);
    toastr.success('Lien copié !');
}
</script>