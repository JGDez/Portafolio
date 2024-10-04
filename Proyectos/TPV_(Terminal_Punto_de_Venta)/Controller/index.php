<?php

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'tienda.php';
    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva();

    include_once RUTA_VISTA.'index.php';
} catch (PDOException $e) {
	//header("Location: /View/error.html");
	//exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	die ("Error: " . $e -> getMessage());
}