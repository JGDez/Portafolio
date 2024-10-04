<?php
/* -- CONTROLA LA LISTA DE PRODUCTOS */

try {
    //Cargar variables globales y Comprobar si ya se ha elegido la tienda activa
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/funciones.php';
    iniciarGlobalVars();
    require_once RUTA_MODELO.'/tienda.php';
    require_once RUTA_MODELO.'/productos.php';
    require_once RUTA_MODELO.'/categorias.php';
    require_once RUTA_MODELO.'/tipos_iva.php';
    require_once RUTA_MODELO.'/tickets.php';
    require_once RUTA_MODELO.'/prod_ticket.php';
    require_once RUTA_MODELO.'/modo_pago.php';
    require_once RUTA_MODELO.'/tipo_movimiento.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/lib/ImpTicket.php';
    //Crear sesiones
    session_start(); //Cargar sesión después de haber cargado la clase que utiliza una de sus variables
    compTiendaActiva(); //Comprueba que la tienda está activa

    //Declaración de variables
    $productos; //Array de objetos que contiene los productos de la BD
    $categorias; //Array de objetos que contiene las categorías de la BD
    $filtroCategoria = "%"; //Filtro aplicado a la categoría de los productos a recuperar ('%' para todos)
    $totalesCaja = 0; //Contiene el total de los productos añadidos a caja
    $productosCaja = array(); //Array Asociativo que contiene los productos elegidos para la caja
    /** Formato para el array asociativo '$productosCaja':
     * $productosCaja['id'] = ['uds'=>valor, 'producto'=> 'valor', 'descuento'=> valor, 'importe'=> valor]
    **/
    $codigoMovimiento; //Código de tipo de movimiento en el ticket.
    $codigoPago; //Código de modo de pago en el ticket.

    //Recuperar las variables de sesión de caja
    if (isset($_SESSION['productosCaja'])) $productosCaja = $_SESSION['productosCaja'];
    if (isset($_SESSION['totalesCaja'])) $totalesCaja = $_SESSION['totalesCaja'];

    //Si se elige una categoría, consultar los productos de esa categoría
    if (isset($_POST['selCategoria'])){
        $_SESSION['filtroCategoria'] = $_POST['selCategoria'];
        $productos['Productos'] = Productos::getProductosByCategoria($_POST['selCategoria']);
        $_SESSION['productos'] = serialize($productos);
    }

    //Si se elige un producto añadirlo a la caja y sumar su valor al total
    if (isset($_POST['selProducto'])){
        $producto = Productos::getProductoById($_POST['selProducto']);
        $ivaProd = Tipos_IVA::getTipoIVAById($producto->getIva())->getValor_IVA();
        if (array_key_exists($_POST['selProducto'], $productosCaja)){
            $productosCaja[$_POST['selProducto']]["uds"] += 1;
        } else {
            //Calcular el valor del producto
            $productosCaja[$_POST['selProducto']] = ["uds" => 1, "producto" => $producto->getNombre(), "descuento" => 0, "importe" => $producto->getPrecioBruto() * (1+($ivaProd/100))];
        }

        //Sumar el valor del producto añadido
        $totalesCaja += $productosCaja[$_POST['selProducto']]["importe"];

        //Guardar variables de sesión
        $_SESSION['productosCaja'] = $productosCaja;
        $_SESSION['totalesCaja'] = $totalesCaja;
    }

    if (isset($_POST['eliminarProd'])){
        if (array_key_exists($_POST['eliminarProd'], $productosCaja)){
            //Restar el valor del producto añadido
            $totalesCaja -= $productosCaja[$_POST['eliminarProd']]["importe"] * $productosCaja[$_POST['eliminarProd']]["uds"];
            
            //Eliminar el producto de la lista de caja
            unset($productosCaja[$_POST['eliminarProd']]);
            
            $_SESSION['productosCaja'] = $productosCaja;
            $_SESSION['totalesCaja'] = $totalesCaja;
        }
    }

    if (isset($_POST['entregado'])) {
        if ($_POST['entregado'] >= $totalesCaja) {
            $codigoMovimiento = Tipo_Movimiento::getTipo_MovimientoByCodigo("E"); //Código de tipo de movimiento que representa una entrada.
            $codigoPago = Modo_Pago::getModo_PagoByCodigo("EF"); //Código de modo de pago que representa al pago en efectivo.
            
            //Crear un ticket nuevo
            $ticket = new Tickets("", date("Y-m-d H:m:s"), $tiendaAct->getId(), 'Caja 1', $codigoMovimiento->getId(), $_POST['entregado'], $codigoPago->getId());
            $ticket->insertar();
            //Recuperar el último ticket para tener el ID generado.
            $ticket = $ticket->getTicketUltimo();

            //Crear productos ticket
            foreach ($productosCaja as $productoId => $productoCaja) {
                $prod_Ticket = new Prod_Ticket("", $ticket->getId(), $productoId, $productoCaja['uds'], $productoCaja['descuento'], $productoCaja['descuento'], $productoCaja['importe']);
                $prod_Ticket->insertar();
            }

            //Generar ticket
            $miTicket = new ImpTicket($tiendaAct->getId(), $ticket->getid());
            $miTicket->generarTicket();

            //Reiniciar contendido de productos en caja y total de caja.
            $productosCaja = [];
            $totalesCaja = 0;
            $_SESSION['productosCaja'] = $productosCaja;
            $_SESSION['totalesCaja'] = $totalesCaja;
        }
    }

    //Volver al tpv
    header("Location: ".RUTA_CONTROLADOR."tpv.php");
} catch (PDOException $e) {
	header("Location: /View/error.html");
	exit;
	//echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
	//die ("Error: " . $e -> getMessage());
}