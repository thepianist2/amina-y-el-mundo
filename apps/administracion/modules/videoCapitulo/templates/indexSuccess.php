<h1>Video capitulos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id capitulo</th>
      <th>Descripcion</th>
      <th>Enlace video</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Borrado</th>
      <th>Activo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($video_capitulos as $video_capitulo): ?>
    <tr>
      <td><a href="<?php echo url_for('videoCapitulo/edit?id='.$video_capitulo->getId()) ?>"><?php echo $video_capitulo->getId() ?></a></td>
      <td><?php echo $video_capitulo->getIdCapitulo() ?></td>
      <td><?php echo $video_capitulo->getDescripcion() ?></td>
      <td><?php echo $video_capitulo->getEnlaceVideo() ?></td>
      <td><?php echo $video_capitulo->getSoloAccesoPremium() ?></td>
      <td><?php echo $video_capitulo->getSoloAccesoLogado() ?></td>
      <td><?php echo $video_capitulo->getBorrado() ?></td>
      <td><?php echo $video_capitulo->getActivo() ?></td>
      <td><?php echo $video_capitulo->getCreatedAt() ?></td>
      <td><?php echo $video_capitulo->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('videoCapitulo/new') ?>">New</a>
