<h1>Categoria contenidos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Texto</th>
      <th>Imagen</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categoria_contenidos as $categoria_contenido): ?>
    <tr>
      <td><a href="<?php echo url_for('categoriaContenido/edit?id='.$categoria_contenido->getId()) ?>"><?php echo $categoria_contenido->getId() ?></a></td>
      <td><?php echo $categoria_contenido->getTexto() ?></td>
      <td><?php echo $categoria_contenido->getImagen() ?></td>
      <td><?php echo $categoria_contenido->getCreatedAt() ?></td>
      <td><?php echo $categoria_contenido->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('categoriaContenido/new') ?>">New</a>
