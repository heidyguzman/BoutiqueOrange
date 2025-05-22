<?php
require_once 'Conexion.php';

class Contacto {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function verificarUsuario($usuario, $contrasena) {
        // Evita inyección SQL usando sentencias preparadas
        $this->conexion->sentencia = "SELECT * FROM user WHERE username = '$usuario' AND passwd = '$contrasena'";
        $resultado = $this->conexion->obtener_sentencia();

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Retorna todo el usuario, incluyendo 'tipo'
        } else {
            return false;
        }
    }

    public function buscarcorreo($correo) {
        // Evita inyección SQL usando sentencias preparadas
        $this->conexion->sentencia = "SELECT * FROM user WHERE email = '$correo'";
        $resultado = $this->conexion->obtener_sentencia();

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Retorna el usuario encontrado
        } else {
            return false;
        }
    }
}
?>