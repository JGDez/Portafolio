<?php
/* -- CONTROLA LA LISTA DE PRODUCTOS */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    require_once RUTA_MODELO.'/productos.php';
    require_once RUTA_MODELO.'/categorias.php';
    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva(); //Comprueba que la tienda está activa

    //Declaración de variables
    $productos; //Array de objetos que contiene los productos de la BD
    $categorias; //Array de objetos que contiene las categorías de la BD
    $filtroCategoria = "%"; //Filtro aplicado a la categoría de los productos a recuperar ('%' para todos)
    $totalesCaja; //Total de lo acumulado en productos en caja.
    $productosCaja; //Array Asociativo que contiene los productos elegidos para la caja
    /** Formato para el array asociativo '$productosCaja':
     * $productosCaja['id'] = ['uds'=>valor, 'producto'=> 'valor', 'descuento'=> valor, 'importe'=> valor]
    **/

    //Recuperar productos, categorías y otras variables de sesión
    $categorias['Categorias'] = Categorias::getCategorias();
    //Recuperar filtro de categoría
    if (isset($_SESSION['filtroCategoria'])){
        $filtroCategoria = $_SESSION['filtroCategoria'];
    } else {
        $_SESSION['filtroCategoria'] = $filtroCategoria;
    }
    //Recuperar productos filtrados por categoría
    if (isset($_SESSION['productos'])){
        $productos = unserialize($_SESSION['productos']);
    } else {
        $productos['Productos'] = Productos::getProductosByCategoria($filtroCategoria);
        $_SESSION['productos'] = serialize($productos);
    }
    //Recuperar productos en caja
    if (isset($_SESSION['productosCaja'])){
        $productosCaja = $_SESSION['productosCaja'];
    } else {
        $productosCaja = array();
    }
    //Recuperar totales de caja
    if (isset($_SESSION['totalesCaja'])){
        $totalesCaja = $_SESSION['totalesCaja'];
    } else {
        $totalesCaja = 0;
    }

    include_once RUTA_VISTA.'tpv.php';
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}