<h1>Fotografia contenido padres y profesoress List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id contenido padres y profesores</th>
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
    <?php foreach ($fotografia_contenido_padres_y_profesoress as $fotografia_contenido_padres_y_profesores): ?>
    <tr>
      <td><a href="<?php echo url_for('fotografiaContenidoPadresYProfesores/edit?id='.$fotografia_contenido_padres_y_profesores->getId()) ?>"><?php echo $fotografia_contenido_padres_y_profesores->getId() ?></a></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getIdContenidoPadresYProfesores() ?></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getDescripcion() ?></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getFotografia() ?></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getSoloAccesoPremium() ?></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getSoloAccesoLogado() ?></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getBorrado() ?></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getActivo() ?></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getCreatedAt() ?></td>
      <td><?php echo $fotografia_contenido_padres_y_profesores->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('fotografiaContenidoPadresYProfesores/new') ?>">New</a>
