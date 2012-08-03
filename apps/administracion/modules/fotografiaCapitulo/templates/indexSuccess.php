<h1>Fotografia capitulos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id capitulo</th>
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
    <?php foreach ($fotografia_capitulos as $fotografia_capitulo): ?>
    <tr>
      <td><a href="<?php echo url_for('fotografiaCapitulo/edit?id='.$fotografia_capitulo->getId()) ?>"><?php echo $fotografia_capitulo->getId() ?></a></td>
      <td><?php echo $fotografia_capitulo->getIdCapitulo() ?></td>
      <td><?php echo $fotografia_capitulo->getDescripcion() ?></td>
      <td><?php echo $fotografia_capitulo->getFotografia() ?></td>
      <td><?php echo $fotografia_capitulo->getSoloAccesoPremium() ?></td>
      <td><?php echo $fotografia_capitulo->getSoloAccesoLogado() ?></td>
      <td><?php echo $fotografia_capitulo->getBorrado() ?></td>
      <td><?php echo $fotografia_capitulo->getActivo() ?></td>
      <td><?php echo $fotografia_capitulo->getCreatedAt() ?></td>
      <td><?php echo $fotografia_capitulo->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('fotografiaCapitulo/new') ?>">New</a>
