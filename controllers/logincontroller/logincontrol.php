<?php
session_start();
require_once __DIR__ . '/../../models/Contacto.php';

class LoginController {
    private $contacto;

     public function index() {
        require_once __DIR__ . '/../../views/viewslogin/login.php';
    }   

    public function __construct() {
        $this->contacto = new Contacto();
    }

    public function iniciarSesion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            $usuarioData = $this->contacto->verificarUsuario($usuario, $contrasena);

            if ($usuarioData) {
                $_SESSION['usuario'] = $usuarioData['username'];
                $_SESSION['user_id'] = $usuarioData['id'];
                $_SESSION['tipo'] = $usuarioData['tipo'];

                if ($usuarioData['tipo'] == 1) {
                    header('Location: /BOUTIQUEORANGE/views/admin/dashboard.php');
                } else {
                    header('Location: /BOUTIQUEORANGE/index.php?view=usuarioDashboard');
                }
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos.";
                require_once __DIR__ . '/../../views/viewslogin/login.php';
            }
        } else {
            require_once __DIR__ . '/../../views/viewslogin/login.php';
        }
    }

    public function cerrarSesion() {
        session_unset();
        session_destroy();
        header('Location: ../../index.php');
    }
}
