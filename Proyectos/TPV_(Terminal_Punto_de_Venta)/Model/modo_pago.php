<?php
require_once 'tpvBD.php';
class Modo_Pago {
    //Variables de campos de la tabla 'modo_pago'
    private $id;
    private $codigo;
    private $nombre;
    private $disponible;

    /**
     * Constructor de la tabla modo_pago
     *
     * @param int $id ID del modo de pago
     * @param string $codigo Código que representa al modo de pago
     * @param string $nombre Nombre del modo de pago
     * @param boolean $disponible Booleano de si está o no disponible este modo de pago
     */
    function __construct($id, $codigo, $nombre, $disponible){
        $this -> id = $id;
        $this -> codigo = $codigo;
        $this -> nombre = $nombre;
        $this -> disponible = $disponible;
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
     * Get the value of codigo
     *
     * @return string
     */
    public function getCodigo(){
        return $this->codigo;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of disponible
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /* Funciones DML (Lenguaje de Manipulación de Datos) de la BD */

    /**
     * Obtener modo_pago cuyo 'id' sea el pasado por argumento
     *
     * @param int $id Identificador del modo_pago a consultar
     * @return object Objeto que representa al modo_pago solicitado
     */
    public static function getModo_PagoById($id) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM modo_pago WHERE id = $id";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $modo_pago = self::nuevoObjModo_Pago($registro);
        //Cerrar la conexión
        $conexion = null;
        return $modo_pago;
    }

    /**
     * Obtiene el último modo_pago introducido
     *
     * @return object Objeto que representa al modo_pago solicitado
     */
    public static function getModo_PagoUltimo() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM modo_pago ORDER BY id DESC LIMIT 1";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $modo_pago = self::nuevoObjModo_Pago($registro);
        //Cerrar la conexión
        $conexion = null;
        return $modo_pago;
    }

    /**
     * Obtiene el modo de pago de la BD que coincide con el código pasado como parámetro.
     *
     * @param string $codigo Código que corresponde con el modo de pago a recuperar.
     * @return object Objeto que representa al modo_pago solicitado
     */
    public static function getModo_PagoByCodigo($codigo) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM modo_pago WHERE codigo = '$codigo'";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $modo_pago = self::nuevoObjModo_Pago($registro);
        //Cerrar la conexión
        $conexion = null;
        return $modo_pago;
    }

    /**
     * Obtener array de modo_pago disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada modo de pago de la base de datos.
     */
    public static function getModo_Pago() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM modo_pago ORDER BY codigo ASC";
        $consulta = $conexion->query($seleccion);
        $modo_pago = [];
        while ($registro = $consulta->fetchObject()){
            $modo_pago[] = self::nuevoObjModo_Pago($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $modo_pago;
    }

    /**
     * Obtener array de modos de pago disponibles en la base de datos con límite de registros devueltos
     *
     * @param int $regInicial Número de registro inicial a recuperar (empieza en el 0)
     * @param int $numRegs Número de registros a recuperar
     * @return void Array de objetos que representan a cada modo de pago de la base de datos.
     */
    public static function getModo_PagoLimites($regInicial, $numRegs) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM modo_pago ORDER BY codigo ASC LIMIT $regInicial, $numRegs";
        $consulta = $conexion->query($seleccion);
        $modo_pago = [];
        while ($registro = $consulta->fetchObject()){
            $modo_pago[] = self::nuevoObjModo_Pago($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $modo_pago;
    }

    /**
     * Inserta un modo de pago en la base de datos
     *
     * @return void
     */
    public function insertar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $insercion = "INSERT INTO modo_pago (codigo, nombre, disponible) 
        VALUES ('$this->codigo', '$this->nombre', '$this->disponible')";

        //Introducir datos
        $conexion->exec($insercion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Actualiza los datos del modo de pago actual
     *
     * @return void
     */
    public function actualizar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $actualizacion = "UPDATE modo_pago SET 
            codigo = '$this->codigo',
            nombre = '$this->nombre', 
            disponible = '$this->disponible' 
            WHERE id = '$this->id'";
            

        //Introducir datos
        $conexion->exec($actualizacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Elimina el modo de pago actual de la BD.
     *
     * @return void
     */
    public function eliminar (){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $eliminacion = "DELETE FROM modo_pago WHERE id = '$this->id'";
        //Ejecutar la consulta
        $conexion->exec($eliminacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /* -- Otras Funciones -- */

    /**
     * Función privada que genera un nuevo objeto Modo_Pago
     *
     * @param object $registro Objeto de la consulta a la BD con los datos del registro del modo de pago
     * @return object Nuevo objeto Modo_Pago.
     */
    private static function nuevoObjModo_Pago ($registro) {
        return new Modo_Pago ($registro->id, $registro->codigo, $registro->nombre, $registro->disponible);
    }

}

