<div class="pt-4 h-full">
    <div class="container flex justify-between items-center">
        <div>
            <h3 class="text-gray-500 text-lg">Productos:</h3>
        </div>
        <div>
            <a href="{{ route('product.create') }}">
                <x-button-espe>
                    Agregar producto
                </x-button-espe>
            </a>
        </div>
    </div>

    <x-table-responsive>
        <div class="px-6 py-4 bg-ocreEspeciera">
            <x-input type="text" wire:model.live="search" class="w-full"
                placeholder="Ingrese el nombre del producto que quiere buscar">
            </x-input>
        </div>

        @if ($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4">
                @foreach ($products as $product)
                    <div class="bg-white p-4 border border-gray-200 rounded shadow-sm">
                        <div class="flex items-center mb-1">
                            <div class="flex-shrink-0 h-10 w-10">
                                @if ($product->file_uri)
                                    <img class="h-10 w-10 rounded-full object-cover border border-gray-300"
                                        src="{{ asset('storage/' . $product->file_uri) }}" alt="">
                                @else
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="https://images.pexels.com/photos/4883800/pexels-photo-4883800.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                        alt="">
                                @endif
                            </div>
                            <div class="ml-4 flex justify-between w-full">
                                <div class="text-sm font-medium text-gray-700 capitalize">
                                    {{ Str::limit($product->name, 23) }}
                                </div>
                                @switch($product->status)
                                    @case(1)
                                        <div class="flex items-center">
                                            <p class="mr-1 text-sm">Estado:</p>
                                            <span
                                                class="inline-flex items-center leading-5 font-medium rounded-md text-red-500 py-1">
                                                <i class="fa-sharp fa-solid fa-circle text-sm"></i>
                                            </span>
                                        </div>
                                    @break

                                    @case(2)
                                        <div class="flex items-center">
                                            <p class="mr-1 text-sm">Estado:</p>
                                            <span
                                                class="inline-flex items-center leading-5 font-medium rounded-md text-green-500 py-1">
                                                <i class="fa-sharp fa-solid fa-circle text-sm"></i>
                                            </span>
                                        </div>

                                        @default
                                    @endswitch
                                </div>
                            </div>
                            <div class="flex justify-between w-full items-center">
                                <div class="text-sm text-gray-700">
                                    <span class="text-gray-700 font-semibold">Precio/Kg: </span> $
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <div class="text-center flex items-center">
                                    <a href="{{ route('product.edit', $product->id) }}" class="text-white">
                                        <span
                                            class="inline-flex text-xs leading-5 font-medium rounded-md bg-greenEspeciera hover:bg-ocreEspeciera text-white p-1 transition ease-in-out duration-150">
                                            Editar
                                        </span>
                                    </a>
                                    <button wire:click="showModal({{ $product->id }})"
                                        wire:key="button-{{ $product->id }}" wire:loading.attr="disabled"
                                        wire:target="showModal" class="ml-2">
                                        <span
                                            class="inline-flex text-xs leading-5 font-medium rounded-md bg-orange-500 hover:bg-orange-400 text-white p-1 transition ease-in-out duration-150">
                                            Eliminar
                                        </span>
                                    </button>

                                    <x-confirmation-modal wire:model="open">
                                        <x-slot name="title">
                                            Confirmación de Eliminación
                                        </x-slot>
                                        <x-slot name="content">
                                            ¿Está seguro de que desea eliminar este producto?
                                        </x-slot>
                                        <x-slot name="footer">
                                            <button wire:click="cancelDelete"
                                                class="bg-gray-300 text-gray-700 rounded-lg font-semibold px-4 py-2 mr-2">
                                                Cancelar
                                            </button>
                                            <button wire:click="deleteProduct({{ $product->id }})"
                                                class="bg-red-500 rounded-lg text-white font-semibold px-4 py-2">
                                                Eliminar
                                            </button>
                                        </x-slot>
                                    </x-confirmation-modal>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-4 flex justify-center text-whiteCanvas bg-secondary">
                    <div class="flex-col text-center text-gray-700">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <p>Ningún producto coincide con la búsqueda.</p>
                    </div>
                </div>
            @endif

            @if ($products->hasPages())
                <div class="pb-4 px-4">
                    {{ $products->links() }}
                </div>
            @endif

        </x-table-responsive>
    </div>
