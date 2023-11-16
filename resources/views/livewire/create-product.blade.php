<div class="max-w-md mx-auto mt-5 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl text-center font-semibold text-ocreEspeciera">Formulario - Crear producto</h2>
    <p class="text-center py-1 mb-4 text-gray-300 ">EspecieraSgo</p>
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        @csrf
        <div >
            <x-input type="text" 
                wire:model.live="name"
                name="name" 
                placeholder="Nombre" 
                class="w-full">
            </x-input>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-input type="text" 
                wire:model.live="slug"
                name="slug" 
                placeholder="Slug" 
                class="w-full bg-gray-200" disabled>
            </x-input>
            @error('slug') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-input type="number" 
                wire:model.live="price"
                name="price"
                inputmode="numeric" 
                placeholder="Precio" 
                class="w-full">
            </x-input>
            @error('price') <span class="error">{{ $message }}</span> @enderror
        </div>
        
        <div class="mt-4">
            <label for="file" class="block text-sm font-medium text-gray-700">Selecciona un archivo</label>
            <x-input type="file" wire:model.lazy="file" name="file" id="file" class="w-full py-2 px-3 border rounded-lg border-gray-300 bg-gray-100">
            </x-input>
            @if ($errors->has('file'))
                <span class="error">{{ $errors->first('file') }}</span>
            @endif
        </div>
        

        <div class="text-center mt-4">
            <x-button-espe 
                type="submit" 
                class="text-white px-4 py-2 rounded mx-auto">
                Crear producto
            </x-button-espe>
        </div>
    </form>
</div>
