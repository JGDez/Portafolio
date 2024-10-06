<?php
require_once 'tpvBD.php';
class Tipos_IVA {
    //Variables de campos de la tabla 'tipos_iva'
    private $id;
    private $tipo;
    private $valor_IVA;

    /**
     * Constructor de la tabla productos
     *
     * @param int $id ID del IVA.
     * @param string $tipo Nombre del tipo de IVa
     * @param string $valor_IVA Valor para el tipo de IVA
     */
    function __construct($id, $tipo, $valor_IVA){
        $this -> id = $id;
        $this -> tipo = mb_substr($tipo,0,20, "UTF-8");
        $this -> valor_IVA = $valor_IVA;
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
     * Get the value of nombre
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Get the value of descripcion
     */
    public function getValor_IVA()
    {
        return $this->valor_IVA;
    }

    /* Funciones DML (Lenguaje de Manipulación de Datos) de la BD */

    /**
     * Obtener IVA cuyo 'id' sea el pasado por argumento
     *
     * @param int $id Identificador del tipo de IVA a consultar
     * @return object Objeto que representa al IVA solicitado
     */
    public static function getTipoIVAById($id) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tipos_iva WHERE id = $id";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $tipo_iva = self::nuevoObjTipoIVA($registro);
        //Cerrar la conexión
        $conexion = null;
        return $tipo_iva;
    }

    /**
     * Obtiene el último tipo de IVA introducido
     *
     * @return object Objeto que representa al tipo de IVA solicitado
     */
    public static function getTipoIVAUltimo() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tipos_iva ORDER BY id DESC LIMIT 1";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $tipo_iva = self::nuevoObjTipoIVA($registro);
        //Cerrar la conexión
        $conexion = null;
        return $tipo_iva;
    }

    /**
     * Obtener array de tipos de IVA disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada tipo de IVA de la base de datos.
     */
    public static function getTiposIVA() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tipos_iva";
        $consulta = $conexion->query($seleccion);
        $tipos_iva = [];
        while ($registro = $consulta->fetchObject()){
            $tipos_iva[] = self::nuevoObjTipoIVA($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $tipos_iva;
    }

    /**
     * Inserta un tipo de IVA en la base de datos
     *
     * @return void
     */
    public function insertar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $insercion = "INSERT INTO tipos_iva (tipo, valor_IVA) 
        VALUES ('$this->tipo', '$this->valor_IVA')";

        //Introducir datos
        $conexion->exec($insercion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Actualiza los datos del tipo de IVA actual
     *
     * @return void
     */
    public function actualizar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $actualizacion = "UPDATE tipos_iva SET 
            tipo = '$this->tipo', 
            valor_IVA = '$this->valor_IVA', 
            WHERE id = '$this->id'";
            

        //Introducir datos
        $conexion->exec($actualizacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Elimina el tipo de IVA actual de la BD.
     *
     * @return void
     */
    public function eliminar (){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $eliminacion = "DELETE FROM tipos_iva WHERE id = '$this->id'";
        //Ejecutar la consulta
        $conexion->exec($eliminacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /* -- Otras Funciones -- */

    /**
     * Función privada que genera un nuevo objeto Tipos_IVA
     *
     * @param object $registro Objeto de la consulta a la BD con los datos del registro del tipo de IVA
     * @return object Nuevo objeto Producto.
     */
    private static function nuevoObjTipoIVA ($registro) {
        //nombre, descripcion, color
        return new Tipos_IVA ($registro->id, $registro->tipo, $registro->valor_IVA);
    }

}

