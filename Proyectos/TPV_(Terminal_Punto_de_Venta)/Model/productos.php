<?php
require_once 'tpvBD.php';
class Productos {
    //Variables de campos de la tabla 'productos'
    private $id;
    private $codigo;
    private $nombre;
    private $descripcion;
    private $categoria;
    private $precioBruto;
    private $iva;
    private $precioUlCom;
    private $imagenProd;

    /**
     * Constructor de la tabla productos
     *
     * @param int $id ID del producto.
     * @param string $codigo Código del prdoucto
     * @param string $nombre Nombre del producto
     * @param string $descripcion Descripción del producto
     * @param int $categoria FK de la categoria a la que pertenece el producto
     * @param float $precioBruto Valor del precio sin IVA
     * @param int $iva FK del IVA aplicado
     * @param float $precioUlCom Valor del precio de última compra
     * @param string $imagenProd Nombre del archivo de la imagen del producto
     */
    function __construct($id, $codigo, $nombre, $descripcion, $categoria, $precioBruto, $iva, $precioUlCom, $imagenProd){
        $this -> id = $id;
        $this -> codigo = mb_substr($codigo,0,20, "UTF-8");
        $this -> nombre = mb_substr($nombre,0,50, "UTF-8");
        $this -> descripcion = mb_substr($descripcion,0,250, "UTF-8");
        $this -> categoria = $categoria;
        $this -> precioBruto = $precioBruto;
        $this -> iva = $iva;
        $this -> precioUlCom = $precioUlCom;
        $this -> imagenProd = $imagenProd;
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
     */
    public function getCodigo()
    {
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
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Get the value of precioBruto
     */
    public function getPrecioBruto()
    {
        return $this->precioBruto;
    }

    /**
     * Get the value of iva
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Get the value of precioUlCom
     */
    public function getPrecioUlCom()
    {
        return $this->precioUlCom;
    }

    /**
     * Get the value of imagenProd
     */
    public function getImagenProd()
    {
        return $this->imagenProd;
    }

    /* Funciones SET */

    /**
     * Establece el valor de la imagen del producto
     *
     * @param integer $imagenProd Nombre de la imagen del logo de la tienda
     * @return void
     */
    public function setImagenProd($imagenProd){
        $this->imagenProd = $imagenProd;
    }

    /* Funciones DML (Lenguaje de Manipulación de Datos) de la BD */

    /**
     * Obtener producto cuyo 'id' sea el pasado por argumento
     *
     * @param int $id Identificador del producto a consultar
     * @return object Objeto que representa al producto solicitado
     */
    public static function getProductoById($id) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM productos WHERE id = $id";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $producto = self::nuevoObjProducto($registro);
        return $producto;
    }

    /**
     * Obtiene el último producto introducido
     *
     * @return object Objeto que representa al producto solicitado
     */
    public static function getProductoUltimo() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM productos ORDER BY id DESC LIMIT 1";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $producto = self::nuevoObjProducto($registro);
        return $producto;
    }

    /**
     * Obtiene los productos filtratos que pertenecen a la categoría indicada
     *
     * @param string $categoria //Id de la categoría a filtrar, '%' para todas las categorías
     * @return void Array de objetos con todos los productos filtrados por categoría.
     */
    public static function getProductosByCategoria($categoria) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM productos WHERE categoria like '$categoria'";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()){
            $productos[] = self::nuevoObjProducto($registro);
        }
        return $productos;
    }

    /**
     * Obtener array de productos disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada producto de la base de datos.
     */
    public static function getProductos() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM productos";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()){
            $productos[] = self::nuevoObjProducto($registro);
        }
        return $productos;
    }

    /**
     * Obtener array de productos disponibles en la base de datos limitando el número de registros a obtener
     *
     * @param [type] $regInicial Número de registro inicial a recuperar (empieza en el 0)
     * @param [type] $numRegs Número de registros a recuperar
     * @return void Array de objetos que representan a cada producto de la base de datos.
     */
    public static function getProductosLimites($regInicial, $numRegs) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM productos LIMIT $regInicial, $numRegs";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()){
            $productos[] = self::nuevoObjProducto($registro);
        }
        return $productos;
    }

    /**
     * Inserta un producto en la base de datos
     *
     * @return void
     */
    public function insertar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $insercion = "INSERT INTO productos (codigo, nombre, descripcion, categoria, precioBruto, iva, precioUlCom, imagenProd) 
        VALUES ('$this->codigo', '$this->nombre', '$this->descripcion', '$this->categoria', '$this->precioBruto', 
        '$this->iva', '$this->precioUlCom', '$this->imagenProd')";

        //Introducir datos
        $conexion->exec($insercion);
    }

    /**
     * Actualiza los datos del producto actual
     *
     * @return void
     */
    public function actualizar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $actualizacion = "UPDATE productos SET 
            codigo = '$this->codigo', 
            nombre = '$this->nombre', 
            descripcion = '$this->descripcion', 
            categoria = '$this->categoria', 
            precioBruto = '$this->precioBruto', 
            iva = '$this->iva', 
            precioUlCom = '$this->precioUlCom', 
            imagenProd = '$this->imagenProd' 
            WHERE id = '$this->id'";
            

        //Introducir datos
        $conexion->exec($actualizacion);
    }

    /**
     * Elimina el producto de la BD.
     *
     * @return void
     */
    public function eliminar (){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $eliminacion = "DELETE FROM productos WHERE id = '$this->id'";
        echo "Instrucción SQL: ".$eliminacion;
        //Ejecutar la consulta
        $conexion->exec($eliminacion);
        //Cerrar la conexión
        $conexion = null;
    }

    /* -- Otras Funciones -- */

    /**
     * Función privada que genera un nuevo objeto Producto
     *
     * @param object $registro Objeto de la consulta a la BD con los datos del registro para el objeto Producto
     * @return object Nuevo objeto Producto.
     */
    private static function nuevoObjProducto ($registro) {
        //codigo, nombre, descripcion, categoria, precioBruto, iva, precioUlCom, imagenProd
        return new Productos($registro->id, $registro->codigo, $registro->nombre, $registro->descripcion,
        $registro->categoria, $registro->precioBruto, $registro->iva, $registro->precioUlCom, 
        $registro->imagenProd);
    }

}

