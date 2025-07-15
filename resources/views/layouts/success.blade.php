@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show my-3" role="alert">
    <h4 class="alert-heading"><i class="bi bi-check-circle-fill"></i> Éxito</h4>
    <p class="mb-0">{{ Session::get('success') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif