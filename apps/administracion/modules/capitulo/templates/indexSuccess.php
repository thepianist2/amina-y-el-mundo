<?php
use_helper('Date') ?>
<?php if($episodio){ ?>
<h1>Capitulos del episodio: <?php echo $episodio->getTitulo(); ?></h1>
<?php }else{ ?>
<h1>Todos los capitulos</h1>
<?php } ?>
<div id="buscador">
<?php include_partial('capitulo/buscador', array('query' => $query)); ?>
</div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $capitulos, 'action' => $action)) ?>
<br></br>
<div class="enlaces-centro">
  <?php echo link_to(image_tag('iconos/volver.png').'Ir al listado de Episodios', 'episodio/indexTodos', array('title' => 'Volver')) ?>    
  <?php echo link_to(image_tag('iconos/experiencias.png').'Todos los capitulos', 'capitulo/indexTodos', array('title' => 'Mostrar todos los capitulos')) ?>    
  <?php if($episodio){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'capitulo/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'capitulo/newSinIdEpisodio', array('title' => 'Nuevo')) ?>
    
    <?php } ?>
</div>
<br></br>
<table class="listado contenido">
  <thead>
    <tr>
      <th>Del Episodio</th>
      <th>Título</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Activa</th>
      <th>Creado en</th>
      <th>Videos</th>
      <th>Fotografias</th>
      <th colspan="3"><?php echo 'Acciones'?></th>            
    </tr>
  </thead>
  <tbody>
      <?php $i = 1 ?>  
    <?php foreach ($capitulos as $capitulo): ?>
      <tr id="<?php echo $capitulo->id ?>" class="<?php echo ($i % 2 == 0 ? 'par' : 'impar') ?>">
      <td><?php echo $capitulo->getEpisodio()->getTitulo() ?></td>
          <td><?php echo $capitulo->getTitulo() ?></td>
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_favorito_' . $capitulo->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($capitulo->getSoloAccesoPremium()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $capitulo->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $capitulo->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Capitulo solo acceso premium. Pulse para desactivar',
                                        "id" => "imagen_fav_" . $capitulo->id,
                                        "title" => 'Capitulo solo acceso premium. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('capitulo/switchValor?id='.$capitulo->id.'&variable=soloPremium&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $capitulo->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $capitulo->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $capitulo->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Capitulo acceso premium no activado. Pulse para activar',
                                        "id" => "imagen_fav_" . $capitulo->id,
                                        "title" => 'Capitulo acceso premium no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('capitulo/switchValor?id='.$capitulo->id.'&variable=soloPremium&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $capitulo->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?></td>

      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_logado_' . $capitulo->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($capitulo->getSoloAccesoLogado()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $capitulo->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $capitulo->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Capitulo solo acceso logado. Pulse para desactivar',
                                        "id" => "imagen_logado_" . $capitulo->id,
                                        "title" => 'Capitulo solo acceso logado. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('capitulo/switchValor?id='.$capitulo->id.'&variable=soloLogado&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $capitulo->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $capitulo->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $capitulo->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Capitulo acceso solo logado no activado. Pulse para activar',
                                        "id" => "imagen_logado_" . $capitulo->id,
                                        "title" => 'Capitulo acceso solo logado no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('capitulo/switchValor?id='.$capitulo->id.'&variable=soloLogado&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $capitulo->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      
      
      
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_activo_' . $capitulo->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($capitulo->getActivo()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $capitulo->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $capitulo->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Capitulo activo. Pulse para desactivar',
                                        "id" => "imagen_activo_" . $capitulo->id,
                                        "title" => 'Capitulo Activo. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('capitulo/switchValor?id='.$capitulo->id.'&variable=activo&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $capitulo->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $capitulo->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $capitulo->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Capitulo inactivo. Pulse para activar',
                                        "id" => "imagen_activo_" . $capitulo->id,
                                        "title" => 'Capitulo inactivo. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('capitulo/switchValor?id='.$capitulo->id.'&variable=activo&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $capitulo->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      <td><?php echo format_date($capitulo->getCreatedAt(), 'p') ?></td>
      <td><a href="<?php echo url_for('videoCapitulo/index?idCapitulo='.$capitulo->getId()) ?>"><?php echo  count(Doctrine_Core::getTable('Capitulo')->getVideos($capitulo->id));  ?></a></td>
      <td><a href="<?php echo url_for('fotografiaCapitulo/index?idCapitulo='.$capitulo->getId()) ?>"><?php echo  count(Doctrine_Core::getTable('Capitulo')->getFotografias($capitulo->id));  ?></a></td>

      <td class="accionListado"><a class="ver" id="<?php echo $capitulo->id ?>" href="javascript:void()"><img  title="Vista previa" alt="Vista previa" src="/images/iconos/vistaPrevia.png"></img></a></td>
      <td class="accionListado"><?php echo link_to(image_tag('iconos/editar.png', array('alt' => 'Editar Capitulo', 'title' => 'Editar Capitulo')), 'capitulo/edit?id='.$capitulo->id) ?>                 
      <td class="accionListado"><a href="javascript:void()" onclick="javascript:eliminar('<?php echo url_for('capitulo/delete?id='.$capitulo->id) ?>',<?php echo $capitulo->id ?>)"><img src="/images/iconos/borrar.png"></img></a></td>  
    </tr>
    <?php $i = $i + 1; ?>
    <?php endforeach; ?>
  </tbody>
</table>
<br></br>
<div class="enlaces-centro">
  <?php if($episodio){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'capitulo/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'capitulo/newSinIdEpisodio', array('title' => 'Nuevo')) ?>
    
    <?php } ?></div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $capitulos, 'action' => $action)) ?>
<br></br>

<div id="ajax-favoritos"></div>
<div id="eliminar" style="display: none;"></div>
<div id="ver" style="display: none;"></div>
<script type="text/javascript">


          $('.ver').click(function() {
        var id = $(this).attr('id');
        dialog = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('capitulo/show?id=') ?>'+id,
            async: false
        }).responseText;
        $('#ver').html(dialog);
        $("#ver").dialog({
            resizable: true,
            width: 800,
            modal: true,
            show: { effect: 'drop', direction: "up" },
            title: "<?php echo 'Capitulo'; ?>"
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
               $().toastmessage('showSuccessToast', "Capitulo Eliminado");
               
              
        }); 
        
   }
 }


</script>