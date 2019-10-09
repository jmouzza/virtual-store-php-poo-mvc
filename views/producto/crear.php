
<h2 class="titulos">Crear Producto</h2>
<form action="<?= base_url?>producto/save" method="post" enctype="multipart/form-data">
    <label for="categoria_id">Categoría</label>
    <select name="categoria_id">
        <?php while($categoria = $categorias->fetch_object()): ?>
        <option value="<?= $categoria->id ?>">
                <?=$categoria->nombre?>
        </option>  
        <?php endwhile; ?>
    </select>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required/>
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" required/>
    <label for="precio">Precio</label>
    <input type="number" name="precio" required/>
    <label for="stock">Stock</label>
    <input type="number" name="stock" required/>
    <label for="oferta">Oferta</label>
    <input type="number" name="oferta"/>
    <label for="imagen">Imagen</label>
    <input type="file" name="imagen"/>
    <input type="submit" value="Guardar"/>
</form>