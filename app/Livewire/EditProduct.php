<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use Illuminate\Support\Str;

class EditProduct extends Component
{
    use WithFileUploads;
    public $product;
    public $name, $slug, $price, $file, $status;

    public function submit()
    {
        $this->validate([
            'file' => 'nullable|image',
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:products,slug,' . $this->product->id,
            'price' => 'required|numeric',
        ]);

        if ($this->file) {
            // Guarda la nueva imagen
            $imagePath = $this->file->store('images', 'public');

            // Borra la imagen anterior
            if ($this->product->file_uri) {
                // Comprueba si la imagen anterior existe antes de intentar borrarla
                $existingImage = storage_path('app/public/' . $this->product->file_uri);
                if (file_exists($existingImage)) {
                    unlink($existingImage); // Borra la imagen anterior
                }
            }

            // Actualiza la ruta de la nueva imagen en el producto
            $this->product->file_uri = $imagePath;
        }

        // Actualiza los demás campos del producto
        $this->product->name = $this->name;
        $this->product->slug = $this->slug;
        $this->product->price = $this->price;
        $this->product->save();

        return redirect()->route('product.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function mount()
    {
        $this->name = $this->product->name;
        $this->slug = $this->product->slug;
        $this->price = $this->product->price;
        $this->status = $this->product->status;
    }

    public function changeStatus()
    {
        $this->status = $this->status === 1 ? 2 : 1;

        $this->product->status = ($this->product->status == 1) ? 2 : 1;

        $this->product->save();
        $this->render();
    }


    public function render()
    {
        return view('livewire.edit-product');
    }
}
