@section('head')
<script type="text/javascript">
function aumentarImagen(){
    const img = this.imagen
	console.log(this)
    console.log(img)
    $('#imagenModal').attr('src', img)
    $('#modalImagen').modal('toggle');
}
</script>
@endsection
@extends('layouts.master')

@section('content')
<div class='titulo-seccion w-25 mt-3'>
	<h3 class='text-center'>Productos</h3>
</div>
<div class='w-100 m-3'></div>
<div id="filterbar" class="justify-content-center">
	<div class="w-100"></div>
	<div class=" box border-bottom">
		<div class="box-label text-uppercase">Marcas <button class="btn ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#inner-box" aria-expanded="false" aria-controls="inner-box" id="out"> <span class="fas fa-plus"></span> </button> </div>
		<div id="inner-box" class="collapse">
			<div class="d-flex flex-row justify-content-center">
				@foreach($marcas as $marca)
				<div class="m-1"> <label class="tick">{{$marca->nombre}} <input type="checkbox" class="categoria"> <span class="check"></span> </label> </div>
				@endforeach
			</div>
		</div>
	</div>
	<div class='w-100'></div>
	<div class="box border-bottom">
		<div class="box-label text-uppercase d-flex align-items-center">Categorias <button class="btn ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#inner-box2" aria-expanded="false" aria-controls="inner-box2"><span class="fas fa-plus"></span></button> </div>
		<div id="inner-box2" class="collapse">
			<div class="d-flex flex-row justify-content-center">
				@foreach($marcas as $marca)
				<div class="m-1"> <label class="tick">{{$marca->nombre}} <input type="checkbox" class="categoria"> <span class="check"></span> </label> </div>
				@endforeach
			</div>
		</div>
	</div>
	<div class='w-100'></div>
	<div class="box border-bottom">
		<div class="box-label text-uppercase d-flex align-items-center">price <button class="btn ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false" aria-controls="price"><span class="fas fa-plus"></span></button> </div>
		<div class="collapse" id="price">
			<form class="multi-range-field my-5 pb-5 w-100">
				<input id="multi" class="multi-range" type="range" />
			</form>
		</div>
	</div>
	<div class='w-100'></div>
	<div class="box border-bottom">
		<div class="box-label text-uppercase d-flex align-items-center">Tallas <button class="btn ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#size" aria-expanded="false" aria-controls="size"><span class="fas fa-plus"></span></button> </div>
		<div id="size" class="collapse">
			<div class="d-flex flex-row justify-content-center">
				@foreach($tallas as $talla)
				<div class="m-1"> <label class="tick">{{$talla->nombre}} <input type="checkbox" value="{{$talla->nombre}}" class="talla"> <span class="check"></span> </label> </div>
				@endforeach
			</div>
		</div>
	</div>
	<div class='w-100'></div>
	<div class="box">
		<div class="form-group text-center justify-content-center">
			<div class="btn-group justify-content-center" data-toggle="buttons"> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="radio"> Reset </label> <label class="btn btn-success form-check-label active"> <input class="form-check-input" type="radio" checked> Apply </label> </div>
		</div>
	</div>
</div>

<div class='col-md-12 col-lg-11'>
	<div class="row section-products  min-vh-90 align-items-center justify-content-center">
		@foreach($productos as $producto)
		<div class="col-sm-6 col-md-4 col-xxl-3">
			<div id="product-1" class="single-product">
				<div class="part-1" style="
						background: url('{{$producto->imagenes[0]->url}}') no-repeat center;
						background-size: cover;">
					<ul>
						<li><a class="aCesta" id="{{$producto->id}}" href="#">
								<fa-icon class="fas fa-shopping-cart"></fa-icon>
							</a></li>
						<li><a href="#">
								<fa-icon class="fas fa-heart"></fa-icon>
							</a></li>
						<li><a href="{{route('producto.show', $producto->id)}}">
								<fa-icon class="fas fa-plus"></fa-icon>
							</a></li>
						<li><a href="#" class="anadirImagen"  imagen="{{$producto->imagenes[0]->url}}" desc="{{$producto->nombre}}">
								<fa-icon class="fas fa-expand"></fa-icon>
							</a></li>
					</ul>
				</div>
				<div class="part-2">
					<h3 class="product-title">{{$producto->nombre}}</h3>
					<h4 class="product-old-price">{{$producto->precio_venta + random_int(2, 20)}}€</h4>
					<h4 class="product-price">{{$producto->precio_venta}}€</h4>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
<div id="modalImagen" class="modal" tabindex="-1">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-body">
		  <img id="imagenModal" class="img-fluid" src="" alt="">
		</div>
	  </div>
	</div>
  </div>
@endsection