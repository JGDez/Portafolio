<?php
require_once 'tpvBD.php';
class Categorias {
    //Variables de campos de la tabla 'productos'
    private $id;
    private $nombre;
    private $descripcion;
    private $color;

    /**
     * Constructor de la tabla productos
     *
     * @param int $id ID de la categoría.
     * @param string $nombre Nombre de la categoría
     * @param string $descripcion Descripción de la categoría
     * @param string $color que identifica a la categoría
     */
    function __construct($id, $nombre, $descripcion, $color){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> color = $color;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /* Funciones DML (Lenguaje de Manipulación de Datos) de la BD */

    /**
     * Obtener categoría cuyo 'id' sea el pasado por argumento
     *
     * @param int $id Identificador del producto a consultar
     * @return object Objeto que representa a la categoría solicitada
     */
    public static function getCategoriaById($id) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM categorias WHERE id = $id";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $categoria = self::nuevoObjCategoria($registro);
        //Cerrar la conexión
        $conexion = null;
        return $categoria;
    }

    /**
     * Obtiene el última categoría introducida
     *
     * @return object Objeto que representa a la categoría solicitada
     */
    public static function getCategoriaUltima() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM categorias ORDER BY id DESC LIMIT 1";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $categoria = self::nuevoObjCategoria($registro);
        //Cerrar la conexión
        $conexion = null;
        return $categoria;
    }

    /**
     * Obtener array de categorías disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada categoría de la base de datos.
     */
    public static function getCategorias() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM categorias ORDER BY nombre ASC";
        $consulta = $conexion->query($seleccion);
        $categorias = [];
        while ($registro = $consulta->fetchObject()){
            $categorias[] = self::nuevoObjCategoria($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $categorias;
    }

    /**
     * Obtener array de categorías disponibles en la base de datos con límite de registros devueltos
     *
     * @param int $regInicial Número de registro inicial a recuperar (empieza en el 0)
     * @param int $numRegs Número de registros a recuperar
     * @return void Array de objetos que representan a cada categoría de la base de datos.
     */
    public static function getCategoriasLimites($regInicial, $numRegs) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM categorias ORDER BY nombre ASC LIMIT $regInicial, $numRegs";
        $consulta = $conexion->query($seleccion);
        $categorias = [];
        while ($registro = $consulta->fetchObject()){
            $categorias[] = self::nuevoObjCategoria($registro);
        }
        //Cerrar la conexión
        $conexion = null;
        return $categorias;
    }

    /**
     * Inserta una categoría en la base de datos
     *
     * @return void
     */
    public function insertar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $insercion = "INSERT INTO categorias (nombre, descripcion, color) 
        VALUES ('$this->nombre', '$this->descripcion', '$this->color')";

        //Introducir datos
        $conexion->exec($insercion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Actualiza los datos de la categoría actual
     *
     * @return void
     */
    public function actualizar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $actualizacion = "UPDATE categorias SET 
            nombre = '$this->nombre', 
            descripcion = '$this->descripcion', 
            color = '$this->color' 
            WHERE id = '$this->id'";
            

        //Introducir datos
        $conexion->exec($actualizacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /**
     * Elimina la categoría actual de la BD.
     *
     * @return void
     */
    public function eliminar (){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $eliminacion = "DELETE FROM categorias WHERE id = '$this->id'";
        //Ejecutar la consulta
        $conexion->exec($eliminacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /* -- Otras Funciones -- */

    /**
     * Función privada que genera un nuevo objeto Categoría
     *
     * @param object $registro Objeto de la consulta a la BD con los datos del registro de la Categoría
     * @return object Nuevo objeto Producto.
     */
    private static function nuevoObjCategoria ($registro) {
        //nombre, descripcion, color
        return new Categorias ($registro->id, $registro->nombre, $registro->descripcion,
        $registro->color);
    }

}

