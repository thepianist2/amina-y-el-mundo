<h1>Programa colegios List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
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
    <?php foreach ($programa_colegios as $programa_colegio): ?>
    <tr>
      <td><a href="<?php echo url_for('programaColegio/edit?id='.$programa_colegio->getId()) ?>"><?php echo $programa_colegio->getId() ?></a></td>
      <td><?php echo $programa_colegio->getTitulo() ?></td>
      <td><?php echo $programa_colegio->getDescripcion() ?></td>
      <td><?php echo $programa_colegio->getSoloAccesoPremium() ?></td>
      <td><?php echo $programa_colegio->getSoloAccesoLogado() ?></td>
      <td><?php echo $programa_colegio->getBorrado() ?></td>
      <td><?php echo $programa_colegio->getActivo() ?></td>
      <td><?php echo $programa_colegio->getCreatedAt() ?></td>
      <td><?php echo $programa_colegio->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('programaColegio/new') ?>">New</a>
