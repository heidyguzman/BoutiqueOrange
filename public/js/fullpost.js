let fullPostModal = document.getElementById('fullPostModal');
let fullPostContent = document.getElementById('fullPostContent');
let closeFullPostModal = document.getElementById('closeFullPostModal');

document.querySelectorAll('.post-card').forEach(function(card) {
  card.addEventListener('click', function(e) {
    if (e.target.closest('.like-btn') || e.target.closest('.comment-btn') || e.target.tagName === 'BUTTON' || e.target.tagName === 'A') return;
    let post = JSON.parse(card.getAttribute('data-post'));
    let html = `
      <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
          <span class="text-white font-semibold text-lg">${post.username.charAt(0).toUpperCase()}</span>
        </div>
        <div>
          <p class="font-semibold text-gray-800">${escapeHtml(post.username)}</p>
          <p class="text-xs text-gray-500">${post.fecha_formateada}</p>
        </div>
      </div>
      ${post.title ? `<h3 class="font-semibold text-gray-900 mb-2 text-xl">${escapeHtml(post.title)}</h3>` : ''}
      <div class="mb-4">
        <p class="text-gray-700 text-base leading-relaxed">${escapeHtml(post.body).replace(/\n/g, '<br>')}</p>
      </div>
      ${post.imagen ? `<img src="${escapeHtml(post.imagen)}" class="w-full h-64 object-cover rounded-lg mb-4" alt="Imagen del post">` : ''}
      <div class="flex items-center gap-2 mt-2">
        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${post.active == 1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
          ${post.active == 1 ? 'Activo' : 'Inactivo'}
        </span>
      </div>
    `;
    fullPostContent.innerHTML = html;
    fullPostModal.classList.remove('hidden');
  });
});

closeFullPostModal.addEventListener('click', function() {
  fullPostModal.classList.add('hidden');
  fullPostContent.innerHTML = '';
});
fullPostModal.addEventListener('click', function(e) {
  if (e.target === fullPostModal) {
    fullPostModal.classList.add('hidden');
    fullPostContent.innerHTML = '';
  }
});

function escapeHtml(text) {
  return text.replace(/[&<>"']/g, function(m) {
    return ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    })[m];
  });
}
