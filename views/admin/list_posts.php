<?php
require_once dirname(__DIR__, 2) . '/models/Contacto.php';
$contacto = new Contacto();
$posts = $contacto->getAllPosts();
$categorias = $contacto->getCategorias();

// Obtener los usernames de los userId de los posts
$usernames = [];
foreach ($posts as $post) {
    $userId = $post['userId'];
    if (!isset($usernames[$userId])) {
        $usernames[$userId] = $contacto->getUsernameById($userId);
    }
}
// Obtener nombres de categorías
$catnames = [];
foreach ($categorias as $cat) {
    $catnames[$cat['id']] = $cat['nombre'];
}
?>
<div class="max-w-4xl mx-auto mb-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Lista de Posts</h2>
    <table class="min-w-full border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Usuario</th>
                <th class="px-4 py-2 border">Título</th>
                <th class="px-4 py-2 border">Categoría</th>
                <th class="px-4 py-2 border">Activo</th>
                <th class="px-4 py-2 border">Fecha</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr data-post='<?php echo json_encode([
                "id" => $post["id"],
                "title" => $post["title"],
                "body" => $post["body"],
                "active" => $post["active"],
                "categoria_id" => $post["categoria_id"] ?? ""
            ]); ?>'>
                <td class="px-4 py-2 border"><?php echo htmlspecialchars($usernames[$post['userId']] ?? ''); ?></td>
                <td class="px-4 py-2 border"><?php echo htmlspecialchars($post['title']); ?></td>
                <td class="px-4 py-2 border"><?php echo htmlspecialchars($catnames[$post['categoriaId']] ?? ''); ?></td>
                <td class="px-4 py-2 border"><?php echo $post['active'] ? 'Sí' : 'No'; ?></td>
                <td class="px-4 py-2 border"><?php echo htmlspecialchars($post['created_at']); ?></td>
                <td class="px-4 py-2 border">
                    <a href="/BOUTIQUEORANGE/controllers/PostController.php?action=delete&id=<?php echo $post['id']; ?>"
                       class="text-red-600 hover:text-red-800 mr-2 delete-post-btn"
                       data-post-id="<?php echo $post['id']; ?>"
                       title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                    <button type="button"
                        class="text-blue-600 hover:text-blue-800 edit-post-btn"
                        data-post-id="<?php echo $post['id']; ?>"
                        title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m2 2H7a2 2 0 01-2-2v-4a2 2 0 012-2h4"/>
                        </svg>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal de confirmación de eliminación -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 hidden">
    <div class="bg-white rounded shadow-lg p-8 max-w-sm w-full">
        <h3 class="text-lg font-bold mb-4">¿Deseas eliminar este post?</h3>
        <div class="flex justify-end space-x-4">
            <button id="cancelDeleteBtn" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</button>
            <a id="confirmDeleteBtn" href="#" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Eliminar</a>
        </div>
    </div>
</div>

<!-- Modal de edición -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 hidden">
    <div class="bg-white rounded shadow-lg p-8 max-w-md w-full">
        <h3 class="text-lg font-bold mb-4">Editar Post</h3>
        <form id="editPostForm" method="POST" action="/BOUTIQUEORANGE/controllers/PostController.php">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" id="editPostId">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Título</label>
                <input type="text" name="title" id="editPostTitle" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Categoría</label>
                <select name="categoria_id" id="editPostCategoria" required class="w-full border px-3 py-2 rounded">
                    <option value="">Selecciona una categoría</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Contenido</label>
                <textarea name="body" id="editPostBody" required class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="active" id="editPostActive" class="mr-2">
                    Activo
                </label>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelEditBtn" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script src="/BOUTIQUEORANGE/public/js/delete_modal.js"></script>
<script src="/BOUTIQUEORANGE/public/js/edit_modal.js"></script>
