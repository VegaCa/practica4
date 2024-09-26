<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;

    protected $table = 'plantillas'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    protected $fillable = [
        'categoria_id', 
        'tipo_catalogo', 
        'imagen_1', 
        'imagen_2', 
        'imagen_3', 
        'imagen_4', 
        'imagen_5', 
        'titulo', 
        'descripcion', 
        'enlace', 
        'slug',
        'precio', 
        'numero_vistas', 
        'estado'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
