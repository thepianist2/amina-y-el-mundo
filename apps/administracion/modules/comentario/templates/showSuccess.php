<?php use_helper('Date') ?>
<div>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($comentario->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($comentario->getUpdatedAt(), 'p') ?>    </br>   
    
    <label>Solo acceso premium: </label>    <?php echo $comentario->getSoloAccesoPremium() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Solo acceso logado: </label>    <?php echo $comentario->getSoloAccesoLogado() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Activa: </label>    <?php echo $comentario->getActivo() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Unidad Temática: </label>    <?php echo $comentario->getUnidadTematica()->getTitulo() ?>

    </div>
    <div>

       <?php echo nl2br(html_entity_decode($comentario->getPublicacion(), ENT_COMPAT , 'UTF-8')); ?>

    </div>
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('comentario/edit?id='.$comentario->getId()) ?>">Editar</a>
</div>