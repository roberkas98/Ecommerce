<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;


class CategoriaController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|unique:categorias|max:30',
            ]);


            $nombreCategoria = request('nombre');

            $categoria = new Categoria();
            $categoria->nombre = $nombreCategoria;
            $categoria->save();


            return redirect()->route('producto.create');
        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
    }
}
