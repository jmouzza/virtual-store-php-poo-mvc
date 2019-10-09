<div id="contenedor_detalle_producto">
    <img src="<?=base_url?>uploads/images/<?= $show_product->imagen?>"/>
    <div id="detalle_producto">
        <h2 id="nombre_producto_detalle"><?= $show_product->nombre ?></h2>
        <!--<p style="font-weight: bold; color: #01B1EA;">Categoría: <?= $producto->categoria ?></p>-->
        
        <p><?= $show_product->descripcion ?></p>
        <?php if ($show_product->oferta > 0): ?>
        <p>Precio original: CLP <?= Utils::formatoNumeros($show_product->precio) ?></p>
        <p style="font-style: italic; color: #009900;">Descuento: CLP <?= Utils::formatoNumeros($show_product->oferta) ?></p>
        <p style="font-weight: bold; color: #01B1EA;">Precio en oferta: CLP <?= Utils::formatoNumeros($show_product->precio - $show_product->oferta) ?></p>
        <?php else: ?>
            <p style="font-weight: bold; color: #01B1EA;">Precio: CLP <?= Utils::formatoNumeros($show_product->precio) ?></p>
        <?php endif; ?>
        <a href="<?=base_url?>carrito/add&id=<?= $show_product->id ?>" class="button">COMPRAR</a>

    </div>
</div>
