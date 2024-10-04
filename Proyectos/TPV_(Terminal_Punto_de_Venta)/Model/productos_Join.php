<?php
require_once 'tpvBD.php';
class Productos_Join {
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
    function __construct($registro){
        $this -> id = $registro->id;
        $this -> codigo = $registro->codigo;
        $this -> nombre = $registro->nombre;
        $this -> descripcion = $registro->descripcion;
        $this -> categoria = $registro->categoria;
        $this -> precioBruto = $registro->precioBruto;
        $this -> iva = $registro->iva;
        $this -> precioUlCom = $registro->precioUlCom;
        $this -> imagenProd = $registro->imagenProd;
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
     * Obtener array de productos disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada producto de la base de datos.
     */
    public static function getProductosJoin() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT P.id , P.codigo, P.nombre, P.descripcion, C.nombre AS categoria, P.precioBruto, TI.valor_IVA AS iva, P.precioUlCom, P.imagenProd FROM `productos` AS P JOIN categorias AS C ON (P.categoria = C.id) JOIN tipos_iva AS TI ON (P.iva = TI.id) ORDER BY P.nombre ASC;";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()){
            $productos[] = new Productos_Join($registro);
        }
        return $productos;
    }


    /**
     * Obtener array de productos disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada producto de la base de datos.
     */
    public static function getProductosJoinLimites($regInicial, $numRegs) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT P.id , P.codigo, P.nombre, P.descripcion, C.nombre AS categoria, P.precioBruto, TI.valor_IVA AS iva, P.precioUlCom, P.imagenProd FROM `productos` AS P JOIN categorias AS C ON (P.categoria = C.id) JOIN tipos_iva AS TI ON (P.iva = TI.id) ORDER BY P.nombre ASC LIMIT $regInicial, $numRegs";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()){
            $productos[] = new Productos_Join($registro);
        }
        return $productos;
    }
}

