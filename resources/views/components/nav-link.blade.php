@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-white underline decoration-yellow-500 decoration-wavy decoration-2'
            : 'text-white hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>