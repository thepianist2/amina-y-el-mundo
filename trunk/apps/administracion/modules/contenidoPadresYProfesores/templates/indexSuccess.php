<h1>Contenido padres y profesoress List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id episodio</th>
      <th>Titulo</th>
      <th>Contenido</th>
      <th>Enlace video</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contenido_padres_y_profesoress as $contenido_padres_y_profesores): ?>
    <tr>
      <td><a href="<?php echo url_for('contenidoPadresYProfesores/edit?id='.$contenido_padres_y_profesores->getId()) ?>"><?php echo $contenido_padres_y_profesores->getId() ?></a></td>
      <td><?php echo $contenido_padres_y_profesores->getIdEpisodio() ?></td>
      <td><?php echo $contenido_padres_y_profesores->getTitulo() ?></td>
      <td><?php echo $contenido_padres_y_profesores->getContenido() ?></td>
      <td><?php echo $contenido_padres_y_profesores->getEnlaceVideo() ?></td>
      <td><?php echo $contenido_padres_y_profesores->getSoloAccesoPremium() ?></td>
      <td><?php echo $contenido_padres_y_profesores->getSoloAccesoLogado() ?></td>
      <td><?php echo $contenido_padres_y_profesores->getCreatedAt() ?></td>
      <td><?php echo $contenido_padres_y_profesores->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('contenidoPadresYProfesores/new') ?>">New</a>
