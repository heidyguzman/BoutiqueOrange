<?php
require_once __DIR__ . '/../models/Contacto.php';
$contacto = new Contacto();
// Obtener los posts más populares de la semana (últimos 7 días)
$popularPosts = [];
$maxLikes = 0;
$oneWeekAgo = date('Y-m-d H:i:s', strtotime('-7 days'));
$posts = $contacto->getAllPosts();
foreach ($posts as $post) {
    if ($post['created_at'] >= $oneWeekAgo) {
        $postLikes = $contacto->getLikesCount($post['id']);
        if ($postLikes > $maxLikes) {
            $maxLikes = $postLikes;
            $popularPosts = [$post];
        } elseif ($postLikes === $maxLikes && $maxLikes > 0) {
            $popularPosts[] = $post;
        }
    }
}
?>

<main class="p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
  <div class="bg-white rounded shadow overflow-hidden">
    <div class="h-[30rem] bg-gradient-to-t relative overflow-hidden">
      <img 
        src=".../../public/images/1.jpg" 
        class="absolute inset-0 w-full h-full object-cover"/>
    </div>
    <div class="bg-cyan-200 text-center p-4 font-semibold text-lg">Estilo</div>
  </div>

    <div class="bg-white rounded shadow overflow-hidden">
    <div class="h-[30rem] bg-gradient-to-t relative overflow-hidden">
      <img 
        src=".../../public/images/2.jpg" 
        class="absolute inset-0 w-full h-full object-cover"/>
    </div>
    <div class="bg-pink-200 text-center p-4 font-semibold text-lg">Tendencias</div>
  </div>


    <div class="bg-white rounded shadow overflow-hidden">
    <div class="h-[30rem] bg-gradient-to-t relative overflow-hidden">
      <img 
        src=".../../public/images/3.jpg"
        class="absolute inset-0 w-full h-full object-cover"/>
    </div>
    <div class="bg-yellow-200 text-center p-4 font-semibold text-lg">Originalidad</div>
  </div>



   <div class="bg-white rounded shadow overflow-hidden">
    <div class="h-[30rem] bg-gradient-to-t relative overflow-hidden">
      <img 
        src=".../../public/images/4.jpg"
        class="absolute inset-0 w-full h-full object-cover"/>
    </div>
    <div class="bg-red-200 text-center p-4 font-semibold text-lg">Moda</div>
  </div>
  </main>

  <!-- Lo más popular -->
  <section class="max-w-5xl mx-auto my-12 bg-white rounded-lg shadow p-8 border-l-4 border-orange-400">
    <div class="flex items-center gap-6 mb-6">
      <span class="text-4xl">🔥</span>
      <div>
        <div class="text-2xl font-bold text-orange-700 mb-1">Looks más amados de la semana</div>
        <div class="text-gray-500 text-base">Estos son los posts que más han gustado a la comunidad en los últimos 7 días.</div>
      </div>
    </div>
    <?php if (!empty($popularPosts)): ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($popularPosts as $popularPost): ?>
          <div class="bg-orange-50 rounded-xl shadow border border-orange-100 p-6 flex flex-col h-full">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-lg">
                  <?= strtoupper(substr($contacto->getUsernameById($popularPost['userId']), 0, 1)) ?>
                </span>
              </div>
              <div>
                <div class="font-semibold text-gray-800 text-base">
                  <?= htmlspecialchars($contacto->getUsernameById($popularPost['userId'])) ?>
                </div>
                <div class="text-xs text-gray-500"><?= date('d/m/Y H:i', strtotime($popularPost['created_at'])) ?></div>
              </div>
            </div>
            <div class="flex-1">
              <div class="text-lg font-semibold text-orange-900 mb-2">
                <?= htmlspecialchars($popularPost['title'] ?: 'Sin título') ?>
              </div>
              <div class="text-gray-700 text-sm mb-3">
                <?= nl2br(htmlspecialchars($popularPost['body'])) ?>
              </div>
              <?php if (!empty($popularPost['imagen'])): ?>
                <img 
                  src="<?= htmlspecialchars($popularPost['imagen']) ?>" 
                  alt="Imagen del post" 
                  class="w-full h-48 object-cover rounded-lg mb-3 cursor-pointer popularPostImage"
                  data-img="<?= htmlspecialchars($popularPost['imagen']) ?>"
                  data-title="<?= htmlspecialchars($popularPost['title']) ?>"
                  style="transition: box-shadow 0.2s;"
                />
              <?php endif; ?>
            </div>
            <div class="flex items-center justify-between mt-2">
              <div class="text-orange-700 font-bold text-base">
                <?= $maxLikes ?> <span class="font-normal text-sm">likes</span>
              </div>
              <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?= $popularPost['active'] == 1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                <?= $popularPost['active'] == 1 ? 'Activo' : 'Inactivo' ?>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="text-gray-800 mt-4 text-center">
        <div class="flex flex-col items-center gap-2">
          <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <div>
            <div class="text-lg font-medium text-gray-900 mb-1">Aún no hay publicaciones populares esta semana.</div>
            <div class="text-gray-500">¡Comparte tu mejor look y sé el primero en aparecer aquí!</div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </section>
  <!-- Features -->
  <section class="bg-white py-8 flex flex-col md:flex-row justify-around items-center text-center text-naranja">
    <div>
      <svg class="mx-auto w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
        <path d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h12v2H3v-2zm0 4h18v2H3v-2zm0 4h12v2H3v-2z"/>
      </svg>
      <p class="font-bold">Envíos <br> nacionales</p>
    </div>
    <div>
      <svg class="mx-auto w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
        <path d="M21 8a2 2 0 00-2-2H5a2 2 0 00-2 2v10h18V8zM5 6a4 4 0 00-4 4v10a2 2 0 002 2h14a2 2 0 002-2V10a4 4 0 00-4-4H5z"/>
      </svg>
      <p class="font-bold">Pagos <br> seguros</p>
    </div>
    <div>
      <svg class="mx-auto w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm-1 2h2c1.11 0 2 .89 2 2v2H9v-2c0-1.11.89-2 2-2z"/>
      </svg>
      <p class="font-bold">Atención <br> personalizada</p>
    </div>
  </section>

<?php if (!empty($popularPosts) && array_filter($popularPosts, fn($p) => !empty($p['imagen']))): ?>
<!-- Modal para imagen del post popular -->
<div id="popularImageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 hidden">
  <div class="relative bg-white rounded-lg shadow-lg max-w-2xl w-full p-4">
    <button id="closePopularImageModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl font-bold">&times;</button>
    <img id="popularModalImg" src="" alt="Imagen grande del post" class="w-full h-auto rounded" />
    <div id="popularModalTitle" class="mt-2 text-center font-semibold text-lg text-orange-700"></div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var imgs = document.querySelectorAll('.popularPostImage');
    var modal = document.getElementById('popularImageModal');
    var closeBtn = document.getElementById('closePopularImageModal');
    var modalImg = document.getElementById('popularModalImg');
    var modalTitle = document.getElementById('popularModalTitle');
    imgs.forEach(function(img) {
      img.addEventListener('click', function() {
        modalImg.src = img.getAttribute('data-img');
        modalTitle.textContent = img.getAttribute('data-title');
        modal.classList.remove('hidden');
      });
    });
    if (closeBtn && modal) {
      closeBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
      });
      modal.addEventListener('click', function(e) {
        if (e.target === modal) {
          modal.classList.add('hidden');
        }
      });
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          modal.classList.add('hidden');
        }
      });
    }
  });
</script>
<?php endif; ?>