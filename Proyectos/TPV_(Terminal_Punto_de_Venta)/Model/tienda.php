<?php
require_once 'tpvBD.php';
class Tienda {
    //Variables de campos de la tabla 'tienda'
    private $id;
    private $cif_nif;
    private $nombre_Fis;
    private $nombre_Com;
    private $direccion;
    private $poblacion;
    private $cp;
    private $provincia;
    private $logoTienda;
    private $logoTicket;
    private $telef;
    private $movil;
    private $email;

    /**
     * Constructor de la tabla Tienda
     *
     * @param int $id ID de la tienda
     * @param integer $cif_nif CIF o NIF de la tienda
     * @param integer $nombre_Fis Nombre fiscal de la tienda
     * @param integer $nombre_Com Nombre comercial de la tienda
     * @param integer $direccion Dirección física de la tienda
     * @param integer $poblacion Población donde está situada la tienda
     * @param integer $cp Código postal
     * @param integer $provincia Provincia donde está situada la tienda
     * @param integer $logoTienda Nombre de la imagen del logo general para la tienda
     * @param integer $logoTicket Nombre de la imagen del logo para los tickets
     * @param integer $telef Número de teléfono de contacto
     * @param integer $movil Número del móvil de contacto
     * @param integer $email Dirección de correo electrónico de contacto
     */
    function __construct($id, $cif_nif, $nombre_Fis, $nombre_Com, $direccion, $poblacion, $cp, $provincia, $logoTienda, $logoTicket, $telef, $movil, $email) {
        $this->id = $id;
        $this->cif_nif = $cif_nif;
        $this->nombre_Fis = $nombre_Fis;
        $this->nombre_Com = $nombre_Com;
        $this->direccion = $direccion;
        $this->poblacion = $poblacion;
        $this->cp = $cp;
        $this->provincia = $provincia;
        $this->logoTienda = $logoTienda;
        $this->logoTicket = $logoTicket;
        $this->telef = $telef;
        $this->movil = $movil;
        $this->email = $email;
    }
    
    /* --- Getters --- */
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of cif_nif
     */
    public function getCifNif()
    {
        return $this->cif_nif;
    }

    /**
     * Get the value of nombre_Fis
     */
    public function getNombreFis()
    {
        return $this->nombre_Fis;
    }

    /**
     * Get the value of nombre_Com
     */
    public function getNombreCom()
    {
        return $this->nombre_Com;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Get the value of poblacion
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Get the value of cp
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Get the value of provincia
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Get the value of logoTienda
     */
    public function getLogoTienda()
    {
        return $this->logoTienda;
    }

    /**
     * Get the value of logoTicket
     */
    public function getLogoTicket()
    {
        return $this->logoTicket;
    }

    /**
     * Get the value of telef
     */
    public function getTelef()
    {
        return $this->telef;
    }

    /**
     * Get the value of movil
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /* Funciones SET */

    /**
     * Establece el valor del logo de la tienda
     *
     * @param integer $logoTienda Nombre de la imagen del logo de la tienda
     * @return void
     */
    public function setLogoTienda($logoTienda){
        $this->logoTienda = $logoTienda;
    }

    public function setLogoTicket($logoTicket){
        $this->logoTicket = $logoTicket;
    }

    /* Funciones DML (Lenguaje de Manipulación de Datos) de la BD */

    /**
     * Obtener tienda cuyo 'id' sea el pasado por argumento
     *
     * @param int $id Identificador de la tienda a consultar
     * @return object Objeto que representa a la tienda solicitada
     */
    public static function getTiendaById($id) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tienda WHERE id = $id";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $tienda = self::nuevoObjTienda($registro);
        return $tienda;
    }

    /**
     * Obtiene la tienda que coincida con el N.I.F. o C.I.F. indicado
     *
     * @param integer $cif_nif Número de N.I.F. o C.I.F. a buscar
     * @return object Objeto que representa a la tienda solicitada
     */
    public static function getTiendaByCifNif($cif_nif) {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tienda WHERE cif_nif = '$cif_nif'";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $tienda = self::nuevoObjTienda($registro);
        return $tienda;
    }

    /**
     * Obtiene última tienda introducida
     *
     * @return object Objeto que representa a la tienda solicitada
     */
    public static function getTiendaUltima() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tienda ORDER BY id DESC LIMIT 1";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $tienda = self::nuevoObjTienda($registro);
        return $tienda;
    }

    /**
     * Obtener array de tiendas disponibles en la base de datos
     *
     * @return array Array de objetos que representan a cada tienda de la base de datos.
     */
    public static function getTiendas() {
        $conexion = TpvBD::conexionBD();
        $seleccion = "SELECT * FROM tienda";
        $consulta = $conexion->query($seleccion);
        $tiendas = [];
        while ($registro = $consulta->fetchObject()){
            $tiendas[] = self::nuevoObjTienda($registro);
        }
        return $tiendas;
    }

    /**
     * Inserta una tienda en la base de datos
     *
     * @return void
     */
    public function insertar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $insercion = "INSERT INTO tienda (cif_nif, nombre_Fis, nombre_Com, direccion, poblacion, cp, provincia, logoTienda, logoTicket, telef, movil, email) 
        VALUES ('$this->cif_nif', '$this->nombre_Com', '$this->nombre_Fis', '$this->direccion', '$this->poblacion', 
        '$this->cp', '$this->provincia', '$this->logoTienda', '$this->logoTicket', '$this->telef', '$this->movil', 
        '$this->email')";

        //Introducir datos
        $conexion->exec($insercion);
    }

    /**
     * Actualiza los datos de la tienda actual
     *
     * @return void
     */
    public function actualizar(){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $actualizacion = "UPDATE tienda SET 
            cif_nif = '$this->cif_nif', 
            nombre_Fis = '$this->nombre_Fis', 
            nombre_Com = '$this->nombre_Com', 
            direccion = '$this->direccion', 
            poblacion = '$this->poblacion', 
            cp = '$this->cp', 
            provincia = '$this->provincia', 
            logoTienda = '$this->logoTienda', 
            logoTicket = '$this->logoTicket', 
            telef = '$this->telef', 
            movil = '$this->movil', 
            email = '$this->email'
            WHERE id = '$this->id'";
            

        //Introducir datos
        $conexion->exec($actualizacion);
    }

    /**
     * Elimina la tienda de la BD.
     *
     * @return void
     */
    public function eliminar (){
        $conexion = TpvBD::conexionBD();
        //Generar consulta
        $eliminacion = "DELETE FROM tienda WHERE id = '$this->id'";
        //Ejecutar la consulta
        $conexion->exec($eliminacion);
    }

    /* -- Otras Funciones -- */

    /**
     * Función privada que genera un nuevo objeto Tienda
     *
     * @param object $registro Objeto de la consulta a la BD con los datos del registro para el objeto Tienda
     * @return object Nuevo objeto Tienda.
     */
    private static function nuevoObjTienda ($registro) {
        return new Tienda($registro->id, $registro->cif_nif, $registro->nombre_Fis, $registro->nombre_Com,
        $registro->direccion, $registro->poblacion, $registro->cp, $registro->provincia, $registro->logoTienda, $registro->logoTicket, $registro->telef,
        $registro->movil, $registro->email);
    }
    


}