<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orange Boutique</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            beige: '#F2E0C9',
            naranja: '#D4A762',
          },
          fontFamily: {
            'dancing': ['Dancing Script', 'cursive'],
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease;
    }
  </style>
</head>
<body class="bg-beige font-sans text-black">

  <!-- Header -->
  <header class="bg-beige text-black p-6 flex items-center justify-between shadow-md">
    <div class="flex items-center gap-4">
      <button class="hover:bg-naranja hover:text-white p-2 rounded-full transition duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 5.65a7.5 7.5 0 010 10.6z"></path>
        </svg>
      </button>
    </div>

    <!-- Logo -->
    <div class="text-4xl font-dancing font-bold text-naranja">Orange</div>

    <!-- Nav -->
    <nav class="flex items-center gap-10 text-sm font-medium">
      <a href="#" class="bg-naranja text-white px-4 py-2 rounded-full transition duration-300 hover:bg-amber-600">Inicio</a>
      <a href="#" class="hover:text-naranja transition duration-300">Novedades</a>
      <a href="#" class="hover:text-naranja transition duration-300">Nosotros</a>
    </nav>

    <!-- Profile Icon -->
    <div>
      <button class="hover:bg-naranja hover:text-white p-2 rounded-full transition duration-300">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M5.121 17.804A4.992 4.992 0 0112 15c1.657 0 3.156.804 4.121 2.036A6.97 6.97 0 0012 21a6.97 6.97 0 01-6.879-3.196z"></path>
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
      </button>
    </div>
  </header>

  <!-- Hero Section -->
  <div class="bg-naranja text-white text-center py-16 px-4">
    <h1 class="text-5xl font-dancing mb-4">Descubre tu estilo único</h1>
    <p class="max-w-xl mx-auto text-lg">La moda que refleja tu personalidad, con la calidad y el diseño que mereces</p>
    <button class="mt-6 bg-white text-naranja px-6 py-3 rounded-full font-medium hover:bg-gray-100 transition duration-300">Ver Colección</button>
  </div>

  <!-- Cards -->
  <main class="p-8 max-w-6xl mx-auto">
    <h2 class="text-3xl font-dancing text-naranja text-center mb-10">Nuestras Categorías</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition duration-300">
        <div class="h-48 bg-gradient-to-t from-teal-600 to-blue-200 flex items-center justify-center">
          <div class="w-24 h-24 bg-white rounded-full shadow-md flex items-center justify-center">
            <svg class="w-12 h-12 text-cyan-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
            </svg>
          </div>
        </div>
        <div class="bg-cyan-200 text-center p-4 font-semibold text-lg">Estilo</div>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition duration-300">
        <div class="h-48 bg-gradient-to-t from-pink-600 to-pink-200 flex items-center justify-center">
          <div class="w-24 h-24 bg-white rounded-full shadow-md flex items-center justify-center">
            <svg class="w-12 h-12 text-pink-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
            </svg>
          </div>
        </div>
        <div class="bg-pink-200 text-center p-4 font-semibold text-lg">Tendencias</div>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition duration-300">
        <div class="h-48 bg-gradient-to-t from-yellow-600 to-yellow-200 flex items-center justify-center">
          <div class="w-24 h-24 bg-white rounded-full shadow-md flex items-center justify-center">
            <svg class="w-12 h-12 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
            </svg>
          </div>
        </div>
        <div class="bg-yellow-200 text-center p-4 font-semibold text-lg">Originalidad</div>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition duration-300">
        <div class="h-48 bg-gradient-to-t from-red-600 to-red-200 flex items-center justify-center">
          <div class="w-24 h-24 bg-white rounded-full shadow-md flex items-center justify-center">
            <svg class="w-12 h-12 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
            </svg>
          </div>
        </div>
        <div class="bg-red-200 text-center p-4 font-semibold text-lg">Moda</div>
      </div>
    </div>
  </main>

  <!-- Features -->
  <section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-6">
      <h2 class="text-3xl font-dancing text-naranja text-center mb-10">Nuestra Historia</h2>
      <div class="bg-beige rounded-lg shadow-lg p-8 text-center">
        <p class="leading-relaxed">
          En Orange Boutique, creemos que la moda es una forma de expresión personal. Nacimos con la misión de ofrecer ropa actual, cómoda y con estilo para mujeres auténticas que buscan destacar en cada temporada. Nuestra pasión por el diseño y los detalles se refleja en cada prenda que seleccionamos.
        </p>
        <p class="leading-relaxed mt-4">
          Desde nuestros inicios, nos hemos comprometido a brindar una experiencia única de compra, combinando calidad, atención personalizada y lo último en tendencias. Ya sea que busques un look casual, elegante o moderno, en Orange Boutique encontrarás algo pensado para ti.
        </p>
        <p class="leading-relaxed mt-4 font-semibold text-naranja">
          Gracias por ser parte de nuestra comunidad. ¡Tu estilo nos inspira!
        </p>
      </div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="bg-naranja text-white text-center py-16">
    <div class="max-w-xl mx-auto px-6">
      <h2 class="text-3xl font-dancing mb-4">¡Mantente conectada!</h2>
      <p class="mb-6">Recibe nuestras novedades y promociones exclusivas</p>
      <form class="flex max-w-md mx-auto">
        <input type="email" placeholder="Tu correo electrónico" class="px-4 py-3 rounded-l-lg w-full focus:outline-none text-gray-700">
        <button type="submit" class="bg-black px-6 py-3 rounded-r-lg hover:bg-gray-800 transition duration-300">Suscribirse</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-black text-white px-6 py-10 text-sm">
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
        <div>
          <h3 class="font-dancing text-xl text-naranja mb-4">Menú</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-naranja transition duration-300">Buscar</a></li>
            <li><a href="#" class="text-naranja">Inicio</a></li>
            <li><a href="#" class="hover:text-naranja transition duration-300">Preguntas Frecuentes</a></li>
          </ul>
        </div>
        <div>
          <h3 class="font-dancing text-xl text-naranja mb-4">Sucursales</h3>
          <ul class="space-y-2">
            <li>Colima</li>
            <li>Manzanillo</li>
            <li>Ciudad Guzman</li>
            <li>Tecomán</li>
            <li>Da click <a href="#" class="text-naranja hover:underline">aquí</a> para ver nuestras ubicaciones.</li>
          </ul>
        </div>
        <div>
          <h3 class="font-dancing text-xl text-naranja mb-4">Contacto</h3>
          <p class="mb-2">Correo: <a href="mailto:Orange.colima@hotmail.com" class="text-naranja hover:underline">Orange.colima@hotmail.com</a></p>
          <p class="mb-2">Teléfono: 312-312-7855</p>
          <p>Whatsapp: 312-180-4283</p>
        </div>
        <div>
          <h3 class="font-dancing text-xl text-naranja mb-4">¡No te pierdas ninguna promoción!</h3>
          <form class="flex border border-naranja rounded-full overflow-hidden max-w-xs mx-auto md:mx-0">
            <input type="email" placeholder="Correo electrónico" class="px-4 py-2 bg-black text-white outline-none w-full">
            <button type="submit" class="px-4 bg-naranja text-white hover:bg-amber-600 transition duration-300">→</button>
          </form>
          <div class="flex mt-4 gap-4 text-white justify-center md:justify-start">
            <a href="#" class="hover:text-naranja transition duration-300">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.891h2.54V9.797c0-2.506 1.493-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.891h-2.33V21.878C18.343 21.128 22 16.991 22 12z"/>
              </svg>
            </a>
            <a href="#" class="hover:text-naranja transition duration-300">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="border-t border-gray-800 mt-8 pt-8 text-center text-xs text-gray-400">
        <p>© 2025 Orange Boutique. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>
</body>
</html>