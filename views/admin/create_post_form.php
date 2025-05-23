<?php
if (!isset($_SESSION)) session_start();
require_once dirname(__DIR__, 2) . '/models/Contacto.php';
$contacto = new Contacto();
?>
<div class="max-w-2xl mx-auto mb-10 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <h2 class="text-2xl font-bold mb-6 px-8 pt-8">Crear Nuevo Post</h2>
    <?php if (isset($_GET['success'])): ?>
        <div class="mb-4 text-green-600 px-8">¡Post creado exitosamente!</div>
    <?php endif; ?>
    <form action="/BOUTIQUEORANGE/controllers/PostController.php" method="POST" enctype="multipart/form-data" class="space-y-4 px-8 pb-8">
        <!-- Header del formulario -->
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">
                    <?php echo isset($_SESSION['usuario']) ? '¡Hola, ' . htmlspecialchars($_SESSION['usuario']) . '!' : 'Administrador'; ?>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1): ?>
                        <span class="text-red-600 text-sm font-normal">(Administrador)</span>
                    <?php endif; ?>
                </p>
                <p class="text-sm text-gray-500">Publica una novedad para la comunidad</p>
            </div>
        </div>
        <!-- Campo título -->
        <div>
            <input 
                type="text"
                name="tittle"
                placeholder="Título de tu publicación (opcional)"
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm mb-1"
                maxlength="100"
            />
        </div>
        <!-- Contenido -->
        <div>
            <textarea 
                name="body" 
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
                    <span class="text-sm font-medium text-gray-700">Añadir imagen (opcional)</span>
                    <input type="file" name="imagen" accept="image/*" class="hidden">
                </label>
                <span id="file-selected" class="text-sm text-green-600 font-medium hidden">✓ Imagen seleccionada</span>
            </div>
            <button 
                type="submit" 
                class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center gap-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Crear Post
            </button>
        </div>
    </form>
</div>
<script>
document.querySelector('input[type="file"]').addEventListener('change', function(e) {
    const fileSelected = document.getElementById('file-selected');
    if (e.target.files.length > 0) {
        fileSelected.classList.remove('hidden');
    } else {
        fileSelected.classList.add('hidden');
    }
});
</script>
