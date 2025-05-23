<?php
session_start();
require_once '../models/Contacto.php';

$contacto = new Contacto();

// Listar comentarios por AJAX GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
    $postId = intval($_GET['post_id']);
    $comments = $contacto->getCommentsByPost($postId);
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $isAdmin = isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1;
    $result = [];
    foreach ($comments as $c) {
        $result[] = [
            'id' => $c['id'],
            'username' => $c['username'],
            'userId' => $c['userId'],
            'body' => $c['body'],
            'fecha_formateada' => date('d/m/Y H:i', strtotime($c['created_at'])),
            'can_delete' => $userId && ($userId == $c['userId'] || $isAdmin)
        ];
    }
    echo json_encode([
        'success' => true,
        'comments' => $result,
        'count' => count($result) // contador de comentarios
    ]);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $commentId = intval($_POST['comment_id']);
        $userId = $_SESSION['user_id'];
        $isAdmin = (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1);
        $ok = $contacto->deleteComment($commentId, $userId, $isAdmin);
        echo json_encode(['success' => $ok]);
        exit;
    }
    // Crear comentario
    $postId = intval($_POST['post_id']);
    $userId = $_SESSION['user_id'];
    $body = trim($_POST['body']);
    if ($body !== '') {
        $ok = $contacto->insertComment($postId, $userId, $body, 1);
        echo json_encode(['success' => $ok]);
        exit;
    }
    echo json_encode(['success' => false, 'error' => 'Comentario vacío']);
    exit;
}
http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Método no permitido']);
exit;
