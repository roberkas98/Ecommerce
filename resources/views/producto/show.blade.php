
@extends('layouts.master')
@section('head')
<script type="text/javascript">
$( document ).ready(function() {
    $('.changeImagen').on('click', function(){
        $('#main-image').attr('src', $(this).attr('src'));
  } )
});

</script>
@endsection

@section('content')
<div id="product-card" class="card m-5 mx-lg-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-2 d-flex flex-column justify-content-center align-items-center h-100">
                            <div class="text-center p-1" style="width: 400px; height:400px;max-height: 400px;"> <img id="main-image" class="img-fluid" src="{{$producto->imagenes[0]->url}}"/> </div>
                            <div class="thumbnail text-center"> 
                                @foreach($producto->imagenes as $imagen)
                                <img class="changeImagen" src="{{$imagen->url}}" width="70">
                                @endforeach
                             </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{route('producto.index')}}"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Volver</span> </a> <a class="aCesta" id="{{$producto->id}}" href="#" ><i class="fa fa-shopping-cart text-muted"></i></a>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">{{$producto->marca->nombre}}</span>
                                <h5 class="text-uppercase">{{$producto->nombre}}</h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price">{{$producto->precio_venta}}€</span>
                                    <!--<div class="ml-2"> <small class="dis-price">{{$producto->precio_venta}}</small> <span>40% OFF</span> </div>-->
                                </div>
                            </div>
                            <p class="about">{{$producto->descripcion}}</p>
                            <div class="sizes mt-5">
                                <h6 class="text-uppercase">Talla</h6> <label class="radio"> <input type="radio" name="size" value="S" checked> <span>S</span> </label> <label class="radio"> <input type="radio" name="size" value="M"> <span>M</span> </label> <label class="radio"> <input type="radio" name="size" value="L"> <span>L</span> </label> <label class="radio"> <input type="radio" name="size" value="XL"> <span>XL</span> </label> <label class="radio"> <input type="radio" name="size" value="XXL"> <span>XXL</span> </label>
                            </div>
                            <div class="cart mt-4 align-items-center"> <button class="btn btn-danger aCesta text-uppercase mr-2 px-4" id="{{$producto->id}}">Añadir al carrito</button> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection