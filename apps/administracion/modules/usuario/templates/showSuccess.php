<?php use_helper('Date') ?>
<div>
    <?php if($sf_guard_user->getImagenPerfil()){ ?>
    <div style="text-align: center;"><a target="_blank" href="<?php echo '/uploads/'.$sf_guard_user->getImagenPerfil(); ?>"><img  style="width: 300px; height: 300px;" src="<?php echo '/uploads/'.$sf_guard_user->getImagenPerfil(); ?>"></img></a></div>
<?php }else{ ?>
<div style="text-align: center;"><img style="width: 300px; height: 300px;" src="<?php echo '/images/imagenPerfil.jpg'; ?>"></img></div>    
    <?php } ?><br>
    <div style="background-color: greenyellow;">
    <label>Nombre usuario: </label>    <?php echo $sf_guard_user->getUserName() ?></br>
    <label>Email: </label>    <?php echo $sf_guard_user->getEmailAddress() ?></br>
    <label>Nombres: </label>    <?php echo $sf_guard_user->getFirstName() ?></br>
    <label>Apellidos: </label>    <?php echo $sf_guard_user->getLastName() ?>   </br> 
    <?php echo "Creado en: ". format_date($sf_guard_user->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($sf_guard_user->getUpdatedAt(), 'p') ?>    </br>   
    <?php echo "Último login: ". format_date($sf_guard_user->getLastLogin(), 'p') ?>    </br>   
   </br>   
    <label>Es administrador: </label>    <?php echo $sf_guard_user->getIsSuperAdmin() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>

    <label>Es usuario premium: </label>    <?php echo $sf_guard_user->getEsPremium() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    
    <label>Activo: </label>    <?php echo $sf_guard_user->getIsActive() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>


    </div>
    
</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('usuario/edit?id='.$sf_guard_user->getId()) ?>">Editar</a>
</div>