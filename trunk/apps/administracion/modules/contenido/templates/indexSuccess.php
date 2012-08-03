<h1>Contenidos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id usuario</th>
      <th>Id categoria contenido</th>
      <th>Titulo</th>
      <th>Contenido</th>
      <th>Borrado</th>
      <th>Activo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contenidos as $contenido): ?>
    <tr>
      <td><a href="<?php echo url_for('contenido/edit?id='.$contenido->getId()) ?>"><?php echo $contenido->getId() ?></a></td>
      <td><?php echo $contenido->getIdUsuario() ?></td>
      <td><?php echo $contenido->getIdCategoriaContenido() ?></td>
      <td><?php echo $contenido->getTitulo() ?></td>
      <td><?php echo $contenido->getContenido() ?></td>
      <td><?php echo $contenido->getBorrado() ?></td>
      <td><?php echo $contenido->getActivo() ?></td>
      <td><?php echo $contenido->getCreatedAt() ?></td>
      <td><?php echo $contenido->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('contenido/new') ?>">New</a>
