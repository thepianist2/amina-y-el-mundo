<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<h1 style="text-align: center;">Imágenes del producto</h1>

					<div class="tabla_imagenes">
					<?php foreach($fotografia_productos as $fotografia_producto): ?>
						<div class="caja-imagen" style="">
                                                    <div onclick="javascript:eliminarImagen('<?php echo url_for('fotografiaProducto/delete?id='.$fotografia_producto->id) ?>',<?php echo $fotografia_producto->id ?>)"
								style="position: absolute; top: 0px; right: 0px; display: none; color: red; background-color: white;">
								<?php echo image_tag('/images/iconos/cross.png',array('style' => 'float: right;'))?>
								<span
									style="padding-top: 3px; padding-left: 5px; display: block; float: right;">Eliminar</span>
							</div>
                                                    
                                                     <!--<div onclick="javascript:editarImagen('<?php // echo url_for('fotografiaProducto/edit?id='.$fotografia_producto->id) ?>',<?php // echo $fotografia_producto->id ?>)"
								style="position: absolute; top: 0px; right: 150px; display: none; color: red; background-color: white;">
								<?php // echo image_tag('/images/iconos/editar.png',array('style' => 'float: left;'))?>
								<span
									style="padding-top: 3px; padding-left: 5px; display: block; float: left;">Editar</span>
							</div>-->
                                                    
							<?php echo image_tag('/uploads/'.$fotografia_producto->getFotografia(),array('width' => '200', 'id'=> $fotografia_producto->id,'class'=>'imagenPiso')); ?>
						</div>
						<?php endforeach ?>
					</div>
<div id="editar-imagen" style="display: none; z-index: 10; position: absolute; background-color: #3399ff;"></div>
<br></br><br></br><br></br><br></br><br></br><br></br>




<div id="eliminar-comen" style="display: none;"></div><br></br><br></br><br></br>
<form action="<?php echo url_for('fotografiaProducto/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('producto/index') ?>">Volver a la lista</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'fotografiaProducto/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Está seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Subir Imágen" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php $form['idProducto']->renderLabel() ?></th>
        <td>
          <?php echo $form['idProducto']->renderError() ?>
          <?php echo $form['idProducto'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['descripcion']->renderLabel() ?></th>
        <td>
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fotografia']->renderLabel() ?></th>
        <td>
          <?php echo $form['fotografia']->renderError() ?>
          <?php echo $form['fotografia'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['soloAccesoPremium']->renderLabel() ?></th>
        <td>
          <?php echo $form['soloAccesoPremium']->renderError() ?>
          <?php echo $form['soloAccesoPremium'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['soloAccesoLogado']->renderLabel() ?></th>
        <td>
          <?php echo $form['soloAccesoLogado']->renderError() ?>
          <?php echo $form['soloAccesoLogado'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<div style="text-align: right;">
    <a href="<?php echo url_for('producto/show?id='.$idProducto) ?>"><button style="font-size: 18px;">Finalizar y visualizar</button></a>
</div>
<br></br>
  <script type="text/javascript">
	$(document).ready(function() {
		$('.caja-imagen').each(function() {
			$(this).hover(function() {
				$(this).addClass('hover-borrar-imagen');
				$(this).children('div').show();
			}, function() {
				$(this).removeClass('hover-borrar-imagen');
				$(this).children('div').hide();
			});
		});
		
	});
        
        
            function eliminarImagen(url,idImagen){
                if (confirm("¿Desea eliminar esta imágen?")) {
           $('#eliminar-comen').load(url,{},function() {  
               $('#'+idImagen).hide("slow");
              
        }); 
        
   }
 }
 
             function editarImagen(url,idImagen){
           $('#editar-imagen').load(url,{},function() {  
               $('#editar-imagen').show("slow");
              
        }); 
 }


             function cerrar(){
               $('#editar-imagen').hide("slow");       
 }
</script>

