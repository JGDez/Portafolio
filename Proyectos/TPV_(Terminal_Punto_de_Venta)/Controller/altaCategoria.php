<?php
/* -- CONTROLADOR PARA DAR DE ALTA UNA CATEGORÍA NUEVA -- */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'tienda.php';
    //Iniciar variable de sesión
    session_start();
    compTiendaActiva();


    //Cargar formulario de la categoría
    include (RUTA_VISTA.'altaCategoria.php');
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}