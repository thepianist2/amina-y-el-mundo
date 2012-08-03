<h1>El expertos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id episodio</th>
      <th>Enlace video</th>
      <th>Descripcion</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Borrado</th>
      <th>Activo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($el_expertos as $el_experto): ?>
    <tr>
      <td><a href="<?php echo url_for('elExperto/edit?id='.$el_experto->getId()) ?>"><?php echo $el_experto->getId() ?></a></td>
      <td><?php echo $el_experto->getIdEpisodio() ?></td>
      <td><?php echo $el_experto->getEnlaceVideo() ?></td>
      <td><?php echo $el_experto->getDescripcion() ?></td>
      <td><?php echo $el_experto->getSoloAccesoPremium() ?></td>
      <td><?php echo $el_experto->getSoloAccesoLogado() ?></td>
      <td><?php echo $el_experto->getBorrado() ?></td>
      <td><?php echo $el_experto->getActivo() ?></td>
      <td><?php echo $el_experto->getCreatedAt() ?></td>
      <td><?php echo $el_experto->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('elExperto/new') ?>">New</a>
