<?php
if (!isset($_SESSION)) session_start();
?>
<div class="max-w-xl mx-auto mb-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Crear Nueva Categoría</h2>
    <?php if (isset($_GET['success'])): ?>
        <div class="mb-4 text-green-600">¡Categoría creada exitosamente!</div>
    <?php endif; ?>
    <form action="/BOUTIQUEORANGE/controllers/CategoriaController.php" method="POST" class="space-y-4">
        <div>
            <label class="block mb-1 font-medium">Nombre de la Categoría</label>
            <input type="text" name="nombre" required class="w-full border px-3 py-2 rounded" />
        </div>
        <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Crear Categoría</button>
    </form>
</div>
