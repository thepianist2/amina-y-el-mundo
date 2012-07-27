<h1>Unidad tematicas List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id usuario</th>
      <th>Titulo</th>
      <th>Descripcion</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Borrado</th>
      <th>Activo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($unidad_tematicas as $unidad_tematica): ?>
    <tr>
      <td><a href="<?php echo url_for('default/show?id='.$unidad_tematica->getId()) ?>"><?php echo $unidad_tematica->getId() ?></a></td>
      <td><?php echo $unidad_tematica->getIdUsuario() ?></td>
      <td><?php echo $unidad_tematica->getTitulo() ?></td>
      <td><?php echo $unidad_tematica->getDescripcion() ?></td>
      <td><?php echo $unidad_tematica->getSoloAccesoPremium() ?></td>
      <td><?php echo $unidad_tematica->getSoloAccesoLogado() ?></td>
      <td><?php echo $unidad_tematica->getBorrado() ?></td>
      <td><?php echo $unidad_tematica->getActivo() ?></td>
      <td><?php echo $unidad_tematica->getCreatedAt() ?></td>
      <td><?php echo $unidad_tematica->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('default/new') ?>">New</a>
