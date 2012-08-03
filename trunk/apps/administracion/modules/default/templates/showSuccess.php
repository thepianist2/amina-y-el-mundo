<?php use_helper('Date') ?>
<div>
    <h1><?php echo $unidad_tematica->getTitulo(); ?></h1>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($unidad_tematica->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($unidad_tematica->getUpdatedAt(), 'p') ?>    </br>   
    
    <label>Solo acceso premium: </label>    <?php echo $unidad_tematica->getSoloAccesoPremium() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Solo acceso logado: </label>    <?php echo $unidad_tematica->getSoloAccesoLogado() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Activa: </label>    <?php echo $unidad_tematica->getActivo() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>

    </div>
    <div>

       <?php echo nl2br(html_entity_decode($unidad_tematica->getDescripcion(), ENT_COMPAT , 'UTF-8')); ?>

    </div>
    
    
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('default/edit?id='.$unidad_tematica->getId()) ?>">Editar</a>
</div>