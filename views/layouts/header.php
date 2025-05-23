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
  <header class="bg-beige text-black p-4 flex items-center justify-between shadow">
    <div class="flex items-center gap-4">
      <!-- Puedes agregar un logo aquí si lo deseas -->
    </div>
    <div class="text-3xl italic font-semibold text-naranja">Orange</div>
    <?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $activePage = $_GET['view'] ?? 'home';
    ?>

    <nav class="flex items-center gap-10 text-sm font-medium">
      <a href="/BOUTIQUEORANGE/index.php?view=home"
        class="<?= $activePage === 'home' ? 'bg-gray-300 text-black px-4 py-1 rounded-full' : 'hover:underline' ?>">
        Inicio
      </a>
      <a href="/BOUTIQUEORANGE/index.php?view=novedades"
        class="<?= $activePage === 'novedades' ? 'bg-gray-300 text-black px-4 py-1 rounded-full' : 'hover:underline' ?>">
        Novedades
      </a>
      <a href="/BOUTIQUEORANGE/index.php?view=nosotros"
        class="<?= $activePage === 'nosotros' ? 'bg-gray-300 text-black px-4 py-1 rounded-full' : 'hover:underline' ?>">
        Nosotros
      </a>
      <?php if (isset($_SESSION['usuario']) && isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1): ?>
        <a href="/BOUTIQUEORANGE/views/admin/dashboard.php"
           class="bg-orange-500 text-white px-4 py-1 rounded-full hover:bg-orange-600 transition ml-2"
           title="Ir al Panel de Administrador">
          Dashboard
        </a>
      <?php endif; ?>
    </nav>

    <div class="flex items-center gap-3">
      <?php if (isset($_SESSION['usuario']) && isset($_SESSION['tipo']) && $_SESSION['tipo'] == 2): ?>
        <span class="font-semibold text-black">Hola, <?= htmlspecialchars($_SESSION['usuario']) ?></span>
        <a href="/BOUTIQUEORANGE/controllers/LogoutController.php"
           class="bg-black text-white px-3 py-1 rounded hover:bg-gray-800 transition text-sm">
          Cerrar sesión
        </a>
      <?php elseif (isset($_SESSION['usuario']) && isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1): ?>
        <span class="font-semibold text-black">Hola, <?= htmlspecialchars($_SESSION['usuario']) ?> (Admin)</span>
        <a href="/BOUTIQUEORANGE/controllers/LogoutController.php"
           class="bg-black text-white px-3 py-1 rounded hover:bg-gray-800 transition text-sm">
          Cerrar sesión
        </a>
      <?php else: ?>
        <a href="/BOUTIQUEORANGE/index.php?view=login" title="Iniciar sesión">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A4.992 4.992 0 0112 15c1.657 0 3.156.804 4.121 2.036A6.97 6.97 0 0012 21a6.97 6.97 0 01-6.879-3.196z"></path>
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
        </a>
      <?php endif; ?>
    </div>
  </header>
