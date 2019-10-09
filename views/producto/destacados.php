
<h2 class="titulos">Productos Destacados</h2>

<?php while($producto = $productos_destacados->fetch_object()): ?>
<div class="product">
    <a href="<?=base_url?>producto/detalle&id=<?= $producto->id ?>">
        <img src="<?=base_url?>uploads/images/<?= $producto->imagen?>"/>
        <h2><?= $producto->nombre?></h2>
        <p style="font-weight: bold; color: #01B1EA;">Categoría: <?= $producto->categoria?></p>
        <hr/>
        <p><?= $producto->descripcion?></p>
        <?php if($producto->oferta > 0): ?>
        <p>Precio original: CLP <?= Utils::formatoNumeros($producto->precio)?></p>
        <p style="font-style: italic; color: #009900;">Descuento: CLP <?= Utils::formatoNumeros($producto->oferta)?></p>
        <p style="font-weight: bold; color: #01B1EA;">Precio en oferta: CLP <?= Utils::formatoNumeros($producto->precio - $producto->oferta)?></p>
        <?php else: ?>

        <p style="font-weight: bold; color: #01B1EA;">Precio: CLP <?= Utils::formatoNumeros($producto->precio)?></p>
        <?php endif; ?>
    </a>
    <div class="div_comprar">
        <a href="<?=base_url?>carrito/add&id=<?= $producto->id ?>" class="button">COMPRAR</a>
    </div>
    
</div>
<?php endwhile; ?>

