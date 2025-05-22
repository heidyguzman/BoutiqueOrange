<?php
session_start();
session_unset();
session_destroy();
// Evita volver atrás usando el historial del navegador
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Location: /BOUTIQUEORANGE/index.php');
exit;
?>
