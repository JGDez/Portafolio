<?php
/* -- CONTROLADOR PARA EDITAR LA TIENDA ACTIVA -- */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva();


    //Declaración de variables
    $tienda = clone $tiendaAct; //Objeto de la tienda a editar clonando la tienda activa.

    //Cargar formulario de la tienda
    include ('../View/editarTienda.php');
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}