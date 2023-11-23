<x-app-layout> 
    <x-slot name="slot">
        <div class="min-h-screen flex items-center">
            @livewire('edit-product', ['product' => $product], key($product->id))
        </div>
    </x-slot>
</x-app-layout>