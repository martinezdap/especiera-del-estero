@props(['color' => 'red'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex justify-center items-center px-4 py-2 bg-$color border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-$color active:bg-$color focus:outline-none focus:border-$color focus:shadow-outline-$color disabled:opacity-25 transition"]) }}>
    {{ $slot }}
</button>