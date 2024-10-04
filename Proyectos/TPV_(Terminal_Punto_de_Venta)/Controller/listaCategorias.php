<?php
/* -- CONTROLA LA LISTA DE PRODUCTOS */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    require_once RUTA_MODELO.'/categorias.php';
    require_once 'lib/ContadorPags.php';

    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva();

    //Declaración de variables
    $categorias ['Categorias'] = Categorias::getCategorias();
    $pagRegs = 10; //Número de registros a recuperar de cada vez para la paginacíon
    $numRegs; //Número de registros que tiene la tabla
    $contaPagsCategorias; //Objeto que controla la paginación de la tabla.

    /* -- Código para el paginador -- */
    //Recuperar número de registros de la BD
    //$consultaBD = $conexionBD -> query("SELECT COUNT(id) AS numRegs FROM actor");
    $numRegs = count($categorias['Categorias']);
    //Objeto para controlar las páginación de la tabla
    if (isset($_SESSION['contaPagsCategorias'])){
        $contaPagsCategorias = unserialize($_SESSION['contaPagsCategorias']);
        //actualizar el número de registros por si han cambiado
        $contaPagsCategorias -> setNumRegs($numRegs);
    } else {
        $contaPagsCategorias = new ContadorPags($pagRegs,$numRegs);
        $_SESSION['contaPagsCategorias'] = serialize($contaPagsCategorias);
    }
    //Controlar si se ha pulsado el botón de siguiente página
    if (isset($_POST["btnSiguiente"])){
        $contaPagsCategorias->siguientePag();
    }
    //Controlar si se ha pulsado el botón de anterior página
    if (isset($_POST["btnAnterior"])){
        $contaPagsCategorias->anteriorPag();
    }

    //Recuperar las categorías con los límites ya marcados.
    $categorias ['Categorias'] = Categorias::getCategoriasLimites($contaPagsCategorias->getIniReg(), $contaPagsCategorias->getPagRegs());

    //Serializar el objeto para guardar la información de las variables de sesión
    $_SESSION['contaPagsCategorias'] = serialize($contaPagsCategorias);
    /* -- Fin del código para el paginador .. */

    include_once RUTA_VISTA.'listaCategorias.php';
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}