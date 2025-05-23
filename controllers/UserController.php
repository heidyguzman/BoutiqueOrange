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

    // Validar correo y usuario únicos
    if ($contacto->obtenerPorCorreo($email) !== null) {
        header('Location: ../views/admin/dashboard.php?view=create_user&error=correo');
        exit;
    }
    // Validar usuario único
    $usuarios = $contacto->getAllUsers();
    foreach ($usuarios as $u) {
        if ($u['username'] === $username) {
            header('Location: ../views/admin/dashboard.php?view=create_user&error=usuario');
            exit;
        }
    }

    // Hashear la contraseña antes de enviar al modelo
    $hash = password_hash($passwd, PASSWORD_DEFAULT);
    $contacto->insertUser($name, $username, $email, $hash, $tipo);
    header('Location: ../views/admin/dashboard.php?view=create_user&success=1');
    exit;
} elseif (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $contacto->deleteUser($id);
    header('Location: ../views/admin/dashboard.php?view=list_users&deleted=1');
    exit;
}
?>
