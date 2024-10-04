<?php

try {
    //Controlador que aplica la tienda seleccionada a la sesión y redirige a la página principal.
    //Iniciar variable de sesión
    session_start();

    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'tienda.php';

    if (isset($_POST['btnSelTienda'])){
        switch ($_POST['selTienda']) {
            case 'nuevaTienda':
                header('location: altaTienda.php');
                break;
            default:
                $_SESSION['Tienda_Act'] = serialize(Tienda::getTiendaById($_POST['selTienda']));
                header("location: ".RUTA_CONTROLADOR."index.php");
                break;
        }
    }
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}