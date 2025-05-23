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

if (isset($_GET['view'])) {
    $view = $_GET['view'];
    // Elimina este bloque:
    // if ($view === 'novedades') {
    //     require_once __DIR__ . '/views/novedades.php';
    //     exit;
    // }
    // ...otras rutas...
}

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
        error_log("Procesando caso login en index.php");
        $controller = new LoginController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("POST detectado en index.php, llamando iniciarSesion");
            $controller->iniciarSesion();
        } else {
            error_log("GET detectado en index.php, mostrando formulario");
            $controller->index();
        }
        break;
    case 'registro':
        $controller = new registrocontroller();
        $controller->index();
        break;
    case 'recuperarcuenta':
        $controller = new recuperarcuentacontroller();
        if (isset($_GET['action']) && $_GET['action'] === 'update') {
            $controller->actualizarPassword();
        } else {
            $controller->index();
        }
        break;
    case 'adminDashboard':
        require_once __DIR__ . '/controllers/admin/AdminDashboardController.php';
        $controller = new AdminDashboardController();
        $controller->index();
        break;

    default:
        echo "Página no encontrada.";
        break;
}
