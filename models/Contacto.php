<?php
include_once 'Conexion.php';

class Contacto extends Conexion {
    public function login($correo, $password)
    {
        // Escapar el correo para evitar inyección SQL
        $correo_escapado = mysqli_real_escape_string($this->obtener_conexion_temp(), $correo);
        
        // Preparar la sentencia SQL
        $this->sentencia = "SELECT id, name, username, email, passwd, tipo FROM user WHERE email = '$correo_escapado'";
        
        // Ejecutar la consulta
        $result = $this->obtener_sentencia();
    }
}
?>