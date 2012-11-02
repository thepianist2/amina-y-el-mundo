<?php use_helper('Date') ?>
<div>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($video_capitulo->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($video_capitulo->getUpdatedAt(), 'p') ?>    </br>   
    
    <label>Solo acceso premium: </label>    <?php echo $video_capitulo->getSoloAccesoPremium() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Solo acceso logado: </label>    <?php echo $video_capitulo->getSoloAccesoLogado() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Activa: </label>    <?php echo $video_capitulo->getActivo() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Capítulo: </label>    <?php echo $video_capitulo->getCapitulo()->getTitulo() ?>

    </div>
    <label>Descripción: </label>    <?php echo nl2br(html_entity_decode($video_capitulo->getDescripcion(), ENT_COMPAT , 'UTF-8')); ?> 
    <div>

       <?php echo nl2br(html_entity_decode($video_capitulo->getEnlaceVideo(), ENT_COMPAT , 'UTF-8')); ?>

    </div>
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('videoCapitulo/edit?id='.$video_capitulo->getId()) ?>">Editar</a>
</div>