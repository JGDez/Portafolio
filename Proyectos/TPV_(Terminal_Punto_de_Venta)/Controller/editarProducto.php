<?php
/* -- CONTROLADOR PARA EDITAR EL PRODUCTO ACTIVO -- */

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
    $categorias; //Objeto para gestionar los datos de la categoría
    $tipos_iva; //Objeto para gestionar los datos del tipo de IVA


    if (isset($_POST['editar'])){
        //Crear objeto de categoría y recuperar los datos del id pasado
        $producto = Productos::getProductoById($_POST['id']);
        $categorias['Categorias'] = Categorias::getCategorias();
        $tipos_iva['TiposIVA'] = Tipos_IVA::getTiposIVA();

        //Cargar formulario de la tienda
        include ('../View/editarProducto.php');
    } else {
        //Si no se ha llegado por el formulario, volver a la página de inicio.
        header("Location: ".RUTA_CONTROLADOR."index.php");
    }
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}