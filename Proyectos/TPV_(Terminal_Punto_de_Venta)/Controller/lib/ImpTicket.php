<?php
/* -- CLASE PARA CREAR ETIQUETAS -- */
require_once RUTA_MODELO.'/tienda.php';
require_once RUTA_MODELO.'/productos.php';
require_once RUTA_MODELO.'/productos_Join.php';
require_once RUTA_MODELO.'/categorias.php';
require_once RUTA_MODELO.'/tipos_iva.php';
require_once RUTA_MODELO.'/tickets.php';
require_once RUTA_MODELO.'/prod_ticket.php';
require_once RUTA_MODELO.'/modo_pago.php';
require_once RUTA_MODELO.'/tipo_movimiento.php';
require_once 'fpdf/fpdf.php';

class ImpTicket {
    //Declaración de variables de la clase
    private $idTienda; //Objeto que representa  a la tienda del ticket.
    private $idTicket; //Objeto que representa al ticket.
    private $prod_Ticket; //Objeto con los productos pertenecientes al ticket.
    private $producto; //Objeto con el producto para cada línea del ticket
    private $pdf; //Objeto del fpdf para el ticket en PDF a crear.
    
    function __construct($idTienda, $idTicket) {
        $this->idTienda = $idTienda;
        $this->idTicket = $idTicket;
    }

    public function generarTicket() {
        $tienda = Tienda::getTiendaById($this->idTienda);
        $ticket = Tickets::getTicketsById($this->idTicket);
        $productos_Ticket ['Productos_Ticket'] = Prod_Ticket::getProd_TicketByTicket($this->idTicket);
        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetFont('Arial', 'B', 8);
        
        //Colocar el logo
        $pdf->Image(RUTA_LOGOS_ABS.$tienda->getLogoTicket(), 5, null, 70);
        $pdf->Ln(7);
        
        //Información de la tienda
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(70, 5, $tienda->getNombreCom(), 0, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Ln(1);
        $pdf->MultiCell(70, 5, $tienda->getDireccion(), 0, 'C');
        $pdf->Ln(1);
        $pdf->MultiCell(70,3, $tienda->getCp()." ".$tienda->getPoblacion(), 0, 'C');
        $pdf->Ln(1);
        $pdf->MultiCell(70,3,"N.I.F / C.I.F: ".$tienda->getCifNif(), 0, 'C');
        $pdf->Ln(1);
        $pdf->MultiCell(70,3,"Tlf: ".$tienda->getTelef(), 0, 'C');
        
        //Información del ticket
        $pdf->Ln(5);
        $pdf->MultiCell(70,3, "Factura simplificada: ".$ticket->getId(), 0, 'C');
        $pdf->Ln(1);
        $pdf->MultiCell(70,3, "Fecha: ".$ticket->getFecha(), 0, 'C');
        $pdf->Ln(5);
        
        //Información de los productos comprados
        $pdf->Cell(10,3, 'Cant.', 0,0,'L');
        $pdf->Cell(30,3, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 0,0,'L');
        $pdf->Cell(15,3, mb_convert_encoding('Eur./Ud.', 'ISO-8859-1', 'UTF-8'), 0,0,'L');
        $pdf->Cell(15,3, mb_convert_encoding('Eur./Tot.', 'ISO-8859-1', 'UTF-8'), 0,0,'L');
        $pdf->Ln(2);
        $pdf->Cell(70,2, '----------------------------------------------------------------------', 0, 1, 'L');

        //Productos
        $totalTicket = 0;  //Total del ticket
        foreach ($productos_Ticket ['Productos_Ticket'] as $producto_Ticket) {
            $totalProd = $producto_Ticket->getCantidad() * $producto_Ticket->getPrecio();
            $totalTicket += $totalProd;
            
            $pdf->Cell(10, 4, $producto_Ticket->getCantidad(), 0, 0, 'L');
            $yInicio = $pdf->GetY();
            $pdf->MultiCell(30, 4, mb_convert_encoding(Productos::getProductoById($producto_Ticket->getProducto())->getNombre(), 'ISO-8859-1', 'UTF-8'), 0,'L');
            $yFin = $pdf->GetY();
            $pdf->SetXY(45, $yInicio);
            $pdf->Cell(15, 4, number_format($producto_Ticket->getPrecio(),2), 0, 0, 'C');
            $pdf->SetXY(60, $yInicio);
            $pdf->Cell(15, 4, number_format($totalProd, 2), 0, 0, 'C');
            $pdf->SetY($yFin);
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(70,4, "TOTAL: ".number_format($totalTicket, 2)." Euros", 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(70,4, "Entregado: ".number_format($ticket->getEntregado(), 2)." Euros", 0, 0, 'R');
        $pdf->Ln(5);
        $pdf->Cell(70,4, "Cambio: ".number_format($ticket->getEntregado() - $totalTicket, 2)." Euros", 0, 0, 'R');

        //Pie
        $pdf->SetFont('Arial', '', 9);
        $pdf->Ln(10);
        $pdf->Cell(70, 3, "Gracias por su visita", 0, 0, "C");



        //Generar pdf ticket
        $pdf->Output('I', 'Ticket-'.$ticket->getId(), true);
    }
}