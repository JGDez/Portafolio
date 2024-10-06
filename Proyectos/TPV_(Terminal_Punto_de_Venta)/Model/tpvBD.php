<?php

class TpvBD {
    //Declaración de variables
    private static $urlBD = "localhost";
    private static $usuarioBD = "TPVUser";
    private static $passBD = 'NF(:91IBk&$H)_w@!*1Z';
    private static $nombreBD = "tpv";
    private static $juegoCarac= "utf8";

    /**
     * Establece conexión con la base de datos
     *
     * @return object Conexión con la base de datos
     */
    public static function conexionBD() {
        try {
            // Creación de la conexión con la BD
            $conexionBD = new PDO("mysql:host=".self::$urlBD.";dbname=".self::$nombreBD.";charset=".self::$juegoCarac, self::$usuarioBD, self::$passBD);
        } catch (PDOException $e) {
            header("Location: /View/error.html");
            exit;
            //echo "No se ha podido establecer conexión con el servidor de base de datos.<br>";
            //die ("Error: " . $e -> getMessage());
        }
        return $conexionBD;
    }

}