<?php use_helper('Date') ?>
<?php if($episodio){ ?>
<h1>Juegos del Episodio: <?php echo $episodio->getTitulo(); ?></h1>
<?php }else{ ?>
<h1>Todos los Juegos de los Episodios</h1>
<?php } ?>
<div id="buscador">
<?php include_partial('juegoEpisodio/buscador', array('query' => $query)); ?>
</div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $juego_episodios, 'action' => $action)) ?>
<br></br>
<div class="enlaces-centro">
  <?php echo link_to(image_tag('iconos/volver.png').'Volver al listado de Episodios', 'episodio/index', array('title' => 'Volver')) ?>    
  <?php echo link_to(image_tag('iconos/experiencias.png').'Todos los juegos', 'juegoEpisodio/indexTodos', array('title' => 'Mostrar todos los juegos')) ?>    
  <?php if($episodio){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'juegoEpisodio/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'juegoEpisodio/newSinIdEpisodio', array('title' => 'Nuevo')) ?>
    
    <?php } ?>
</div>
<br></br>
<table class="listado contenido">
  <thead>
    <tr>
      <th>Episodio</th>
      <th>Título</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Activo</th>
      <th>Creado en</th>
      <th colspan="3"><?php echo 'Acciones'?></th>            
    </tr>
  </thead>
  <tbody>
      <?php $i = 1 ?>  
    <?php foreach ($juego_episodios as $juego): ?>
      <tr id="<?php echo $juego->id ?>" class="<?php echo ($i % 2 == 0 ? 'par' : 'impar') ?>">
      <td><?php echo $juego->getEpisodio()->getTitulo() ?></td>
          <td><?php echo $juego->getTitulo() ?></td>
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_favorito_' . $juego->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($juego->getSoloAccesoPremium()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $juego->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $juego->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Juego solo acceso premium. Pulse para desactivar',
                                        "id" => "imagen_fav_" . $juego->id,
                                        "title" => 'Juego solo acceso premium. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('juegoEpisodio/switchValor?id='.$juego->id.'&variable=soloPremium&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $juego->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $juego->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $juego->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Juego acceso premium no activado. Pulse para activar',
                                        "id" => "imagen_fav_" . $juego->id,
                                        "title" => 'Juego acceso premium no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('juegoEpisodio/switchValor?id='.$juego->id.'&variable=soloPremium&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $juego->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?></td>

      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_logado_' . $juego->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($juego->getSoloAccesoLogado()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $juego->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $juego->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Juego solo acceso logado. Pulse para desactivar',
                                        "id" => "imagen_logado_" . $juego->id,
                                        "title" => 'Juego solo acceso logado. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('juegoEpisodio/switchValor?id='.$juego->id.'&variable=soloLogado&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $juego->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $juego->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $juego->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Juego acceso solo logado no activado. Pulse para activar',
                                        "id" => "imagen_logado_" . $juego->id,
                                        "title" => 'Juego acceso solo logado no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('juegoEpisodio/switchValor?id='.$juego->id.'&variable=soloLogado&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $juego->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      
      
      
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_activo_' . $juego->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($juego->getActivo()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $juego->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $juego->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Juego activo. Pulse para desactivar',
                                        "id" => "imagen_activo_" . $juego->id,
                                        "title" => 'Juego Activo. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('juegoEpisodio/switchValor?id='.$juego->id.'&variable=activo&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $juego->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $juego->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $juego->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Juego inactivo. Pulse para activar',
                                        "id" => "imagen_activo_" . $juego->id,
                                        "title" => 'Juego inactivo. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('juegoEpisodio/switchValor?id='.$juego->id.'&variable=activo&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $juego->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      <td><?php echo format_date($juego->getCreatedAt(), 'p') ?></td>
      <td class="accionListado"><a class="ver" id="<?php echo $juego->id ?>" href="javascript:void()"><img  title="Vista previa" alt="Vista previa" src="/images/iconos/vistaPrevia.png"></img></a></td>
      <td class="accionListado"><?php echo link_to(image_tag('iconos/editar.png', array('alt' => 'Editar Juego', 'title' => 'Editar Juego')), 'juegoEpisodio/edit?id='.$juego->id) ?>                 
      <td class="accionListado"><a href="javascript:void()" onclick="javascript:eliminar('<?php echo url_for('juegoEpisodio/delete?id='.$juego->id) ?>',<?php echo $juego->id ?>)"><img src="/images/iconos/borrar.png"></img></a></td>  
    </tr>
    <?php $i = $i + 1; ?>
    <?php endforeach; ?>
  </tbody>
</table>
<br></br>
<div class="enlaces-centro">
  <?php if($episodio){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nueva', 'juegoEpisodio/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nueva', 'juegoEpisodio/newSinIdEpisodio', array('title' => 'Nuevo')) ?>
    
    <?php } ?></div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $juego_episodios, 'action' => $action)) ?>
<br></br>

<div id="ajax-favoritos"></div>
<div id="eliminar" style="display: none;"></div>
<div id="ver" style="display: none;"></div>
<script type="text/javascript">


          $('.ver').click(function() {
        var id = $(this).attr('id');
        dialog = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('juegoEpisodio/show?id=') ?>'+id,
            async: false
        }).responseText;
        $('#ver').html(dialog);
        $("#ver").dialog({
            resizable: true,
            width: 800,
            modal: true,
            show: { effect: 'drop', direction: "up" },
            title: "<?php echo 'Juego'; ?>"
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
               $().toastmessage('showSuccessToast', "Juego Eliminado");
               
              
        }); 
        
   }
 }


</script>