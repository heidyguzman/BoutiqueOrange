<?php
namespace App\Models;

class Post {
    private $db;
    private $table = 'posts';
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllPosts($limit = 10, $offset = 0) {
        $query = "SELECT p.*, u.name as autor_nombre 
                 FROM {$this->table} p
                 JOIN usuarios u ON p.autor_id = u.id
                 WHERE p.activo = 1
                 ORDER BY p.fecha_creacion DESC
                 LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getPostById($id) {
        $query = "SELECT p.*, u.name as autor_nombre 
                 FROM {$this->table} p
                 JOIN usuarios u ON p.autor_id = u.id
                 WHERE p.id = ? AND p.activo = 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function createPost($titulo, $contenido, $imagen, $autor_id) {
        $query = "INSERT INTO {$this->table} 
                 (titulo, contenido, imagen, autor_id, fecha_creacion, activo) 
                 VALUES (?, ?, ?, ?, NOW(), 1)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssi", $titulo, $contenido, $imagen, $autor_id);
        
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        
        return false;
    }
    
    public function getPostsByCategory($categoria_id, $limit = 10) {
        $query = "SELECT p.*, u.name as autor_nombre 
                 FROM {$this->table} p
                 JOIN usuarios u ON p.autor_id = u.id
                 WHERE p.categoria_id = ? AND p.activo = 1
                 ORDER BY p.fecha_creacion DESC
                 LIMIT ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $categoria_id, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}