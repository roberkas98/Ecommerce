<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            $validatedData = $request->validate([
                'nombre_proveedor' => 'required|max:30',
                'email' => 'required',
                'telefono' => 'required',
                'cuenta_proveedor' => 'required',
            ]);
    
    
            $nombre=request('nombre_proveedor');
            $email=request('email');
            $telefono=request('telefono');
            $cuenta=request('cuenta_proveedor');
            
    
    
            $proveedor=new Proveedor();
            $proveedor->nombre=$nombre;
            $proveedor->email=$email;
            $proveedor->telefono=$telefono;
            $proveedor->cuenta=$cuenta;
           
            $proveedor->save();
    
            return redirect()->route('producto.create');
        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() ."\n";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
