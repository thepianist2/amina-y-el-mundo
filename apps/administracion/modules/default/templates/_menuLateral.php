<script type="text/javascript">
$(document).ready(function(){
  $("#navmenu-h li,#navmenu-v li").hover(
    function() { $(this).addClass("iehover"); },
    function() { $(this).removeClass("iehover"); }
  );
});
</script>
<ul id="navmenu-v">
        <li><a href="<?php echo url_for('default/index'); ?>">Inicio</a></li>
        <li><a href="<?php echo url_for('default/index'); ?>">Unidades Temáticas +</a>
          <ul>
            <li><a href="<?php echo url_for('comentario/indexTodos'); ?>">Comentarios</a></li>
            <li><a href="<?php echo url_for('episodio/indexTodos'); ?>">Episodios +</a>
              <ul>
                <li><a href="<?php echo url_for('juegoEpisodio/indexTodos'); ?>">Juegos del episodio</a></li>
                <li><a href="<?php echo url_for('elExperto/indexTodos'); ?>">El experto</a></li>
                <li><a href="<?php echo url_for('capitulo/indexTodos'); ?>">Capítulos +</a>
                    <ul>
                        <li><a href="<?php echo url_for('contenidoPadresYProfesores/indexTodos'); ?>">Contenido adúltos</a></li>
                    </ul>
                </li>
              </ul>
            </li>   
          </ul>
        </li>
        <li><a href="<?php echo url_for('programaColegio/index'); ?>">Programas de colégio</a></li>
        <li><a href="<?php echo url_for('producto/index'); ?>">Producto</a></li>
        <li><a href="<?php echo url_for('usuario/index'); ?>">Usuarios</a></li>
        <li><a href="<?php echo url_for('sf_media_browser/index'); ?>">Libreria de archivos</a></li>
        <li><a href="<?php echo url_for('contenido/index') ?>">Contenido web +</a>
            <ul>
                <li><a href="<?php echo url_for('categoriaContenido/index'); ?>">Categorías</a></li>
            </ul>
        </li>
        <li><a href="<?php echo url_for('contacto/index'); ?>">Contactos</a></li>
        <li><a href="<?php echo url_for('configuracion/index'); ?>">Configuración</a></li>
        <li><a href="<?php echo url_for('sf_guard_signout') ?>">Salir</a></li>
      </ul>

