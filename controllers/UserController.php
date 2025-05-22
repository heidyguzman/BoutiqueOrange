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
        $name = trim($_POST['name']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $tipo = intval($_POST['tipo']);
        $contacto->updateUser($id, $name, $username, $email, $tipo);
        header('Location: ../views/admin/dashboard.php?view=list_users&edited=1');
        exit;
    }
    // Crear usuario
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $passwd = trim($_POST['passwd']);
    $tipo = intval($_POST['tipo']);
    $contacto->insertUser($name, $username, $email, $passwd, $tipo);
    header('Location: ../views/admin/dashboard.php?view=create_user&success=1');
    exit;
} elseif (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $contacto->deleteUser($id);
    header('Location: ../views/admin/dashboard.php?view=list_users&deleted=1');
    exit;
}
?>
