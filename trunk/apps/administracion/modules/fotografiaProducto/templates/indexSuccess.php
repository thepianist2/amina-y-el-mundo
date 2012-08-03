<h1>Fotografia productos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id producto</th>
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
    <?php foreach ($fotografia_productos as $fotografia_producto): ?>
    <tr>
      <td><a href="<?php echo url_for('fotografiaProducto/edit?id='.$fotografia_producto->getId()) ?>"><?php echo $fotografia_producto->getId() ?></a></td>
      <td><?php echo $fotografia_producto->getIdProducto() ?></td>
      <td><?php echo $fotografia_producto->getDescripcion() ?></td>
      <td><?php echo $fotografia_producto->getFotografia() ?></td>
      <td><?php echo $fotografia_producto->getSoloAccesoPremium() ?></td>
      <td><?php echo $fotografia_producto->getSoloAccesoLogado() ?></td>
      <td><?php echo $fotografia_producto->getBorrado() ?></td>
      <td><?php echo $fotografia_producto->getActivo() ?></td>
      <td><?php echo $fotografia_producto->getCreatedAt() ?></td>
      <td><?php echo $fotografia_producto->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('fotografiaProducto/new') ?>">New</a>
