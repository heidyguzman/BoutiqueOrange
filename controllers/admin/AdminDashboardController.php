<?php
class AdminDashboardController {
    
    public function index() {
        session_start();
        
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 1) {
            header('Location: /BOUTIQUEORANGE/index.php?view=login');
            exit();
        }
        
        // Cargar la vista del dashboard de admin
        require_once __DIR__ . '/../../views/admin/dashboard.php';
    }
    
    // Método para verificar permisos de admin
    private function verificarAdmin() {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 1) {
            header('Location: /BOUTIQUEORANGE/index.php?view=login');
            exit();
        }
    }
    
    // Otros métodos específicos de admin
    public function gestionarUsuarios() {
        $this->verificarAdmin();
        require_once __DIR__ . '/../../views/admin/usuarios.php';
    }
    
    public function gestionarProductos() {
        $this->verificarAdmin();
        require_once __DIR__ . '/../../views/admin/productos.php';
    }
    
    public function reportes() {
        $this->verificarAdmin();
        require_once __DIR__ . '/../../views/admin/reportes.php';
    }
}
?>