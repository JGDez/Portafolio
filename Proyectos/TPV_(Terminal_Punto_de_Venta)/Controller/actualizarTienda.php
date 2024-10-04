<?php
/* --- CONTROLADOR PARA ACTUALIZAR LOS DATOS DE LA TIENDA --- */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva();


    //Declaración de variables
    $logoTienda; //Guarda el nombre del archivo para el logo de la tienda
    $logoTicket; //Guarda el nombre del archivo para el logo del ticket
    $tienda = clone $tiendaAct; //Objeto de la tienda a editar clonando la tienda activa.
    $imgDefecto = $rutaLogos.'img_Defecto.png'; //Imagen por defecto. Eliminar cuando se ponga un aviso en formulario
    $nomLogoTienda = "_LogoTienda."; //Nombre que tienen los logos de las tiendas 'id_LogoTienda.ext'
    $nomLogoTicket = "_LogoTicket."; //Nombre que tienen los logos de las tiendas 'id_LogoTienda.ext'
    $extLogoTienda; //Extensión del logo de la tienda que se ha subido
    $extLogoTicket; //Extensión del logo del ticket que se ha subido
    $extOrigLogoTienda; //Extensión del logo de la tienda anterior
    $extOrigLogoTicket; //Extensión del logo del ticket anterior

    //Comprobar que se ha accedido desde el formulario
    if (isset($_POST["cancelar"])){
        //Volver a la página inicial
        header("Location: ".RUTA_CONTROLADOR."index.php");
    } else if (isset($_POST['aceptar'])){
        //Comprobar si se ha subido el logo para la tienda.
        if($_FILES["logoTienda"]["error"]>0){
            // ToDo: En vez de colocar la imagen por defecto poner aviso y no validar formulario.
            $logoTienda = $imgDefecto;
        } else {
            /* Por el momento, poner todas las imágenes con el 'id_LogoTienda.ext'.
            //Comprobar si existe el mismo nombre de otra tienda y cambiar nombre si es necesario (en desuso)
            $logoTienda = verifArchivo($_FILES["logoTienda"]["name"], $rutaLogo);
            */
            
            //Si se ha cargado imagen: 

            //Recuperar extensión de imagen cargada anteriormente y guardar la imagen en el disco
            $extOrigLogoTienda = pathinfo($tienda->getLogoTienda(), PATHINFO_EXTENSION);
            $extLogoTienda = pathinfo($_FILES["logoTienda"]["name"], PATHINFO_EXTENSION);
            $logoTienda = $tienda->getId().$nomLogoTienda.$extLogoTienda;
            move_uploaded_file($_FILES["logoTienda"]["tmp_name"], RUTA_LOGOS_ABS.$logoTienda);
        }

        //Comprobar si se ha subido el logo para el ticket.
        if($_FILES["logoTicket"]["error"]>0){
            // ToDo: En vez de colocar la imagen por defecto poner aviso y no validar formulario.
            $logoTicket = $imgDefecto;
        } else {
            /* Por el momento, poner todas las imágenes con el 'id_LogoTienda.ext'.
            //Comprobar si existe el mismo nombre de otro logo ticket y cambiar nombre si es necesario (en desuso)
            $logoTienda = verifArchivo($_FILES["logoTienda"]["name"], $rutaLogo);
            */
            
            //Si se ha cargado imagen: 

            //Recuperar extensión de imagen cargada anteriormente y guardar la imagen en el disco
            $extOrigLogoTicket = pathinfo($tienda->getLogoTicket(), PATHINFO_EXTENSION);
            $extLogoTicket = pathinfo($_FILES["logoTicket"]["name"], PATHINFO_EXTENSION);
            $logoTicket = $tienda->getId().$nomLogoTicket.$extLogoTicket;
            move_uploaded_file($_FILES["logoTicket"]["tmp_name"], RUTA_LOGOS_ABS.$logoTicket);
        }

        //Crear objeto de nueva tienda con los datos del formulario y guardar los datos en la BD
        $tienda = new Tienda($tienda->getId(), $_POST['cif_nif'], $_POST['nombre_Fis'],$_POST['nombre_Com'],$_POST['direccion'],
        $_POST['poblacion'],$_POST['cp'],$_POST['provincia'], $logoTienda, $logoTicket, $_POST['telef'],
        $_POST['movil'], $_POST['email']);
        $tienda->actualizar();

        //Si el logo nuevo subido de la tienda tiene diferente extensión, borra el logo existente con extensión anterior
        if (isset($extOrigLogoTienda) && $extOrigLogoTienda!=$extLogoTienda) {
            $logoTienda = $tienda->getId().$nomLogoTienda.$extOrigLogoTienda;
            if (file_exists(RUTA_LOGOS_ABS.$logoTienda)) {
                unlink(RUTA_LOGOS_ABS.$logoTienda);
            }
        }
        
        //Si el logo nuevo subido del ticket tiene diferente extensión, borra el logo existente con extensión anterior
        if (isset($extOrigLogoTicket) && $extOrigLogoTicket!=$extLogoTicket) {
            $logoTicket = $tienda->getId().$nomLogoTicket.$extOrigLogoTicket;
            if (file_exists(RUTA_LOGOS_ABS.$logoTicket)) {
                unlink(RUTA_LOGOS_ABS.$logoTicket);
            }
        }

        //Actualizar la sesión
        $_SESSION['Tienda_Act'] = serialize($tienda);
        $tiendaAct = unserialize($_SESSION['Tienda_Act']);

        header("Location: ".RUTA_CONTROLADOR."index.php");
    } else if (isset($_POST['eliminar'])){
        //ToDo: Hacer pregunta de confirmación antes de eliminar
        $tienda->eliminar();
        //Comprobar si existen las imágenes de los logos y eliminarlas
        $logoTienda = $tienda->getLogoTienda();
        $logoTicket = $tienda->getLogoTicket();

        if (file_exists(RUTA_LOGOS_ABS.$logoTienda)) {
            unlink(RUTA_LOGOS_ABS.$logoTienda);
            echo "Se ha eliminado el logo Tienda";
        } else {
            echo "No se ha encontrado el logo Tienda";
        }
        if (file_exists(RUTA_LOGOS_ABS.$logoTicket)) {
            echo "Se ha eliminado el logo Ticket";
            unlink(RUTA_LOGOS_ABS.$logoTicket);
        } else {
            echo "No se ha encontrado el logo Ticket";
        }
        //Eliminar la sesión actual
        header("Location: ".RUTA_CONTROLADOR."salir.php?Salir=Si");
    }
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}