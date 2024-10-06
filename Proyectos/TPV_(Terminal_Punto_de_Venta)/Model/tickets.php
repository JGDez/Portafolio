<?php
require_once 'tpvBD.php';
class Tickets {
    //Variables de campos de la tabla 'tickets'
    private $id;
    private $fecha;
    private $tienda;
    private $vendedor;
    private $tipo;
    private $entregado;
    private $modoPago;

    /**
     * Constructor de la tabla tickets
     *
     * @param int $id
     * @param [type] $fecha Fecha de emisión del ticket
     * @param int $tienda FK del ID de la tienda
     * @param string $vendedor Identificador de la persona que realiza la venta
     * @param int $tipo FK del Tipo de movimiento
     * @param double $entregado Importe entregado por el cliente
     * @param int $modoPago FK de la forma en que se realizado el pago (efectivo, tarjeta, etc)
     */
    function __construct($id, $fecha, $tienda, $vendedor, $tipo, $entregado, $modoPago){
        $this -> id = $id;
        $this -> fecha = $fecha;
        $this -> tienda = $tienda;
        $this -> vendedor = mb_substr($vendedor,0,20, "UTF-8");
        $this -> tipo = $tipo;
        $this -> entregado = $entregado;
        $this -> modoPago = $modoPago;
    }

    /* Lista de getters */

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Get the value of Tienda
     */
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * Get the value of Vendedor
     */
    public function getVendedor()
    {
        return $this->vendedor;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getEntregado() {
        return $this->entregado;
    }

    public function getModoPago() {
        return $this->modoPago;
    }   

    /* Funciones DML (Lenguaje de Manipulación de Datos) de la BD */

    /**
     * Obtener ticket cuyo 'id' sea el pasado por argumento
     *
     * @param int $id Identificador del ticket a consultar
     * @return object Objeto que representa al ticket solicitado
     */
    public static function getTicketsById($id) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tickets WHERE id = $id";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $ticket = self::nuevoObjTicket($registro);
        //Cerrar la conexión
        $conexion = null;
        return $ticket;
    }

    /**
     * Obtiene el último ticket introducido
     *
     * @return object Objeto que representa al ticket solicitado
     */
    public static function getTicketUltimo() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tickets ORDER BY id DESC LIMIT 1";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $ticket = self::nuevoObjTicket($registro);
        //Cerrar la conexión
        $conexion = null;
        return $ticket;
    }

    /**
     * Obtener array de tickets disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada ticket de la base de datos.
     */
    public static function getTickets() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tickets ORDER BY tienda ASC";
        $consulta = $conexion->query($seleccion);
        $tickets = [];
        while ($registro = $consulta->fetchObject()){
            $tickets[] = self::nuevoObjTicket($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $tickets;
    }

    /**
     * Obtener array de tickets disponibles en la base de datos con límite de registros devueltos
     *
     * @param int $regInicial Número de registro inicial a recuperar (empieza en el 0)
     * @param int $numRegs Número de registros a recuperar
     * @return void Array de objetos que representan a cada ticket de la base de datos.
     */
    public static function getTicketsLimites($regInicial, $numRegs) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tickets ORDER BY tienda ASC LIMIT $regInicial, $numRegs";
        $consulta = $conexion->query($seleccion);
        $tickets = [];
        while ($registro = $consulta->fetchObject()){
            $tickets[] = self::nuevoObjTicket($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $tickets;
    }

    /**
     * Inserta un ticket en la base de datos
     *
     * @return void
     */
    public function insertar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $insercion = "INSERT INTO tickets (fecha, tienda, vendedor, tipo, entregado, modoPago) 
        VALUES ('$this->fecha', '$this->tienda', '$this->vendedor', '$this->tipo', '$this->entregado', '$this->modoPago')";
        //Introducir datos
        $conexion->exec($insercion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Actualiza los datos del ticket actual
     *
     * @return void
     */
    public function actualizar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $actualizacion = "UPDATE tickets SET 
            fecha = '$this->fecha', 
            tienda = '$this->tienda', 
            vendedor = '$this->vendedor',
            tipo = '$this->tipo',
            entregado = '$this->entregado',
            modoPago = '$this->modoPago'
            WHERE id = '$this->id'";
            

        //Introducir datos
        $conexion->exec($actualizacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Elimina el ticket actual de la BD.
     *
     * @return void
     */
    public function eliminar (){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $eliminacion = "DELETE FROM tickets WHERE id = '$this->id'";
        //Ejecutar la consulta
        $conexion->exec($eliminacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /* -- Otras Funciones -- */

    /**
     * Función privada que genera un nuevo objeto Ticket
     *
     * @param object $registro Objeto de la consulta a la BD con los datos del registro del ticket
     * @return object Nuevo objeto Ticket.
     */
    private static function nuevoObjTicket ($registro) {
        return new Tickets ($registro->id, $registro->fecha, $registro->tienda,
        $registro->vendedor, $registro->tipo, $registro->entregado, $registro->modoPago);
    }

    public function __toString() {
        return "$this->id, $this->fecha, $this->tienda,
        $this->vendedor, $this->tipo, $this->entregado, $this->modoPago";
    }

}

