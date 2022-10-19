@extends('layouts.master')

@section('head')
    <style>
        body {
            background: #ddd;
            vertical-align: middle;
            display: flex;
            font-family: sans-serif;
            font-size: 0.8rem;
            font-weight: bold
        }

    </style>
@endsection
@section('content')
    <div class="d-flex align-items-center h-100" style="min-height: 600px;">
        <div class="carB mt-3 mx-auto w-100" style="max-width: 1500px;">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Carrito</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted">
                                {{ Cart::content()->groupBy('id')->count() }} items</div>
                        </div>
                    </div>
                    @foreach ($productos as $producto)
                        <div class="row border-top border-bottom">
                            <div class="row main align-items-center">
                                <div class="col-2"><img class="img-fluid img-confirmacion"
                                        src="{{ $producto['imagen'] }}"></div>
                                <div class="col">
                                    <div class="row text-muted">{{ $producto['name'] }}</div>
                                    <div class="row">{{ $producto['name'] }}</div>
                                </div>
                                <div class="col"> <input style="max-width: 5em;" type="number"
                                        id="{{ $producto['id'] }}" class="cantidad-producto form-control"
                                        placeholder="{{ $producto['qty'] }}" value="{{ $producto['qty'] }}" min="1"
                                        max="99"> </div>
                                <div class="col">{{ $producto['price'] }}&euro;</div>
                                <div class="col"><span class="close text-right"><a
                                            href="{{ route('carrito.removeAll', $producto['id']) }}">&#10005;</a></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="back-to-shop"><a href="{{ route('producto.index') }}">&leftarrow;</a><span
                            class="text-muted">Volver a la tienda</span></div>
                </div>
                <div class="col-md-4 summary">
                    <div>
                        <h5><b>Resumen</b></h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p> ITEMS </p>
                        </div>
                        <div class="col text-right">{{ Cart::count() }}</div>
                    </div>
                    <form>
                        <p>CODIGO DESCUENTO</p> <input id="code" placeholder="Codigo descuento">
                    </form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">PRECIO TOTAL</div>
                        <div class="col text-right">&euro; {{ Cart::total() }}</div>
                    </div>
                    <a class="btn btn-primary w-100 pagar" href="{{ route('pedido.store') }}">PAGAR</a>
                </div>
            </div>
        </div>
    </div>
@endsection
