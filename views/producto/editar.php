
<h2 class="titulos">Editar Producto</h2>
<?php while($info_producto = $edit->fetch_object()): ?>
<form action="<?=base_url?>producto/update&id=<?= $info_producto->id;?>" method="post" enctype="multipart/form-data">
    <label for="categoria_id">Categoría</label>
    <select name="categoria_id">
        <?php while($categoria = $categorias->fetch_object()): ?>
        <option value="<?= $categoria->id ?>" <?php if($categoria->id == $info_producto->categoria_id){echo 'selected';} ?>>
                <?=$categoria->nombre?>
        </option>  
        <?php endwhile; ?>
    </select>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?= $info_producto->nombre ?>" required/>
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" value="<?= $info_producto->descripcion ?>" required/>
    <label for="precio">Precio</label>
    <input type="number" name="precio" value="<?= $info_producto->precio ?>" required/>
    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?= $info_producto->stock ?>" required/>
    <label for="oferta">Oferta</label>
    <input type="number" name="oferta" value="<?= $info_producto->oferta ?>"/>
    <label for="imagen">Imagen Actual</label>
    <?php if(!empty($info_producto->imagen)): ?>
    <img class="imagen_formulario" src="<?=base_url?>uploads/images/<?= $info_producto->imagen ?>"/>
    <?php endif; ?>
    <input type="file" name="imagen" />
    <?php endwhile; ?>
    <input type="submit" value="Actualizar"/>
</form>