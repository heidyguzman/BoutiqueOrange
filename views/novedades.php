<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Título -->
  <div class="text-center bg-gradient-to-b from-[#DFF4FF] to-white py-10">
    <h2 class="text-4xl font-semibold">Novedades</h2>
    <p class="text-2xl mt-2 text-gray-700">orange</p>
  </div>

  <!-- Filtros y Crear Publicación -->
  <div class="max-w-6xl mx-auto px-4 mt-8">
    <div class="flex items-center gap-4 mb-6">
      <button class="flex items-center gap-2 text-gray-700">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M4 6h16M4 12h16M4 18h7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Filtros
      </button>

      <div class="flex-grow">
        <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 2): ?>
        <form action="crear_post.php" method="POST" enctype="multipart/form-data" class="bg-gray-200 rounded-md p-4 flex items-center gap-4">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <input type="text" name="contenido" placeholder="¿En qué estás pensando?" class="flex-grow bg-transparent outline-none" required>
          <input type="file" name="imagen" accept="image/*" class="text-sm">
          <button type="submit" class="bg-black text-white text-sm px-4 py-1 rounded-md">Foto/Video</button>
        </form>
        <?php else: ?>
        <div class="bg-gray-200 rounded-md p-4 flex items-center gap-4 opacity-50 pointer-events-none">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <input type="text" placeholder="¿En qué estás pensando?" class="flex-grow bg-transparent outline-none" disabled>
          <button class="bg-black text-white text-sm px-4 py-1 rounded-md" disabled>Foto/Video</button>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Publicaciones -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Card -->
      <div class="border rounded-md p-4 shadow-md">
        <p class="text-sm text-gray-500">Usuario</p>
        <p class="text-xs text-gray-400 mb-2">Fecha</p>
        <img src="https://via.placeholder.com/300x200" class="w-full h-48 object-cover rounded-md mb-2">
        <div class="flex justify-start gap-4 text-2xl text-gray-600">
          <span>♡</span>
          <span>🗨️</span>
        </div>
      </div>

      <!-- Card repetida (puedes duplicar este bloque) -->
      <div class="border rounded-md p-4 shadow-md">
        <p class="text-sm text-gray-500">Usuario</p>
        <p class="text-xs text-gray-400 mb-2">Fecha</p>
        <img src="https://via.placeholder.com/300x200" class="w-full h-48 object-cover rounded-md mb-2">
        <div class="flex justify-start gap-4 text-2xl text-gray-600">
          <span>♡</span>
          <span>🗨️</span>
        </div>
      </div>

      <!-- Otro card -->
      <div class="border rounded-md p-4 shadow-md">
        <p class="text-sm text-gray-500">Usuario</p>
        <p class="text-xs text-gray-400 mb-2">Fecha</p>
        <img src="https://via.placeholder.com/300x200" class="w-full h-48 object-cover rounded-md mb-2">
        <div class="flex justify-start gap-4 text-2xl text-gray-600">
          <span>♡</span>
          <span>🗨️</span>
        </div>
      </div>
    </div>
  </div>