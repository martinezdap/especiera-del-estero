<div>
    <x-table-responsive>

        <div class="px-6 py-4 bg-ocreEspeciera">
            <x-input wire:model.live="search" class="w-full" type=text
                placeholder="Ingrese el nombre del producto que está buscando.">
            </x-input>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($products->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-ocreEspeciera uppercase bg-gray-100"
                            colspan="2">
                            Producto
                        </th>
                        <th colspan="1"
                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100">

                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($products as $product)
                        <div>
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap" colspan="2">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="flex items-center">
                                                <img class="h-10 w-10 rounded-full object-cover border border-gray-300"
                                                    src="{{ asset('storage/' . $product->file_uri) }}" alt="">
                                                <div class="ml-2 text-sm font-medium leading-5 text-gray-900">
                                                    <div>
                                                        {{ $product->name }}
                                                    </div>
                                                    <div class="text-sm leading-5 text-gray-900 flex">
                                                        <p><span class="text-gray-500 mr-1">Precio por Kg: </span>
                                                            $ {{ number_format($product->price, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-end" colspan="1">
                                    <div>
                                        @php
                                            $isDisabled = in_array(
                                                $product->id,
                                                Cart::content()
                                                    ->pluck('id')
                                                    ->toArray(),
                                            );
                                        @endphp

                                        <x-button-espe wire:click="showModal('{{ $product->id }}')" :disabled="$isDisabled">
                                            ¡Lo quiero!
                                        </x-button-espe>

                                        <x-dialog-modal wire:model="open">
                                            <x-slot name="title">
                                                <p class="text-start">
                                                    @if ($selectedProduct)
                                                        ¿Cuantos Kgs quieres de
                                                        <span>{{ $selectedProduct->name }}?</span>
                                                    @endif
                                                </p>
                                            </x-slot>
                                            <x-slot name="content">
                                                <div class="text-start items-center">
                                                    <p>
                                                        Cargá los Kgs de este producto, entrá a "Mi bolsa"
                                                        para finalizar el pedido.
                                                    </p>
                                                    <div
                                                        class="mt-4 text-gray-700 px-3 flex justify-between bg-gray-200 py-2 rounded-md sm:w-full lg:w-3/4 mx-auto items-center">
                                                        <x-button-espe x-bind:disabled="{{ $weight }} <= 0.5"
                                                            wire:target="decrement"
                                                            wire:click="decrement">
                                                            <i class="fa-solid fa-minus text-white text-md"></i>
                                                        </x-button-espe>
                                                        <span>
                                                            @if (strpos($weight, '.') !== false)
                                                                {{ number_format($weight, 3) }} kg
                                                            @else
                                                                {{ $weight }} kg
                                                            @endif
                                                        </span>
                                                        <x-button-espe x-bind:disabled="{{ $weight }} >= 20"
                                                            wire:target="increment"
                                                            wire:click="increment">
                                                            <i class="fa-solid fa-plus text-white text-md"></i>
                                                        </x-button-espe>
                                                    </div>
                                                </div>
                                            </x-slot>
                                            <x-slot name="footer">
                                                <div class="flex justify-between sm:justify-center">
                                                    <div>
                                                        <button wire:click="closeModal"
                                                            class="bg-gray-300 text-greenEspeciera rounded-lg font-semibold px-4 py-2 mr-2">
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                    @if ($selectedProduct)
                                                        <div>
                                                            <button wire:click="addItem({{ $selectedProduct->id }})"
                                                                wire:key="product-{{ $selectedProduct->id }}"
                                                                wire:loading.attr="disabled"
                                                                wire:target="addItem({{ $selectedProduct->id }})"
                                                                class="bg-ocreEspeciera rounded-lg text-white font-semibold px-4 py-2">
                                                                Agregar a mi bolsa
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </x-slot>
                                            </x-confirmation-modal>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-12 text-center w-full">
                <i class="fa-regular fa-file text-3xl text-gray-500"></i>
                <p class="text-gray-500">No hay ningún producto que coincida con la busqueda.</p>
            </div>
        @endif

        <div class="w-full text-center py-2 bg-ocreEspeciera">
            <p class="text-gray-100 text-sm">© EspecieraSgo</p>
        </div>

        @if ($products->hasPages())
            <div class="container px-6 py-6 bg-gray-100 z-50">
                {{ $products->links() }}
            </div>
        @endif
    </x-table-responsive>
</div>
