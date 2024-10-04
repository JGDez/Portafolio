<?php
/* -- CONTROLADOR PARA DAR DE ALTA UN PRODUCTO NUEVO -- */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'tienda.php';
    require_once RUTA_MODELO.'categorias.php';
    require_once RUTA_MODELO.'tipos_iva.php';
    //Iniciar variable de sesión
    session_start();
    compTiendaActiva();

    //Declaración de variables
    $categorias['Categorias'] = Categorias::getCategorias(); //Array de objetos con las categorías a elegir para el producto
    $tipos_iva['TiposIVA'] = Tipos_IVA::getTiposIVA(); //Array de objetos con los tipos de IVA a elegir para el producto


    //Eliminar variable de sesión
    if (isset($_SESSION['contaPagsCategorias'])){
        unset($_SESSION['contaPagsCategorias']);
    }

    //Cargar formulario de la categoría
    include (RUTA_VISTA.'altaProducto.php');
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}