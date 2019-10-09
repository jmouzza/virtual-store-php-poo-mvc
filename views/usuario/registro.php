<?php if(isset($_SESSION['sign_up_completed'])): ?>
    <h1><?= $_SESSION['sign_up_completed'] ?></h1>
    <?php Utils::deleteSession('sign_up_completed'); ?>
<?php elseif(isset($_SESSION['sign_up_failed'])): ?>
    <h1><?= $_SESSION['sign_up_failed'] ?></h1>
    <?php Utils::deleteSession('sign_up_failed'); ?>
<?php else: ?>
<h2 class="titulos">Registrarse</h2>
<form action="<?=base_url?>usuario/save" method="post">
    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required/>
    <?php if(isset($_SESSION['errores']['nombre'])):?>
    <p style="margin-left: 100px; color: red;"><?= $_SESSION['errores']['nombre'] ?></p>
    <?php endif;?>
    
    <label>Apellidos</label>
    <input type="text" name="apellidos" required/>
    <?php if(isset($_SESSION['errores']['apellidos'])):?>
    <p style="margin-left: 100px; color: red;"><?= $_SESSION['errores']['apellidos'] ?></p>
    <?php endif;?>
    
    <label for="email">Email</label>
    <input type="email" name="email" required/>
    <?php if(isset($_SESSION['errores']['email'])):?>
    <p style="margin-left: 100px; color: red;"><?= $_SESSION['errores']['email'] ?></p>
    <?php endif;?>
    
    <label for="password">Contraseña</label>
    <input type="password" name="password" required/>
    <?php if(isset($_SESSION['errores']['password'])):?>
    <p style="margin-left: 100px; color: red;"><?= $_SESSION['errores']['password'] ?></p>
    <?php endif;?>
    <?php Utils::deleteSession('errores') ?>
    <input type="submit" value="Registrarse"/>
</form>
<?php endif; ?>