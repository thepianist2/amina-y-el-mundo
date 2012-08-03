<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="contenedor">
        <?php include_partial('bloque/bloqueMensaje'); ?>
        <div id="header">
	     <div id="header1" style="height: 100px;">
                 <a style="margin-left: 85px; margin-top: -16px;" href="<?php echo url_for('homepage') ?>"><?php echo image_tag('administracion/logo.png') ?></a>
	     </div>
	</div> <!-- fin header -->
        
	<div id="cuerpo">
            <div id="contenidoadmin">
                <?php if($sf_user->isAuthenticated()){ ?>
        	<div id="principal-left-admin">
		  		<div id="menu_izquierda">
                                    
		    	<?php include_component('default', 'menuLateral') ?>
                                    
		  		</div>
	  		</div>
                <?php }else{ ?>
                
                <?php echo $sf_content ?>
                <?php } ?>
                <?php if($sf_user->isAuthenticated()){ ?>
	  		<div id="principal-right-admin">
	  			<div id="derecha" >
	    		<?php echo $sf_content ?>
	    		</div>
	    	</div>
                <?php } ?>
                <div class="clear"></div>
            </div> <!-- fin contenido -->
	</div>  <!-- fin cuerpo -->
        
   <div class="clear"></div>
   </div>  <!-- fin contenedor -->
   
  </body>
</html>
