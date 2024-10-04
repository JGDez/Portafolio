<?php

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    require_once RUTA_MODELO.'/categorias.php';

    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables

    //Declaración de variables
    $categoria; //Objeto para gestionar los datos de la categoría

    //Comprobar que se ha accedido desde el formulario
    if (isset($_POST['aceptar'])){
        
        //Crear objeto de nueva categoría y asignar los atributos
        $categoria = new Categorias("", $_POST['nombre'], $_POST['descripcion'], $_POST['color']);

        $categoria->insertar();

        //Eliminar variable de sesión
        if (isset($_SESSION['contaPagsCategorias'])){
            unset($_SESSION['contaPagsCategorias']);
        }

        //Volver a la lista de categorías
        header("Location: ".RUTA_CONTROLADOR."listaCategorias.php");
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