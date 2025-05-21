<div class="bg-beige py-8">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <h1 class="text-2xl font-semibold text-naranja mb-6">Crear nuevo tema</h1>
                
                <form action="index.php?controller=foro&action=guardarPost" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input type="text" name="titulo" id="titulo" required 
                               class="w-full border border-gray-300 rounded-md p-2" 
                               placeholder="Escribe un título para tu tema">
                    </div>
                    
                    <div class="mb-4">
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <select name="categoria_id" id="categoria_id" required class="w-full border border-gray-300 rounded-md p-2">
                            <?php foreach($categorias as $id => $nombre): ?>
                                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="contenido" class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                        <textarea name="contenido" id="contenido" rows="8" required 
                                  class="w-full border border-gray-300 rounded-md p-2" 
                                  placeholder="Escribe el contenido de tu tema..."></textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1">Imagen (opcional)</label>
                        <input type="file" name="imagen" id="imagen" class="w-full border border-gray-300 rounded-md p-2"
                               accept="image/jpeg,image/png,image/gif">
                        <p class="text-xs text-gray-500 mt-1">Formatos permitidos: JPEG, PNG, GIF. Tamaño máximo: 2MB</p>
                    </div>
                    
                    <div class="flex justify-end gap-4">
                        <a href="index.php?controller=foro&action=index" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 bg-naranja text-white rounded-md hover:bg-amber-600">
                            Publicar tema
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>