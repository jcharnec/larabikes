@props(['type' => 'info'])

@php
$icon = match($type) {
'success' => 'bi-check-circle-fill',
'danger' => 'bi-exclamation-triangle-fill',
'warning' => 'bi-exclamation-circle-fill',
'info' => 'bi-info-circle-fill',
default => 'bi-info-circle-fill',
};
@endphp

<div class="alert alert-{{ $type }} d-flex align-items-center" role="alert">
    <i class="bi {{ $icon }} me-2"></i>
    <div>
        <p class="mb-0">{{ $message }}</p>
        {{ $slot }}
    </div>
</div>