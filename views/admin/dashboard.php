<?php
session_start();
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
    header('Location: /BOUTIQUEORANGE/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Boutique Orange</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    
    <!-- Header -->
    <header class="bg-[#E4D1B9] shadow-md border-b border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-black">Panel de Administrador</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-black font-medium">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                    <a href="/BOUTIQUEORANGE/controllers/LogoutController.php" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <nav class="bg-white w-64 min-h-screen shadow-lg border-r border-gray-200">
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="?view=dashboard" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="relative">
                        <button id="postMenuBtn" type="button" class="flex items-center w-full p-3 text-gray-700 rounded-lg hover:bg-gray-100 transition focus:outline-none">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Posts
                            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul id="postMenuDropdown" class="hidden absolute left-0 mt-2 w-full bg-white border rounded shadow z-10">
                            <li>
                                <a href="?view=create_post" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Crear Post</a>
                            </li>
                            <li>
                                <a href="?view=list_posts" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Listar Posts</a>
                            </li>
                        </ul>
                    </li>
                    <li class="relative">
                        <button id="catMenuBtn" type="button" class="flex items-center w-full p-3 text-gray-700 rounded-lg hover:bg-gray-100 transition focus:outline-none">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/>
                            </svg>
                            Categorías
                            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul id="catMenuDropdown" class="hidden absolute left-0 mt-2 w-full bg-white border rounded shadow z-10">
                            <li>
                                <a href="?view=create_categoria" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Crear Categoría</a>
                            </li>
                            <li>
                                <a href="?view=list_categorias" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Listar Categorías</a>
                            </li>
                        </ul>
                    </li>
                    <li class="relative">
                        <button id="userMenuBtn" type="button" class="flex items-center w-full p-3 text-gray-700 rounded-lg hover:bg-gray-100 transition focus:outline-none">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Usuarios
                            <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul id="userMenuDropdown" class="hidden absolute left-0 mt-2 w-full bg-white border rounded shadow z-10">
                            <li>
                                <a href="?view=create_user" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Crear Usuario</a>
                            </li>
                            <li>
                                <a href="?view=list_users" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Listar Usuarios</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <?php
            $view = $_GET['view'] ?? 'dashboard';
            if ($view === 'create_post') {
                include 'create_post_form.php';
            } else if ($view === 'list_posts') {
                include 'list_posts.php';
            } else if ($view === 'create_categoria') {
                include 'create_categoria_form.php';
            } else if ($view === 'list_categorias') {
                include 'list_categorias.php';
            } else if ($view === 'create_user') {
                include 'create_user_form.php';
            } else if ($view === 'list_users') {
                include 'list_users.php';
            } else {
                require_once dirname(__DIR__, 2) . '/models/Contacto.php';
                $contacto = new Contacto();
                $totalPosts = $contacto->getTotalPosts();
                $postsToday = $contacto->getPostsToday();
                $totalVisits = $contacto->getTotalVisits();
            ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-8 border-l-4 border-blue-500 flex flex-col items-center">
                    <div class="mb-2">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700">Total Publicaciones</span>
                    <span class="text-3xl font-bold text-blue-600"><?php echo $totalPosts; ?></span>
                </div>
                <div class="bg-white rounded-lg shadow p-8 border-l-4 border-green-500 flex flex-col items-center">
                    <div class="mb-2">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700">Publicaciones Hoy</span>
                    <span class="text-3xl font-bold text-green-600"><?php echo $postsToday; ?></span>
                </div>
                <div class="bg-white rounded-lg shadow p-8 border-l-4 border-purple-500 flex flex-col items-center">
                    <div class="mb-2">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700">Total Visitas</span>
                    <span class="text-3xl font-bold text-purple-600"><?php echo $totalVisits; ?></span>
                </div>
            </div>
            <?php } ?>
        </main>
    </div>
    <script src="/BOUTIQUEORANGE/public/js/admin_menu.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('catMenuBtn');
        const dropdown = document.getElementById('catMenuDropdown');
        if (btn && dropdown) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                dropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function (e) {
                if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }
        const userBtn = document.getElementById('userMenuBtn');
        const userDropdown = document.getElementById('userMenuDropdown');
        if (userBtn && userDropdown) {
            userBtn.addEventListener('click', function (e) {
                e.preventDefault();
                userDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function (e) {
                if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
    });
    </script>
</body>
</html>