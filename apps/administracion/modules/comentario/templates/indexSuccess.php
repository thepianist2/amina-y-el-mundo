<h1>Comentarios List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id usuario</th>
      <th>Id unidad tematica</th>
      <th>Publicacion</th>
      <th>Archivo</th>
      <th>Borrado</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($comentarios as $comentario): ?>
    <tr>
      <td><a href="<?php echo url_for('comentario/edit?id='.$comentario->getId()) ?>"><?php echo $comentario->getId() ?></a></td>
      <td><?php echo $comentario->getIdUsuario() ?></td>
      <td><?php echo $comentario->getIdUnidadTematica() ?></td>
      <td><?php echo $comentario->getPublicacion() ?></td>
      <td><?php echo $comentario->getArchivo() ?></td>
      <td><?php echo $comentario->getBorrado() ?></td>
      <td><?php echo $comentario->getCreatedAt() ?></td>
      <td><?php echo $comentario->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('comentario/new') ?>">New</a>
