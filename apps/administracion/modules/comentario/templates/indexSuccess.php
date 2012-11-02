<?php use_helper('Date') ?>
<?php if($unidad_tematica){ ?>
<h1>Comentarios de la unidad temática: <?php echo $unidad_tematica->getTitulo(); ?></h1>
<?php }else{ ?>
<h1>Todos los comentarios</h1>
<?php } ?>
<div id="buscador">
<?php include_partial('comentario/buscador', array('query' => $query)); ?>
</div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $comentarios, 'action' => $action)) ?>
<br></br>
<div class="enlaces-centro">
  <?php echo link_to(image_tag('iconos/volver.png').'Volver al listado de Unidades Temáticas', 'default/index', array('title' => 'Volver')) ?>    
  <?php echo link_to(image_tag('iconos/experiencias.png').'Todos los comentarios', 'comentario/indexTodos', array('title' => 'Mostrar todos los comentarios')) ?>    
  <?php if($unidad_tematica){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'comentario/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'comentario/newSinIdUnidad', array('title' => 'Nuevo')) ?>
    
    <?php } ?>
</div>
<br></br>
<table class="listado contenido">
  <thead>
    <tr>
      <th>Unidad temática</th>
      <th>Usuario</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Activa</th>
      <th>Creado en</th>
      <th colspan="3"><?php echo 'Acciones'?></th>            
    </tr>
  </thead>
  <tbody>
      <?php $i = 1 ?>  
    <?php foreach ($comentarios as $comentario): ?>
      <tr id="<?php echo $comentario->id ?>" class="<?php echo ($i % 2 == 0 ? 'par' : 'impar') ?>">
      <td><?php echo $comentario->getUnidadTematica()->getTitulo() ?></td>
      <td><a class="verUsuario" id="<?php echo $comentario->getSfGuardUser()->id ?>" href="javascript:void()"><?php echo $comentario->getSfGuardUser()->getUsername()."<br><br>".$comentario->getSfGuardUser()->getEmailAddress() ?></a></td>
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_favorito_' . $comentario->id . '" href="javascript:void()" ';
                                        //si es premium mostramos un icono correspondiente
					if ($comentario->getSoloAccesoPremium()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $comentario->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $comentario->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Comentario solo acceso premium. Pulse para desactivar',
                                        "id" => "imagen_fav_" . $comentario->id,
                                        "title" => 'Comentario solo acceso premium. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('comentario/switchValor?id='.$comentario->id.'&variable=soloPremium&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $comentario->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $comentario->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $comentario->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Comentario acceso premium no activado. Pulse para activar',
                                        "id" => "imagen_fav_" . $comentario->id,
                                        "title" => 'Comentario acceso premium no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('comentario/switchValor?id='.$comentario->id.'&variable=soloPremium&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $comentario->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?></td>

      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_logado_' . $comentario->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($comentario->getSoloAccesoLogado()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $comentario->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $comentario->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Comentario solo acceso logado. Pulse para desactivar',
                                        "id" => "imagen_logado_" . $comentario->id,
                                        "title" => 'Comentario solo acceso logado. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('comentario/switchValor?id='.$comentario->id.'&variable=soloLogado&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $comentario->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $comentario->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $comentario->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Comentario acceso solo logado no activado. Pulse para activar',
                                        "id" => "imagen_logado_" . $comentario->id,
                                        "title" => 'Comentario acceso solo logado no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('comentario/switchValor?id='.$comentario->id.'&variable=soloLogado&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $comentario->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      
      
      
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_activo_' . $comentario->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($comentario->getActivo()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $comentario->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $comentario->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Comentario activo. Pulse para desactivar',
                                        "id" => "imagen_activo_" . $comentario->id,
                                        "title" => 'Comentario Activo. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('comentario/switchValor?id='.$comentario->id.'&variable=activo&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $comentario->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $comentario->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $comentario->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Comentario inactivo. Pulse para activar',
                                        "id" => "imagen_activo_" . $comentario->id,
                                        "title" => 'Comentario inactivo. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('comentario/switchValor?id='.$comentario->id.'&variable=activo&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $comentario->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      <td><?php echo format_date($comentario->getCreatedAt(), 'p') ?></td>

      <td class="accionListado"><a class="ver" id="<?php echo $comentario->id ?>" href="javascript:void()"><img  title="Vista previa" alt="Vista previa" src="/images/iconos/vistaPrevia.png"></img></a></td>
      <td class="accionListado"><?php echo link_to(image_tag('iconos/editar.png', array('alt' => 'Editar Comentario', 'title' => 'Editar Comentario')), 'comentario/edit?id='.$comentario->id) ?>                 
      <td class="accionListado"><a href="javascript:void()" onclick="javascript:eliminar('<?php echo url_for('comentario/delete?id='.$comentario->id) ?>',<?php echo $comentario->id ?>)"><img src="/images/iconos/borrar.png"></img></a></td>  
    </tr>
    <?php $i = $i + 1; ?>
    <?php endforeach; ?>
  </tbody>
</table>
<br></br>
<div class="enlaces-centro">
  <?php if($unidad_tematica){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'comentario/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'comentario/newSinIdUnidad', array('title' => 'Nuevo')) ?>
    
    <?php } ?></div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $comentarios, 'action' => $action)) ?>
<br></br>

<div id="ajax-favoritos"></div>
<div id="eliminar" style="display: none;"></div>
<div id="ver" style="display: none;"></div>
<script type="text/javascript">


          $('.ver').click(function() {
        var id = $(this).attr('id');
        dialog = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('comentario/show?id=') ?>'+id,
            async: false
        }).responseText;
        $('#ver').html(dialog);
        $("#ver").dialog({
            resizable: true,
            width: 800,
            modal: true,
            show: { effect: 'drop', direction: "up" },
            title: "<?php echo 'Comentario'; ?>"
        });
    }); 




         $('.verUsuario').click(function() {
        var id = $(this).attr('id');
        dialog = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('usuario/show?id=') ?>'+id,
            async: false
        }).responseText;
        $('#ver').html(dialog);
        $("#ver").dialog({
            resizable: true,
            width: 800,
            modal: true,
            show: { effect: 'drop', direction: "up" },
            title: "<?php echo 'Detalles del usuario'; ?>"
        });
    }); 




function switchPremium(url,imagen,id_inmueble)
{
//    if($('#imagen_fav_'+id_inmueble).attr('src') == imagen) {
//        if (confirm("¿Desea realizar este cambio?")) {
            $('#ajax-favoritos').load(url,{},function() {
                $('#imagen_fav_'+id_inmueble).attr('src',imagen);
                $('#icono_favorito_'+id_inmueble).attr('onmouseover','');
                $('#icono_favorito_'+id_inmueble).attr('onmouseout','');
                $('#imagen_fav_'+id_inmueble).attr('title','');
                $('#imagen_fav_'+id_inmueble).attr('alt','');
                //para lo contrario activar desactivar
//                 setTimeout("refrescar()",1500)
//                $().toastmessage('showSuccessToast', "Cambio realizado");
    window.location.reload();
            });
//        }      
//    }
}


function refrescar(){
    window.location.reload();
}

function switchLogado(url,imagen,id_inmueble)
{
//    if($('#imagen_fav_'+id_inmueble).attr('src') == imagen) {
//        if (confirm("¿Desea realizar este cambio?")) {
            $('#ajax-favoritos').load(url,{},function() {
                $('#imagen_logado_'+id_inmueble).attr('src',imagen);
                $('#icono_logado_'+id_inmueble).attr('onmouseover','');
                $('#icono_logado_'+id_inmueble).attr('onmouseout','');
                $('#imagen_logado_'+id_inmueble).attr('title','');
                $('#imagen_logado_'+id_inmueble).attr('alt','');
                //para lo contrario activar desactivar
//                 setTimeout("refrescar()",1500)
//                $().toastmessage('showSuccessToast', "Cambio realizado");
    window.location.reload();
            });
//        }      
//    }
}

function switchActivo(url,imagen,id_inmueble)
{
//    if($('#imagen_fav_'+id_inmueble).attr('src') == imagen) {
//        if (confirm("¿Desea realizar este cambio?")) {
            $('#ajax-favoritos').load(url,{},function() {
                $('#imagen_activo_'+id_inmueble).attr('src',imagen);
                $('#icono_activo_'+id_inmueble).attr('onmouseover','');
                $('#icono_activo_'+id_inmueble).attr('onmouseout','');
                $('#imagen_activo_'+id_inmueble).attr('title','');
                $('#imagen_activo_'+id_inmueble).attr('alt','');
//                //para lo contrario activar desactivar
//                 setTimeout("refrescar()",1500)
//                $().toastmessage('showSuccessToast', "Cambio realizado");
    window.location.reload();
            });
//        }      
//    }
}


            function eliminar(url,idImagen){
                if (confirm("¿Desea eliminar esto?")) {
           $('#eliminar').load(url,{},function() {  
               $('#'+idImagen).hide("slow");
                //para lo contrario activar desactivar
//                window.location.reload();
               $().toastmessage('showSuccessToast', "Comentario Eliminado");
               
              
        }); 
        
   }
 }


</script>