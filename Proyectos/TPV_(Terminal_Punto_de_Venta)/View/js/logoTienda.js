
let imgDefecto = 'View/Imagenes/img_Defecto.png';

//Mostrar foto Logo Tienda
let imagen = document.getElementById( 'logoTienda' );
let imgVistaTienda = document.getElementById( 'vistaLogoTienda' );

imagen.addEventListener( 'change', e => {
  if( e.target.files[0] ){
    const reader = new FileReader( );
    reader.onload = function( e ){
      imgVistaTienda.src = e.target.result;
    }
    reader.readAsDataURL(e.target.files[0])
  }else{
    imgVistaTienda.src = imgDefecto;
  }
} );

//Mostrar foto del ticket

let logoTicket = document.getElementById( 'logoTicket' );
let imgVistaTicket = document.getElementById( 'vistaLogoTicket' );

logoTicket.addEventListener( 'change', e => {
  if( e.target.files[0] ){
    const reader = new FileReader( );
    reader.onload = function( e ){
      imgVistaTicket.src = e.target.result;
    }
    reader.readAsDataURL(e.target.files[0])
  }else{
    imgVistaTicket.src = imgDefecto;
  }
} );