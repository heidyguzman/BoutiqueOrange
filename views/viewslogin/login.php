<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de sesión</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center" 
      style="background-image: url('.../../public/images/fondo.jpg');">

  <!-- Modal de error -->
  <?php if (isset($error)): ?>
  <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full mx-4">
      <div class="flex items-center mb-4">
        <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="text-lg font-semibold text-gray-900">Error de autenticación</h3>
      </div>
      <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($error); ?></p>
      <div class="flex justify-end">
        <button onclick="closeErrorModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
          Cerrar
        </button>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Caja de inicio de sesión -->
  <div class="relative bg-[#E4D1B9] border border-black rounded-md p-10 w-80 shadow-md">
    
    <!-- Icono de casa en la esquina superior derecha -->
    <div class="absolute top-2 right-2">
      <a href="/BOUTIQUEORANGE/index.php?view=home">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75h-5.5a.75.75 0 01-.75-.75V15a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75v6a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
      </svg>
      </a>
    </div>

    <!-- Título -->
    <h2 class="text-2xl font-semibold mb-6 text-black">Inicio de sesión</h2>
    <form method="POST" action="/BOUTIQUEORANGE/index.php?view=login">
      <!-- Campo correo -->
      <label class="block text-sm font-semibold text-black mb-1">Usuario</label>
      <input type="text" name="usuario" required placeholder="Usuario" class="w-full border border-black px-3 py-2 text-sm mb-4" />

      <!-- Campo contraseña -->
      <label class="block text-sm font-semibold text-black mb-1">CONTRASEÑA</label>
      <div class="relative mb-4">
        <input type="password" name="contrasena" required class="w-full border border-black px-3 py-2 text-sm pr-10" />
      </div>

      <!-- Enlaces -->
      <div class="text-xs mb-4">
        <a href="/BOUTIQUEORANGE/index.php?view=recuperarcuenta" class="text-black underline block mt-1"> RECUPERAR CUENTA</a>
        <a href="/BOUTIQUEORANGE/index.php?view=registro" class="text-black underline block mt-1">CREAR CUENTA</a>

      </div>

      <!-- Botón de inicio -->
      <button name="login" type="submit" class="w-full bg-black text-white py-2 text-sm font-semibold hover:bg-gray-800 transition">
        Iniciar sesión
      </button>
    </form>
  </div>

  <script>
    function closeErrorModal() {
      document.getElementById('errorModal').style.display = 'none';
    }

    // Cerrar modal al hacer clic fuera de él
    document.addEventListener('click', function(event) {
      const modal = document.getElementById('errorModal');
      if (modal && event.target === modal) {
        closeErrorModal();
      }
    });

    // Cerrar modal con la tecla Escape
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeErrorModal();
      }
    });
  </script>

</body>
</html>