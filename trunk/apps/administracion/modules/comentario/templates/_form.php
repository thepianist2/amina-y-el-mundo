<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('comentario/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('comentario/index') ?>">Volver a la lista</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'comentario/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Está seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td>
          <?php echo $form['idUsuario']->renderError() ?>
          <?php echo $form['idUsuario'] ?>
        </td>
      </tr>
      <tr>
        <td>
          <?php echo $form['idUnidadTematica']->renderError() ?>
          <?php echo $form['idUnidadTematica'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['publicacion']->renderLabel() ?></th>
        <td>
          <?php echo $form['publicacion']->renderError() ?>
          <?php echo $form['publicacion'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
