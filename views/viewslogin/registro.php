<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center" 
      style="background-image: url('.../../public/images/fondo.jpg');">

  <!-- Contenedor del formulario -->
  <div class="relative bg-[#E4D1B9] border border-black rounded-md p-8 w-80 shadow-md">

    <!-- Icono de casa -->
    <div class="absolute top-2 right-2">
      <a href="/BOUTIQUEORANGE/index.php?view=home">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75h-5.5a.75.75 0 01-.75-.75V15a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75v6a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
      </svg>
      </a>
    </div>

  <form action="/BOUTIQUEORANGE/index.php?view=registro" method="POST">
  <!-- Campo nombre -->
  <label class="block text-sm font-semibold text-black mb-1">NOMBRE COMPLETO</label>
  <input type="text" name="nombre" placeholder="Juan Carlos Perez Ruiz" class="w-full border border-black px-3 py-2 text-sm mb-3" required />
  <!-- Campo usuario -->
  <label class="block text-sm font-semibold text-black mb-1">USUARIO</label>
  <input type="text" name="usuario" placeholder="JuanR1" class="w-full border border-black px-3 py-2 text-sm mb-3" required />
  <!-- Campo correo -->
  <label class="block text-sm font-semibold text-black mb-1">CORREO</label>
  <input type="email" name="correo" placeholder="ejemplo@gmail.com" class="w-full border border-black px-3 py-2 text-sm mb-3" required />

  <!-- Contraseña -->
  <label class="block text-sm font-semibold text-black mb-1">CONTRASEÑA</label>
  <input type="password" name="passwd" class="w-full border border-black px-3 py-2 text-sm mb-3" required />

  <!-- Confirmar contraseña -->
  <label class="block text-sm font-semibold text-black mb-1">CONFIRMAR CONTRASEÑA</label>
  <input type="password" name="confirmar_passwd" class="w-full border border-black px-3 py-2 text-sm mb-3" required />

  <!-- Checkbox términos -->
  <div class="flex items-center mb-3 text-sm">
    <input id="terminos" type="checkbox" name="terminos" class="mr-2 accent-black" required />
    <label for="terminos" class="text-black">TÉRMINOS Y CONDICIONES</label>
  </div>

  <!-- Enlace de login -->
  <div class="text-xs mb-4">
    <a href="/BOUTIQUEORANGE/index.php?view=login" class="text-black underline">INICIAR SESIÓN</a>
  </div>

  <!-- Botón crear cuenta -->
  <button type="submit" class="w-full bg-black text-white py-2 text-sm font-semibold hover:bg-gray-800 transition">
    CREAR CUENTA
  </button>
</form>
  </div>

</body>
</html>