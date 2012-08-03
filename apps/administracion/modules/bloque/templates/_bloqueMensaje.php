<?php if ($sf_user->hasFlash('mensajeTerminado')): ?>
 <script type="text/javascript"> $().toastmessage('showSuccessToast', "<?php echo  $sf_user->getFlash('mensajeTerminado') ?>");</script>
 <?php $sf_user->setFlash('mensajeTerminado',null); ?>
        <?php endif; ?>
 
 
        <?php if ($sf_user->hasFlash('mensajeError')): ?>
  <script type="text/javascript"> $().toastmessage('showWarningToast', "<?php echo $sf_user->getFlash('mensajeError') ?>");</script>
<?php $sf_user->setFlash('mensajeError',null); ?>
                    <?php endif; ?>   
  
        <?php if ($sf_user->hasFlash('mensajeErrorGrave')): ?>
  <script type="text/javascript"> $().toastmessage('showErrorToast', "<?php echo $sf_user->getFlash('mensajeErrorGrave') ?>");</script>
<?php $sf_user->setFlash('mensajeErrorGrave',null); ?>
                    <?php endif; ?>     
  
  
         <?php if ($sf_user->hasFlash('mensajeSuceso')): ?>
  <script type="text/javascript"> $().toastmessage('showNoticeToast', "<?php echo $sf_user->getFlash('mensajeSuceso') ?>");</script>
<?php $sf_user->setFlash('mensajeSuceso',null); ?>
                    <?php endif; ?>    