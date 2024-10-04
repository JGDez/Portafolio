<?php

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'tienda.php';
    //Iniciar variable de sesión
    session_start();

    //Comprobar si existe una sesión activa y entonces redireccionar al inicio
    if (isset($_SESSION['Tienda_Act'])){
        header("Location: index.php");
    }

    //Cargar variables globales
    iniciarGlobalVars();

    //Declaración de variables
    $tiendas; //Array de objetos de tiendas disponibles en la BD

    //Obtener las tiendas de la BD
    $tiendas['tiendas'] = Tienda::getTiendas();

    include_once RUTA_VISTA."selecTienda.php";
    //include_once "../View/selecTienda.php";
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}
