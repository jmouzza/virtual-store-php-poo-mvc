<h3 class="titulos">Gestionar Pedidos</h3>
<br/>
<table id="tabla_carrito">
    <tr>
        <th>Nro. Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Status</th>
    </tr>
    <?php while($pedido = $pedidos->fetch_object()):?> 
    <tr>
        <td><a href="<?=base_url?>pedido/detail&id=<?= $pedido->id?>"><?= $pedido->id ?></a></td>
        <td><?= Utils::formatoNumeros($pedido->coste) ?></td>
        <td><?= $pedido->fecha ?></td>
        <td><?= $pedido->estado ?></td>
    </tr>
    <?php endwhile;?>
</table>
