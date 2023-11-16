@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-greenEspeciera text-sm font-medium leading-5 text-ocreEspeciera focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-greenEspeciera hover:text-ocreEspeciera hover:border-ocreEspeciera focus:outline-none focus:text-yellow-600 focus:border-yellow-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
