<?php
require_once dirname(__DIR__, 2) . '/models/Contacto.php';
$contacto = new Contacto();
$categorias = $contacto->getCategorias();
?>
<div class="max-w-xl mx-auto mb-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Lista de Categorías</h2>
    <table class="min-w-full border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $cat): ?>
            <tr data-categoria='<?php echo json_encode([
                "id" => $cat["id"],
                "nombre" => $cat["nombre"]
            ]); ?>'>
                <td class="px-4 py-2 border"><?php echo htmlspecialchars($cat['nombre']); ?></td>
                <td class="px-4 py-2 border">
                    <a href="/BOUTIQUEORANGE/controllers/CategoriaController.php?action=delete&id=<?php echo $cat['id']; ?>"
                       class="text-red-600 hover:text-red-800 mr-2 delete-categoria-btn"
                       data-categoria-id="<?php echo $cat['id']; ?>"
                       title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                    <button type="button"
                        class="text-blue-600 hover:text-blue-800 edit-categoria-btn"
                        data-categoria-id="<?php echo $cat['id']; ?>"
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
<div id="deleteCategoriaModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 hidden">
    <div class="bg-white rounded shadow-lg p-8 max-w-sm w-full">
        <h3 class="text-lg font-bold mb-4">¿Deseas eliminar esta categoría?</h3>
        <div class="flex justify-end space-x-4">
            <button id="cancelDeleteCategoriaBtn" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</button>
            <a id="confirmDeleteCategoriaBtn" href="#" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Eliminar</a>
        </div>
    </div>
</div>

<!-- Modal de edición -->
<div id="editCategoriaModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 hidden">
    <div class="bg-white rounded shadow-lg p-8 max-w-md w-full">
        <h3 class="text-lg font-bold mb-4">Editar Categoría</h3>
        <form id="editCategoriaForm" method="POST" action="/BOUTIQUEORANGE/controllers/CategoriaController.php">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" id="editCategoriaId">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Nombre</label>
                <input type="text" name="nombre" id="editCategoriaNombre" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelEditCategoriaBtn" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Eliminar
    const deleteBtns = document.querySelectorAll('.delete-categoria-btn');
    const deleteModal = document.getElementById('deleteCategoriaModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteCategoriaBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteCategoriaBtn');
    let deleteUrl = '';

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            deleteUrl = btn.getAttribute('href');
            deleteModal.classList.remove('hidden');
        });
    });

    confirmDeleteBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (deleteUrl) {
            window.location.href = deleteUrl;
        }
    });

    cancelDeleteBtn.addEventListener('click', function () {
        deleteModal.classList.add('hidden');
        deleteUrl = '';
    });

    deleteModal.addEventListener('click', function (e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
            deleteUrl = '';
        }
    });

    // Editar
    const editBtns = document.querySelectorAll('.edit-categoria-btn');
    const editModal = document.getElementById('editCategoriaModal');
    const cancelEditBtn = document.getElementById('cancelEditCategoriaBtn');
    const form = document.getElementById('editCategoriaForm');
    const idInput = document.getElementById('editCategoriaId');
    const nombreInput = document.getElementById('editCategoriaNombre');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const tr = btn.closest('tr');
            const cat = JSON.parse(tr.getAttribute('data-categoria'));
            idInput.value = cat.id;
            nombreInput.value = cat.nombre;
            editModal.classList.remove('hidden');
        });
    });

    cancelEditBtn.addEventListener('click', function (e) {
        e.preventDefault();
        editModal.classList.add('hidden');
    });

    editModal.addEventListener('click', function (e) {
        if (e.target === editModal) {
            editModal.classList.add('hidden');
        }
    });
});
</script>
