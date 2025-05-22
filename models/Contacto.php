<?php
require_once 'Conexion.php';

class Contacto extends Conexion {
    private $conn;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function verificarUsuario($usuario, $contrasena) {
        // Evita inyección SQL usando sentencias preparadas
        $this->conexion->sentencia = "SELECT * FROM user WHERE username = '$usuario' AND passwd = '$contrasena'";
        $resultado = $this->conexion->obtener_sentencia();

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Retorna todo el usuario, incluyendo 'tipo'
        } else {
            return false;
        }
    }

    public function buscarcorreo($correo) {
        $this->conexion->sentencia = "SELECT * FROM user WHERE email = '$correo'";
        $resultado = $this->conexion->obtener_sentencia();
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Retorna el usuario encontrado
        } else {
            return false; // El correo no existe
        }
    }
    
    public function obtenerPorCorreo($correo) {
        $this->conexion->sentencia = "SELECT * FROM user WHERE email = '$correo'";
        $resultado = $this->conexion->obtener_sentencia();
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Retorna el usuario
        } else {
            return null; // No se encontró el usuario
        }
    }

    public function crear($nombre, $usuario, $correo, $password) {
        $this->conexion->sentencia = "INSERT INTO user (name, username, email, passwd) VALUES ('$nombre', '$usuario', '$correo', '$password')";
        $resultado = $this->conexion->ejecutar_sentencia();
        
    }

    public function insertPost($userId, $tittle, $body, $categoria_id, $active, $created_at) {
        $this->conexion->sentencia = "INSERT INTO posts (userId, title, body, categoriaId, active, created_at) VALUES ('$userId', '$tittle', '$body', '$categoria_id', '$active', '$created_at')";
        $resultado = $this->conexion->ejecutar_sentencia();
    }

    public function getAllPosts() {
        $this->conexion->sentencia = "SELECT * FROM posts ORDER BY created_at DESC";
        $resultado = $this->conexion->obtener_sentencia();
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
        $this->conexion->sentencia = "SELECT username FROM user WHERE id = '$userId' LIMIT 1";
        $resultado = $this->conexion->obtener_sentencia();
        if ($resultado && $row = $resultado->fetch_assoc()) {
            return $row['username'];
        }
        return '';
    }

    public function deletePost($id) {
        $this->conexion->sentencia = "DELETE FROM posts WHERE id = '$id'";
        return $this->conexion->ejecutar_sentencia();
    }

    public function updatePost($id, $title, $body, $categoria_id, $active) {
        $this->conexion->sentencia = "UPDATE posts SET title = '$title', body = '$body', categoriaId = '$categoria_id', active = '$active' WHERE id = '$id'";
        return $this->conexion->ejecutar_sentencia();
    }

    public function insertCategoria($nombre) {
        $this->conexion->sentencia = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
        return $this->conexion->ejecutar_sentencia();
    }

    public function getCategorias() {
        $this->conexion->sentencia = "SELECT id, nombre FROM categorias";
        $resultado = $this->conexion->obtener_sentencia();
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
        $this->conexion->sentencia = "DELETE FROM categorias WHERE id = '$id'";
        return $this->conexion->ejecutar_sentencia();
    }

    public function updateCategoria($id, $nombre) {
        $this->conexion->sentencia = "UPDATE categorias SET nombre = '$nombre' WHERE id = '$id'";
        return $this->conexion->ejecutar_sentencia();
    }

    public function getAllUsers() {
        $this->conexion->sentencia = "SELECT id, name, username, email, tipo FROM user ORDER BY id DESC";
        $resultado = $this->conexion->obtener_sentencia();
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
        $this->conexion->sentencia = "INSERT INTO user (name, username, email, passwd, tipo) VALUES ('$name', '$username', '$email', '$passwd', '$tipo')";
        return $this->conexion->ejecutar_sentencia();
    }

    public function updateUser($id, $name, $username, $email, $tipo) {
        $this->conexion->sentencia = "UPDATE user SET name = '$name', username = '$username', email = '$email', tipo = '$tipo' WHERE id = '$id'";
        return $this->conexion->ejecutar_sentencia();
    }

    public function deleteUser($id) {
        $this->conexion->sentencia = "DELETE FROM user WHERE id = '$id'";
        return $this->conexion->ejecutar_sentencia();
    }

    public function getTotalPosts() {
        $this->conexion->sentencia = "SELECT COUNT(*) as total FROM posts";
        $resultado = $this->conexion->obtener_sentencia();
        $row = $resultado ? $resultado->fetch_assoc() : ['total' => 0];
        return $row['total'];
    }

    public function getPostsToday() {
        $today = date('Y-m-d');
        $this->conexion->sentencia = "SELECT COUNT(*) as total FROM posts WHERE DATE(created_at) = '$today'";
        $resultado = $this->conexion->obtener_sentencia();
        $row = $resultado ? $resultado->fetch_assoc() : ['total' => 0];
        return $row['total'];
    }

    public function getTotalVisits() {
        // Suponiendo que tienes una tabla 'visitas' con un campo 'id'
        $this->conexion->sentencia = "SELECT COUNT(*) as total FROM visitas";
        $resultado = $this->conexion->obtener_sentencia();
        $row = $resultado ? $resultado->fetch_assoc() : ['total' => 0];
        return $row['total'];
    }
}
?>