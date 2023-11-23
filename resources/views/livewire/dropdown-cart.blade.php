<div style="z-index: 900">
    <x-dropdown width="72">

        <x-slot name="trigger">
            <x-cart />
        </x-slot>

        <x-slot name="content">

            <ul>
                <div class="px-4 py-3 text-start border-b border-gray-200">
                    <p class="text-gray-500">Mi lista:</p>
                </div>
                @forelse (Cart::content() as $item)
                    <li class="p-4 border-b border-gray-200">
                        <article class="flex justify-between">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full object-cover border border-gray-300"
                                    src="{{ asset('storage/' . $item->options->image) }}" alt="">
                                <div class="ml-2 flex-1">
                                    <h1 class="font-bold">{{ Str::limit($item->name, 23) }}</h1>
                                    <p>ARS ${{ $item->price }} - Kgs: {{ $item->options->weight }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <button wire:click="deleteItem({{ $item->id }})">
                                    <i class="fa-solid fa-trash text-red-700 text-xl"></i>
                                </button>
                            </div>
                        </article>
                    </li>
                @empty
                    <div class="py-6 px-4">
                        <p class="text-center">
                            No tiene agregado ningun ítem en su bolsa.
                        </p>
                    </div>
                @endforelse
            </ul>

            <div style="position: sticky; bottom: 0; background-color: white;">
                @if (Cart::count())
                    <div class="p-2 px-3">
                        <p class="text-lg mt-2 text-gray-700"><span class="font-bold">Total:</span> ARS
                            {{ Cart::subtotal()}}</p>
                        <a href="{{ route('shopping-cart') }}">
                            <x-button-enlace color="ocreEspeciera" class="w-full my-2">
                                Ir a mi bolsa
                            </x-button-enlace>
                        </a>
                    </div>
                @endif
            </div>

        </x-slot>

    </x-dropdown>
</div>
