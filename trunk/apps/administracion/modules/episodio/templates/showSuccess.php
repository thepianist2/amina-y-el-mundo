<?php use_helper('Date') ?>
<div>
    <h1><?php echo $episodio->getTitulo(); ?></h1>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($episodio->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($episodio->getUpdatedAt(), 'p') ?>    </br>   
    
    <label>Solo acceso premium: </label>    <?php echo $episodio->getSoloAccesoPremium() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Solo acceso logado: </label>    <?php echo $episodio->getSoloAccesoLogado() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Activa: </label>    <?php echo $episodio->getActivo() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>

    </div>
    <div>

       <?php echo nl2br(html_entity_decode($episodio->getDescripcion(), ENT_COMPAT , 'UTF-8')); ?>

    </div>
    <label>Vídeo: </label>
    <div>

       <?php echo nl2br(html_entity_decode($episodio->getEnlaceVideo(), ENT_COMPAT , 'UTF-8')); ?>

    </div> 
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('episodio/edit?id='.$episodio->getId()) ?>">Editar</a>
</div>