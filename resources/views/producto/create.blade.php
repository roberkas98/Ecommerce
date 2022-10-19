@extends('layouts.master') 
@section('head')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.modal-btn-proveedor').on('click', function() {
                $('#modal-proveedor').modal('show');
            }); $('.close').on('click', function() {
                $('.modal').modal('hide');
            }); $('.modal-btn-marca').on('click', function() {
                $('#modal-marca').modal('show');
            }); $('.modal-btn-categoria').on('click', function() {
                $('#modal-categoria').modal('show');
            });
        });
    </script>
    @endsection 
    @section('content') @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif <form class="row justify-content-center m-3" id="productoForm" action="{{ route('producto.store') }}"
            method="post" accept-charset="UTF-8" enctype="multipart/form-data"> @csrf <h2
                class="border-bottom border-secondary text-center col-md-5 col-xl-3 mb-3">Subir nuevo producto</h2>
            <div class="w-100"></div>
            <div class="form-floating col-md-10 col-xl-8 mb-2"> <input type="text" class="form-control" id="nombre"
                    name="nombre" placeholder=" "> <label for="nombre form-label">Nombre producto</label> </div>
            <div class="w-100"></div>
            <div class="form-floating col-md-4 col-xl-3 mb-2"> <select class="form-select" name='categoria'
                id="floatingSelect" aria-label="Floating label select example">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
            </select> <label for="floatingSelect">Categoria</label> </div>
             <button type="button"
            class="modal-btn-categoria btn btn-primary btn-sm col-md-1 col-xl-1 mb-2" data-toggle="modal"
            data-target="#exampleModalCenter"> + </button>
            <div class="form-floating col-md-4 col-xl-3 mb-2"> <select class="form-select" name='marca' id="floatingSelect"
                    aria-label="Floating label select example">
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                </select> <label for="floatingSelect">Marca</label> </div> <button type="button"
                class="modal-btn-marca btn btn-primary btn-sm col-md-1 col-xl-1 mb-2" data-toggle="modal"
                data-target="#exampleModalCenter"> + </button>
                <div class="w-100"></div>

            <div class="form-floating col-md-5 col-xl-4 mb-2"> <select class="form-select" id="floatingSelect"
                    name='color' aria-label="Floating label select example">
                    <option value="negro" data-color="#000000">Negro</option>
                    <option value="verde" data-color="#008000">Verde</option>
                    <option value="amarillo" data-color="#FFFF00">Amarillo</option>
                    <option value="azul" data-color="#0000FF">Azul</option>
                    <option value="rojo" data-color="#FF0000">Rojo</option>
                    <option value="blanco" data-color="#FFFFFF">Blanco</option>
                    <option value="morado" data-color="#800080">Morado</option>
                </select> <label for="floatingSelect">Color</label> </div>
                <fieldset class="col-6 col-md-4 mb-2 d-flex flex-row justify-content-center flex-wrap border rounded p-4 ">
                    <h4 class="w-100 text-center mb-3">Tallas</h4>

                    @foreach($tallas as $talla)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" class="talla" type="checkbox" id="inlineCheckbox1" name="tallas[]" value="{{$talla->id}}">
                    <label class="form-check-label" for="inlineCheckbox1">{{$talla->nombre}}</label>
                  </div>
                  @endforeach
                </fieldset>
            <div class="w-100"></div>
            <div class="form-floating col-md-5 col-xl-4 mb-2"> <input type="number" class="form-control"
                    id="precio_proveedor" name="precio_proveedor" value="35" min="0"> <label for="precio_proveedor">Precio
                    proveedor</label> </div>
            <div class="form-floating col-md-5 col-xl-4 mb-2"> <input type="number" class="form-control" id="precio_venta"
                    name="precio_venta" value="55" min="0"> <label for="precio_venta">Precio venta publico</label> </div>
            <div class="w-100"></div>
            <div class="form-floating col-md-7 col-xl-6 mb-2"> <select class="form-control" name="proveedor"
                    id="exampleFormControlSelect1">
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                </select> <label for="exampleFormControlSelect1">Proveedor</label> </div> <button type="button"
                class="modal-btn-proveedor btn btn-primary col-md-3 col-xl-2 mb-2" data-toggle="modal"
                data-target="#exampleModalCenter"> Añadir proveedor </button>
            <div class="w-100"></div>
            <div class="form-floating col-md-10 col-xl-8 m-2" style="height: 100px;"> <textarea class="form-control h-100" placeholder="Descripción del plato" id="descripcion" name="descripcion"></textarea> <label for="descripcion">Descripci&oacute;n</label> </div>
        </form>
        <div class="w-100"></div>
        <div class="col-sm-2"> <img id='imgPreview' class='img-fluid'
                src="{{ asset('images/default-placeholder.png') }}" alt="Image preview..."> </div>
        <div class="col-sm-10 col-md-8 col-xl-6 mb-3 "> <label for="inputimg" class="form-label">Foto del
                producto</label> <input class="form-control" onchange="previewFile()" multiple type="file" id="inputimg"
                name="imagen"> </div>
        <div class="w-100"></div> <button type="button" id='productSubmit'
            class="btn btn-primary col-4 col-xl-3">Añadir</button> 
            
            <!-- Modal categoria-->
        <div class="modal fade" id="modal-categoria" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id='categoriaForm' method='POST' action='{{ route('categoria.store') }}'> @csrf <div
                            class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Añadir categoria</h5> <button
                                type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                    aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating mb-2"> <input type="text" class="form-control" id="nombre_categoria"
                                    name="nombre" placeholder=" "> <label for="nombre_categoria form-label">Nombre
                                    categoria</label> </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center"> <button type="button"
                                class="btn close btn-secondary" data-dismiss="modal">Volver</button> <button type="submit"
                                id="btn-marca" class="btn btn-primary">Guardar</button> </div>
                    </form>
                </div>
            </div>
        </div> <!-- Modal marca-->
        <div class="modal fade" id="modal-marca" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id='marcaForm' method='POST' action='{{ route('marca.store') }}'> @csrf <div
                            class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Añadir marca</h5> <button type="button"
                                class="close" data-dismiss="modal" aria-label="Close"> <span
                                    aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating mb-2"> <input type="text" class="form-control" id="nombre_marca"
                                    name="nombre" placeholder=" "> <label for="nombre_marcas form-label">Nombre
                                    marca</label> </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center"> <button type="button"
                                class="btn close btn-secondary" data-dismiss="modal">Volver</button> <button type="submit"
                                id="btn-marca" class="btn btn-primary">Guardar</button> </div>
                    </form>
                </div>
            </div>
        </div> <!-- Modal Proveedor-->
        <div class="modal fade" id="modal-proveedor" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Añadir proveedor</h5> <button type="button"
                            class="close" data-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">&times;</span> </button>
                    </div>
                    <form id='proveedorForm' method='POST' action='{{ route('proveedor.store') }}'> @csrf <div
                            class="modal-body">
                            <div class="form-floating mb-2"> <input type="text" class="form-control" id="nombre_proveedor"
                                    name="nombre_proveedor" placeholder=" "> <label for="nombre_proveedor form-label">Nombre
                                    proveedor</label> </div>
                            <div class="form-floating mb-2"> <input type="email" class="form-control" id="email"
                                    name="email" placeholder="Email "> <label for="email form-label">Email</label> </div>
                            <div class="form-floating mb-2"> <input type="tel" class="form-control" id="telefono"
                                    name="telefono" placeholder=" "> <label for="telefono form-label">Telefono</label>
                            </div>
                            <div class="form-floating mb-2"> <input type="text" class="form-control" id="cuenta_proveedor"
                                    name="cuenta_proveedor" placeholder=" "> <label for="cuenta_proveedor form-label">Cuenta
                                    proveedor</label> </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center"> <button type="button"
                                class="btn close btn-secondary" data-dismiss="modal">Volver</button> <button type="submit"
                                id='btn-proveedor' class="btn btn-primary">Guardar</button> </div>
                    </form>
                </div>
            </div>
    </div> @endsection
