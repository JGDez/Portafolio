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

    //Declaración de variables
    $producto; //Objeto para gestionar los datos del producto
    $categoria; //Objeto para gestionar los datos de la categoría
    $tipo_IVA; //Objeto para gestionar los datos del tipo de IVA
    $imgDefecto = $rutaImgs.'img_Defecto.png'; //Imagen por defecto. Eliminar cuando se ponga un aviso en formulario
    $imgProducto; //Guarda el nombre del archivo para la imagen del producto
    $ext; //Extensión del archivo subido

    //Comprobar que se ha accedido desde el formulario
    if (isset($_POST['aceptar'])){
        echo "Valor POST".var_dump($_POST);
        
        //Comprobar si se ha subido una imagen del producto
        if($_FILES["Img"]["error"]>0){
            // ToDo: En vez de colocar la imagen por defecto poner aviso y no validar formulario.
            $imgProducto = $imgDefecto;
        } else {
            /* Por el momento, poner todas las imágenes con el 'id_ImgProducto'. No pongo el código por poder contener caracteres no válidos para nombre de archivo
            //Comprobar si existe el mismo nombre de otro producto y cambiar nombre si es necesario (en desuso)
            $logoTienda = verifArchivo($_FILES["logoTienda"]["name"], $rutaLogo);
            */
            $imgProducto = $_FILES["Img"]["name"];
        }

        //Crear objeto de nuevo producto y asignar los atributos
        $producto = new Productos("", $_POST['codigo'], $_POST['nombre'], $_POST['descripcion'], $_POST['categoria'], $_POST['precioBruto'], $_POST['iva'], $_POST['precioUlCom'], $_POST['Img'] );

        $producto->insertar();

        //Recuperar el registro del producto para obtener el ID y ponérselo al nombre de la imagen
        $producto = Productos::getProductoUltimo();
        //Obtener la extensión del archivo y guardar los archivos de los logos en el directorio
        $ext = pathinfo($_FILES["Img"]["name"], PATHINFO_EXTENSION);
        $imgProducto = $producto->getId()."_ImgProducto.".$ext;
        move_uploaded_file($_FILES["Img"]["tmp_name"], RUTA_PRODS_ABS.$imgProducto);
        //Actualizar nombre de la imagen del producto en la BD
        $producto->setImagenProd($imgProducto);
        $producto->actualizar();

        //Volver a la lista de categorías
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