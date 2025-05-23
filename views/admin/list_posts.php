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
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-0 max-w-xl w-full overflow-hidden">
        <form id="editPostForm" method="POST" action="/BOUTIQUEORANGE/controllers/PostController.php" enctype="multipart/form-data" class="space-y-4 px-8 pb-8 pt-8">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" id="editPostId">
            <!-- Header del formulario -->
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">
                        Editar publicación
                    </p>
                    <p class="text-sm text-gray-500">Modifica el contenido de tu post</p>
                </div>
            </div>
            <!-- Campo título -->
            <div>
                <input 
                    type="text"
                    name="title"
                    id="editPostTitle"
                    placeholder="Título de tu publicación (opcional)"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm mb-1"
                    maxlength="100"
                />
            </div>
            <!-- Campo de texto principal -->
            <div>
                <textarea 
                    name="body"
                    id="editPostBody"
                    placeholder="¿En qué estás pensando? Comparte tus ideas, experiencias o novedades..." 
                    class="w-full p-4 border-2 border-gray-200 rounded-lg resize-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition-all duration-200 outline-none placeholder-gray-400"
                    rows="3"
                    required
                ></textarea>
            </div>
            <!-- Imagen y botón -->
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer bg-gray-50 hover:bg-gray-100 px-4 py-2 rounded-lg border border-gray-200 transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Cambiar imagen (opcional)</span>
                        <input type="file" name="imagen" accept="image/*" class="hidden" id="editPostImagenInput">
                    </label>
                    <span id="edit-file-selected" class="text-sm text-green-600 font-medium hidden">✓ Imagen seleccionada</span>
                </div>
                <div class="flex items-center gap-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="active" id="editPostActive" class="mr-2">
                        <span class="text-sm">Activo</span>
                    </label>
                    <button 
                        type="submit" 
                        class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Guardar
                    </button>
                    <button type="button" id="cancelEditBtn" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 ml-2">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="/BOUTIQUEORANGE/public/js/delete_modal.js"></script>
<script>
// Mostrar nombre de archivo seleccionado en el modal de editar
document.addEventListener('DOMContentLoaded', function () {
    // Imagen seleccionada
    var fileInput = document.getElementById('editPostImagenInput');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const fileSelected = document.getElementById('edit-file-selected');
            if (e.target.files.length > 0) {
                fileSelected.classList.remove('hidden');
            } else {
                fileSelected.classList.add('hidden');
            }
        });
    }

    // Modal de edición de post
    const editBtns = document.querySelectorAll('.edit-post-btn');
    const editModal = document.getElementById('editModal');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const editPostForm = document.getElementById('editPostForm');
    const idInput = document.getElementById('editPostId');
    const titleInput = document.getElementById('editPostTitle');
    const bodyInput = document.getElementById('editPostBody');
    const activeInput = document.getElementById('editPostActive');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const tr = btn.closest('tr');
            const post = JSON.parse(tr.getAttribute('data-post'));
            idInput.value = post.id;
            titleInput.value = post.title || '';
            bodyInput.value = post.body || '';
            activeInput.checked = post.active == 1 || post.active === true || post.active === "1";
            editModal.classList.remove('hidden');
        });
    });

    cancelEditBtn.addEventListener('click', function (e) {
        e.preventDefault();
        editModal.classList.add('hidden');
        // Limpiar campos si quieres
        // editPostForm.reset();
    });

    editModal.addEventListener('click', function (e) {
        if (e.target === editModal) {
            editModal.classList.add('hidden');
        }
    });
});
</script>
