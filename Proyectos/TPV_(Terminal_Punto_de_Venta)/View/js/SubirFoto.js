
let imgDefecto = 'View/Imagenes/img_Defecto.png';

//Mostrar imagen cargada
let imagen = document.getElementById( 'Img' );
let imgVista = document.getElementById( 'vistaImg' );

imagen.addEventListener( 'change', e => {
  if( e.target.files[0] ){
    const reader = new FileReader( );
    reader.onload = function( e ){
      imgVista.src = e.target.result;
    }
    reader.readAsDataURL(e.target.files[0])
  }else{
    imgVista.src = imgDefecto;
  }
} );
