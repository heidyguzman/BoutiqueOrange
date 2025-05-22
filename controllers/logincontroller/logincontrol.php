<?php
require_once __DIR__ . '/../../models/Contacto.php';

class LoginController {

    // Carga la vista del formulario login
    public function index() {
        require_once __DIR__ . '/../../views/viewslogin/login.php';
    }
}