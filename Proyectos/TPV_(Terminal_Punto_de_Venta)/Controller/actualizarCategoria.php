<?php
/* --- CONTROLADOR PARA ACTUALIZAR LOS DATOS DE LA TIENDA --- */

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
    $categoria; //Objeto de la categoría a editar.

    //Comprobar que se ha accedido desde el formulario
    if (isset($_POST["cancelar"])){
        //Volver a la página de listado de categorías
        header("Location: ".RUTA_CONTROLADOR."listaCategorias.php");
    } else if (isset($_POST['aceptar'])){
        //Instanciar objeto de la categoría a editar
        $categoria = new Categorias($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['color']);

        //Actualizar categoría en la BD
        $categoria->actualizar();

        //Volver a la lista de categorías
        header("Location: ".RUTA_CONTROLADOR."listaCategorias.php");
    } else if (isset($_POST['eliminar'])){
        //ToDo: Hacer pregunta de confirmación antes de eliminar
        //Instanciar objeto de categoría y eliminarlo de la BD
        $categoria = Categorias::getCategoriaById($_POST['id']);
        $categoria->eliminar();

        //Volver al listado de categorías
        header("Location: ".RUTA_CONTROLADOR."listaCategorias.php");
    } else {
        //Si no se ha llegado por el formulario, voler a la página de inicio
        header("Location: ".RUTA_CONTROLADOR."index.php");
    }
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}