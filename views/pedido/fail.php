<h3 class="titulos">ESTATUS DEL PEDIDO</h3>
<p>
    <strong><?= $_SESSION['pedido_no_guardado'] ?></strong>
</p>
<br>
<a href="<?= base_url ?>carrito/index" class="button button-categoria" style="width: 220px;">Volver al carrito de compras</a>
<?php Utils::deleteSession('pedido_no_guardado')?>