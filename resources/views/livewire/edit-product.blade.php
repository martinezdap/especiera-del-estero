<div class="max-w-md mx-auto mt-5 p-6 bg-white rounded-lg shadow-md text-gray-700">
    <h2 class="text-xl text-center font-semibold text-ocreEspeciera">Formulario - Editar producto</h2>
    <p class="text-center pb-2 pt-1 text-gray-300 ">EspecieraSgo</p>

    <div class="flex justify-between items-center text-center bg-gray-100 rounded-lg px-4 py-2 mb-4">
        <div class="text-center">
            <p class="my-auto">Estado:</p>
        </div>

        <div>
            <button wire:click="changeStatus" wire:loading.attr="changedStatus" wire:targget="disabled"
                class="hover-button text-white text-sm py-2 px-4 rounded-lg font-bold cursor-pointer 
                    @if ($product->status == 2) bg-green-500 hover:bg-green-600 @else bg-red-500 hover:bg-red-600 @endif">
                @if ($product->status == 2)
                    Publicado
                @else
                    Borrador
                @endif
            </button>
        </div>
    </div>

    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-2 flex justify-center relative">
            <div class="relative group">
                @if ($file)
                    <img class="h-24 w-24 rounded-full object-cover border border-gray-300 transition-opacity duration-500 ease-in-out group-hover:opacity-75"
                        src="{{ $file->temporaryUrl() }}" alt="">
                @else
                    <img class="h-24 w-24 rounded-full object-cover border border-gray-300 transition-opacity duration-500 ease-in-out group-hover:opacity-75"
                        src="{{ asset('storage/' . $product->file_uri) }}" alt="">
                @endif
                <div
                    class="overlay h-24 w-24 bg-gray-700 rounded-full object-cover bg-opacity-10 opacity-0 flex flex-col justify-center items-center absolute top-0 left-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
                    <label for="fileInput"
                        class="hover-button bg-none text-white text-sm py-2 px-4 rounded-lg font-bold cursor-pointer flex flex-col items-center">
                        <span>Cambiar</span>
                        <span>imagen</span>
                        <input type="file" id="fileInput" class="hidden" wire:model="file">
                    </label>
                </div>
            </div>
        </div>

        <div class="text-center">
            <div class="sm:block lg:hidden">
                <p class="mb-2 text-sm text-ocreEspeciera">Click en la imagen para actualizar.</p>
            </div>
            <div class="sm:hidden lg:block pt-2"></div>
            <x-input type="text" wire:model.live="name" name="name" placeholder="Nombre" class="w-full">
            </x-input>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4 hidden">
            <x-input type="text" wire:model.live="slug" name="slug" placeholder="Slug" class="w-full bg-gray-200"
                disabled>
            </x-input>
            @error('slug')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <x-input type="number" wire:model.live="price" name="price" inputmode="numeric" placeholder="Precio"
                class="w-full">
            </x-input>
            @error('price')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="items-center text-center mt-4">
            <x-button-espe type="submit" class="text-white px-4 py-2 rounded">
                Guardar cambios
            </x-button-espe>
        </div>
    </form>

</div>
