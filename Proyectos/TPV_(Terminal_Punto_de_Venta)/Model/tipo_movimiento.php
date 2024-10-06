<?php
require_once 'tpvBD.php';
class Tipo_Movimiento {
    //Variables de campos de la tabla 'tipo_movimiento'
    private $id;
    private $codigo;
    private $nombre;

    /**
     * Constructor de la tabla tipo_movimiento
     *
     * @param int $id ID del tipo de movimiento.
     * @param string $codigo Código del tipo de movimiento
     * @param string $nombre Nombre del tipo de movimiento
     */
    function __construct($id, $codigo, $nombre){
        $this -> id = $id;
        $this -> codigo = mb_substr($codigo,0,3, "UTF-8");
        $this -> nombre = mb_substr($nombre,0,20, "UTF-8");
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

    /* Funciones DML (Lenguaje de Manipulación de Datos) de la BD */

    /**
     * Obtener tipo de movimiento cuyo 'id' sea el pasado por argumento
     *
     * @param int $id Identificador del tipo de movimiento a consultar
     * @return object Objeto que representa al tipo de movimeinto solicitado
     */
    public static function getModo_PagoById($id) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tipo_movimiento WHERE id = $id";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $tipo_movimiento = self::nuevoObjTipo_Movimiento($registro);
        //Cerrar la conexión
        $conexion = null;
        return $tipo_movimiento;
    }

    /**
     * Obtiene el último tipo de movimiento introducido
     *
     * @return object Objeto que representa al tipo de movimiento solicitado
     */
    public static function getTipo_MovimientoUltimo() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tipo_movimiento ORDER BY id DESC LIMIT 1";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $tipo_movimiento = self::nuevoObjTipo_Movimiento($registro);
        //Cerrar la conexión
        $conexion = null;
        return $tipo_movimiento;
    }

    /**
     * Obtiene el tipo de movimiento de la BD que coincide con el código pasado como parámetro.
     *
     * @param string $codigo Código que corresponde con el tipo de movimiento a recuperar.
     * @return object Objeto que representa al tipo de movimiento solicitado
     */
    public static function getTipo_MovimientoByCodigo($codigo) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tipo_movimiento WHERE codigo = '$codigo'";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $tipo_movimiento = self::nuevoObjTipo_Movimiento($registro);
        //Cerrar la conexión
        $conexion = null;
        return $tipo_movimiento;
    }

    /**
     * Obtener array de tipo de movimiento disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada tipo de movimiento de la base de datos.
     */
    public static function getTipo_Movimiento() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tipo_movimiento ORDER BY codigo ASC";
        $consulta = $conexion->query($seleccion);
        $tipo_movimiento = [];
        while ($registro = $consulta->fetchObject()){
            $tipo_movimiento[] = self::nuevoObjTipo_Movimiento($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $tipo_movimiento;
    }

    /**
     * Obtener array de tipos de movimiento disponibles en la base de datos con límite de registros devueltos
     *
     * @param int $regInicial Número de registro inicial a recuperar (empieza en el 0)
     * @param int $numRegs Número de registros a recuperar
     * @return void Array de objetos que representan a cada tipo de movimiento de la base de datos.
     */
    public static function getTipo_MovimientoLimites($regInicial, $numRegs) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tipo_movimiento ORDER BY codigo ASC LIMIT $regInicial, $numRegs";
        $consulta = $conexion->query($seleccion);
        $tipo_movimiento = [];
        while ($registro = $consulta->fetchObject()){
            $tipo_movimiento[] = self::nuevoObjTipo_Movimiento($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $tipo_movimiento;
    }

    /**
     * Inserta un tipo de movimiento en la base de datos
     *
     * @return void
     */
    public function insertar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $insercion = "INSERT INTO tipo_movimiento (codigo, nombre) 
        VALUES ('$this->codigo', '$this->nombre')";

        //Introducir datos
        $conexion->exec($insercion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Actualiza los datos del tipo de movimiento actual
     *
     * @return void
     */
    public function actualizar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $actualizacion = "UPDATE tipo_movimiento SET 
            codigo = '$this->codigo',
            nombre = '$this->nombre', 
            WHERE id = '$this->id'";
            

        //Introducir datos
        $conexion->exec($actualizacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Elimina el tipo de movimiento actual de la BD.
     *
     * @return void
     */
    public function eliminar (){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $eliminacion = "DELETE FROM tipo_movimiento WHERE id = '$this->id'";
        //Ejecutar la consulta
        $conexion->exec($eliminacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /* -- Otras Funciones -- */

    /**
     * Función privada que genera un nuevo objeto Tipo_Movimiento
     *
     * @param object $registro Objeto de la consulta a la BD con los datos del registro del tipo de movimiento
     * @return object Nuevo objeto Tipo_Movimiento.
     */
    private static function nuevoObjTipo_Movimiento ($registro) {
        return new Tipo_Movimiento ($registro->id, $registro->codigo, $registro->nombre);
    }

}

