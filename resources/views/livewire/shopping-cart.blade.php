<div class="py-16 container">
    @if (Cart::count())
        <form class="bg-white rounded-lg shadow-md py-4 my-6">
            @csrf
            <div class="px-4 pb-4 pt-2">
                <x-label for="name">Nombre y apellido</x-label>
                <x-input type="text" required wire:model.defer="name" name="name" value="{{ $name }}"
                    class="w-full" id="name">
                </x-input>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="px-4 pb-2">
                <x-label for="adress">Dirección de envío (Domicílio)</x-label>
                <x-input type="text" required wire:model.defer="adress" name="adress" value="{{ $adress }}"
                    class="w-full" id="adress">
                </x-input>
                @error('adress')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </form>
    @endif

    <input hidden disabled type="text" id="row" wire:model="productRowIdToDelete"
        value="{{ $productRowIdToDelete }}" />

    <div class="bg-white rounded-lg shadow-md px-4 py-6 my-6" style="z-index: 10">
        <h3 class="text-lg text-greenEspeciera pb-2">Resumen del pedido:</h3>
        @forelse (Cart::content() as $item)
            <div class="flex-col bg-gray-200 p-2 rounded-md mb-2 text-gray-600 sm:flex sm:justify-between relative">
                <button wire:click="showModal('{{ $item->rowId }}')" wire:key="{{ $item->rowId }}"
                    class="absolute top-2 right-1 py-1 px-2">
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
                        <button id="delete-button" onclick="eventDelete()"
                            wire:click="deleteItem('{{ $item->rowId }}')"
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
                                class="font-bold text-gray-600">Kgs:</span>
                            @if (strpos($item->options->weight, '.') !== false)
                                {{ number_format($item->options->weight, 3) }}
                            @else
                                {{ $item->options->weight }}
                            @endif
                        </p>
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
                    <x-confirmation-modal wire:model="openTwo">
                        <x-slot name="title">
                            Confirmación de pedido.
                        </x-slot>
                        <x-slot name="content">
                            ¿Confirmas que tu pedido incluye todos los productos deseados? Al confirmar, tu carrito se
                            vaciará y enviaremos los detalles del pedido por WhatsApp.
                        </x-slot>
                        <x-slot name="footer">
                            <button wire:click="closeModalTwo"
                                class="bg-gray-300 text-gray-700 rounded-lg font-semibold px-4 py-2 mr-2">
                                Cancelar
                            </button>
                            <button @click="sendwhatsapp()" wire:click="destroyCart"
                                class="bg-red-500 rounded-lg text-white font-semibold px-4 py-2">
                                Confirmar
                            </button>
                        </x-slot>
                    </x-confirmation-modal>
                </div>
            </div>
        @endif
    </div>

    <script>
        var cartContent = {!! $cartContentJson !!};
        var rowId = 0;
        var btn = document.getElementById('delete-button');

        function eventDelete() {
            var rowId = document.getElementById('row').value;
            if (cartContent.hasOwnProperty(rowId)) {
                delete cartContent[rowId];
            }
        }

        function sendwhatsapp() {
            var name = document.getElementById('name').value;
            var adress = document.getElementById('adress').value;
            var productList = "Lista de productos:" + "%0a";
            var productNumber = 0;
            var total = 0;

            for (var key in cartContent) {

                if (cartContent.hasOwnProperty(key)) {
                    var product = cartContent[key];
                    var productName = product.name;
                    var productWeight = product.options.weight;
                    total += product.price;

                    // Use el id del contenido para determinar el número de producto
                    var productNumber = productNumber + 1;

                    // Actualice la cadena de salida
                    productList += "Producto " + productNumber + " - *_" + productName + "_* - Kgs: *_" +
                        productWeight +
                        "_*" + "%0a";
                }
            }

            var phonenumber = "+5493855983249";
            var url = "https://wa.me/" + phonenumber + "?text=" +
                "Hola! Mi nombre es *_" + name + "_* y me gustaria realizar un pedido." + "%0a" +
                "Datos de entrega: *_" + adress + "_*" + "%0a %0a" + productList + "%0a" + "Total a pagar: *_" + total +
                "_*";

            window.open(url, '_blank').focus();
        }
    </script>
</div>
