<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
  <?php use_javascript('/sfMediaBrowserPlugin/js/WindowManager.js') ?>
    <script type="text/javascript">
  sfMediaBrowserWindowManager.init('<?php echo url_for('sf_media_browser_select') ?>');

  </script>
<form action="<?php echo url_for('default/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
            <div class="enlaces-centro">
          &nbsp;<a href="<?php echo url_for('default/index') ?>">Volver a la lista</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'default/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Está seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
          </div>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
