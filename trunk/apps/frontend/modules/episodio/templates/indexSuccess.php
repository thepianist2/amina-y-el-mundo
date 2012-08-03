<h1>Episodios List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id unidad tematica</th>
      <th>Titulo</th>
      <th>Descripcion</th>
      <th>Enlace video</th>
      <th>Solo acceso premium</th>
      <th>Solo acceso logado</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($episodios as $episodio): ?>
    <tr>
      <td><a href="<?php echo url_for('episodio/edit?id='.$episodio->getId()) ?>"><?php echo $episodio->getId() ?></a></td>
      <td><?php echo $episodio->getIdUnidadTematica() ?></td>
      <td><?php echo $episodio->getTitulo() ?></td>
      <td><?php echo $episodio->getDescripcion() ?></td>
      <td><?php echo $episodio->getEnlaceVideo() ?></td>
      <td><?php echo $episodio->getSoloAccesoPremium() ?></td>
      <td><?php echo $episodio->getSoloAccesoLogado() ?></td>
      <td><?php echo $episodio->getCreatedAt() ?></td>
      <td><?php echo $episodio->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('episodio/new') ?>">New</a>
