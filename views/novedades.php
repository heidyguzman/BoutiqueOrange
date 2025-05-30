<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Agrega esto para cargar los posts:
require_once __DIR__ . '/../models/Contacto.php';
$contacto = new Contacto();
$posts = $contacto->getAllPosts();

// Enriquecer los posts con username, fecha formateada y likes
foreach ($posts as &$post) {
    $post['username'] = $contacto->getUsernameById($post['userId']);
    $post['fecha_formateada'] = date('d/m/Y H:i', strtotime($post['created_at']));
    // Obtener cantidad de likes y si el usuario actual ya dio like
    $post['likes'] = $contacto->getLikesCount($post['id']);
    $post['liked_by_user'] = (isset($_SESSION['user_id']) && $contacto->userLikedPost($_SESSION['user_id'], $post['id'])) ? true : false;
}
unset($post);
?>
<!-- Título -->
  <div class="text-center bg-gradient-to-b from-[#DFF4FF] to-white py-10">
    <h2 class="text-4xl font-semibold">Novedades</h2>
    <p class="text-2xl mt-2 text-gray-700">orange</p>
  </div>

  <!-- Filtros y Crear Publicación -->
  <div class="max-w-6xl mx-auto px-4 mt-8">
    <div class="flex items-center gap-4 mb-8">

      <div class="flex-grow">
        <?php if (isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 2 || $_SESSION['tipo'] == 1)): ?>
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <?php if (isset($_GET['success'])): ?>
            <div id="success-message" class="mb-4 text-green-600">¡Post creado exitosamente!</div>
            <script>
              setTimeout(function() {
                var msg = document.getElementById('success-message');
                if (msg) msg.style.display = 'none';
              }, 3000); // 3 segundos
            </script>
          <?php elseif (isset($_GET['error'])): ?>
            <div class="mb-4 text-red-600">Error al crear el post. Intenta de nuevo.</div>
          <?php endif; ?>
          <form action="controllers/PostController.php" method="POST" enctype="multipart/form-data" class="p-6">
            <!-- Header del formulario -->
            <div class="flex items-center gap-3 mb-4">
              <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div>
                <p class="font-semibold text-gray-800">
                  ¡Hola, <?= htmlspecialchars($_SESSION['usuario']) ?>!
                  <?php if ($_SESSION['tipo'] == 1): ?>
                    <span class="text-red-600 text-sm font-normal">(Administrador)</span>
                  <?php endif; ?>
                </p>
                <p class="text-sm text-gray-500">Comparte algo interesante</p>
              </div>
            </div>
            
            <!-- Campo título (opcional, puedes quitar si no lo quieres) -->
            <div class="mb-4">
              <input 
                type="text"
                name="tittle"
                placeholder="Título de tu publicación (opcional)"
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm mb-1"
                maxlength="100"
              />
            </div>

            <!-- Campo de texto principal -->
            <div class="mb-4">
              <textarea 
                name="body" 
                placeholder="¿En qué estás pensando? Comparte tus ideas, experiencias o novedades..." 
                class="w-full p-4 border-2 border-gray-200 rounded-lg resize-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition-all duration-200 outline-none placeholder-gray-400"
                rows="3"
                required
              ></textarea>
            </div>
            
            <!-- Sección de archivo y botón -->
            <div class="flex items-center justify-between gap-4">
              <div class="flex items-center gap-4">
                <!-- Input de archivo estilizado -->
                <label class="flex items-center gap-2 cursor-pointer bg-gray-50 hover:bg-gray-100 px-4 py-2 rounded-lg border border-gray-200 transition-colors duration-200">
                  <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span class="text-sm font-medium text-gray-700">Añadir imagen (opcional)</span>
                  <!-- El campo de imagen es opcional, no lleva atributo required -->
                  <input type="file" name="imagen" accept="image/*" class="hidden">
                </label>
                
                <!-- Indicador de archivo seleccionado -->
                <span id="file-selected" class="text-sm text-green-600 font-medium hidden">✓ Imagen seleccionada</span>
              </div>
              
              <!-- Botón de publicar -->
              <button 
                type="submit" 
                class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center gap-2"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Publicar
              </button>
            </div>
            <input type="hidden" name="from_novedades" value="1" />
          </form>
        </div>
        
        <!-- Script para mostrar archivo seleccionado -->
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
        
        <?php else: ?>
        <div class="bg-gray-100 rounded-xl border-2 border-dashed border-gray-300 p-6 text-center">
          <div class="flex flex-col items-center gap-3">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div>
              <p class="text-gray-600 font-medium">Inicia sesión para crear publicaciones</p>
              <p class="text-sm text-gray-500">Comparte tus ideas con la comunidad</p>
            </div>
            <a href="/BOUTIQUEORANGE/index.php?view=login" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
              Iniciar sesión
            </a>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Publicaciones -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
      <?php if (isset($posts) && !empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
          <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300 post-card"
               data-post='<?=
                 htmlspecialchars(json_encode([
                   'id' => $post['id'],
                   'username' => $post['username'],
                   'fecha_formateada' => $post['fecha_formateada'],
                   'title' => $post['title'],
                   'body' => $post['body'],
                   'imagen' => $post['imagen'],
                   'active' => $post['active'],
                 ]))
               ?>'>
            <!-- Header del post -->
            <div class="flex items-center gap-3 mb-4">
              <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                <span class="text-white font-semibold text-sm">
                  <?= strtoupper(substr($post['username'], 0, 1)) ?>
                </span>
              </div>
              <div>
                <p class="text-sm font-semibold text-gray-800"><?= htmlspecialchars($post['username']) ?></p>
                <p class="text-xs text-gray-500"><?= $post['fecha_formateada'] ?></p>
              </div>
            </div>

            <!-- Título del post -->
            <?php if (!empty($post['title'])): ?>
              <h3 class="font-semibold text-gray-900 mb-2"><?= htmlspecialchars($post['title']) ?></h3>
            <?php endif; ?>

            <!-- Contenido del post -->
            <div class="mb-4">
              <p class="text-gray-700 text-sm leading-relaxed"><?= nl2br(htmlspecialchars($post['body'])) ?></p>
            </div>

            <!-- Imagen del post -->
            <?php if (!empty($post['imagen'])): ?>
              <img src="<?= htmlspecialchars($post['imagen']) ?>" class="w-full h-48 object-cover rounded-lg mb-4 cursor-pointer post-image-modal-trigger" alt="Imagen del post">
            <?php endif; ?>

            <!-- Acciones del post -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
              <div class="flex items-center gap-4">
                <button 
                  class="flex items-center gap-1 text-gray-500 hover:text-red-500 transition-colors duration-200 like-btn <?= ($post['liked_by_user'] ? 'liked' : '') ?>"
                  data-post-id="<?= $post['id'] ?>"
                  <?php if (!isset($_SESSION['user_id'])): ?>disabled title="Inicia sesión para dar like"<?php endif; ?>
                >
                  <svg class="w-5 h-5" fill="<?= ($post['liked_by_user'] ? 'red' : 'none') ?>" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span class="text-sm like-count"><?= $post['likes'] ?></span>
                  <span class="text-sm">Me gusta</span>
                </button>
                <button 
                  class="flex items-center gap-1 text-gray-500 hover:text-blue-500 transition-colors duration-200 comment-btn"
                  data-post-id="<?= $post['id'] ?>"
                  data-post-title="<?= htmlspecialchars($post['title']) ?>"
                  data-comment-count="0"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span class="text-sm comment-count" id="comment-count-<?= $post['id'] ?>">0</span>
                  <span class="text-sm">Comentar</span>
                </button>
              </div>
              
              <!-- Estado del post -->
              <?php if ($post['active'] == 1): ?>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                  Activo
                </span>
              <?php else: ?>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                  Inactivo
                </span>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Mensaje cuando no hay posts -->
        <div class="col-span-full text-center py-12">
          <div class="flex flex-col items-center gap-4">
            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div>
              <h3 class="text-lg font-medium text-gray-900 mb-2">No hay publicaciones aún</h3>
              <p class="text-gray-500">Sé el primero en compartir algo interesante con la comunidad.</p>
            </div>
            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 2): ?>
              <button onclick="document.querySelector('textarea[name=contenido]').focus()" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                Crear primera publicación
              </button>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

<!-- MODAL DE COMENTARIOS -->
<div id="commentsModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-2 relative">
    <button id="closeCommentsModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
    <div class="p-6">
      <h3 id="modalPostTitle" class="text-lg font-bold mb-2"></h3>
      <div id="commentsList" class="space-y-3 max-h-60 overflow-y-auto mb-4"></div>
      <?php if (isset($_SESSION['user_id'])): ?>
      <form id="modalCommentForm" class="flex gap-2">
        <input type="text" name="body" id="modalCommentInput" placeholder="Escribe un comentario..." class="flex-1 border border-gray-300 rounded px-2 py-1 text-sm" required maxlength="250" />
        <button type="submit" class="bg-orange-500 text-white px-3 py-1 rounded text-xs hover:bg-orange-600">Comentar</button>
      </form>
      <?php else: ?>
      <div class="text-xs text-gray-500">Inicia sesión para comentar.</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- MODAL DE POST COMPLETO -->
<div id="fullPostModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-2 relative">
    <button id="closeFullPostModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
    <div class="p-6" id="fullPostContent">
      <!-- Aquí se carga el contenido del post -->
    </div>
  </div>
</div>

<!-- Scripts externos para mantener MVC -->
<script src="/BOUTIQUEORANGE/public/js/likes.js"></script>
<script src="/BOUTIQUEORANGE/public/js/comments.js"></script>
<script src="/BOUTIQUEORANGE/public/js/fullpost.js"></script>

<script>
// Mostrar modal con post completo al hacer clic en la imagen
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.post-image-modal-trigger').forEach(function(img) {
    img.addEventListener('click', function(e) {
      e.stopPropagation();
      const postCard = img.closest('.post-card');
      const post = JSON.parse(postCard.getAttribute('data-post'));
      const modal = document.getElementById('fullPostModal');
      const content = document.getElementById('fullPostContent');
      content.innerHTML = `
        <div class="flex items-center gap-3 mb-2">
          <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-lg">${post.username.charAt(0).toUpperCase()}</span>
          </div>
          <div>
            <div class="font-semibold text-gray-800 text-base">${post.username}</div>
            <div class="text-xs text-gray-500">${post.fecha_formateada}</div>
          </div>
        </div>
        <h3 class="text-xl font-bold mb-2">${post.title ? post.title : ''}</h3>
        <div class="mb-4 text-gray-700">${post.body.replace(/\n/g, '<br>')}</div>
        ${post.imagen ? `<img src="${post.imagen}" class="w-full max-h-[400px] object-cover rounded-lg mb-4" alt="Imagen del post">` : ''}
        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${post.active == 1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
          ${post.active == 1 ? 'Activo' : 'Inactivo'}
        </span>
      `;
      modal.classList.remove('hidden');
    });
  });

  // Cerrar modal
  document.getElementById('closeFullPostModal').onclick = function() {
    document.getElementById('fullPostModal').classList.add('hidden');
  };
  document.getElementById('fullPostModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.add('hidden');
  });
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      document.getElementById('fullPostModal').classList.add('hidden');
    }
  });
});
</script>