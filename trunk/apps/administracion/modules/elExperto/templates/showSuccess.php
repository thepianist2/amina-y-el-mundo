<?php use_helper('Date') ?>
<div>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($el_experto->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($el_experto->getUpdatedAt(), 'p') ?>    </br>   
    
    <label>Solo acceso premium: </label>    <?php echo $el_experto->getSoloAccesoPremium() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Solo acceso logado: </label>    <?php echo $el_experto->getSoloAccesoLogado() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Activa: </label>    <?php echo $el_experto->getActivo() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Capítulo: </label>    <?php echo $el_experto->getEpisodio()->getTitulo() ?>

    </div>
    <label>Descripción: </label>    <?php echo nl2br(html_entity_decode($el_experto->getDescripcion(), ENT_COMPAT , 'UTF-8')); ?> 
    <div>

       <?php echo nl2br(html_entity_decode($el_experto->getEnlaceVideo(), ENT_COMPAT , 'UTF-8')); ?>

    </div>
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('videoCapitulo/edit?id='.$el_experto->getId()) ?>">Editar</a>
</div>