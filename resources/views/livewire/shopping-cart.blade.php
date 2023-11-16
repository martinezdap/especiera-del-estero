<div class="py-16 container">
    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-md py-4 my-6">
            <div class="px-4 pb-4 pt-2">
                <x-input type="text" required wire:model.live="name" name="name" placeholder="Nombre" class="w-full">
                </x-input>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="px-4 pb-2">
                <x-input type="text" required wire:model.live="adress" name="adress"
                    placeholder="Direccion/domicilio" class="w-full">
                </x-input>
                @error('adress')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md px-4 py-6 my-6" style="z-index: 10">
        <h3 class="text-lg text-greenEspeciera pb-2">Resumen del pedido:</h3>
        @forelse (Cart::content() as $item)
            <div class="flex-col bg-gray-200 p-2 rounded-md mb-2 text-gray-600 sm:flex sm:justify-between relative">
                <button wire:click="showModal('{{ $item->rowId }}')" wire:key="{{ $item->rowId }}" class="absolute top-2 right-1 py-1 px-2">
                    <i class="fa-solid fa-square-xmark text-red-500 hover:text-red-600 text-3xl"></i>
                </button>                

                <x-confirmation-modal wire:model="open">
                    <x-slot name="title">
                        Confirmación de Eliminación
                    </x-slot>
                    <x-slot name="content">
                        ¿Está seguro de que desea eliminar este producto?
                    </x-slot>
                    <x-slot name="footer">
                        <button wire:click="closeModal"
                            class="bg-gray-300 text-gray-700 rounded-lg font-semibold px-4 py-2 mr-2">
                            Cancelar
                        </button>
                        <button wire:click="deleteItem"
                            class="bg-red-500 rounded-lg text-white font-semibold px-4 py-2">
                            Eliminar
                        </button>
                    </x-slot>
                </x-confirmation-modal>

                <div class="flex items-center">
                    <img class="h-10 w-10 rounded-full object-cover border border-gray-300"
                        src="{{ asset('storage/' . $item->options->image) }}" alt="">
                    <div class="ml-4">
                        <h4><span class="font-bold text-gray-600">Nombre: </span>{{ Str::limit($item->name, 15) }}</h4>
                        <p><span class="font-bold text-gray-600">Subtotal: </span> $
                            {{ number_format($item->price, 0, ',', '.') }} - <span
                                class="font-bold text-gray-600">Kg:</span> {{ $item->options->weight }} </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="flex-col items-center bg-gray-300 text-gray-500 rounded-lg shadow-sm p-6 text-center">
                <p>Tu bolsa no contiene ningún producto.</p>
                <a href="{{ route('welcome') }}"><span class="font-semibold">Volver al inicio</span></a>
            </div>
        @endforelse
        @if (Cart::count())
            <div class="w-full pt-2 flex justify-between">
                <div>
                    <a href="{{ route('welcome') }}">
                        <x-secondary-button-espe>Atras</x-secondary-button-espe>
                    </a>
                </div>
                <div>
                    <x-secondary-button-espe wire:click="confirmarPedido">Confirmar pedido</x-secondary-button-espe>
                </div>
            </div>
        @endif
    </div>
</div>
