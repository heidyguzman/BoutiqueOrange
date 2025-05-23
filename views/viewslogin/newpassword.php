<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Restablecer Contraseña</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center"
      style="background-image: url('.../../public/images/fondo.jpg');">
  <div class="bg-[#ead8bd] w-[350px] p-10 rounded-md shadow-md border-4 border-black-200 relative">
    <h2 class="text-2xl font-semibold mb-6 mt-2 text-center">Nueva Contraseña</h2>
    <form action="/BoutiqueOrange/index.php?view=recuperarcuenta&action=update" method="POST" class="space-y-4">
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
      <div>
        <label for="password" class="text-xs font-bold tracking-wide block mb-1">Nueva Contraseña</label>
        <input type="password" id="password" name="password" required
               class="w-full px-3 py-2 border border-gray-400 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" />
      </div>
      <button type="submit"
              class="w-full bg-black text-white py-2 font-semibold hover:bg-gray-800 transition-colors">
        Cambiar Contraseña
      </button>
    </form>
  </div>
</body>
</html>
