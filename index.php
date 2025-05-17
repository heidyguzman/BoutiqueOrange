<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orange</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
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
    <div class="text-3xl italic font-semibold text-orange-400">Orange</div>

    <!-- Nav -->
    <nav class="flex items-center gap-10 text-sm font-medium">
      <a href="#" class="bg-gray-300 text-black px-4 py-1 rounded-full">Inicio</a>
      <a href="#" class="hover:underline">Novedades</a>
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

  <!-- Cards -->
  <main class="p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white rounded shadow overflow-hidden">
      <div class="h-48 bg-gradient-to-t from-green-600 to-blue-200 flex items-center justify-center">
        <!-- Imagen de ejemplo -->
        <div class="w-24 h-24 bg-white rounded-full shadow-md"></div>
      </div>
      <div class="bg-cyan-200 text-center p-4 font-semibold text-lg">Estilo</div>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
      <div class="h-48 bg-gradient-to-t from-green-600 to-blue-200 flex items-center justify-center">
        <div class="w-24 h-24 bg-white rounded-full shadow-md"></div>
      </div>
      <div class="bg-pink-200 text-center p-4 font-semibold text-lg">Tendencias</div>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
      <div class="h-48 bg-gradient-to-t from-green-600 to-blue-200 flex items-center justify-center">
        <div class="w-24 h-24 bg-white rounded-full shadow-md"></div>
      </div>
      <div class="bg-yellow-200 text-center p-4 font-semibold text-lg">Originalidad</div>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
      <div class="h-48 bg-gradient-to-t from-green-600 to-blue-200 flex items-center justify-center">
        <div class="w-24 h-24 bg-white rounded-full shadow-md"></div>
      </div>
      <div class="bg-red-200 text-center p-4 font-semibold text-lg">Moda</div>
    </div>
  </main>
</body>
</html>
