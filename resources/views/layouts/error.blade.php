@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
    <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Se han producido errores:</h4>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif