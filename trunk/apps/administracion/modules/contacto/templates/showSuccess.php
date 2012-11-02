<?php use_helper('Date') ?>
<div>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($contacto->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($contacto->getUpdatedAt(), 'p') ?>    </br>   
        <label>Nombre de contacto: </label>    <?php echo $contacto->getNombre() ?></br>
        <label>Email del contacto: </label>    <?php echo $contacto->getEmail() ?></br>
        <label>Teléfono del contacto: </label>    <?php echo $contacto->getTelefono() ?></br>
        <?php if($contacto->getEmpresa()){ ?>
        <label>Empresa del contacto: </label>    <?php echo $contacto->getEmpresa() ?></br>
                <?php if($contacto->getDocumento()){ ?>
       <div style="text-align: center;"><a target="_blank" href="<?php echo '/uploads/documentos/'.$contacto->getDocumento(); ?>">Enlace a documento</a></div>     
        <?php } ?>
        <?php } ?>
    </div>
    </br>

        <label>Comentario del contacto: </label> <?php echo nl2br(html_entity_decode($contacto->getComentario(), ENT_COMPAT , 'UTF-8')); ?></br>

</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('contacto/edit?id='.$contacto->getId()) ?>">Editar</a>
</div>