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

    protected $listeners = ['carritoActualizado' => 'render'];

    public $name, $adress, $weight, $open = false;
    public $productRowIdToDelete = 'Valor inicial', $confirm = false;
    public $cartContent = [], $openTwo = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'adress' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->name = $this->name;
        $this->adress = $this->adress;
        $this->cartContent = Cart::content()->toArray();
    }

    public function confirmarPedido()
    {
        $this->validate($this->rules);
        $this->openTwo = !$this->openTwo;
    }

    public function destroyCart(){
        Cart::destroy();
        return redirect()->route('welcome');
    }

    public function deleteItem($rowId)
    {
        if (!is_null($this->productRowIdToDelete)) {
            Cart::remove($this->productRowIdToDelete);
            $this->open = false;
            $this->dispatch('add_cart');
        }
    }

    public function eliminarElemento($rowId)
    {
        // Filtrar el array para eliminar el elemento con el rowId específico
        $this->cartContent = array_filter($this->cartContent, function ($item) use ($rowId) {
            return $item['rowId'] !== $rowId;
        });

        $this->dispatch('add_cart');
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

    public function closeModalTwo()
    {
        $this->openTwo = !$this->openTwo;
    }

    public function render()
    {
        return view('livewire.shopping-cart', [
            'cartContentJson' => json_encode($this->cartContent)
        ]);
    }
}
