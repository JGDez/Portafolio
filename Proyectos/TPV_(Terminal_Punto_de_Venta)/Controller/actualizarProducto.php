<?php
try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'tienda.php';
    require_once RUTA_MODELO.'productos.php';
    require_once RUTA_MODELO.'categorias.php';
    require_once RUTA_MODELO.'tipos_iva.php';

    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva(); //Comprobar si se ha accedido con una tienda activa

    //Declaración de variables
    $producto; //Objeto para gestionar los datos del producto
    $categoria; //Objeto para gestionar los datos de la categoría
    $tipo_IVA; //Objeto para gestionar los datos del tipo de IVA
    $imgDefecto = $rutaProds.'img_Defecto.png'; //Imagen por defecto. Eliminar cuando se ponga un aviso en formulario
    $imgProducto; //Guarda el nombre del archivo para la imagen del producto
    $nombreImgProd = "_ImgProducto."; //Nombre que tienen las imágenes de productos 'id_ImgProducto.ext'
    $ext; //Extensión del archivo subido
    $extOrig; //Extensión del archivo cargado anteriormente

    //Comprobar que se ha accedido desde el formulario
    if (isset($_POST['cancelar'])) {
        //Volver a la página de listado de productos
        header("Location: ".RUTA_CONTROLADOR."listaProductos.php");
    } else if (isset($_POST['aceptar'])){
        //Comprobar si se ha subido una imagen del producto
        if($_FILES["Img"]["error"]>0){
            // ToDo: En vez de colocar la imagen por defecto poner aviso y no validar formulario.
            $imgProducto = $_POST['imgOrig'];
        } else {
            /* Por el momento, poner todas las imágenes con el 'id_ImgProducto'. No pongo el código por poder contener caracteres no válidos para nombre de archivo
            //Comprobar si existe el mismo nombre de otro producto y cambiar nombre si es necesario (en desuso)
            $logoTienda = verifArchivo($_FILES["logoTienda"]["name"], $rutaLogo);
            */
            
            //Si se ha cargado imagen: 

            //Recuperar extensión de imagen cargada anteriormente y guardar la imagen en el disco
            $extOrig = pathinfo($_POST['imgOrig'], PATHINFO_EXTENSION);
            $ext = pathinfo($_FILES["Img"]["name"], PATHINFO_EXTENSION);
            $imgProducto = $_POST['id'].$nombreImgProd.$ext;
            move_uploaded_file($_FILES["Img"]["tmp_name"], RUTA_PRODS_ABS.$imgProducto);
        }
        
        //Instanciar objeto del producto editado
        $producto = new Productos($_POST['id'], $_POST['codigo'], $_POST['nombre'], $_POST['descripcion'], $_POST['categoria'], $_POST['precioBruto'], $_POST['iva'], $_POST['precioUlCom'], $imgProducto );
        $producto->actualizar();
        
        //Si la imagen nueva subida tiene diferente extensión, borra la existente con extensión anterior
        if (isset($extOrig) && $extOrig!=$ext) {
            $imgProducto = $_POST['id'].$nombreImgProd.$extOrig;
            if (file_exists(RUTA_PRODS_ABS.$imgProducto)) {
                unlink(RUTA_PRODS_ABS.$imgProducto);
            }
        }
        
        //Volver a la lista de categorías
        header("Location: ".RUTA_CONTROLADOR."listaProductos.php");
    } else if (isset($_POST['eliminar'])){
        //ToDo: Hacer pregunta de confirmación antes de eliminar
        //Instanciar objeto de categoría y eliminarlo de la BD
        $producto = Productos::getProductoById($_POST['id']);
        $producto->eliminar();

        $imgProducto = $_POST['imgOrig'];

        if (file_exists(RUTA_PRODS_ABS.$imgProducto)) {
            unlink(RUTA_PRODS_ABS.$imgProducto);
        }

        //Volver al listado de categorías
        header("Location: ".RUTA_CONTROLADOR."listaProductos.php");
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