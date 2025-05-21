
<div class="bg-beige py-8">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-4xl font-semibold text-naranja text-center mb-8">Foro Orange</h1>
        
        <div class="flex justify-between items-center mb-8">
            <div class="flex space-x-4">
                <a href="index.php?controller=foro&action=index" class="px-4 py-2 bg-naranja text-white rounded-full">Todos</a>
                <a href="index.php?controller=foro&action=filtrar&categoria=1" class="px-4 py-2 bg-pink-200 text-black rounded-full">Tendencias</a>
                <a href="index.php?controller=foro&action=filtrar&categoria=2" class="px-4 py-2 bg-cyan-200 text-black rounded-full">Estilo</a>
                <a href="index.php?controller=foro&action=filtrar&categoria=3" class="px-4 py-2 bg-red-200 text-black rounded-full">Moda</a>
                <a href="index.php?controller=foro&action=filtrar&categoria=4" class="px-4 py-2 bg-yellow-200 text-black rounded-full">Originalidad</a>
            </div>
            
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="index.php?controller=foro&action=crearPost" class="px-4 py-2 bg-black text-white rounded-md">Crear tema</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login" class="px-4 py-2 bg-black text-white rounded-md">Iniciar sesión para publicar</a>
            <?php endif; ?>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($posts as $post): ?>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="h-48 relative">
                        <?php if ($post['imagen']): ?>
                            <img src="uploads/<?php echo $post['imagen']; ?>" alt="<?php echo htmlspecialchars($post['titulo']); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-500">
                                <span>Sin imagen</span>
                            </div>
                        <?php endif; ?>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <div class="text-white font-semibold">
                                <?php echo htmlspecialchars($post['titulo']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm text-gray-600">
                                Por: <?php echo htmlspecialchars($post['autor_nombre']); ?>
                            </div>
                            <div class="text-xs text-gray-500">
                                <?php echo date('d/m/Y', strtotime($post['fecha_creacion'])); ?>
                            </div>
                        </div>
                        <p class="text-gray-700 line-clamp-3 mb-4"><?php echo htmlspecialchars(substr($post['contenido'], 0, 100)) . '...'; ?></p>
                        <div class="flex justify-between items-center">
                            <span class="inline-block px-2 py-1 bg-<?php echo getCategoryColor($post['categoria_id']); ?>-200 text-sm rounded">
                                <?php echo $categorias[$post['categoria_id']]; ?>
                            </span>
                            <a href="index.php?controller=foro&action=verPost&id=<?php echo $post['id']; ?>" class="text-naranja hover:underline">Leer más →</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if (empty($posts)): ?>
                <div class="col-span-3 text-center py-12 text-gray-500">
                    No hay temas disponibles en este momento. ¡Sé el primero en crear uno!
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
function getCategoryColor($category_id) {
    switch ($category_id) {
        case 1: return 'pink';
        case 2: return 'cyan';
        case 3: return 'red';
        case 4: return 'yellow';
        default: return 'gray';
    }
}
?>