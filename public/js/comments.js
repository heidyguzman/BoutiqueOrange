let currentPostId = null;
let modal = document.getElementById('commentsModal');
let commentsList = document.getElementById('commentsList');
let modalPostTitle = document.getElementById('modalPostTitle');
let modalCommentForm = document.getElementById('modalCommentForm');
let modalCommentInput = document.getElementById('modalCommentInput');
let closeBtn = document.getElementById('closeCommentsModal');

// Actualizar contador de comentarios para todos los posts al cargar la página
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.comment-btn').forEach(function(btn) {
    let postId = btn.getAttribute('data-post-id');
    fetch('/BOUTIQUEORANGE/controllers/CommentController.php?post_id=' + encodeURIComponent(postId))
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          let countSpan = document.getElementById('comment-count-' + postId);
          if (countSpan) countSpan.textContent = data.count;
          btn.setAttribute('data-comment-count', data.count);
        }
      });
  });
});

// Abrir modal y cargar comentarios
document.querySelectorAll('.comment-btn').forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    currentPostId = btn.getAttribute('data-post-id');
    modalPostTitle.textContent = btn.getAttribute('data-post-title') || 'Comentarios';
    commentsList.innerHTML = '<div class="text-gray-400 text-center py-4">Cargando...</div>';
    modal.classList.remove('hidden');
    loadComments(currentPostId);
  });
});

// Cerrar modal
closeBtn.addEventListener('click', function() {
  modal.classList.add('hidden');
  commentsList.innerHTML = '';
  if (modalCommentInput) modalCommentInput.value = '';
});
modal.addEventListener('click', function(e) {
  if (e.target === modal) {
    modal.classList.add('hidden');
    commentsList.innerHTML = '';
    if (modalCommentInput) modalCommentInput.value = '';
  }
});

// Cargar comentarios por AJAX
function loadComments(postId) {
  fetch('/BOUTIQUEORANGE/controllers/CommentController.php?post_id=' + encodeURIComponent(postId))
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        renderComments(data.comments);
        // Actualiza el contador en el botón
        let countSpan = document.getElementById('comment-count-' + postId);
        if (countSpan) countSpan.textContent = data.count;
        let btn = document.querySelector('.comment-btn[data-post-id="' + postId + '"]');
        if (btn) btn.setAttribute('data-comment-count', data.count);
      } else {
        commentsList.innerHTML = '<div class="text-red-500 text-center py-4">Error al cargar comentarios</div>';
      }
    });
}

function renderComments(comments) {
  if (!comments.length) {
    commentsList.innerHTML = '<div class="text-gray-400 text-center py-4">Sin comentarios aún.</div>';
    return;
  }
  commentsList.innerHTML = '';
  comments.forEach(function(comment) {
    let div = document.createElement('div');
    div.className = 'flex items-start gap-2 group';
    div.innerHTML = `
      <div class="w-7 h-7 bg-orange-200 rounded-full flex items-center justify-center text-xs font-bold text-orange-700">
        ${comment.username.charAt(0).toUpperCase()}
      </div>
      <div class="flex-1">
        <span class="font-semibold text-gray-800 text-xs">${escapeHtml(comment.username)}</span>
        <span class="text-xs text-gray-500">${comment.fecha_formateada}</span>
        <div class="text-sm text-gray-700">${escapeHtml(comment.body).replace(/\n/g, '<br>')}</div>
      </div>
      ${comment.can_delete ? `<button class="ml-2 text-xs text-red-500 hover:underline delete-comment-btn" data-comment-id="${comment.id}">Eliminar</button>` : ''}
    `;
    commentsList.appendChild(div);
  });
  // Bind eliminar
  commentsList.querySelectorAll('.delete-comment-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      if (!confirm('¿Eliminar este comentario?')) return;
      let commentId = btn.getAttribute('data-comment-id');
      fetch('/BOUTIQUEORANGE/controllers/CommentController.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=delete&comment_id=' + encodeURIComponent(commentId)
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) loadComments(currentPostId);
      });
    });
  });
}

// Enviar comentario desde modal
if (modalCommentForm) {
  modalCommentForm.addEventListener('submit', function(e) {
    e.preventDefault();
    let body = modalCommentInput.value.trim();
    if (!body) return;
    fetch('/BOUTIQUEORANGE/controllers/CommentController.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'post_id=' + encodeURIComponent(currentPostId) + '&body=' + encodeURIComponent(body)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        modalCommentInput.value = '';
        loadComments(currentPostId);
      }
    });
  });
}

// Utilidad para escapar HTML
function escapeHtml(text) {
  return text.replace(/[&<>"']/g, function(m) {
    return ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    })[m];
  });
}
