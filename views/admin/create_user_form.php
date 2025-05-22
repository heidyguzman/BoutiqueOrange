<?php
if (!isset($_SESSION)) session_start();
?>
<div class="max-w-xl mx-auto mb-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Crear Nuevo Usuario</h2>
    <?php if (isset($_GET['success'])): ?>
        <div class="mb-4 text-green-600">¡Usuario creado exitosamente!</div>
    <?php endif; ?>
    <form action="/BOUTIQUEORANGE/controllers/UserController.php" method="POST" class="space-y-4">
        <div>
            <label class="block mb-1 font-medium">Nombre</label>
            <input type="text" name="name" required class="w-full border px-3 py-2 rounded" />
        </div>
        <div>
            <label class="block mb-1 font-medium">Usuario</label>
            <input type="text" name="username" required class="w-full border px-3 py-2 rounded" />
        </div>
        <div>
            <label class="block mb-1 font-medium">Correo</label>
            <input type="email" name="email" required class="w-full border px-3 py-2 rounded" />
        </div>
        <div>
            <label class="block mb-1 font-medium">Contraseña</label>
            <input type="password" name="passwd" required class="w-full border px-3 py-2 rounded" />
        </div>
        <div>
            <label class="block mb-1 font-medium">Tipo</label>
            <select name="tipo" required class="w-full border px-3 py-2 rounded">
                <option value="1">Administrador</option>
                <option value="0">Usuario</option>
            </select>
        </div>
        <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Crear Usuario</button>
    </form>
</div>
