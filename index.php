<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carga de controladores
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/novedadescontroller.php';
require_once __DIR__ . '/controllers/nosotroscontroller.php';
require_once __DIR__ . '/controllers/logincontroller/logincontrol.php';
require_once __DIR__ . '/controllers/logincontroller/registrocontroller.php';
require_once __DIR__ . '/controllers/logincontroller/recuperarcuentacontroller.php';
// Agrega más controladores aquí si es necesario

// Obtiene la vista solicitada, por defecto 'home'
$view = isset($_GET['view']) ? $_GET['view'] : 'home';

switch ($view) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'novedades':
        $controller = new novedadesController();
        $controller->index();
        break;
    case 'nosotros':
        $controller = new nosotrosController();
        $controller->index();
        break;
    case 'login':
        $controller = new LoginController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->autenticar();
        } else {
            $controller->index();
        }
        break;
    case 'registro':
        $controller = new registrocontroller();
        $controller->index();
        break;
    case 'recuperarcuenta':
        $controller = new recuperarcuentacontroller();
        $controller->index();
        break;
    default:
        echo "Página no encontrada.";
        break;
}
