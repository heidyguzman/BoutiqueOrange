<?php
namespace App\Models;

class Comentario {
    private $db;
    private $table = 'comentarios';
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getComentariosByPostId($post_id) {
        $query = "SELECT c.*, u.name as autor_nombre 
                 FROM {$this->table} c
                 JOIN usuarios u ON c.autor_id = u.id
                 WHERE c.post_id = ?
                 ORDER BY c.fecha_creacion ASC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function createComentario($post_id, $contenido, $autor_id) {
        $query = "INSERT INTO {$this->table} 
                 (post_id, contenido, autor_id, fecha_creacion) 
                 VALUES (?, ?, ?, NOW())";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isi", $post_id, $contenido, $autor_id);
        
        return $stmt->execute();
    }
} 