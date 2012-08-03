<h1>Configuracions List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Variable</th>
      <th>Valor</th>
      <th>Descripcion</th>
      <th>Tipo</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($configuracions as $configuracion): ?>
    <tr>
      <td><a href="<?php echo url_for('configuracion/edit?id='.$configuracion->getId()) ?>"><?php echo $configuracion->getId() ?></a></td>
      <td><?php echo $configuracion->getVariable() ?></td>
      <td><?php echo $configuracion->getValor() ?></td>
      <td><?php echo $configuracion->getDescripcion() ?></td>
      <td><?php echo $configuracion->getTipo() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('configuracion/new') ?>">New</a>
