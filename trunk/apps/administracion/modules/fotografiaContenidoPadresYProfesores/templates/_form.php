<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('fotografiaContenidoPadresYProfesores/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('fotografiaContenidoPadresYProfesores/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'fotografiaContenidoPadresYProfesores/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idContenidoPadresYProfesores']->renderLabel() ?></th>
        <td>
          <?php echo $form['idContenidoPadresYProfesores']->renderError() ?>
          <?php echo $form['idContenidoPadresYProfesores'] ?>
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
        <th><?php echo $form['fotografia']->renderLabel() ?></th>
        <td>
          <?php echo $form['fotografia']->renderError() ?>
          <?php echo $form['fotografia'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['soloAccesoPremium']->renderLabel() ?></th>
        <td>
          <?php echo $form['soloAccesoPremium']->renderError() ?>
          <?php echo $form['soloAccesoPremium'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['soloAccesoLogado']->renderLabel() ?></th>
        <td>
          <?php echo $form['soloAccesoLogado']->renderError() ?>
          <?php echo $form['soloAccesoLogado'] ?>
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
        <th><?php echo $form['activo']->renderLabel() ?></th>
        <td>
          <?php echo $form['activo']->renderError() ?>
          <?php echo $form['activo'] ?>
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
