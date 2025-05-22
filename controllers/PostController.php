<?php
session_start();
require_once '../models/Contacto.php';

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
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
    $userId = $_SESSION['user_id'];
    $tittle = trim($_POST['tittle']);
    $body = trim($_POST['body']);
    $categoria_id = intval($_POST['categoria_id']);
    $active = 1;
    $created_at = date('Y-m-d H:i:s');
    $contacto->insertPost($userId, $tittle, $body, $categoria_id, $active, $created_at);
    header('Location: ../views/admin/dashboard.php?view=create_post&success=1');
    exit;
} elseif (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $contacto->deletePost($id);
    header('Location: ../views/admin/dashboard.php?view=list_posts&deleted=1');
    exit;
}
?>
