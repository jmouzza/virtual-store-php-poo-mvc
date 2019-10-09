<h3 class="titulos">ESTATUS DEL PEDIDO</h3>
<p>
    <strong><?= $_SESSION['pedido_guardado'] ?></strong>
</p>
<br>
<a href="<?= base_url ?>" class="button button-categoria" style="width: 220px;">Volver a la tienda</a>
<?php Utils::deleteSession('pedido_guardado')?>
<?php Utils::deleteSession('carrito')?>