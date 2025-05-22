<?php
require_once 'Conexion.php';

class user extends Conexion {
    public function obtenerPorCorreo($correo) {
        $correo = $this->conexion->real_escape_string($correo); // seguridad básica
        $this->sentencia = "SELECT * FROM usuario WHERE correo = '$correo'";
        $result = $this->obtener_sentencia();
        return $result ? $result->fetch_assoc() : null;
    }

    public function crear($nombre, $correo, $password) {
        $nombre = $this->conexion->real_escape_string($nombre);
        $correo = $this->conexion->real_escape_string($correo);
        $password = $this->conexion->real_escape_string($password);
        $this->sentencia = "INSERT INTO user (name, email, passwd) VALUES ('$nombre', '$correo', '$password')";
        return $this->ejecutar_sentencia();
    }
}
    