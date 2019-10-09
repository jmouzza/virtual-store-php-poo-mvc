<h3 class="titulos">Carrito de compra</h3>

<table id="tabla_carrito">
    <tr>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Precio por unidad</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>
    <?php
    foreach ($carrito as $indice => $elemento):
        $producto = $elemento['producto'];
        ?> 
        <tr>
            <td><img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>"></td>
            <td>
                <?= $producto->nombre ?>
                <?php if ($producto->oferta > 0): ?>
                    <strong style="color: #01B1EA;"> (Oferta) </strong> 
    <?php endif; ?>
            </td>
            <td><?= Utils::formatoNumeros($elemento['precio_final']) ?></td>
            <td id="tabla_updown_unidades">
                <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>">
                    <h4 class="updown_unidades">+</h4>
                </a>
                <span><?= $elemento['unidades'] ?></span>
                <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>">
                    <h4 class="updown_unidades">-</h4>
                </a>
            </td>
            <td>
                <a href="<?= base_url ?>carrito/remove&index=<?= $indice ?>">
                    <h4 id="quitar_producto">Quitar Producto</h4>
                </a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
<div id="estadisticas_carrito">
<?php $producto = Utils::statsCarrito(); ?>
    <h4>Total: CLP <?= Utils::formatoNumeros($producto['total']) ?></h4>
    <a href="<?= base_url ?>pedido/hacer">
        <h4 id="confirmar_pedido">Confirmar pedido</h4>
    </a>
    <a href="<?= base_url ?>carrito/delete">
        <h4 id="vaciar">Vaciar carrito</h4>
    </a>
</div>




