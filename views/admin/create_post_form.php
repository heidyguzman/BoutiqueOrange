<?php
if (!isset($_SESSION)) session_start();
require_once dirname(__DIR__, 2) . '/models/Contacto.php';
$contacto = new Contacto();
$categorias = $contacto->getCategorias();
?>
<div class="max-w-xl mx-auto mb-10 bg-white p-8 rounded shadow">
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
            <label class="block mb-1 font-medium">Categoría</label>
            <select name="categoria_id" required class="w-full border px-3 py-2 rounded">
                <option value="">Selecciona una categoría</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="block mb-1 font-medium">Contenido</label>
            <textarea name="body" required class="w-full border px-3 py-2 rounded"></textarea>
        </div>
        <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Crear Post</button>
    </form>
</div>
