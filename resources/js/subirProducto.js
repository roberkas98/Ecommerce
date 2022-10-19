import { forEach } from 'lodash'
import { uploadImagenes } from './cloudStorage'







async function subirProducto() {
  const urlImagenesConMierda = await uploadImagenes()
  let urlImagenes = new Array();
  urlImagenesConMierda.forEach(urlImagen => {
    console.log(urlImagen)
    urlImagenes.push(urlImagen.slice(0, urlImagen.indexOf('&')))
  });
  //let form = $('#productoForm')
  //let formData =  form.serialize()
  let form = document.querySelector('#productoForm')
  let formData = new FormData(form)
  //formData.append('form', form.serialize())
  formData.append('imagenes', JSON.stringify(urlImagenes))
  $.ajax({
    method: 'post',
    enctype: 'multipart/form-data',
    processData: false,
    contentType: false,
    cache: false,
    url: '/producto/store',
    data: formData,
    success: function (data) {
      if (data == 'success') {
        $.notify("Producto guardado correctamente", 'success');

      } else {
        $.notify("'Disculpe, existió un problema'", "error");
      }
      form.reset()
      console.log(data)
    },
    error: function (data) {
      $.notify("'Disculpe, existió un problema'", "error");
      console.log(data)
    }
  });
}


function previewFile() {
  //    var file  = document.querySelector('input[type=file]').files[document.querySelector('input[type=file]').files.length];
  var file = document.querySelector('input[type=file]').files[0];
  var preview = document.querySelector('#imgPreview');

  var reader = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "/images/default-placeholder.png";
  }
}


$("#productSubmit").on('click', subirProducto)
$("#inputimg").on('change', previewFile)