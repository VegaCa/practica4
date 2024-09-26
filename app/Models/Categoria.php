<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'slug', 
        'estado'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Relación con Plantillas
    public function plantillas()
    {
        return $this->hasMany(Plantilla::class);
    }
}
