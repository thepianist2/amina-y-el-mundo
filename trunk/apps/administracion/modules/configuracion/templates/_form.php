<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
  <?php use_javascript('/sfMediaBrowserPlugin/js/WindowManager.js') ?>
    <script type="text/javascript">
  sfMediaBrowserWindowManager.init('<?php echo url_for('sf_media_browser_select') ?>');

  </script>
<form action="<?php echo url_for('configuracion/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('configuracion/index') ?>">Volver a la lista</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'configuracion/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Está seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['variable']->renderLabel() ?></th>
        <td>
          <?php echo $form['variable']->renderError() ?>
          <?php echo $form['variable'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['valor']->renderLabel() ?></th>
        <td>
          <?php echo $form['valor']->renderError() ?>
          <?php echo $form['valor'] ?>
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
        <th><?php echo $form['tipo']->renderLabel() ?></th>
        <td>
          <?php echo $form['tipo']->renderError() ?>
          <?php echo $form['tipo'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
