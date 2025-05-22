<?php
session_start();
require_once '../models/Contacto.php';

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
    header('Location: ../views/viewslogin/login.php');
    exit;
}

$contacto = new Contacto();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $id = intval($_POST['id']);
        $nombre = trim($_POST['nombre']);
        $contacto->updateCategoria($id, $nombre);
        header('Location: ../views/admin/dashboard.php?view=list_categorias&edited=1');
        exit;
    }
    $nombre = trim($_POST['nombre']);
    $contacto->insertCategoria($nombre);
    header('Location: ../views/admin/dashboard.php?view=create_categoria&success=1');
    exit;
} elseif (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $contacto->deleteCategoria($id);
    header('Location: ../views/admin/dashboard.php?view=list_categorias&deleted=1');
    exit;
}
?>
