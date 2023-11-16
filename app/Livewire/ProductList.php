<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class ProductList extends Component
{
    use WithPagination;

    public $search, $open = false;
    public $productIdToDelete;

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc') // Aquí debes especificar la columna y la dirección del orden
            ->paginate(6);

        return view('livewire.product-list', compact('products'));
    }

    public function deleteProduct()
    {
        $product = Product::find($this->productIdToDelete);

        if ($product) {
            $imagePath = $product->file_uri;

            Storage::delete($imagePath);
            $product->delete();
            $this->open = false;

            $this->resetPage();
        }
    }

    public function cancelDelete(){
        $this->open = false;
    }

    public function showModal($productId)
    {
        $this->productIdToDelete = $productId;
        $this->open = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
