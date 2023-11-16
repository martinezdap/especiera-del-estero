<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;
    public $name, $slug, $price, $file;

    public function submit()
    {
        $this->validate([
            'file' => 'required|image',
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:products,slug',
            'price' => 'required|numeric'
        ]);
 
        // $nameUnique = time().'.'.$this->file->extension();
        $imagePath = $this->file->store('images', 'public');

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->price = $this->price;
        $product->file_uri = $imagePath;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Producto creado correctamente.');
    }

    public function updatedName($value){
        $this->slug = Str::slug($value);
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
