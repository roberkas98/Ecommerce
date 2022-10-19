import { initializeApp } from "firebase/app";
import { getDownloadURL, getStorage, ref, uploadBytes } from "firebase/storage";

// Set the configuration for your app
// TODO: Replace with your app's config object
const firebaseConfig = {
  apiKey: "AIzaSyD1MoX78yctRNmjrUMjI_bEItpTdUJgyKM",
  authDomain: "ecommerce-71b70.firebaseapp.com",
  projectId: "ecommerce-71b70",
  storageBucket: "ecommerce-71b70.appspot.com",
  messagingSenderId: "603671269431",
  appId: "1:603671269431:web:275b45cbec2c27587e6fb2"
};
const firebaseApp = initializeApp(firebaseConfig);

// Get a reference to the storage service, which is used to create references in your storage bucket
const storage = getStorage(firebaseApp);

//rutas
const publicRef = ref(storage, 'public/')
const imagesRef = ref(storage, 'public/images/');


export async function uploadImage() {
  var imagen = document.querySelector('input[type=file]').files[0];
  const imgRef = ref(storage, 'public/images/' + imagen.name)

  await uploadBytes(imgRef, imagen)

  const imgUrl = await getDownloadURL(ref(storage, 'public/images/' + imagen.name))



  return imgUrl
}

export async function uploadImagenes() {
  var imagenes = document.querySelector('input[type=file]').files;
  var urlImagenes = new Array()
  for (let i = 0; i < imagenes.length; i++) {
    const imgRef = ref(storage, 'public/images/' + imagenes.item(i).name)
    await uploadBytes(imgRef, imagenes.item(i))
    const imgUrl = await getDownloadURL(ref(storage, 'public/images/' + imagenes.item(i).name))
    urlImagenes.push(imgUrl)
  }
  return urlImagenes
}
