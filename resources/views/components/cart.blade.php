<div>
    <span class="text-3xl cursor-pointer">
        <i class="fa-solid fa-bag-shopping text-greenEspeciera"></i>
    </span>

    @if (Cart::count())
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-ocreEspeciera rounded-full">{{ Cart::count() }}</span>
    @else
        <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-ocreEspeciera rounded-full"></span>
    @endif
</div>