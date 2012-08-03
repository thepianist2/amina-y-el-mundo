<h1>Fotografia programa colegios List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id programa colegio</th>
      <th>Descripcion</th>
      <th>Fotografia</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Borrado</th>
      <th>Activo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($fotografia_programa_colegios as $fotografia_programa_colegio): ?>
    <tr>
      <td><a href="<?php echo url_for('fotografiaProgramaColegio/edit?id='.$fotografia_programa_colegio->getId()) ?>"><?php echo $fotografia_programa_colegio->getId() ?></a></td>
      <td><?php echo $fotografia_programa_colegio->getIdProgramaColegio() ?></td>
      <td><?php echo $fotografia_programa_colegio->getDescripcion() ?></td>
      <td><?php echo $fotografia_programa_colegio->getFotografia() ?></td>
      <td><?php echo $fotografia_programa_colegio->getSoloAccesoPremium() ?></td>
      <td><?php echo $fotografia_programa_colegio->getSoloAccesoLogado() ?></td>
      <td><?php echo $fotografia_programa_colegio->getBorrado() ?></td>
      <td><?php echo $fotografia_programa_colegio->getActivo() ?></td>
      <td><?php echo $fotografia_programa_colegio->getCreatedAt() ?></td>
      <td><?php echo $fotografia_programa_colegio->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('fotografiaProgramaColegio/new') ?>">New</a>
