<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    @yield('head')
</head>

<body class="antialiased bg-light bg-opacity-25">
    <div class="container-fluid px-0 bg-light">
        <header class="row">
            <nav class="navbar fixed-top navbar-dark bg-dark">
                <div class="container-fluid">
                    <div class="d-flex flex-row align-center">
                        <span class="navbar-brand material-icons" style="font-size:30px;margin-right: -10px;">spa</span>
                        <a class="navbar-brand nav-link" href="#">Robina</a>
                    </div>

                    <div>
                        <a class="mx-4 text-secondary" id="cart"><i class="fa fa-shopping-cart"></i> Cart <span
                                class="cart-badge badge"></span></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('producto.index') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('producto.create') }}">Subir productos</a>
                            </li>
                            <li>
                                <div class="d-flex justify-content-end">
                                    @if (!Auth()->user())
                                        <button type="button" class="btn btn-link px-3 me-2">
                                            Login
                                        </button>
                                        <button type="button" class="btn btn-primary me-3">
                                            Sign up for free
                                        </button>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>



            @include('layouts.carrousel')
        </header>
        <!--Carrito-->
        <div class="shopping-cart d-none">
            <div class="shopping-cart-header m-3">
                <i class="fa fa-shopping-cart cart-icon"></i><span class="cart-badge badge"></span>
                <div class="shopping-cart-total">
                    <span class="lighter-text">Total:</span>
                    <span class="cart-total main-color-text"></span>
                </div>
            </div>
            <!--end shopping-cart-header -->

            <ul class="shopping-cart-items">

                <!--items carrito -->
            </ul>

            <a href="{{ route('pedido.create') }}" class="button">COMPRAR</a>
        </div>
        <!--Fin Carrito-->
        <div id="content" class='row justify-content-center align-items-center mx-auto my-5 bg-light'>
            @yield('content')
        </div>
        @include('layouts.footer')

    </div>
</body>

</html>
