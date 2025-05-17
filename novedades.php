<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orange</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            beige: '#F2E0C9',
            naranja: '#D4A762',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-100 font-sans text-black">

  <!-- Header -->
  <header class="bg-beige text-black p-4 flex items-center justify-between shadow">
    <div class="flex items-center gap-4">
      <button>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 5.65a7.5 7.5 0 010 10.6z"></path>
        </svg>
      </button>
    </div>

    <!-- Logo -->
    <div class="text-3xl italic font-semibold text-naranja">Orange</div>

    <!-- Nav -->
    <nav class="flex items-center gap-10 text-sm font-medium">
      <a href="#" class="hover:underline">Inicio</a>
      <a href="#" class="bg-gray-300 text-black px-4 py-1 rounded-full">Novedades</a>
      <a href="#" class="hover:underline">Nosotros</a>
    </nav>

    <!-- Profile Icon -->
    <div>
      <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M5.121 17.804A4.992 4.992 0 0112 15c1.657 0 3.156.804 4.121 2.036A6.97 6.97 0 0012 21a6.97 6.97 0 01-6.879-3.196z"></path>
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
      </svg>
    </div>
  </header>

  <!-- Título -->
  <div class="text-center bg-gradient-to-b from-[#DFF4FF] to-white py-10">
    <h2 class="text-4xl font-semibold">Novedades</h2>
    <p class="text-2xl mt-2 text-gray-700">orange</p>
  </div>

  <!-- Filtros y Crear Publicación -->
  <div class="max-w-6xl mx-auto px-4 mt-8">
    <div class="flex items-center gap-4 mb-6">
      <button class="flex items-center gap-2 text-gray-700">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M4 6h16M4 12h16M4 18h7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Filtros
      </button>

      <div class="flex-grow">
        <div class="bg-gray-200 rounded-md p-4 flex items-center gap-4">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <input type="text" placeholder="¿En qué estás pensando?" class="flex-grow bg-transparent outline-none">
          <button class="bg-black text-white text-sm px-4 py-1 rounded-md">Foto/Video</button>
        </div>
      </div>
    </div>

    <!-- Publicaciones -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Card -->
      <div class="border rounded-md p-4 shadow-md">
        <p class="text-sm text-gray-500">Usuario</p>
        <p class="text-xs text-gray-400 mb-2">Fecha</p>
        <img src="https://via.placeholder.com/300x200" class="w-full h-48 object-cover rounded-md mb-2">
        <div class="flex justify-start gap-4 text-2xl text-gray-600">
          <span>♡</span>
          <span>🗨️</span>
        </div>
      </div>

      <!-- Card repetida (puedes duplicar este bloque) -->
      <div class="border rounded-md p-4 shadow-md">
        <p class="text-sm text-gray-500">Usuario</p>
        <p class="text-xs text-gray-400 mb-2">Fecha</p>
        <img src="https://via.placeholder.com/300x200" class="w-full h-48 object-cover rounded-md mb-2">
        <div class="flex justify-start gap-4 text-2xl text-gray-600">
          <span>♡</span>
          <span>🗨️</span>
        </div>
      </div>

      <!-- Otro card -->
      <div class="border rounded-md p-4 shadow-md">
        <p class="text-sm text-gray-500">Usuario</p>
        <p class="text-xs text-gray-400 mb-2">Fecha</p>
        <img src="https://via.placeholder.com/300x200" class="w-full h-48 object-cover rounded-md mb-2">
        <div class="flex justify-start gap-4 text-2xl text-gray-600">
          <span>♡</span>
          <span>🗨️</span>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="bg-black text-white px-6 py-10 text-sm">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div>
        <h3 class="font-semibold mb-2">Menú</h3>
        <ul class="space-y-1">
          <li><a href="#" class="hover:underline">Buscar</a></li>
          <li><a href="#" class="underline">Inicio</a></li>
          <li><a href="#" class="hover:underline">Preguntas Frecuentes</a></li>
        </ul>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Sucursales</h3>
        <ul class="space-y-1">
          <li>Colima</li>
          <li>Manzanillo</li>
          <li>Ciudad Guzman</li>
          <li>Tecomán</li>
          <li>Da click <a href="#" class="underline">aquí</a> para ver nuestras ubicaciones.</li>
        </ul>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Contacto</h3>
        <p>Correo: <a href="mailto:Orange.colima@hotmail.com" class="underline">Orange.colima@hotmail.com</a></p>
        <p>Número de teléfono: 312-312-7855</p>
        <p>Whatsapp: 312-180-4283</p>
      </div>
      <div>
        <h3 class="font-semibold mb-2">¡No te pierdas ninguna promoción!</h3>
        <form class="flex border border-white rounded overflow-hidden">
          <input type="email" placeholder="Correo electrónico" class="px-2 py-1 bg-black text-white outline-none w-full">
          <button type="submit" class="px-2 text-white">→</button>
        </form>
        <div class="flex mt-4 gap-4 text-white">
          <a href="#"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.891h2.54V9.797c0-2.506 1.493-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.891h-2.33V21.878C18.343 21.128 22 16.991 22 12z"/></svg></a>
          <a href="#"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm-6.5 11.5h-3v-5h3v5zM10.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"/></svg></a>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
