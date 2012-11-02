

<?php use_helper('Date') ?>
<h1>Variables de configuración</h1>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $configuracions, 'action' => $action)) ?>
<br></br>
<div class="enlaces-centro">
  <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nueva', 'configuracion/new', array('title' => 'Nuevo')) ?>
</div>
<br></br>
<table class="listado contenido">
  <thead>
    <tr>
      <th>Variable</th>
      <th>Valor</th>
      <th>Descripción</th>
      <th>Tipo</th>
      <th>Creado en</th>    
      <th colspan="2"><?php echo 'Acciones'?></th>  
    </tr>
  </thead>
  <tbody>
      <?php $i = 1 ?>  
    <?php foreach ($configuracions as $configuracion): ?>
      <tr id="<?php echo $configuracion->id ?>" class="<?php echo ($i % 2 == 0 ? 'par' : 'impar') ?>">
      <td><?php echo $configuracion->getVariable() ?></td>
      <td><?php echo $configuracion->getValor() ?></td>
      <td><?php echo $configuracion->getDescripcion() ?></td>
      <td><?php echo $configuracion->getTipo() ?></td>
      <td><?php echo format_date($configuracion->getCreatedAt(), 'p') ?></td>
      <td class="accionListado"><a class="ver" id="<?php echo $configuracion->id ?>" href="javascript:void()"><img  title="Vista previa" alt="Vista previa" src="/images/iconos/vistaPrevia.png"></img></a></td>      
      <td class="accionListado"><?php echo link_to(image_tag('iconos/editar.png', array('alt' => 'Editar Usuario', 'title' => 'Editar Usuario')), 'configuracion/edit?id='.$configuracion->id) ?>                 
    </tr>
    <?php $i = $i + 1; ?>
    <?php endforeach; ?>
  </tbody>
</table>
<br></br>
<div class="enlaces-centro">
  <?php echo link_to(image_tag('iconos/nuevo.png').'Añadir nueva', 'configuracion/new', array('title' => 'Nuevo')) ?>
</div>
<br></br>
<?php  include_component('bloque', 'bloquePaginador', array('pager' => $configuracions, 'action' => $action)) ?>
<br></br>

<div id="ajax-favoritos"></div>
<div id="eliminar" style="display: none;"></div>
<div id="ver" style="display: none;"></div>
<script type="text/javascript">


          $('.ver').click(function() {
        var id = $(this).attr('id');
        dialog = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('configuracion/show?id=') ?>'+id,
            async: false
        }).responseText;
        $('#ver').html(dialog);
        $("#ver").dialog({
            resizable: true,
            width: 800,
            modal: true,
            show: { effect: 'drop', direction: "up" },
            title: "<?php echo 'Variable de configuración'; ?>"
        });
    }); 


function refrescar(){
    window.location.reload();
}



            function eliminar(url,idImagen){
                if (confirm("¿Desea eliminar esto?")) {
           $('#eliminar').load(url,{},function() {  
               $('#'+idImagen).hide("slow");
                //para lo contrario activar desactivar
//                window.location.reload();
               $().toastmessage('showSuccessToast', "Variable de configuración Eliminada");
               
              
        }); 
        
   }
 }


</script>
