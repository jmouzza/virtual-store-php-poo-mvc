<h2 class="titulos">Gestión de Productos</h2>
<?php if(isset($_SESSION['producto_eliminado'])) : ?>
<h3 style="color: #0066cc;"><?= $_SESSION['producto_eliminado']; ?></h3>
<?php
Utils::deleteSession('producto_eliminado');
endif;
?>
<?php if(isset($_SESSION['producto_guardado'])): ?>
<h3 style="color: #0066cc;"><?= $_SESSION['producto_guardado']; ?></h3>
<?php
Utils::deleteSession('producto_guardado');
endif;
?>
<?php if(isset($_SESSION['updated'])): ?>
<h3 style="color: #0066cc;"><?= $_SESSION['updated']; ?></h3>
<?php
Utils::deleteSession('updated');
endif;
?>

<a href="<?=base_url?>producto/crear" class="button button-categoria">Crear Producto</a>

<table>
    <tr>
        <th>ID</th>
        <th>Producto</th>
        <th>Categoria</th>
        <th>Precio | CLP</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while($producto = $listado_productos->fetch_object()): ?>
    <tr>
        <td><?= $producto->id; ?></td>
        <td><?= $producto->nombre; ?></td>
        <td><?= $producto->categoria; ?></td>
        <td><?= Utils::formatoNumeros($producto->precio); ?></td>
        <?php if($producto->stock <= 10): ?>
        <td style="font-weight: bold; color:red;"><?= $producto->stock; ?></td>
        <?php else: ?>
        <td style="font-weight: bold; color:green;"><?= $producto->stock; ?></td>
        <?php endif; ?>
        
        <td>
            <a href="<?=base_url?>producto/editar&id=<?= $producto->id;?>" id="edicion_producto">Editar</a>
            <a href="<?=base_url?>producto/eliminar&id=<?= $producto->id;?>" id="eliminar_producto">Eliminar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
