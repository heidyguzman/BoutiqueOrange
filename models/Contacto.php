<?php
require_once 'Conexion.php';

class Contacto extends Conexion {
    private $conn;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function verificarUsuario($usuario, $contrasena) {
        // Buscar usuario por username
        $this->sentencia = "SELECT * FROM user WHERE username = '$usuario'";
        $resultado = $this->obtener_sentencia();

        if ($resultado && $resultado->num_rows > 0) {
            $user = $resultado->fetch_assoc();
            // Debug temporal
            error_log("Usuario encontrado: " . $user['username']);
            error_log("Hash en BD: " . $user['passwd']);
            error_log("Contraseña ingresada: " . $contrasena);
            
            // Prueba manual del hash
            $testHash = password_hash($contrasena, PASSWORD_DEFAULT);
            error_log("Hash generado para contraseña actual: " . $testHash);
            
            // Verificar el hash de la contraseña
            if (password_verify($contrasena, $user['passwd'])) {
                error_log("Contraseña verificada correctamente");
                return $user; // Retorna todo el usuario, incluyendo 'tipo'
            } else {
                error_log("Contraseña no coincide");
            }
        } else {
            error_log("Usuario no encontrado: " . $usuario);
        }
        return false;
    }

    public function buscarcorreo($correo) {
        $this->sentencia = "SELECT * FROM user WHERE email = '$correo'";
        $resultado = $this->obtener_sentencia();
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Retorna el usuario encontrado
        } else {
            return false; // El correo no existe
        }
    }
    
    public function obtenerPorCorreo($correo) {
        $this->sentencia = "SELECT * FROM user WHERE email = '$correo'";
        $resultado = $this->obtener_sentencia();
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Retorna el usuario
        } else {
            return null; // No se encontró el usuario
        }
    }

    public function crear($nombre, $usuario, $correo, $password) {
        // La contraseña ya debe venir hasheada desde el controlador
        $this->sentencia = "INSERT INTO user (name, username, email, passwd) VALUES ('$nombre', '$usuario', '$correo', '$password')";
        $resultado = $this->ejecutar_sentencia();
    }

    public function insertPost($userId, $tittle, $body, $categoria_id, $active, $created_at, $imagen = null) {
        $this->sentencia = "INSERT INTO posts (userId, title, body, categoriaId, active, created_at, imagen) VALUES ('$userId', '$tittle', '$body', '$categoria_id', '$active', '$created_at', '$imagen')";
        $resultado = $this->ejecutar_sentencia();
    }

    public function getAllPosts() {
        $this->sentencia = "SELECT * FROM posts ORDER BY created_at DESC";
        $resultado = $this->obtener_sentencia();
        $posts = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $posts[] = $row;
            }
            $resultado->free();
        }
        return $posts;
    }

    public function getUsernameById($userId) {
        $this->sentencia = "SELECT username FROM user WHERE id = '$userId' LIMIT 1";
        $resultado = $this->obtener_sentencia();
        if ($resultado && $row = $resultado->fetch_assoc()) {
            return $row['username'];
        }
        return '';
    }

    public function deletePost($id) {
        $this->sentencia = "DELETE FROM posts WHERE id = '$id'";
        return $this->ejecutar_sentencia();
    }

    public function updatePost($id, $title, $body, $categoria_id, $active) {
        $this->sentencia = "UPDATE posts SET title = '$title', body = '$body', categoriaId = '$categoria_id', active = '$active' WHERE id = '$id'";
        return $this->ejecutar_sentencia();
    }

    public function insertCategoria($nombre) {
        $this->sentencia = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
        return $this->ejecutar_sentencia();
    }

    public function getCategorias() {
        $this->sentencia = "SELECT id, nombre FROM categorias";
        $resultado = $this->obtener_sentencia();
        $categorias = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $categorias[] = $row;
            }
            $resultado->free();
        }
        return $categorias;
    }

    public function deleteCategoria($id) {
        $this->sentencia = "DELETE FROM categorias WHERE id = '$id'";
        return $this->ejecutar_sentencia();
    }

    public function updateCategoria($id, $nombre) {
        $this->sentencia = "UPDATE categorias SET nombre = '$nombre' WHERE id = '$id'";
        return $this->ejecutar_sentencia();
    }

    public function getAllUsers() {
        $this->sentencia = "SELECT id, name, username, email, tipo FROM user ORDER BY id DESC";
        $resultado = $this->obtener_sentencia();
        $users = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $users[] = $row;
            }
            $resultado->free();
        }
        return $users;
    }

    public function insertUser($name, $username, $email, $passwd, $tipo) {
        // La contraseña ya debe venir hasheada desde el controlador
        $this->sentencia = "INSERT INTO user (name, username, email, passwd, tipo) VALUES ('$name', '$username', '$email', '$passwd', '$tipo')";
        return $this->ejecutar_sentencia();
    }

    public function updateUser($id, $name, $username, $email, $tipo) {
        $this->sentencia = "UPDATE user SET name = '$name', username = '$username', email = '$email', tipo = '$tipo' WHERE id = '$id'";
        return $this->ejecutar_sentencia();
    }

    public function deleteUser($id) {
        $this->sentencia = "DELETE FROM user WHERE id = '$id'";
        return $this->ejecutar_sentencia();
    }

    public function getTotalPosts() {
        $this->sentencia = "SELECT COUNT(*) as total FROM posts";
        $resultado = $this->obtener_sentencia();
        $row = $resultado ? $resultado->fetch_assoc() : ['total' => 0];
        return $row['total'];
    }

    public function getPostsToday() {
        $today = date('Y-m-d');
        $this->sentencia = "SELECT COUNT(*) as total FROM posts WHERE DATE(created_at) = '$today'";
        $resultado = $this->obtener_sentencia();
        $row = $resultado ? $resultado->fetch_assoc() : ['total' => 0];
        return $row['total'];
    }

    public function getTotalVisits() {
        // Suponiendo que tienes una tabla 'visitas' con un campo 'id'
        $this->sentencia = "SELECT COUNT(*) as total FROM visitas";
        $resultado = $this->obtener_sentencia();
        $row = $resultado ? $resultado->fetch_assoc() : ['total' => 0];
        return $row['total'];
    }

    // Función temporal para crear usuario de prueba
    public function crearUsuarioPrueba() {
        $hash = password_hash("123456", PASSWORD_DEFAULT);
        error_log("Creando usuario de prueba con hash: " . $hash);
        $this->sentencia = "INSERT INTO user (name, username, email, passwd, tipo) VALUES ('Prueba', 'prueba', 'prueba@test.com', '$hash', 2)";
        return $this->ejecutar_sentencia();
    }

    public function getLikesCount($postId) {
        $this->sentencia = "SELECT COUNT(*) as total FROM interactions WHERE postId = '$postId' AND tipo = 1";
        $resultado = $this->obtener_sentencia();
        $row = $resultado ? $resultado->fetch_assoc() : ['total' => 0];
        return (int)$row['total'];
    }

    public function userLikedPost($userId, $postId) {
        $this->sentencia = "SELECT 1 FROM interactions WHERE postId = '$postId' AND userId = '$userId' AND tipo = 1 LIMIT 1";
        $resultado = $this->obtener_sentencia();
        return ($resultado && $resultado->num_rows > 0);
    }

    public function addLike($userId, $postId) {
        $this->sentencia = "INSERT IGNORE INTO interactions (userId, postId, tipo) VALUES ('$userId', '$postId', 1)";
        return $this->ejecutar_sentencia();
    }

    public function removeLike($userId, $postId) {
        $this->sentencia = "DELETE FROM interactions WHERE userId = '$userId' AND postId = '$postId' AND tipo = 1";
        return $this->ejecutar_sentencia();
    }

    // --- COMENTARIOS ---
    public function insertComment($postId, $userId, $body, $active = 1) {
        $this->sentencia = "INSERT INTO comments (postId, userId, body, active, created_at) VALUES ('$postId', '$userId', '$body', '$active', NOW())";
        return $this->ejecutar_sentencia();
    }

    public function getCommentsByPost($postId) {
        $this->sentencia = "SELECT c.*, u.username FROM comments c JOIN user u ON c.userId = u.id WHERE c.postId = '$postId' AND c.active = 1 ORDER BY c.created_at ASC";
        $resultado = $this->obtener_sentencia();
        $comments = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $comments[] = $row;
            }
            $resultado->free();
        }
        return $comments;
    }

    public function deleteComment($commentId, $userId, $isAdmin = false) {
        // Solo el autor o admin puede eliminar (soft delete)
        if ($isAdmin) {
            $this->sentencia = "UPDATE comments SET active = 0 WHERE id = '$commentId'";
        } else {
            $this->sentencia = "UPDATE comments SET active = 0 WHERE id = '$commentId' AND userId = '$userId'";
        }
        return $this->ejecutar_sentencia();
    }

    // --- RECUPERACIÓN DE CONTRASEÑA ---
    public function guardarTokenRecuperacion($correo, $token, $expires_at, $created_at) {
        // Elimina tokens anteriores para ese correo
        $this->sentencia = "DELETE FROM password_resets WHERE email = '$correo'";
        $this->ejecutar_sentencia();
        // Inserta el nuevo token
        $this->sentencia = "INSERT INTO password_resets (email, token, expires_at, created_at) VALUES ('$correo', '$token', '$expires_at', '$created_at')";
        return $this->ejecutar_sentencia();
    }

    public function obtenerResetPorToken($token) {
        $this->sentencia = "SELECT * FROM password_resets WHERE token = '$token' LIMIT 1";
        $resultado = $this->obtener_sentencia();
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        }
        return false;
    }

    public function actualizarPasswordPorCorreo($correo, $hash) {
        $this->sentencia = "UPDATE user SET passwd = '$hash' WHERE email = '$correo'";
        return $this->ejecutar_sentencia();
    }

    public function eliminarToken($token) {
        $this->sentencia = "DELETE FROM password_resets WHERE token = '$token'";
        return $this->ejecutar_sentencia();
    }
}
?>