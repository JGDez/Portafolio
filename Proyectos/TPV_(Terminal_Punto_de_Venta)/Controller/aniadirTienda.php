<?php

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables

    //Declaración de variables
    $imgDefecto = $rutaImgs.'img_Defecto.png'; //Imagen por defecto. Eliminar cuando se ponga un aviso en formulario
    $logoTienda; //Guarda el nombre del archivo para el logo de la tienda
    $logoTicket; //Guarda el nombre del archivo para el logo del ticket
    $tienda; //Objeto de la tienda a añadir a la BD
    $ext; //Extensión del archivo subido
    $tiendaAct; //Tienda actualmente en activo

    //Comprobar que se ha accedido desde el formulario
    if (isset($_POST['aceptar'])){
        //Comprobar si se ha subido una imagen del logo de la tienda
        if($_FILES["logoTienda"]["error"]>0){
            // ToDo: En vez de colocar la imagen por defecto poner aviso y no validar formulario.
            $logoTienda = $imgDefecto;
        } else {
            /* Por el momento, poner todas las imágenes con el 'id_logoTienda'
            //Comprobar si existe el mismo nombre de otra tienda y cambiar nombre si es necesario
            $logoTienda = verifArchivo($_FILES["logoTienda"]["name"], $rutaLogo);
            */
            $logoTienda = $_FILES["logoTienda"]["name"];
        }

        //Comprobar si se ha subido una imagen del logo para el ticket
        if($_FILES["logoTicket"]["error"]>0){
            // ToDo: En vez de colocar la imagen por defecto poner aviso y no validar formulario.
            $logoTicket = $imgDefecto;
        } else {
            $logoTicket = $_FILES["logoTienda"]["name"];
        }

        //Crear objeto de nueva tienda y asignar los atributos
        $tienda = new Tienda("", $_POST['cif_nif'], $_POST['nombre_Fis'],$_POST['nombre_Com'],$_POST['direccion'],
            $_POST['poblacion'],$_POST['cp'],$_POST['provincia'], $logoTienda, $logoTicket, $_POST['telef'], 
            $_POST['movil'], $_POST['email']);

        $tienda->insertar();

        //Recuperar el registro de la tienda para obtener el ID y ponérselo al nombre de la imagen
        //$tienda = Tienda::getTiendaByCifNif($_POST['cif_nif']);
        $tienda = Tienda::getTiendaUltima();

        //Obtener la extensión del archivo y guardar los archivos de los logos en el directorio
        $ext = pathinfo($_FILES["logoTienda"]["name"], PATHINFO_EXTENSION);
        $logoTienda = $tienda->getId()."_LogoTienda.".$ext;
        move_uploaded_file($_FILES["logoTienda"]["tmp_name"], RUTA_LOGOS_ABS.$logoTienda);
        $ext = pathinfo($_FILES["logoTicket"]["name"], PATHINFO_EXTENSION);
        $logoTicket = $tienda->getId()."_LogoTicket.".$ext;
        move_uploaded_file($_FILES["logoTicket"]["tmp_name"], RUTA_LOGOS_ABS.$logoTicket);

        //Actualizar nombre de fotos de la tienda en la BD
        $tienda->setLogoTienda($logoTienda);
        $tienda->setLogoTicket($logoTicket);
        $tienda->actualizar();

        //Cargar tienda actual
        if (isset($_SESSION['Tienda_Act'])){
            unset($_SESSION['Tienda_Act']);
        }
        $tiendaAct = Tienda::getTiendaById($tienda->getId());
        $_SESSION['Tienda_Act'] = serialize($tiendaAct);

        //Cargar inicio del TPV
        header("Location: ".RUTA_CONTROLADOR."index.php");
    } else {
        //Si no se ha accedido desde el formulario, devolver a la página de inicio
        header("Location: ".RUTA_CONTROLADOR."index.php");
    }
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}