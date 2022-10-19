<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Models\Producto;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    static public function removeAll(Request $request){
        $id=request('id');
        $itemsCesta = Cart::content()->toArray();
        foreach ($itemsCesta as $clave => $valor){
            if($itemsCesta[$clave]['id']==$id){
                Cart::remove($clave);
                if (Auth::check()) {
                    Cart::store(Auth::user()->id);
                }
                else{
                    Cart::store(1);
                }
                return redirect()->route('carrito.show');
            }
        }
        return redirect()->route('carrito.show');
        
    }

    static public function store(Request $request)
    {
        if (Auth::check()) {
            $userId=Auth::user()->id;
        }
        
        
        
        $productoId=request('id');
        $producto=Producto::find($productoId);
        
        //$cantidad=request('cantidad');
        //precio=request('precio');
        

        Cart::add($producto->id, $producto->nombre, 1, $producto->precio_venta)->associate('Producto');
        if (Auth::check()) {
            Cart::store($userId);
        }
        else{
            Cart::store(1);
        }
        $itemsCesta = Cart::content()->toArray();
        foreach ($itemsCesta as $clave => $valor){
            $itemsCesta[$clave]['imagen']=Producto::find($valor['id'])->imagenUrl;
        }
        return $itemsCesta;
    }

    static public function restore()
    {
        if (Auth::check()) {
            Cart::restore(Auth::user()->id);
        }
        else{
            Cart::restore(1);
        }
        $itemsCesta = Cart::content()->toArray();
        foreach ($itemsCesta as $clave => $valor){
            if(Producto::find($valor['id']) != null){
                $itemsCesta[$clave]['imagen']=Producto::find($valor['id'])->imagenes[0]->url;
            }
            else{
                unset($itemsCesta[$clave]);
                Cart::remove($clave);
            }
        }
        return $itemsCesta;
    }


  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $itemsCesta = Cart::content()->toArray();
        foreach ($itemsCesta as $clave => $valor){
            if(Producto::find($valor['id']) != null){
                $itemsCesta[$clave]['imagen']=Producto::find($valor['id'])->imagenes[0]->url;
            }
            else{
                unset($itemsCesta[$clave]);
                Cart::remove($clave);
            }
        }
        return view('carrito.confirmacion', [
            'productos' => $itemsCesta
        ]);
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
        
        $id=request('id');
        $cantidad=request('cantidad');
        $itemsCesta = Cart::content()->toArray();
        //dd($itemsCesta);
        foreach ($itemsCesta as $clave => $valor){
            if($itemsCesta[$clave]['id']==$id){
                Cart::update($clave, $cantidad);
            }
        }
        if (Auth::check()) {
            Cart::store(Auth::user()->id);
        }
        else{
            Cart::store();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    static public function destroy()
    {
        Cart::destroy();
        //dd(Cart::content());
        if (Auth::check()) {
            Cart::store(Auth::user()->id);
        }
        else{
            Cart::store();
        }
    }


    static public function getItems()
    {
        $itemsCesta = Cart::content()->toArray();
        foreach ($itemsCesta as $clave => $valor){
            if(Producto::find($valor['id']) != null){
                $itemsCesta[$clave]['imagen']=Producto::find($valor['id'])->imagenes[0]->url;
            }
            else{
                unset($itemsCesta[$clave]);
                Cart::remove($clave);
            }
        }
        return $itemsCesta;
    }
    
}