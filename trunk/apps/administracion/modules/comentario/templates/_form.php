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
          &nbsp;<a href="<?php echo url_for('comentario/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'comentario/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idUsuario']->renderLabel() ?></th>
        <td>
          <?php echo $form['idUsuario']->renderError() ?>
          <?php echo $form['idUsuario'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idUnidadTematica']->renderLabel() ?></th>
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
      <tr>
        <th><?php echo $form['archivo']->renderLabel() ?></th>
        <td>
          <?php echo $form['archivo']->renderError() ?>
          <?php echo $form['archivo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['borrado']->renderLabel() ?></th>
        <td>
          <?php echo $form['borrado']->renderError() ?>
          <?php echo $form['borrado'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
