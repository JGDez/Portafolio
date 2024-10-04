<?php
/* --- BIBLIOTECA DE FUNCIONES --- */

function rutasTPV () {
    if (!defined('RUTA_RAIZ')) {
        define ('RUTA_RAIZ', $_SERVER['DOCUMENT_ROOT']."/");
        define ('RUTA_MODELO', $_SERVER['DOCUMENT_ROOT'].'/Model/');
        define ('RUTA_CONTROLADOR', '/Controller/');
        define ('URL_CONTROLADOR', 'http://localhost/Controller/');
        define ('RUTA_VISTA', $_SERVER['DOCUMENT_ROOT'].'/View/');
        define ('RUTA_CSS', 'http://localhost/View/css/');
        define ('RUTA_JS', '/View/js/');
        define ('RUTA_IMGS_ABS', $_SERVER['DOCUMENT_ROOT'].'/View/Imagenes/');
        define ('RUTA_LOGOS_ABS', $_SERVER['DOCUMENT_ROOT'].'/View/Imagenes/Logos/');
        define ('RUTA_PRODS_ABS', $_SERVER['DOCUMENT_ROOT'].'/View/Imagenes/Productos/');
    }
}

/**
 * Incia las variables globales del programa
 *
 * @return void
 */
function iniciarGlobalVars () {

    //Declaración de variables Globales
    global $tiendaAct;
    global $rutaImgs; //Ruta donde están localizadas las imágenes.
    global $rutaLogos; //Ruta donde están localizados los logos.
    global $rutaProds; //Ruta donde están localizadas las imágenes de productos.

    //Cargar las rutas
    rutasTPV();

    //Inicializar variables globales. ToDo: Cambiarlas a rutasTPV()
    $rutaImgs = "/View/Imagenes/";
    $rutaLogos = "/View/Imagenes/Logos/";
    $rutaProds = "/View/Imagenes/Productos/";
    
}

/**
 * Comprueba si existe una sesión de tienda activa. Si existe crea la variable global $tiendaAct.
 * Si no existe, redirecciona a la página donde seleccionar o crear una tienda.
 *
 * @return void
 */
function compTiendaActiva(){

    //Comprobar sesión activa
    if (isset($_SESSION['Tienda_Act'])){
        
        //Si hay tienda activa, cargar sesión en variable
        $GLOBALS['tiendaAct'] = unserialize($_SESSION['Tienda_Act']);
    } else {
        //Redireccionar para seleccionar la tienda.
        header("Location:".RUTA_CONTROLADOR."selecTienda.php");
    }
}

/**
 * Comprueba si existe el archivo en el directorio indicado y le cambia el nombre
 *
 * @param string $archivo Nombre del archivo a comprobar
 * @param string $ruta Ruta donde comprobar si existe el archivo
 * @return string Nombre único para el archivo
 */
function verifArchivo ($archivo, $ruta){
    //Declaración de variables
    $subIndice = ""; //Coletilla que se le pone al archivo por si existe otro con el mismo nombre
    
    //Comprobar si existe el mismo nombre de otra tienda y añadir subíndice al final del nombre del archivo
    while (file_exists($archivo.$subIndice)){
        $subIndice++;
    }
    return $archivo.$subIndice;
}