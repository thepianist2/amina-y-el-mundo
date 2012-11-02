<?php use_helper('Date') ?>
<?php if($episodio){ ?>
<h1>Contenido del padres y profesores: <?php echo $episodio->getTitulo(); ?></h1>
<?php }else{ ?>
<h1>Contenidos de padres y profesores episodio</h1>
<?php } ?>
<div id="buscador">
<?php include_partial('contenidoPadresYProfesores/buscador', array('query' => $query)); ?>
</div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $contenido_padres_y_profesoress, 'action' => $action)) ?>
<br></br>
<div class="enlaces-centro">
  <?php echo link_to(image_tag('iconos/volver.png').'Volver al listado de Episodios', 'episodio/index', array('title' => 'Volver')) ?>    
  <?php echo link_to(image_tag('iconos/experiencias.png').'Todos los contenidos de padres y profesores', 'contenidoPadresYProfesores/indexTodos', array('title' => 'Mostrar todos los contenidos de padres y profesores')) ?>    
  <?php if($episodio){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'contenidoPadresYProfesores/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'contenidoPadresYProfesores/newSinIdEpisodio', array('title' => 'Nuevo')) ?>
    
    <?php } ?>
</div>
<br></br>
<table class="listado contenido">
  <thead>
    <tr>
      <th>Episodio</th>
      <th>Título</th>
      <th>Vídeo</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Activo</th>
      <th>Creado en</th>
      <th>Fotografías</th>
      <th colspan="3"><?php echo 'Acciones'?></th>            
    </tr>
  </thead>
  <tbody>
      <?php $i = 1 ?>  
    <?php foreach ($contenido_padres_y_profesoress as $contenido_padres_y_profesores): ?>
      <tr id="<?php echo $contenido_padres_y_profesores->id ?>" class="<?php echo ($i % 2 == 0 ? 'par' : 'impar') ?>">
      <td><?php echo $contenido_padres_y_profesores->getEpisodio()->getTitulo() ?></td>
      <td><?php echo $contenido_padres_y_profesores->getTitulo() ?></td>
      
                <?php
      //poner tamaño a 400 por 250
      //obtenemos la posicion de width
      $posicionCadenaWidth=strpos($contenido_padres_y_profesores->getEnlaceVideo(), "width=") ;
      $posicionCadenaHeight=strpos($contenido_padres_y_profesores->getEnlaceVideo(), "height=") ;
      //vamos a la posicion de width y obtenemos todo el width completo
      $variableWidth=substr($contenido_padres_y_profesores->getEnlaceVideo(), $posicionCadenaWidth, 22) ;
      $variableHeight=substr($contenido_padres_y_profesores->getEnlaceVideo(), $posicionCadenaHeight, 22) ;
      //variable de cadena para reemplazar
      $reemplazoWidth="width=\"300\"";
      $reemplazoHeight="height=\"150\"";
      //reemplazamos variable width con todo por otro texto con el tamaño indicado
      $codigo=str_replace($variableWidth,$reemplazoWidth,$contenido_padres_y_profesores->getEnlaceVideo()) ;
      $codigo=str_replace($variableHeight,$reemplazoHeight,$codigo) ;
      ?>
      <td><?php 
      //si la longitud de string es mayor de 40 entonces es un iframe,sino no es nada.
      if(strlen($codigo)>40){
          echo nl2br(html_entity_decode($codigo, ENT_COMPAT , 'UTF-8')); 
      }else{
          echo "";
      }
      ?>
      </td>
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_favorito_' . $contenido_padres_y_profesores->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($contenido_padres_y_profesores->getSoloAccesoPremium()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Contenido padres y profesores solo acceso premium. Pulse para desactivar',
                                        "id" => "imagen_fav_" . $contenido_padres_y_profesores->id,
                                        "title" => 'Contenido padres y profesores solo acceso premium. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('contenidoPadresYProfesores/switchValor?id='.$contenido_padres_y_profesores->id.'&variable=soloPremium&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $contenido_padres_y_profesores->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Contenido padres y profesores acceso premium no activado. Pulse para activar',
                                        "id" => "imagen_fav_" . $contenido_padres_y_profesores->id,
                                        "title" => 'Contenido padres y profesores acceso premium no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('contenidoPadresYProfesores/switchValor?id='.$contenido_padres_y_profesores->id.'&variable=soloPremium&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $contenido_padres_y_profesores->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?></td>

      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_logado_' . $contenido_padres_y_profesores->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($contenido_padres_y_profesores->getSoloAccesoLogado()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Contenido padres y profesores solo acceso logado. Pulse para desactivar',
                                        "id" => "imagen_logado_" . $contenido_padres_y_profesores->id,
                                        "title" => 'Contenido padres y profesores solo acceso logado. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('contenidoPadresYProfesores/switchValor?id='.$contenido_padres_y_profesores->id.'&variable=soloLogado&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $contenido_padres_y_profesores->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Contenido padres y profesores acceso solo logado no activado. Pulse para activar',
                                        "id" => "imagen_logado_" . $contenido_padres_y_profesores->id,
                                        "title" => 'Contenido padres y profesores acceso solo logado no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('contenidoPadresYProfesores/switchValor?id='.$contenido_padres_y_profesores->id.'&variable=soloLogado&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $contenido_padres_y_profesores->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      
      
      
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_activo_' . $contenido_padres_y_profesores->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($contenido_padres_y_profesores->getActivo()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Contenido padres y profesores activo. Pulse para desactivar',
                                        "id" => "imagen_activo_" . $contenido_padres_y_profesores->id,
                                        "title" => 'Contenido padres y profesores Activo. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('contenidoPadresYProfesores/switchValor?id='.$contenido_padres_y_profesores->id.'&variable=activo&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $contenido_padres_y_profesores->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $contenido_padres_y_profesores->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Contenido padres y profesores inactivo. Pulse para activar',
                                        "id" => "imagen_activo_" . $contenido_padres_y_profesores->id,
                                        "title" => 'Contenido padres y profesores inactivo. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('contenidoPadresYProfesores/switchValor?id='.$contenido_padres_y_profesores->id.'&variable=activo&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $contenido_padres_y_profesores->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      <td><?php echo format_date($contenido_padres_y_profesores->getCreatedAt(), 'p') ?></td>
      <td><a href="<?php echo url_for('fotografiaContenidoPadresYProfesores/index?idContenidoPadresYProfesores='.$contenido_padres_y_profesores->id) ?>"><?php echo  count(Doctrine_Core::getTable('ContenidoPadresYProfesores')->getFotografias($contenido_padres_y_profesores->id));  ?></a></td>      
      <td class="accionListado"><a class="ver" id="<?php echo $contenido_padres_y_profesores->id ?>" href="javascript:void()"><img  title="Vista previa" alt="Vista previa" src="/images/iconos/vistaPrevia.png"></img></a></td>
      <td class="accionListado"><?php echo link_to(image_tag('iconos/editar.png', array('alt' => 'Editar Contenido padres y profesores', 'title' => 'Editar Contenido padres y profesores')), 'contenidoPadresYProfesores/edit?id='.$contenido_padres_y_profesores->id) ?>                 
      <td class="accionListado"><a href="javascript:void()" onclick="javascript:eliminar('<?php echo url_for('contenidoPadresYProfesores/delete?id='.$contenido_padres_y_profesores->id) ?>',<?php echo $contenido_padres_y_profesores->id ?>)"><img src="/images/iconos/borrar.png"></img></a></td>  
    </tr>
    <?php $i = $i + 1; ?>
    <?php endforeach; ?>
  </tbody>
</table>
<br></br>
<div class="enlaces-centro">
  <?php if($episodio){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nueva', 'contenidoPadresYProfesores/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nueva', 'contenidoPadresYProfesores/newSinIdEpisodio', array('title' => 'Nuevo')) ?>
    
    <?php } ?></div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $contenido_padres_y_profesoress, 'action' => $action)) ?>
<br></br>

<div id="ajax-favoritos"></div>
<div id="eliminar" style="display: none;"></div>
<div id="ver" style="display: none;"></div>
<script type="text/javascript">


          $('.ver').click(function() {
        var id = $(this).attr('id');
        dialog = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('contenidoPadresYProfesores/show?id=') ?>'+id,
            async: false
        }).responseText;
        $('#ver').html(dialog);
        $("#ver").dialog({
            resizable: true,
            width: 800,
            modal: true,
            show: { effect: 'drop', direction: "up" },
            title: "<?php echo 'Contenido padres y profesores'; ?>"
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
               $().toastmessage('showSuccessToast', "Contenido padres y profesores Eliminado");
               
              
        }); 
        
   }
 }


</script>