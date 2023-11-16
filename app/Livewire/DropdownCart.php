<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\Attributes\On;

class DropdownCart extends Component
{
    #[On('add_cart')]
    public function updateCart(){
        $this->render();
    }

    public function deleteItem($product_id) {
        $rowId = null;
    
        // Recorre los elementos del carrito para encontrar el rowId del producto
        foreach (Cart::content() as $cartItem) {
            if ($cartItem->id == $product_id) {
                $rowId = $cartItem->rowId;
                break;
            }
        }
    
        // Si se encontró el rowId, elimina el producto del carrito
        if (!is_null($rowId)) {
            Cart::remove($rowId);
        }
    
        $this->updateCart();
        $this->dispatch('delete_cart');
    }
    
    public function render()
    {
        return view('livewire.dropdown-cart');
    }
}

