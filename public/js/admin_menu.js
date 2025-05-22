document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('postMenuBtn');
    const dropdown = document.getElementById('postMenuDropdown');
    if (btn && dropdown) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            dropdown.classList.toggle('hidden');
        });
        // Opcional: cerrar el menú si se hace clic fuera
        document.addEventListener('click', function (e) {
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }
});
