<h3 class="titulos">Detalle del pedido <?= $pedido_id ?></h3>
<?php if(isset($_SESSION['identity_admin'])): ?>
<h4 style="margin-left: 95px;">Cambiar estado del pedido</h4>
<form action="<?=base_url?>pedido/estado" method="POST">
    <select name="estado">
        <option value="confirm">Pendiente</option>
        <option value="preparation">En preparación</option>
        <option value="ready">Preparado para enviar</option>
        <option value="sended">Enviado</option>
    </select>
    <input type="hidden" name="pedido_id" value="<?= $pedido_id ?>"/>
    <input type="submit" value="Cambiar estado"/>
</form>
<?php endif; ?>
<table id="tabla_carrito">
    <tr>
        <th>Usuario</th>
        <th>Unidades</th>
        <th>Producto</th>
        <th>Status</th>
        <th>Imagen</th>
    </tr>
    <?php while ($producto = $detalle_pedido->fetch_object()): ?> 
    <tr>
        <td><?= $producto->cliente ?></td>
        <td><?= $producto->unidades ?></td>
        <td><?= $producto->nombre ?></td>
        <td><?= $producto->estado ?></td>
        <td><img src="<?=base_url?>uploads/images/<?= $producto->imagen ?>"></td>
    </tr>
    <?php endwhile;?>
</table>