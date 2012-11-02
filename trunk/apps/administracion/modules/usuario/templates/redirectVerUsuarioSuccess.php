<script type="text/javascript">

 if (confirm("Este usuario ya existe, se ha recuperado automáticamente ¿desea editar el usuario existente?")) {
     
     
     window.location.href = "<?php echo url_for('usuario/show?id='.$usuario->id); ?>"

 }else{
     window.location.href = "<?php echo url_for('usuario/buscar?query='.$usuario->username); ?>"

 }

</script>    