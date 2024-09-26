<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create'); // Retornar la vista para crear una nueva categoría
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|unique:categorias|max:255',
        ]);
    
        // Crear una nueva categoría
        Categoria::create([
            'nombre' => $request->input('nombre'),
            'slug' => Str::slug($request->input('nombre')), // Genera un slug automáticamente
            'estado' => true, // O usa $request->input('estado') si quieres que sea seleccionable
        ]);
    
        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria')); // Retornar la vista para editar una categoría
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|max:255|unique:categorias,nombre,' . $categoria->id,
        ]);

        // Actualizar la categoría
        $categoria->update([
            'nombre' => $request->input('nombre'),
            'slug' => Str::slug($request->input('nombre')), // Actualiza el slug automáticamente
            'estado' => $request->input('estado'), // Mantén el estado actual o cámbialo si lo haces seleccionable
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete(); // Eliminar la categoría

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
