<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Olvidé Contraseña</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center" 
      style="background-image: url('.../../public/images/fondo.jpg');">


  <div class="bg-[#ead8bd] w-[350px] p-10 rounded-md shadow-md border-4 border-black-200 relative">
    <!-- Icono de casa (puedes usar uno de Heroicons) -->
    <div class="absolute top-2 right-2">
        <a href="/BOUTIQUEORANGE/index.php?view=home">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
        </svg>
      </a>
    </div>

    <h2 class="text-2xl font-semibold mb-6 mt-2 text-center">Olvide contraseña</h2>

    <form action="#" method="POST" class="space-y-4">
      <div>
        <label for="correo" class="text-xs font-bold tracking-wide block mb-1">CORREO</label>
        <input type="email" id="correo" name="correo" placeholder="ejemplo@gmail.com" required
               class="w-full px-3 py-2 border border-gray-400 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" />
      </div>

      <button type="submit"
              class="w-full bg-black text-white py-2 font-semibold hover:bg-gray-800 transition-colors">
        Enviar Correo
      </button>
    </form>
  </div>

</body>
</html>