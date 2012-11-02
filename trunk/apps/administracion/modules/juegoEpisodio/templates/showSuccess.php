<?php use_helper('Date') ?>
<div>
    <h1><?php echo $juego_episodio->getTitulo(); ?></h1>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($juego_episodio->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($juego_episodio->getUpdatedAt(), 'p') ?>    </br>   
    
    <label>Solo acceso premium: </label>    <?php echo $juego_episodio->getSoloAccesoPremium() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Solo acceso logado: </label>    <?php echo $juego_episodio->getSoloAccesoLogado() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Activa: </label>    <?php echo $juego_episodio->getActivo() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>

    </div>
    <div>

       <?php echo nl2br(html_entity_decode($juego_episodio->getDescripcion(), ENT_COMPAT , 'UTF-8')); ?>

    </div>
    <label>Juego: </label>
    <div>     
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10.0.0.0" width="550" height="400">
    <param name="movie" value="<?php echo '/uploads/juegoEpisodio/'.$juego_episodio->getArchivoFlash(); ?>" />
    <param name="quality" value="high" />
    <embed src="<?php echo '/uploads/juegoEpisodio/'.$juego_episodio->getArchivoFlash(); ?>" quality="high" type="application/x-shockwave-flash" width="550" height="400" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
    </object>

    </div> 
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('juegoEpisodio/edit?id='.$juego_episodio->getId()) ?>">Editar</a>
</div>