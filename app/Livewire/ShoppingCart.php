<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class ShoppingCart extends Component
{
    #[On('delete_cart')]
    public function updateCart()
    {
        $this->render();
    }

    public $name, $adress, $weight, $open = false;
    public $valor = 1;
    public $productRowIdToDelete;

    protected $rules = [
        'name' => 'required|string|max:255',
        'adress' => 'required|string|max:255',
    ];

    public function confirmarPedido()
    {
        $this->validate($this->rules);
    }

    public function deleteItem()
    {
        if (!is_null($this->productRowIdToDelete)) {
            Cart::remove($this->productRowIdToDelete);
            $this->open = false;
            $this->dispatch('add_cart');
        }
    }

    public function showModal($rowId)
    {
        $this->open = !$this->open;
        $this->productRowIdToDelete = $rowId;
    }

    public function closeModal()
    {
        $this->open = !$this->open;
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
