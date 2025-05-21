<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orange Boutique - Foro</title>
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
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
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
    <nav class="flex items-center gap-6 text-sm font-medium">
      <a href="index.php" class="hover:underline">Inicio</a>
      <a href="novedades.php" class="hover:underline">Novedades</a>
      <a href="nosotros.php" class="hover:underline">Nosotros</a>
      <a href="index.php?controller=foro&action=index" class="bg-gray-300 text-black px-4 py-1 rounded-full">Foro</a>
    </nav>

    <!-- Profile or Login -->
    <div>
      <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="flex items-center gap-3">
          <span class="text-sm"><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
          <a href="index.php?controller=auth&action=logout" class="text-xs text-gray-500 hover:underline">Cerrar sesión</a>
        </div>
      <?php else: ?>
        <a href="index.php?controller=auth&action=login" class="flex items-center gap-1">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A4.992 4.992 0 0112 15c1.657 0 3.156.804 4.121 2.036A6.97 6.97 0 0012 21a6.97 6.97 0 01-6.879-3.196z"></path>
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          <span class="text-sm">Iniciar sesión</span>
        </a>
      <?php endif; ?>
    </div>
  </header>