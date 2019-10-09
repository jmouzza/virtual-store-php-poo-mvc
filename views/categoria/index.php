<?php if(isset($_SESSION['categorias_empty'])) : ?>
<h3> <?= $_SESSION['categorias_empty'] ?> </h3>
<?php Utils::deleteSession('categorias_empty');
elseif(isset($categorias)):?>

<h2 class="titulos">Gestionar Categorías</h2>
<a href="<?=base_url?>categoria/crear" class="button button-categoria">Crear Categoría</a>

<table id="table_categoria">
    <tr>
        <th id="table_categoria_first">ID</th>
        <th>Nombre de Categoría</th>
    </tr>
    <?php while($categoria = $categorias->fetch_object()): ?>
    <tr>
        <td><?= $categoria->id; ?></td>
        <td><a href="<?=base_url.'categoria/'.$categoria->id ?>"><?= $categoria->nombre; ?></a></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php endif; ?>
