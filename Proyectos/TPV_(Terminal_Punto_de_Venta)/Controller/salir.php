<?php

try {
    //Crear sesiónes
    session_start();

    //Cargar variables globales
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();


    if (isset($_GET['Salir'])){
        // Eliminar todas las variables de sesión
        session_unset();

        // Destrucir la sesión
        session_destroy(); 
        
        //unset($_SESSION['Tienda_Act']);
    }

    header("Location: ".RUTA_CONTROLADOR."index.php");
} catch (PDOException $e) {
	header("Location: View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}