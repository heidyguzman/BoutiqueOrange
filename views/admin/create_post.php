<?php
session_start();
if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
    header('Location: ../../views/viewslogin/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Post - Boutique Orange</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Crear Nuevo Post</h2>
        <?php if (isset($_GET['success'])): ?>
            <div class="mb-4 text-green-600">¡Post creado exitosamente!</div>
        <?php endif; ?>
        <form action="/BOUTIQUEORANGE/controllers/PostController.php" method="POST" class="space-y-4">
            <div>
                <label class="block mb-1 font-medium">Título</label>
                <input type="text" name="tittle" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1 font-medium">Contenido</label>
                <textarea name="body" required class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Crear Post</button>
        </form>
    </div>
</body>
</html>
