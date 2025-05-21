<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de sesión</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center" 
      style="background-image: url('../image/fondo.jpg');">

  <!-- Caja de inicio de sesión -->
  <div class="relative bg-[#E4D1B9] border border-black rounded-md p-10 w-80 shadow-md">
    
    <!-- Icono de casa en la esquina superior derecha -->
    <div class="absolute top-2 right-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75h-5.5a.75.75 0 01-.75-.75V15a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75v6a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
      </svg>
    </div>

    <!-- Título -->
    <h2 class="text-2xl font-semibold mb-6 text-black">Inicio de sesión</h2>

    <!-- Campo correo -->
    <label class="block text-sm font-semibold text-black mb-1">CORREO</label>
    <input type="email" placeholder="ejemplo@gmail.com" class="w-full border border-black px-3 py-2 text-sm mb-4" />

    <!-- Campo contraseña -->
    <label class="block text-sm font-semibold text-black mb-1">CONTRASEÑA</label>
    <div class="relative mb-4">
      <input type="password" class="w-full border border-black px-3 py-2 text-sm pr-10" />
      <button type="button" class="absolute right-2 top-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
      </button>
    </div>

    <!-- Enlaces -->
    <div class="text-xs mb-4">
      <a href="#" class="text-black underline block">RECUPERAR CONTRASEÑA</a>
      <a href="#" class="text-black underline block mt-1">CREAR CUENTA</a>
    </div>

    <!-- Botón de inicio -->
    <button class="w-full bg-black text-white py-2 text-sm font-semibold hover:bg-gray-800 transition">
      Iniciar sesión
    </button>
  </div>

</body>
</html>
