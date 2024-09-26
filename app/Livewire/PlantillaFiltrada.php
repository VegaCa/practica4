<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Plantilla;
use App\Models\Categoria;

class PlantillaFiltrada extends Component
{
    public $categorias;
    public $selectedCategory = null;

    #[Url]
    public $tipoCatalogo = []; // Cambiado a array

    #[Url]
    public $numeroVistas = []; // Cambiado a array

    #[Url]
    public $selectedPrices = [];

    public function mount($slug = null)
    {
        $this->categorias = Categoria::where('estado', 1)->get();
    
        if ($slug) {
            $categoria = Categoria::where('slug', $slug)->first();
            if ($categoria) {
                $this->selectedCategory = $categoria->id;
            }
        }
    }
    
    public function render()
    {
        // Obtener las primeras 12 plantillas o menos si no hay tantas disponibles
        $plantillas = Plantilla::where('estado', 1)
            ->when($this->selectedCategory, function ($query) {
                $query->where('categoria_id', $this->selectedCategory);
            })
            ->when(count($this->tipoCatalogo) > 0, function ($query) {
                $query->whereIn('tipo_catalogo', $this->tipoCatalogo);
            })
            ->when(count($this->numeroVistas) > 0, function ($query) {
                $query->whereIn('numero_vistas', $this->numeroVistas);
            })
            ->when(count($this->selectedPrices) > 0, function ($query) {
                $query->where(function ($subQuery) {
                    foreach ($this->selectedPrices as $range) {
                        [$min, $max] = explode('-', $range);
                        $subQuery->orWhereBetween('precio', [(float) $min, (float) $max]);
                    }
                });
            })
            ->whereHas('categoria', function ($query) {
                $query->where('estado', 1);
            })
            ->take(12) // Asegura que se carguen hasta 12 plantillas
            ->get();
    
        return view('livewire.plantilla-filtrada', ['plantillas' => $plantillas]);
    }
    
    public function setValueCategory($id)
    {
        $this->selectedCategory = $this->selectedCategory === $id ? null : $id;
    }
    
    public function resetCategory()
    {
        $this->selectedCategory = null;
        $this->tipoCatalogo = [];
        $this->numeroVistas = [];
        $this->selectedPrices = [];
    }
    public function filterByCategory($slug)
    {
        $categoria = Categoria::where('slug', $slug)->first();
        if ($categoria) {
            $this->selectedCategory = $categoria->id;
        } else {
            $this->resetCategory();
        }
    }
}
