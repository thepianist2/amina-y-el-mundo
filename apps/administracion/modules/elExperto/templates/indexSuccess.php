<?php use_helper('Date') ?>
<?php if($episodio){ ?>
<h1>Contenido del experto del Episodio: <?php echo $episodio->getTitulo(); ?></h1>
<?php }else{ ?>
<h1>Contenidos del experto episodio</h1>
<?php } ?>
<div id="buscador">
<?php include_partial('elExperto/buscador', array('query' => $query)); ?>
</div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $el_expertos, 'action' => $action)) ?>
<br></br>
<div class="enlaces-centro">
  <?php echo link_to(image_tag('iconos/volver.png').'Volver al listado de Episodios', 'episodio/index', array('title' => 'Volver')) ?>    
  <?php echo link_to(image_tag('iconos/experiencias.png').'Todos los contenidos del experto', 'elExperto/indexTodos', array('title' => 'Mostrar todos los contenidos del experto')) ?>    
  <?php if($episodio){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'elExperto/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nuevo', 'elExperto/newSinIdEpisodio', array('title' => 'Nuevo')) ?>
    
    <?php } ?>
</div>
<br></br>
<table class="listado contenido">
  <thead>
    <tr>
      <th>Episodio</th>
      <th>Vídeo</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Activo</th>
      <th>Creado en</th>
      <th colspan="3"><?php echo 'Acciones'?></th>            
    </tr>
  </thead>
  <tbody>
      <?php $i = 1 ?>  
    <?php foreach ($el_expertos as $el_experto): ?>
      <tr id="<?php echo $el_experto->id ?>" class="<?php echo ($i % 2 == 0 ? 'par' : 'impar') ?>">
      <td><?php echo $el_experto->getEpisodio()->getTitulo() ?></td>
                <?php
      //poner tamaño a 400 por 250
      //obtenemos la posicion de width
      $posicionCadenaWidth=strpos($el_experto->getEnlaceVideo(), "width=") ;
      $posicionCadenaHeight=strpos($el_experto->getEnlaceVideo(), "height=") ;
      //vamos a la posicion de width y obtenemos todo el width completo
      $variableWidth=substr($el_experto->getEnlaceVideo(), $posicionCadenaWidth, 22) ;
      $variableHeight=substr($el_experto->getEnlaceVideo(), $posicionCadenaHeight, 22) ;
      //variable de cadena para reemplazar
      $reemplazoWidth="width=\"300\"";
      $reemplazoHeight="height=\"150\"";
      //reemplazamos variable width con todo por otro texto con el tamaño indicado
      $codigo=str_replace($variableWidth,$reemplazoWidth,$el_experto->getEnlaceVideo()) ;
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
					$imagen_fav = '<a id="icono_favorito_' . $el_experto->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($el_experto->getSoloAccesoPremium()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $el_experto->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $el_experto->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Contenido el experto solo acceso premium. Pulse para desactivar',
                                        "id" => "imagen_fav_" . $el_experto->id,
                                        "title" => 'Contenido el experto solo acceso premium. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('elExperto/switchValor?id='.$el_experto->id.'&variable=soloPremium&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $el_experto->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_fav_' . $el_experto->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_fav_' . $el_experto->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Contenido el experto acceso premium no activado. Pulse para activar',
                                        "id" => "imagen_fav_" . $el_experto->id,
                                        "title" => 'Contenido el experto acceso premium no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchPremium("' . url_for('elExperto/switchValor?id='.$el_experto->id.'&variable=soloPremium&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $el_experto->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?></td>

      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_logado_' . $el_experto->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($el_experto->getSoloAccesoLogado()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $el_experto->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $el_experto->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Contenido el experto solo acceso logado. Pulse para desactivar',
                                        "id" => "imagen_logado_" . $el_experto->id,
                                        "title" => 'Contenido el experto solo acceso logado. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('elExperto/switchValor?id='.$el_experto->id.'&variable=soloLogado&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $el_experto->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_logado_' . $el_experto->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_logado_' . $el_experto->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Contenido el experto acceso solo logado no activado. Pulse para activar',
                                        "id" => "imagen_logado_" . $el_experto->id,
                                        "title" => 'Contenido el experto acceso solo logado no activado. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchLogado("' . url_for('elExperto/switchValor?id='.$el_experto->id.'&variable=soloLogado&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $el_experto->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      
      
      
      <td><?php
				if ($sf_user->isAuthenticated()) {
					$imagen_fav = '<a id="icono_activo_' . $el_experto->id . '" href="javascript:void()" ';
                                        //si la palabra es del usuario mostramos icono favorito
					if ($el_experto->getActivo()) {
                                            	$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $el_experto->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $el_experto->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= '>';
					$imagen_fav .= image_tag('iconos/tick.png', array("alt" => 'Contenido el experto activo. Pulse para desactivar',
                                        "id" => "imagen_activo_" . $el_experto->id,
                                        "title" => 'Contenido el experto Activo. Pulse para desactivar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('elExperto/switchValor?id='.$el_experto->id.'&variable=activo&valor=0') . '","' . image_path('iconos/cross.png') . '",' . $el_experto->id . ')',
						));
					} else {
						$imagen_fav .= ' onmouseover=document.getElementById("imagen_activo_' . $el_experto->id . '").src="' . image_path('iconos/tick.png') . '"';
						$imagen_fav .= ' onmouseout=document.getElementById("imagen_activo_' . $el_experto->id . '").src="' . image_path('iconos/cross.png') . '"';
						$imagen_fav .= '>';
						$imagen_fav .= image_tag('iconos/cross.png', array("alt" => 'Contenido el experto inactivo. Pulse para activar',
                                        "id" => "imagen_activo_" . $el_experto->id,
                                        "title" => 'Contenido el experto inactivo. Pulse para activar',
                                        "class" => 'favoritos',                           
                                        "onclick" => 'javascript:switchActivo("' . url_for('elExperto/switchValor?id='.$el_experto->id.'&variable=activo&valor=1') . '","' . image_path('iconos/tick.png') . '",' . $el_experto->id . ')',
						));
					}
					$imagen_fav .= '</a>';
					echo $imagen_fav;
				}
				?>
      </td>
      <td><?php echo format_date($el_experto->getCreatedAt(), 'p') ?></td>
      <td class="accionListado"><a class="ver" id="<?php echo $el_experto->id ?>" href="javascript:void()"><img  title="Vista previa" alt="Vista previa" src="/images/iconos/vistaPrevia.png"></img></a></td>
      <td class="accionListado"><?php echo link_to(image_tag('iconos/editar.png', array('alt' => 'Editar Contenido el experto', 'title' => 'Editar Contenido el experto')), 'elExperto/edit?id='.$el_experto->id) ?>                 
      <td class="accionListado"><a href="javascript:void()" onclick="javascript:eliminar('<?php echo url_for('elExperto/delete?id='.$el_experto->id) ?>',<?php echo $el_experto->id ?>)"><img src="/images/iconos/borrar.png"></img></a></td>  
    </tr>
    <?php $i = $i + 1; ?>
    <?php endforeach; ?>
  </tbody>
</table>
<br></br>
<div class="enlaces-centro">
  <?php if($episodio){ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nueva', 'elExperto/new', array('title' => 'Nuevo')) ?>
    <?php }else{ ?>
        <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nueva', 'elExperto/newSinIdEpisodio', array('title' => 'Nuevo')) ?>
    
    <?php } ?></div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $el_expertos, 'action' => $action)) ?>
<br></br>

<div id="ajax-favoritos"></div>
<div id="eliminar" style="display: none;"></div>
<div id="ver" style="display: none;"></div>
<script type="text/javascript">


          $('.ver').click(function() {
        var id = $(this).attr('id');
        dialog = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('elExperto/show?id=') ?>'+id,
            async: false
        }).responseText;
        $('#ver').html(dialog);
        $("#ver").dialog({
            resizable: true,
            width: 800,
            modal: true,
            show: { effect: 'drop', direction: "up" },
            title: "<?php echo 'Contenido el experto'; ?>"
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
               $().toastmessage('showSuccessToast', "Contenido el experto Eliminado");
               
              
        }); 
        
   }
 }


</script>