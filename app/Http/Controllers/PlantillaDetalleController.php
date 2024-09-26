<?php

namespace App\Http\Controllers;

use App\Models\Plantilla;
use Illuminate\Http\Request;

class PlantillaDetalleController extends Controller
{
    public function show($categoriaSlug, $plantillaSlug)
    {
        // Obtener la plantilla por su slug
        $plantilla = Plantilla::where('slug', $plantillaSlug)->whereHas('categoria', function ($query) use ($categoriaSlug) {
            $query->where('slug', $categoriaSlug);
        })->firstOrFail();

        return view('presentacion-detalle', compact('plantilla'));
    }
}
