<?php use_helper('Date') ?>
<div>
    <h1><?php echo $categoria_contenido->getTexto(); ?></h1>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($categoria_contenido->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($categoria_contenido->getUpdatedAt(), 'p') ?>    </br>   

    </div>
    <div>

       <?php echo "Nombre de categoría: ". $categoria_contenido->getTexto(); ?>

    </div>
    
    
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('categoriaContenido/edit?id='.$categoria_contenido->getId()) ?>">Editar</a>
</div>