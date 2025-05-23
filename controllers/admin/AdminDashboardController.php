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

    // Nuevo método para registrar usuarios con contraseña hasheada
    public function registrarUsuario() {
        $this->verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $password = $_POST['password'] ?? '';
            $tipo = $_POST['tipo'] ?? 2; // Por defecto tipo 2 (no admin)

            if ($usuario && $password) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Asumiendo conexión PDO en $pdo
                require __DIR__ . '/../../config/db.php'; // Debe definir $pdo

                $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, password, tipo) VALUES (?, ?, ?)");
                $stmt->execute([$usuario, $passwordHash, $tipo]);

                header('Location: /BOUTIQUEORANGE/index.php?view=admin_usuarios&success=1');
                exit();
            } else {
                header('Location: /BOUTIQUEORANGE/index.php?view=admin_usuarios&error=1');
                exit();
            }
        }
    }
}
?>