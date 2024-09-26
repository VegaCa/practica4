<?php

namespace App\Http\Controllers;

use App\Models\Plantilla;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PlantillaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
        $plantillas = Plantilla::all(); // Obtener todas las plantillas
        return view('plantillas.index', compact('plantillas')); // Retornar la vista con las plantillas
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::where('estado', 1)->get();

        return view('plantillas.create', compact('categorias'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'tipo_catalogo' => 'required|string',
            'titulo' => 'required|max:255',
            'imagen_1' => 'required|image|mimes:jpeg,png,jpg',
            'imagen_2' => 'nullable|image|mimes:jpeg,png,jpg',
            'imagen_3' => 'nullable|image|mimes:jpeg,png,jpg',
            'imagen_4' => 'nullable|image|mimes:jpeg,png,jpg',
            'imagen_5' => 'nullable|image|mimes:jpeg,png,jpg',
            'enlace' => 'required|url',
            'descripcion' => 'nullable|string',
        ]);

        // Crear una nueva plantilla
        $plantilla = new Plantilla();
        $plantilla->categoria_id = $request->input('categoria_id');
        $plantilla->tipo_catalogo = $request->input('tipo_catalogo');
        $plantilla->titulo = $request->input('titulo');
        $plantilla->slug = Str::slug($request->input('titulo'));
        $plantilla->precio = $request->input('precio');
        $plantilla->numero_vistas = $request->input('numero_vistas');
        $plantilla->imagen_1 = $this->saveImagen($request->file('imagen_1'));

        // Guardar las imágenes opcionales si existen
        if ($request->hasFile('imagen_2')) {
            $plantilla->imagen_2 = $this->saveImagen($request->file('imagen_2'));
        }
        if ($request->hasFile('imagen_3')) {
            $plantilla->imagen_3 = $this->saveImagen($request->file('imagen_3'));
        }
        if ($request->hasFile('imagen_4')) {
            $plantilla->imagen_4 = $this->saveImagen($request->file('imagen_4'));
        }
        if ($request->hasFile('imagen_5')) {
            $plantilla->imagen_5 = $this->saveImagen($request->file('imagen_5'));
        }

        $plantilla->enlace = $request->input('enlace');
        $plantilla->descripcion = $request->input('descripcion');
        $plantilla->estado = true; // O hacer seleccionable

        $plantilla->save();

            return redirect()->route('plantillas.index')->with('success', 'Plantilla creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plantilla $plantilla)
    {
        $categorias = Categoria::where('estado', 1)->get();

        return view('plantillas.edit', compact('plantilla', 'categorias'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plantilla $plantilla)
    {
        // Validar los datos de entrada
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'tipo_catalogo' => 'required|string',
            'titulo' => 'required|max:255',
            'precio' => 'nullable|numeric|min:0',
            'numero_vistas' => 'required|integer|min:1',
            'imagen_1' => 'nullable|image|mimes:jpeg,png,jpg',
            'imagen_2' => 'nullable|image|mimes:jpeg,png,jpg',
            'imagen_3' => 'nullable|image|mimes:jpeg,png,jpg',
            'imagen_4' => 'nullable|image|mimes:jpeg,png,jpg',
            'imagen_5' => 'nullable|image|mimes:jpeg,png,jpg',
            'enlace' => 'required|url',
            'descripcion' => 'nullable|string',
        ]);


        $plantilla->categoria_id = $request->input('categoria_id');
        $plantilla->tipo_catalogo = $request->input('tipo_catalogo');
        $plantilla->titulo = $request->input('titulo');
        $plantilla->slug = Str::slug($request->input('titulo'));
        $plantilla->precio = $request->input('precio');
        $plantilla->numero_vistas = $request->input('numero_vistas');
    

        // Manejar la imagen principal
        if ($request->hasFile('imagen_1')) {
            if (!is_null($plantilla->imagen_1)) {
                $this->deleteImagen($plantilla->imagen_1);  // Eliminar la imagen antigua
            }
            $plantilla->imagen_1 = $this->saveImagen($request->file('imagen_1'));  // Guardar la nueva imagen
        } elseif ($request->input('imagen_1_actual')) {
            $plantilla->imagen_1 = $request->input('imagen_1_actual');  // Mantener la imagen actual si no se ha subido una nueva
        } else {
            $plantilla->imagen_1 = null;  // Limpiar la imagen si se elimina
        }
    
        // IMAGEN 2
        if ($request->hasFile('imagen_2')) {
            if (!is_null($plantilla->imagen_2)) {
                $this->deleteImagen($plantilla->imagen_2);
            }
            $plantilla->imagen_2 = $this->saveImagen($request->file('imagen_2'));
        } elseif ($request->input('imagen_2_actual')) {
            $plantilla->imagen_2 = $request->input('imagen_2_actual');
        } else if ($request->input('imagen2_eliminar') == '1') {
            if (!is_null($plantilla->imagen_2)) {
                $this->deleteImagen($plantilla->imagen_2);
            }
            $plantilla->imagen_2 = null;
        }

        // IMAGEN 3
        if ($request->hasFile('imagen_3')) {
            if (!is_null($plantilla->imagen_3)) {
                $this->deleteImagen($plantilla->imagen_3);
            }
            $plantilla->imagen_3 = $this->saveImagen($request->file('imagen_3'));
        } elseif ($request->input('imagen_3_actual')) {
            $plantilla->imagen_3 = $request->input('imagen_3_actual');
        } else if ($request->input('imagen3_eliminar') == '1') {
            if (!is_null($plantilla->imagen_3)) {
                $this->deleteImagen($plantilla->imagen_3);
            }
            $plantilla->imagen_3 = null;
        }

        // IMAGEN 4
        if ($request->hasFile('imagen_4')) {
            if (!is_null($plantilla->imagen_4)) {
                $this->deleteImagen($plantilla->imagen_4);
            }
            $plantilla->imagen_4 = $this->saveImagen($request->file('imagen_4'));
        } elseif ($request->input('imagen_4_actual')) {
            $plantilla->imagen_4 = $request->input('imagen_4_actual');
        } else if ($request->input('imagen4_eliminar') == '1') {
            if (!is_null($plantilla->imagen_4)) {
                $this->deleteImagen($plantilla->imagen_4);
            }
            $plantilla->imagen_4 = null;
        }

        // IMAGEN 5
        if ($request->hasFile('imagen_5')) {
            if (!is_null($plantilla->imagen_5)) {
                $this->deleteImagen($plantilla->imagen_5);
            }
            $plantilla->imagen_5 = $this->saveImagen($request->file('imagen_5'));
        } elseif ($request->input('imagen_5_actual')) {
            $plantilla->imagen_5 = $request->input('imagen_5_actual');
        } else if ($request->input('imagen5_eliminar') == '1') {
            if (!is_null($plantilla->imagen_5)) {
                $this->deleteImagen($plantilla->imagen_5);
            }
            $plantilla->imagen_5 = null;
        }
    
        $plantilla->enlace = $request->input('enlace');
        $plantilla->descripcion = $request->input('descripcion');
        $plantilla->estado = $request->input('estado');
    
        $plantilla->save();

        return redirect()->route('plantillas.index')->with('success', 'Plantilla actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plantilla $plantilla)
    {
        $plantilla->delete(); // Eliminar la plantilla

        return redirect()->route('plantillas.index')->with('success', 'Plantilla eliminada exitosamente.');
    }

    /*--------------------------------------------*/
    function compressAndResizeImage($sourcePath, $destinationPath, $quality) {
        $imgInfo = getimagesize($sourcePath);
        $mime = $imgInfo['mime'];
    
        // Crear una nueva imagen a partir del archivo
        switch($mime) { 
            case 'image/jpeg': 
            case 'image/jpg':  // Añadido soporte para jpg
                $image = imagecreatefromjpeg($sourcePath); 
                break; 
            case 'image/png': 
                $image = imagecreatefrompng($sourcePath); 
                break; 
            default: 
                throw new Exception('Formato de imagen no soportado. Solo se permiten JPG, JPEG y PNG.');
        }
    
        // Obtener ancho y alto de la imagen
        $width = imagesx($image);
        $height = imagesy($image);
    
        // Redimensionar la imagen si es necesario
        if ($width > 600 || $width < 100) {
            $newWidth = 600;
            $newHeight = ($height / $width) * $newWidth; // Mantener el aspecto
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
            // Redimensionar
            imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
            // Guardar la imagen comprimida y redimensionada
            imagejpeg($resizedImage, $destinationPath, $quality);
            imagedestroy($resizedImage); // Liberar memoria
        } else {
            // Guardar la imagen original comprimida
            imagejpeg($image, $destinationPath, $quality);
        }
    
        imagedestroy($image); // Liberar memoria
        return $destinationPath;
    }
    
    private function saveImagen($imagen)
    {
        $nombre = date('Ymdhis') . rand() . '.' . $imagen->extension();
        $ruta = storage_path() . '/app/public/imagenes/' . $nombre;
        $productImg = 'storage/imagenes/' . $nombre;
    
        // Guardar la imagen original
        $imagen->move(storage_path() . '/app/public/imagenes/', $nombre);
    
        // Comprimir y redimensionar la imagen guardada
        $this->compressAndResizeImage($ruta, $ruta, 80);  // Ajusta el 100 según la calidad deseada
    
        return $productImg;
    }

    private function deleteImagen($imagen)
    {
        $url = str_replace('storage', 'public', $imagen);
        Storage::delete($url);
    }
}
