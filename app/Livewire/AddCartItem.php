<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class AddCartItem extends Component
{
    use WithPagination;
    public $search;
    public $open = false;
    public $weight = 0.5;
    public $product, $selectedProduct;

    #[On('delete_cart')]
    public function updateCart()
    {
        $this->render();
    }

    public function addItem($producto_id)
    {
        $productIDsInCart = Cart::content()->pluck('id')->toArray();

        $product = Product::find($producto_id);
        $options = [
            'image' => $product->file_uri, // Almacena la dirección de la imagen
            'weight' => $this->weight, // Almacena el peso del producto (en kilogramos, por ejemplo)
        ];

        if (!in_array($producto_id, $productIDsInCart)) {

            $product = Product::find($producto_id);
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price * $this->weight,
                'options' => $options,
            ]);
            $this->dispatch('add_cart');
        }

        $this->open = false;
        $this->weight = 0.5;
        
    }

    public function showModal($productId) {
        $product = Product::find($productId);
    
        if ($product) {
            $this->selectedProduct = $product;
            $this->open = true;
        } else {
            dd('No encontrado');
        }
    }

    public function closeModal(){
        $this->open = false;
    }

    public function delete()
    {
        Cart::destroy();
        $this->emitTo('dropdown-cart', 'render');
    }

    public function increment(){
        $this->weight = $this->weight + 0.5;
    }

    public function decrement(){
        $this->weight = $this->weight - 0.5;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
                   ->where('status', 2)
                   ->paginate(6);

        return view('livewire.add-cart-item', compact('products'));
    }
}
