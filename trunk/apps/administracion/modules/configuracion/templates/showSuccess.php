<?php use_helper('Date') ?>
<div>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($configuracion->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($configuracion->getUpdatedAt(), 'p') ?>    </br>   

    </div>
    </br>
        <label>Nombre de variable: </label>    <?php echo $configuracion->getVariable() ?></br>
        <label>Descripción: </label>    <?php echo $configuracion->getDescripcion() ?></br>
        <label>Valor: </label>    <?php echo $configuracion->getValor() ?></br>

</div>


<div class="enlaces-centro">
<a href="<?php echo url_for('configuracion/edit?id='.$configuracion->getId()) ?>">Editar</a>
</div>