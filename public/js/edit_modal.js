document.addEventListener('DOMContentLoaded', function () {
    const editBtns = document.querySelectorAll('.edit-post-btn');
    const modal = document.getElementById('editModal');
    const cancelBtn = document.getElementById('cancelEditBtn');
    const form = document.getElementById('editPostForm');
    const idInput = document.getElementById('editPostId');
    const titleInput = document.getElementById('editPostTitle');
    const bodyInput = document.getElementById('editPostBody');
    const activeInput = document.getElementById('editPostActive');
    const categoriaInput = document.getElementById('editPostCategoria');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            // Busca el tr más cercano y obtiene los datos del post
            const tr = btn.closest('tr');
            const post = JSON.parse(tr.getAttribute('data-post'));
            idInput.value = post.id;
            titleInput.value = post.title;
            bodyInput.value = post.body;
            activeInput.checked = post.active == 1;
            categoriaInput.value = post.categoria_id || '';
            modal.classList.remove('hidden');
        });
    });

    cancelBtn.addEventListener('click', function (e) {
        e.preventDefault();
        modal.classList.add('hidden');
    });

    // Cierra el modal si se hace click fuera del contenido
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
