<?php
session_start();
require_once '../models/Contacto.php';

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])) {
    header('Location: ../views/viewslogin/login.php');
    exit;
}

$contacto = new Contacto();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        // Redirige si no hay user_id en la sesión
        header('Location: ../views/admin/dashboard.php?view=create_post&error=nouserid');
        exit;
    }
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $id = intval($_POST['id']);
        $title = trim($_POST['title']);
        $body = trim($_POST['body']);
        $categoria_id = intval($_POST['categoria_id']);
        $active = isset($_POST['active']) ? 1 : 0;
        $contacto->updatePost($id, $title, $body, $categoria_id, $active);
        header('Location: ../views/admin/dashboard.php?view=list_posts&edited=1');
        exit;
    }
    // Crear post desde novedades o admin
    $userId = $_SESSION['user_id'];
    // Si viene de novedades, el campo es 'body' y 'tittle' (opcional)
    $tittle = isset($_POST['tittle']) ? trim($_POST['tittle']) : '';
    $body = isset($_POST['body']) ? trim($_POST['body']) : '';
    // Si viene del admin panel, puede venir como 'body' y 'tittle' también
    if ($tittle === '' && isset($_POST['contenido'])) {
        $body = trim($_POST['contenido']);
        $tittle = mb_substr($body, 0, 40);
    }
    // Categoría por defecto si no se envía
    $categoria_id = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 1;
    $active = 1;
    $created_at = date('Y-m-d H:i:s');
    $imagen_path = '';

    // Manejo de imagen (solo si viene un archivo)
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imgTmp = $_FILES['imagen']['tmp_name'];
        $imgName = basename($_FILES['imagen']['name']);
        $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($imgExt, $allowed)) {
            $destDir = '../public/uploads/';
            if (!is_dir($destDir)) {
                mkdir($destDir, 0777, true);
            }
            $newName = uniqid('img_') . '.' . $imgExt;
            $destPath = $destDir . $newName;
            if (move_uploaded_file($imgTmp, $destPath)) {
                $imagen_path = '/BOUTIQUEORANGE/public/uploads/' . $newName;
            }
        }
    }

    // Guardar post con imagen si corresponde
    $contacto->insertPost($userId, $tittle, $body, $categoria_id, $active, $created_at, $imagen_path);

    // Redirige según origen
    if (isset($_POST['from_novedades'])) {
        header('Location: ../index.php?view=novedades&success=1');
    } else {
        header('Location: ../views/admin/dashboard.php?view=create_post&success=1');
    }
    exit;
} elseif (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $contacto->deletePost($id);
    header('Location: ../views/admin/dashboard.php?view=list_posts&deleted=1');
    exit;
}
?>
