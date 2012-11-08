<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
  <?php use_javascript('/sfMediaBrowserPlugin/js/WindowManager.js') ?>
    <script type="text/javascript">
  sfMediaBrowserWindowManager.init('<?php echo url_for('sf_media_browser_select') ?>');

  </script>
<form action="<?php echo url_for('contenido/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('contenido/index') ?>">Volver a la lista</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'contenido/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Está seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php $form['idUsuario']->renderLabel() ?></th>
        <td>
          <?php echo $form['idUsuario']->renderError() ?>
          <?php echo $form['idUsuario'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idCategoriaContenido']->renderLabel() ?></th>
        <td>
          <?php echo $form['idCategoriaContenido']->renderError() ?>
          <?php echo $form['idCategoriaContenido'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['titulo']->renderLabel() ?></th>
        <td>
          <?php echo $form['titulo']->renderError() ?>
          <?php echo $form['titulo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['contenido']->renderLabel() ?></th>
        <td>
          <?php echo $form['contenido']->renderError() ?>
          <?php echo $form['contenido'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
