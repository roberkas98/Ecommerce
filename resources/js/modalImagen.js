


$('.anadirImagen').on("click",function(){
    //var img=$(event.target).attr("imagen");
    var img=$(this).attr("imagen");
    var alt=$(this).attr("nombre");
    $('#imagenModal').attr('src', img);
    $('#imagenModal').attr('alt', alt);
    $('#modalImagen').modal('toggle');
  }
)