<?php if(isset($_SESSION['categoria_guardada'])) : ?>
<h2><?= $_SESSION['categoria_guardada'] ?></h2>
<?php
Utils::deleteSession('categoria_guardada');
else: ?>
<h2 class="titulos">Crear categoría</h2>
<form action="<?=base_url?>categoria/save" method="post">
    <label for="nombre">Nombre Categoría</label>
    <input type="text" name="nombre" required/>
    <?php if(isset($_SESSION['error_crearCategoria'])) : ?>
    <p style="margin-left: 100px; color: red;"><?= $_SESSION['error_crearCategoria'] ?></p>
    <?php 
     Utils::deleteSession('error_crearCategoria');
    endif; ?>
    <input id="boton_crear_categoria" type="submit" value="Crear"/>
</form>
<?php endif; ?>