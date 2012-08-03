<h1>Juego episodios List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id episodio</th>
      <th>Titulo</th>
      <th>Enlace juego</th>
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
    <?php foreach ($juego_episodios as $juego_episodio): ?>
    <tr>
      <td><a href="<?php echo url_for('juegoEpisodio/edit?id='.$juego_episodio->getId()) ?>"><?php echo $juego_episodio->getId() ?></a></td>
      <td><?php echo $juego_episodio->getIdEpisodio() ?></td>
      <td><?php echo $juego_episodio->getTitulo() ?></td>
      <td><?php echo $juego_episodio->getEnlaceJuego() ?></td>
      <td><?php echo $juego_episodio->getDescripcion() ?></td>
      <td><?php echo $juego_episodio->getSoloAccesoPremium() ?></td>
      <td><?php echo $juego_episodio->getSoloAccesoLogado() ?></td>
      <td><?php echo $juego_episodio->getBorrado() ?></td>
      <td><?php echo $juego_episodio->getActivo() ?></td>
      <td><?php echo $juego_episodio->getCreatedAt() ?></td>
      <td><?php echo $juego_episodio->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('juegoEpisodio/new') ?>">New</a>
