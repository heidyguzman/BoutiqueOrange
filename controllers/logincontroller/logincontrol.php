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

            error_log("Intentando login con usuario: " . $usuario);
            
            $usuarioData = $this->contacto->verificarUsuario($usuario, $contrasena);

            if ($usuarioData) {
                error_log("Login exitoso para: " . $usuario);
                
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['usuario'] = $usuarioData['username'];
                $_SESSION['user_id'] = $usuarioData['id'];
                $_SESSION['tipo'] = $usuarioData['tipo'];

                error_log("Tipo de usuario: " . $usuarioData['tipo']);

                if ($usuarioData['tipo'] == 1) {
                    error_log("Redirigiendo a admin dashboard");
                    header('Location: /BOUTIQUEORANGE/views/admin/dashboard.php');
                    exit();
                } else if ($usuarioData['tipo'] == 2) {
                    error_log("Redirigiendo a novedades");
                    header('Location: /BOUTIQUEORANGE/index.php?view=novedades');
                    exit();
                } else {
                    error_log("Redirigiendo a home");
                    header('Location: /BOUTIQUEORANGE/index.php');
                    exit();
                }
            } else {
                error_log("Login fallido para: " . $usuario);
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
