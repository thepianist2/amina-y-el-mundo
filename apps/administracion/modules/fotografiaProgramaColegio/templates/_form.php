<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('fotografiaProgramaColegio/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('fotografiaProgramaColegio/index') ?>">Volver a la lista</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'fotografiaProgramaColegio/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Está seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idProgramaColegio']->renderLabel() ?></th>
        <td>
          <?php echo $form['idProgramaColegio']->renderError() ?>
          <?php echo $form['idProgramaColegio'] ?>
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
    </tbody>
  </table>
</form>
