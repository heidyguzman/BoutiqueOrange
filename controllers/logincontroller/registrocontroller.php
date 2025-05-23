<?php
require_once __DIR__ . '/../../models/Contacto.php';

class registrocontroller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->registrar();
        } else {
            require_once __DIR__ . '/../../views/viewslogin/registro.php';
        }
    }

    private function registrar() {
        $nombre = $_POST['nombre'];
        $usuario= $_POST['usuario'];
        $correo = $_POST['correo'];
        $passwd = $_POST['passwd'];
        $confirmar = $_POST['confirmar_passwd'];

        if ($passwd !== $confirmar) {
            echo "<script>alert('Las contraseñas no coinciden'); window.location.href='/BOUTIQUEORANGE/index.php?view=registro';</script>";
            return;
        }

        $usuarioModel = new Contacto();
        if ($usuarioModel->obtenerPorCorreo($correo)) {
            echo "<script>alert('El correo ya está registrado'); window.location.href='/BOUTIQUEORANGE/index.php?view=registro';</script>";
            return;
        }

        // Hashear la contraseña
        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        $usuarioModel->crear($nombre, $usuario, $correo, $hash);

        echo "<script>alert('Cuenta creada correctamente'); window.location.href='/BOUTIQUEORANGE/index.php?view=login';</script>";
    }
}

