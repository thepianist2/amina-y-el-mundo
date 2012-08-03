<h1>Productos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Precio</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Borrado</th>
      <th>Activo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($productos as $producto): ?>
    <tr>
      <td><a href="<?php echo url_for('producto/edit?id='.$producto->getId()) ?>"><?php echo $producto->getId() ?></a></td>
      <td><?php echo $producto->getNombre() ?></td>
      <td><?php echo $producto->getDescripcion() ?></td>
      <td><?php echo $producto->getPrecio() ?></td>
      <td><?php echo $producto->getSoloAccesoPremium() ?></td>
      <td><?php echo $producto->getSoloAccesoLogado() ?></td>
      <td><?php echo $producto->getBorrado() ?></td>
      <td><?php echo $producto->getActivo() ?></td>
      <td><?php echo $producto->getCreatedAt() ?></td>
      <td><?php echo $producto->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('producto/new') ?>">New</a>
