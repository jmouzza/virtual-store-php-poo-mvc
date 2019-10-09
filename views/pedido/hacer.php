<h3 class="titulos">Hacer Pedido</h3>
<?php if (isset($_SESSION['identity'])): ?>
    <a href="<?= base_url ?>carrito/index" class="button button-categoria" style="width: 220px;">Volver al carrito de compras</a>    
    <p style="margin-top: 20px; margin-left : 95px; font-weight: bold;">Dirección de Envío</p>
    <form action="<?= base_url ?>pedido/add" method="POST">
        <label for="region">Región</label>
        <input type="text" name="region" required/>
        <label for="comuna">Comuna</label>
        <input type="text" name="comuna" required/>
        <label for="direccion">Dirección (Calle o Avenida/Número domicilio/Número Departamento o Casa)</label>
        <input type="text" name="direccion"/>
        <input type="submit" value="Confirmar pedido" required/>
    </form>

<?php else: ?>
    <h4 style="text-align: center;">Ingresa con tu usuario y contraseña para poder continuar</h4>
<?php endif; ?>
