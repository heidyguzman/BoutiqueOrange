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
  <input 
    type="text" 
    name="nombre" 
    id="nombre-completo"
    placeholder="Heidy Samantha Guzmán Márquez" 
    class="w-full border border-black px-3 py-2 text-sm mb-3" 
    required 
    maxlength="40"
    pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
    title="Solo letras y espacios, máximo 40 caracteres"
  />
  <!-- Campo usuario -->
  <label class="block text-sm font-semibold text-black mb-1">USUARIO</label>
  <input type="text" name="usuario" placeholder="Heidyguzz" class="w-full border border-black px-3 py-2 text-sm mb-3" required maxlength="30" />
  
  <!-- Campo correo -->
  <label class="block text-sm font-semibold text-black mb-1">CORREO</label>
  <input type="email" name="correo" placeholder="ejemplo@gmail.com" class="w-full border border-black px-3 py-2 text-sm mb-3" required maxlength="30" />

  <!-- Contraseña -->
  <label class="block text-sm font-semibold text-black mb-1">CONTRASEÑA</label>
  <div class="relative mb-3">
    <input type="password" name="passwd" id="register-password" class="w-full border border-black px-3 py-2 text-sm pr-10" required maxlength="15" />
    <button type="button" id="toggle-register-password" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-black">
      <svg id="register-eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
      <svg id="register-eye-closed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.634 6.634A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.293 5.95M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
      </svg>
    </button>
  </div>
  <!-- Confirmar contraseña -->
  <label class="block text-sm font-semibold text-black mb-1">CONFIRMAR CONTRASEÑA</label>
  <div class="relative mb-3">
    <input type="password" name="confirmar_passwd" id="register-confirm-password" class="w-full border border-black px-3 py-2 text-sm pr-10" required maxlength="15" />
    <button type="button" id="toggle-register-confirm-password" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-black">
      <svg id="register-confirm-eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
      <svg id="register-confirm-eye-closed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.634 6.634A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.293 5.95M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
      </svg>
    </button>
  </div>

  <!-- Checkbox términos -->
  <div class="flex items-center mb-3 text-sm">
    <input id="terminos" type="checkbox" name="terminos" class="mr-2 accent-black" required />
    <div class="text-xs mb-4">
      <a href="/BOUTIQUEORANGE/public/terminos/Terminos%20y%20condiciones.pdf" class="text-black underline">TÉRMINOS Y CONDICIONES</a>
    </div>
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
  <script>
    // Mostrar/ocultar contraseña principal
    document.getElementById('toggle-register-password').addEventListener('click', function() {
      const input = document.getElementById('register-password');
      const eyeOpen = document.getElementById('register-eye-open');
      const eyeClosed = document.getElementById('register-eye-closed');
      if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
      } else {
        input.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
      }
    });
    // Mostrar/ocultar confirmar contraseña
    document.getElementById('toggle-register-confirm-password').addEventListener('click', function() {
      const input = document.getElementById('register-confirm-password');
      const eyeOpen = document.getElementById('register-confirm-eye-open');
      const eyeClosed = document.getElementById('register-confirm-eye-closed');
      if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
      } else {
        input.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
      }
    });
    // Validación solo letras y máximo 40 caracteres en nombre completo
    document.getElementById('nombre-completo').addEventListener('input', function(e) {
      this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').slice(0, 40);
    });
    // Limitar correo a 30 caracteres
    document.querySelector('input[name="correo"]').addEventListener('input', function(e) {
      this.value = this.value.slice(0, 30);
    });
    // Limitar contraseña y confirmar contraseña a 15 caracteres
    document.getElementById('register-password').addEventListener('input', function(e) {
      this.value = this.value.slice(0, 15);
    });
    document.getElementById('register-confirm-password').addEventListener('input', function(e) {
      this.value = this.value.slice(0, 15);
    });
    // Limitar usuario a 30 caracteres
    document.querySelector('input[name="usuario"]').addEventListener('input', function(e) {
      this.value = this.value.slice(0, 30);
    });
  </script>
</body>
</html>