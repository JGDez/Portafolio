<?php
/* -- CONTROLA LA LISTA DE PRODUCTOS */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    require_once RUTA_MODELO.'/productos_Join.php';
    require_once 'lib/ContadorPags.php';    
    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva();

    //Declaración de variables
    $productos_Join ['Productos_Join'] = Productos_Join::getProductosJoin();
    $pagRegs = 10; //Número de registros a recuperar de cada vez para la paginacíon
    $numRegs; //Número de registros que tiene la tabla
    $contaPagsProductos; //Objeto que controla la paginación de la tabla.

    /* -- Código para el paginador -- */
    //Recuperar número de registros de la BD
    //$consultaBD = $conexionBD -> query("SELECT COUNT(id) AS numRegs FROM actor");
    $numRegs = count($productos_Join['Productos_Join']);
    //Objeto para controlar las páginación de la tabla
    if (isset($_SESSION['contaPagsProductos'])){
        $contaPagsProductos = unserialize($_SESSION['contaPagsProductos']);
        //actualizar el número de registros por si han cambiado
        $contaPagsProductos -> setNumRegs($numRegs);
    } else {
        $contaPagsProductos = new ContadorPags($pagRegs,$numRegs);
        $_SESSION['contaPagsProductos'] = serialize($contaPagsProductos);
    }
    //Controlar si se ha pulsado el botón de siguiente página
    if (isset($_POST["btnSiguiente"])){
        $contaPagsProductos->siguientePag();
    }
    //Controlar si se ha pulsado el botón de anterior página
    if (isset($_POST["btnAnterior"])){
        $contaPagsProductos->anteriorPag();
    }

    //Recuperar los productos con los límites ya marcados.
    $productos_Join ['Productos_Join'] = Productos_Join::getProductosJoinLimites($contaPagsProductos->getIniReg(), $contaPagsProductos->getPagRegs());

    //Serializar el objeto para guardar la información de las variables de sesión
    $_SESSION['contaPagsProductos'] = serialize($contaPagsProductos);
    /* -- Fin del código para el paginador .. */

    include_once RUTA_VISTA.'listaProductos.php';
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}