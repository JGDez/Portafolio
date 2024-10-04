<?php
require_once 'tpvBD.php';
class Prod_Ticket {
    //Variables de campos de la tabla 'prod_ticket'
    private $id;
    private $ticket;
    private $producto;
    private $cantidad;
    private $descX100;
    private $descVal;
    private $precio;

    /**
     * Constructor de la tabla prod_ticket
     *
     * @param int $id PK del producto del ticket
     * @param int $ticket FK del ticket relacionado con el producto
     * @param int $producto FK del producto relacionado con el ticket
     * @param double $cantidad Cantidad comprada de este producto
     * @param double $descX100 Porcentaje del descuento aplicado al producto
     * @param double $descVal Valor del descuento aplicado al producto
     * @param double $precio Precio del producto en el momento de la compra
     */
    function __construct($id, $ticket, $producto, $cantidad, $descX100, $descVal, $precio){
        $this -> id = $id;
        $this -> ticket = $ticket;
        $this -> producto = $producto;
        $this -> cantidad = $cantidad;
        $this -> descX100 = $descX100;
        $this -> descVal = $descVal;
        $this -> precio = $precio;
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
     * Get the value of Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Get the value of Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Get the value of Cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getDescX100(){
        return $this->descX100;
    }

    public function getDescVal() {
        return $this->descVal;
    }

    public function getPrecio() {
        return $this->precio;
    }

    /* Funciones DML (Lenguaje de Manipulación de Datos) de la BD */

    /**
     * Obtener prod_ticket cuyo 'id' sea el pasado por argumento
     *
     * @param int $id Identificador del prod_ticket a consultar
     * @return object Objeto que representa al prod_ticket solicitado
     */
    public static function getProd_TicketById($id) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM prod_ticket WHERE id = $id";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $prod_ticket = self::nuevoObjProd_Ticket($registro);
        //Cerrar la conexión
        $conexion = null;
        return $prod_ticket;
    }

    /**
     * Obtiene el último prod_ticket introducido
     *
     * @return object Objeto que representa al prod_ticket solicitado
     */
    public static function getProd_TicketUltimo() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM prod_ticket ORDER BY id DESC LIMIT 1";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $prod_ticket = self::nuevoObjProd_Ticket($registro);
        //Cerrar la conexión
        $conexion = null;
        return $prod_ticket;
    }

    /**
     * Obtener array de prod_ticket disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada prod_ticket de la base de datos.
     */
    public static function getProd_Tickets() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM prod_ticket ORDER BY ticket ASC";
        $consulta = $conexion->query($seleccion);
        $prod_ticket = [];
        while ($registro = $consulta->fetchObject()){
            $prod_ticket[] = self::nuevoObjProd_Ticket($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $prod_ticket;
    }

    /**
     * Obtener array de prod_ticket disponibles en la base de datos para el ticket pasado como parámetro.
     *
     * @param int $idTicket ID del ticket cuyos productos se desea recuperar
     * @return void Array de objetos que representan a cada prod_ticket de la base de datos.
     */
    public static function getProd_TicketByTicket($idTicket) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM prod_ticket WHERE ticket =  $idTicket";
        $consulta = $conexion->query($seleccion);
        $prod_ticket = [];
        while ($registro = $consulta->fetchObject()){
            $prod_ticket[] = self::nuevoObjProd_Ticket($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $prod_ticket;
    }

    /**
     * Inserta un prod_ticket en la base de datos
     *
     * @return void
     */
    public function insertar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $insercion = "INSERT INTO prod_ticket (ticket, producto, cantidad, descX100, descVal, precio) 
        VALUES ('$this->ticket', '$this->producto', '$this->cantidad', '$this->descX100', '$this->descVal', '$this->precio')";

        //Introducir datos
        $conexion->exec($insercion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Actualiza los datos del prod_ticket actual
     *
     * @return void
     */
    public function actualizar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $actualizacion = "UPDATE prod_ticket SET 
            ticket = '$this->ticket', 
            producto = '$this->producto', 
            cantidad = '$this->cantidad',
            descX100 = '$this->descX100',
            descVal = '$this->descVal',
            precio = '$this->precio',
            WHERE id = '$this->id'";
            

        //Introducir datos
        $conexion->exec($actualizacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Elimina el prod_ticket actual de la BD.
     *
     * @return void
     */
    public function eliminar (){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $eliminacion = "DELETE FROM prod_ticket WHERE id = '$this->id'";
        //Ejecutar la consulta
        $conexion->exec($eliminacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /* -- Otras Funciones -- */

    /**
     * Función privada que genera un nuevo objeto Prod_Ticket
     *
     * @param object $registro Objeto de la consulta a la BD con los datos del registro del prod_ticket
     * @return object Nuevo objeto Prod_Ticket.
     */
    private static function nuevoObjProd_Ticket ($registro) {
        return new Prod_Ticket ($registro->id, $registro->ticket, $registro->producto,
        $registro->cantidad, $registro->descX100, $registro->descVal, $registro->precio);
    }

}

