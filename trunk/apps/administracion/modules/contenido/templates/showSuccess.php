<?php use_helper('Date') ?>
<h1><?php echo $contenido->getTitulo(); ?></h1>
<div>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($contenido->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($contenido->getUpdatedAt(), 'p') ?>    </br>   
    
    <label>Activa: </label>    <?php echo $contenido->getActivo() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Categoria: </label>    <?php echo $contenido->getCategoriaContenido()->getTexto() ?>

    </div>
    <div>

       <?php echo nl2br(html_entity_decode($contenido->getContenido(), ENT_COMPAT , 'UTF-8')); ?>

    </div>
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('comentario/edit?id='.$contenido->getId()) ?>">Editar</a>
</div>