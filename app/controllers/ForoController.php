<?php
namespace App\Controllers;

use App\Models\Post;
use App\Models\Comentario;
use App\Models\Usuario;

class ForoController {
    private $postModel;
    private $comentarioModel;
    private $usuarioModel;
    
    public function __construct($db) {
        $this->postModel = new Post($db);
        $this->comentarioModel = new Comentario($db);
        $this->usuarioModel = new Usuario($db);
    }
    
    // Mostrar lista de posts
    public function index() {
        $categorias = [
            1 => 'Tendencias',
            2 => 'Estilo',
            3 => 'Moda',
            4 => 'Originalidad'
        ];
        
        $posts = $this->postModel->getAllPosts();
        
        // Incluir vista
        include_once '../app/views/layouts/header.php';
        include_once '../app/views/foro/index.php';
        include_once '../app/views/layouts/footer.php';
    }
    
    // Ver un post específico con sus comentarios
    public function verPost($id) {
        $post = $this->postModel->getPostById($id);
        
        if (!$post) {
            header('Location: index.php?controller=foro&action=index');
            exit();
        }
        
        $comentarios = $this->comentarioModel->getComentariosByPostId($id);
        
        // Incluir vista
        include_once '../app/views/layouts/header.php';
        include_once '../app/views/foro/tema.php';
        include_once '../app/views/layouts/footer.php';
    }
    
    // Formulario para crear un nuevo post
    public function crearPost() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        
        $categorias = [
            1 => 'Tendencias',
            2 => 'Estilo',
            3 => 'Moda',
            4 => 'Originalidad'
        ];
        
        // Incluir vista
        include_once '../app/views/layouts/header.php';
        include_once '../app/views/foro/crear_tema.php';
        include_once '../app/views/layouts/footer.php';
    }
    
    // Procesar la creación de un nuevo post
    public function guardarPost() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $contenido = $_POST['contenido'] ?? '';
            $categoria_id = $_POST['categoria_id'] ?? 1;
            $autor_id = $_SESSION['usuario_id'];
            
            // Manejar la carga de imágenes
            $imagen = '';
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = 'uploads/';
                $temp_name = $_FILES['imagen']['tmp_name'];
                $original_name = $_FILES['imagen']['name'];
                $extension = pathinfo($original_name, PATHINFO_EXTENSION);
                $imagen = uniqid() . '.' . $extension;
                move_uploaded_file($temp_name, $upload_dir . $imagen);
            }
            
            $post_id = $this->postModel->createPost($titulo, $contenido, $imagen, $autor_id);
            
            if ($post_id) {
                header("Location: index.php?controller=foro&action=verPost&id={$post_id}");
                exit();
            } else {
                // Error al crear el post
                header('Location: index.php?controller=foro&action=crearPost&error=1');
                exit();
            }
        }
    }
    
    // Añadir un comentario a un post
    public function agregarComentario() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_id = $_POST['post_id'] ?? 0;
            $contenido = $_POST['contenido'] ?? '';
            $autor_id = $_SESSION['usuario_id'];
            
            if ($post_id && $contenido) {
                $this->comentarioModel->createComentario($post_id, $contenido, $autor_id);
                header("Location: index.php?controller=foro&action=verPost&id={$post_id}");
                exit();
            }
        }
        
        header('Location: index.php?controller=foro&action=index');
        exit();
    }
}