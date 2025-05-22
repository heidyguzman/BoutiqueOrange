document.addEventListener('DOMContentLoaded', function () {
    const deleteBtns = document.querySelectorAll('.delete-post-btn');
    const modal = document.getElementById('deleteModal');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');
    let deleteUrl = '';

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            deleteUrl = btn.getAttribute('href');
            modal.classList.remove('hidden');
        });
    });

    confirmBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (deleteUrl) {
            window.location.href = deleteUrl;
        }
    });

    cancelBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
        deleteUrl = '';
    });

    // Cierra el modal si se hace click fuera del contenido
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            deleteUrl = '';
        }
    });
});
