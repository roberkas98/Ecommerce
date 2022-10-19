<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Proveedor;
use App\Models\Marca;
use App\Models\Talla;


class Producto extends Model
{
    use HasFactory;

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }


    public function tallas()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            Talla::class,
            'tallas_productos',
            'producto_id',
            'talla_id'
        );
    }
}
