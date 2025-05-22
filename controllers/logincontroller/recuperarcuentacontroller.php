<?php
require_once __DIR__ . '/../../models/Contacto.php';

//mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);


class recuperarcuentacontroller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['correo'])) {
            $correo = $_POST['correo'];
            $contacto = new Contacto();
            $usuario = $contacto->buscarcorreo($correo);

            if ($usuario) {
                echo "<script>alert('Correo recuperado: " . htmlspecialchars($usuario['email']) . "'); window.location.href = window.location.pathname;</script>";
            } else {
                echo "<script>alert('Correo no encontrado.'); window.location.href = window.location.pathname;</script>";
            }
        } else {
            require_once __DIR__ . '/../../views/viewslogin/recuperarcuenta.php';
        }
    }
}