<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Imagen;
use App\Models\Marca;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Talla;
use PhpParser\Node\Stmt\Foreach_;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::all();
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $tallas = Talla::all();
        return view('producto.index', [
            'tallas' => $tallas,
            'marcas' => $marcas,
            'proveedores' => $proveedores,
            'productos' => $productos,
        ] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        $tallas = Talla::all();

        return view('producto.create', [
            'tallas' => $tallas,
            'marcas' => $marcas,
            'proveedores' => $proveedores,
            'categorias' => $categorias,
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            /*
            $validatedData = $request->validate([
                'nombre' => 'required|unique:productos|max:30',
                'precio_venta' => 'required',
                'descripcion' => 'required',
                'imagen' => 'required',
                'color' => 'required'
            ]);
            */
            
    
            $nombreProducto=request('nombre');
            $marcaId=request('marca');
            $color=request('color');
            $proveedorId=request('proveedor');
            $imgUrl=substr(request('img'), 0,80) . urlencode(substr(request('img'), 80,8)) . substr(request('img'), 88);
            $precio_venta=request('precio_venta');
            $precio_proveedor=request('precio_proveedor');
            $descripcion=request('descripcion');
            $categoria=request('categoria');
            $tallas=request('tallas');
    
    
            $producto=new Producto();
            $producto->nombre=$nombreProducto;
            $producto->marca_id=$marcaId;
            $producto->color=$color;
            $producto->categoria_id=$categoria;
            $producto->proveedor_id=$proveedorId;
            $producto->precio_venta=$precio_venta;
            $producto->precio_proveedor=$precio_proveedor;
            $producto->descripcion=$descripcion;
            foreach ($tallas as $talla) {
               $producto->tallas->associate($talla);
            };
            $producto->imagenUrl=$imgUrl;
            $producto->save();

            $imagenes=json_decode(request('imagenes'));
            //return $imagenes;
            foreach ($imagenes as $img) {
                $imagen=new Imagen();
                $imagen->url=$img;
                $imagen->producto_id=$producto->id;
                $imagen->save();
            }

            return 'success';


            //return redirect()->route('producto.index');
        } catch (Exception $e) {
            return  json_encode(
                [
                    'status'=> 'failed',
                    'error'=> $e->intl_get_error_message
                 ]) ;
            //return 'Excepción capturada: ' .  $e->getMessage() ."\n";
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marcas = Marca::all();
        $proveedores = Proveedor::all();
        $producto = Producto::find($id);
        return view('producto.show', [
            'marcas' => $marcas,
            'proveedores' => $proveedores,
            'producto' => $producto,
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
