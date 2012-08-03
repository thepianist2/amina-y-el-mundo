<h1>Capitulos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id episodio</th>
      <th>Titulo</th>
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
    <?php foreach ($capitulos as $capitulo): ?>
    <tr>
      <td><a href="<?php echo url_for('capitulo/edit?id='.$capitulo->getId()) ?>"><?php echo $capitulo->getId() ?></a></td>
      <td><?php echo $capitulo->getIdEpisodio() ?></td>
      <td><?php echo $capitulo->getTitulo() ?></td>
      <td><?php echo $capitulo->getDescripcion() ?></td>
      <td><?php echo $capitulo->getSoloAccesoPremium() ?></td>
      <td><?php echo $capitulo->getSoloAccesoLogado() ?></td>
      <td><?php echo $capitulo->getBorrado() ?></td>
      <td><?php echo $capitulo->getActivo() ?></td>
      <td><?php echo $capitulo->getCreatedAt() ?></td>
      <td><?php echo $capitulo->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('capitulo/new') ?>">New</a>
