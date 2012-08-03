<script type="text/javascript">
    $(document).ready(function(){
        $('.desplegable-menu-lateral').each(function(){ 
            $(this).click(function() {                
                $('#desplegado-'+$(this).attr('id')).show();
                $('#plegado-'+$(this).attr('id')).hide();
                $('#contenido-'+$(this).attr('id')).slideToggle(50);
            });
        });
        $('.plegable-menu-lateral').each(function() {
            $(this).click(function() {                
                $('#desplegado-'+$(this).attr('id')).hide();
                $('#plegado-'+$(this).attr('id')).show();
                $('#contenido-'+$(this).attr('id')).slideToggle(50);
            });
        });
    });
</script>

<div id="inicioadmin">
	<a href="<?php echo url_for('default/index'); ?>"><?php echo 'Inicio Administración'; ?>
	</a>
</div>
<div id="menus">
	<div class="selector-menu-lateral" id="plegado-menu1">
		<ul>
			<li class="sin-seleccionar"><a class="desplegable-menu-lateral"
				id="menu1" href="#">Contenido</a>
			</li>
		</ul>
	</div>
	<div class="selector-menu-lateral" id="desplegado-menu1"
		style="display: none;">
		<ul>
			<li class="seleccionado"><a class="plegable-menu-lateral" id="menu1"
				href="#">Contenido</a>
			</li>
		</ul>
	</div>
	<div class="contenido-menu-lateral" id="contenido-menu1"
		style="display: none;">
		<ul>

			<li class="sin-type">
				<ul>
					<li class="fin-rama"><a class="opcion-menu-lateral" href="#"
						onclick="enlace('#derecha','<?php echo url_for('default/index') ?>')">Unidades temáticas</a>
					</li>
					<li class="fin-rama"><a class="opcion-menu-lateral" href="#"
						onclick="enlace('#derecha','<?php echo url_for('contenido/index') ?>')">Contenido web</a></li>
                                        <li class="fin-rama"><a class="opcion-menu-lateral" href="#"
						onclick="enlace('#derecha','<?php echo url_for('programaColegio/index') ?>')">Programa Colegio</a></li>
                                </ul>
			</li>
		</ul>
	</div>
	


</div>
<div id="sinelementos">
	<ul>
           <li><a class="opcion-menu-lateral" href="#" onclick="enlace('#derecha','<?php echo url_for('contacto/index') ?>')">Contacto</a>
		</li>
           <li><a class="opcion-menu-lateral" href="#" onclick="enlace('#derecha','<?php echo url_for('usuario/index') ?>')">Usuarios</a>
		</li>
           <li><a class="opcion-menu-lateral" href="#" onclick="enlace('#derecha','<?php echo url_for('comentario/index') ?>')">Comentario</a>
		</li>
           <li><a class="opcion-menu-lateral" href="<?php echo url_for('sf_media_browser/index') ?>">Libreria de archivos</a>
     
           <li><a class="opcion-menu-lateral" href="#" onclick="enlace('#derecha','<?php echo url_for('producto/index') ?>')">Productos</a>
		</li>
           <li><a class="opcion-menu-lateral" href="#" onclick="enlace('#derecha','<?php echo url_for('configuracion/index') ?>')">Configuración</a>
		</li>     
		<li><a class="opcion-menu-lateral"
			href="<?php echo url_for('sf_guard_signout') ?>">Salir</a>
		</li>
	</ul>
</div>

