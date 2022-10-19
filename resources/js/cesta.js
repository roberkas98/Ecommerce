recuperarCesta();
$('.aCesta').on('click', anadirACesta);
$('.aCesta').on('click', recuperarCesta);
$("#cart").on("click", toggle);
$('.cantidad-producto').on('focusout', actualizarCantidad);


$(document).on('click',function(){          //parte 1
    $(".shopping-cart").addClass('d-none')
});


function toggle() {
    if ($(".shopping-cart").hasClass('d-none')) {  
        $(".shopping-cart").removeClass('d-none')
                      //parte 2 "return false"
        return false //necesario para actuar junto con la parte 1 para cerra la cesta
    } else {        //al clickar fuera de ella
        $(".shopping-cart").addClass('d-none')
    }

}

function actualizarCantidad() {
    cantidad = $('#' + this.id).val();
    url = "/carrito/update/" + this.id + "?cantidad=" + cantidad;
    $.ajax({
        url: url,
        type: 'GET',
        success: function () {
        },

        error: function (xhr, status, textStatus) {
            alert('Disculpe, existió un problema' + textStatus);
        },
    });
}


function anadirACesta() {
    console.log(this.id)
    url = "/carrito/store/" + this.id;
    $.ajax({
        url: url,
        type: 'GET',
        success: function (json) {
            
            incluirElementosCesta(json);
            $.notify.defaults( {globalPosition: 'bottom right'} )
            $.notify("Producto añadido a la cesta",'success');
        },

        // código a ejecutar si la petición falla;
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error: function () {
            $.notify("'Disculpe, existió un problema'", "error");
        },
    });
}

function recuperarCesta() {
    url = "/carrito/restore";

    $.ajax({
        url: url,
        type: 'GET',
        success: function (json) {
            incluirElementosCesta(json);
        },

        // código a ejecutar si la petición falla;
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error: function (xhr, status) {
            console.log('Disculpe, existió un problema');
        }
    });
}

function incluirElementosCesta(productosJSON) {
    contenedorElementos = $('.shopping-cart-items');
    numElementosCarrito = 0;
    totalCarrito = 0;
    productos = productosJSON;
    html = "";
    for (const [key, producto] of Object.entries(productos)) {
        console.log(producto);
        html += "<li class='clearfix row align-items-center'><div class='col-4'><img class='img-fluid' src='" + producto['imagen'] + "' alt='" + producto['name'] + "' /></div><div class='col-8'><span class='item-name'>" + producto['name'] + "</span><span class='item-price'>" + producto['price'] + "€</span><span class='item-quantity'>Cantidad: " + producto['qty'] + "</span></div></li>";
        numElementosCarrito += producto['qty'];
        totalCarrito += producto['price'] * producto['qty'];
    };
    $('.cart-badge').html(numElementosCarrito);
    $('.cart-total').html(totalCarrito + "&euro;");
    contenedorElementos.html(html);
}