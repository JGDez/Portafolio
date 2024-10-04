<?php
/* -- CONTROLADOR PARA DAR DE EDITAR UNA CATEGORÍA NUEVA -- */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    require_once RUTA_MODELO.'/categorias.php';
    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva();

    //Declaración de variables
    $categoria; //Objeto para gestionar los datos de la categoría

    //Comprobar que se ha accedido desde el formulario
    if (isset($_POST['editar'])){
        
        //Crear objeto de categoría y recuperar los datos del id pasado
        $categoria = Categorias::getCategoriaById($_POST['id']);
        //Cargar formulario de la categoría
        include (RUTA_VISTA.'editarCategoria.php');
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