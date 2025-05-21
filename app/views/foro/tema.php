<div class="bg-beige py-8">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-semibold text-naranja"><?php echo htmlspecialchars($post['titulo']); ?></h1>
                    <span class="inline-block px-3 py-1 bg-<?php echo getCategoryColor($post['categoria_id']); ?>-200 rounded-full text-sm">
                        <?php echo $categorias[$post['categoria_id']]; ?>
                    </span>
                </div>
                
                <div class="flex items-center text-gray-600 text-sm mb-6">
                    <span>Por: <?php echo htmlspecialchars($post['autor_nombre']); ?></span>
                    <span class="mx-2">•</span>
                    <span><?php echo date('d/m/Y H:i', strtotime($post['fecha_creacion'])); ?></span>
                </div>
                
                <?php if ($post['imagen']): ?>
                    <div class="mb-6">
                        <img src="uploads/<?php echo $post['imagen']; ?>" alt="<?php echo htmlspecialchars($post['titulo']); ?>" class="w-full h-auto rounded-lg">
                    </div>
                <?php endif; ?>
                
                <div class="prose max-w-none mb-6">
                    <?php echo nl2br(htmlspecialchars($post['contenido'])); ?>
                </div>
                
                <div class="flex items-center gap-4 text-gray-500">
                    <button class="flex items-center gap-1 hover:text-naranja">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a12 12 0 0114.264 0M6.75 9.75a9 9 0 0110.5 0M9 12.75a6 6 0 018 0M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Me gusta</span>
                    </button>
                    <button class="flex items-center gap-1 hover:text-naranja">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span><?php echo count($comentarios); ?> comentarios</span>
                    </button>
                </div>
            </div>
            
            <!-- Comentarios -->
            <div class="border-t bg-gray-50">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Comentarios</h2>
                    
                    <?php if (empty($comentarios)): ?>
                        <div class="text-gray-500 italic mb-6">
                            No hay comentarios aún. ¡Sé el primero en comentar!
                        </div>
                    <?php else: ?>
                        <div class="space-y-4 mb-6">
                            <?php foreach($comentarios as $comentario): ?>
                                <div class="bg-white p-4 rounded-lg shadow">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="font-medium"><?php echo htmlspecialchars($comentario['autor_nombre']); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo date('d/m/Y H:i', strtotime($comentario['fecha_creacion'])); ?></div>
                                    </div>
                                    <p class="text-gray-700"><?php echo nl2br(htmlspecialchars($comentario['contenido'])); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <form action="index.php?controller=foro&action=agregarComentario" method="post" class="bg-white p-4 rounded-lg shadow">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <div class="mb-4">
                                <label for="contenido" class="block text-sm font-medium text-gray-700 mb-1">Tu comentario</label>
                                <textarea name="contenido" id="contenido" rows="3" class="w-full border border-gray-300 rounded-md p-2" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-naranja text-white rounded-md hover:bg-amber-600">Publicar comentario</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="bg-white p-4 rounded-lg shadow text-center">
                            <p class="mb-2">Necesitas iniciar sesión para comentar</p>
                            <a href="index.php?controller=auth&action=login" class="inline-block px-4 py-2 bg-naranja text-white rounded-md hover:bg-amber-600">Iniciar sesión</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <a href="index.php?controller=foro&action=index" class="inline-block px-4 py-2 border border-naranja text-naranja rounded-md hover:bg-naranja hover:text-white">
                Volver al foro
            </a>
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