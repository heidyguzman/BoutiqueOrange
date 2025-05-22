<?php
require_once __DIR__ . '/../../models/Correo.php';

class contactocontroller {
    public function enviarCorreo() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $mensaje = $_POST['mensaje'];

            $enviado = Correo::enviar($nombre, $email, $mensaje);
            include_once __DIR__ . '/../../views/viewslogin/contactoresultado.php';
        }
    }
}
?>