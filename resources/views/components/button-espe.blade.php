<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-greenEspeciera border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-greenHover focus:bg-ocreEspeciera active:greenEspeciera focus:outline-none focus:ring-2 focus:ring-greenEspeciera focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>