<?php
session_start();
header('Content-Type: application/json');
require_once '../models/Contacto.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'not_logged_in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $userId = $_SESSION['user_id'];
    $postId = intval($_POST['post_id']);
    $contacto = new Contacto();

    if ($contacto->userLikedPost($userId, $postId)) {
        $contacto->removeLike($userId, $postId);
        $liked = false;
    } else {
        $contacto->addLike($userId, $postId);
        $liked = true;
    }
    $likes = $contacto->getLikesCount($postId);
    echo json_encode(['success' => true, 'liked' => $liked, 'likes' => $likes]);
    exit;
}
echo json_encode(['success' => false, 'error' => 'invalid_request']);
