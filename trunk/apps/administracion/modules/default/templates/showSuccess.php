<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $unidad_tematica->getId() ?></td>
    </tr>
    <tr>
      <th>Id usuario:</th>
      <td><?php echo $unidad_tematica->getIdUsuario() ?></td>
    </tr>
    <tr>
      <th>Titulo:</th>
      <td><?php echo $unidad_tematica->getTitulo() ?></td>
    </tr>
    <tr>
      <th>Descripcion:</th>
      <td><?php echo $unidad_tematica->getDescripcion() ?></td>
    </tr>
    <tr>
      <th>Solo acceso premium:</th>
      <td><?php echo $unidad_tematica->getSoloAccesoPremium() ?></td>
    </tr>
    <tr>
      <th>Solo acceso logado:</th>
      <td><?php echo $unidad_tematica->getSoloAccesoLogado() ?></td>
    </tr>
    <tr>
      <th>Borrado:</th>
      <td><?php echo $unidad_tematica->getBorrado() ?></td>
    </tr>
    <tr>
      <th>Activo:</th>
      <td><?php echo $unidad_tematica->getActivo() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $unidad_tematica->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $unidad_tematica->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('default/edit?id='.$unidad_tematica->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('default/index') ?>">List</a>
