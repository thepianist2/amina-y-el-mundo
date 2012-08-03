<?php $url = html_entity_decode($action, ENT_COMPAT , 'UTF-8')?>
<?php if ($pager->haveToPaginate()): ?>
    <div id="pagination">
        <?php if ($pager->getPage() == 1): ?>
            <span class="disabled_pagination">Anterior</span>
        <?php else: ?>
            <?php echo link_to('Anterior', $url.$pager->getPreviousPage()); ?>
        <?php endif ?>

        <?php foreach($pager->getLinks() as $lista): ?>
            <?php if($pager->getPage() == $lista): ?>
                <span class="active_link"><?php echo $lista ?></span>
            <?php else: ?>
                <?php echo link_to($lista, $url.$lista) ?>
            <?php endif ?>
        <?php endforeach ?>

        <?php if ($pager->getPage() == $pager->getLastPage()): ?>
            <span class="disabled_pagination">Siguiente</span>
        <?php else: ?>
            <?php echo link_to('Siguiente', $url.$pager->getNextPage()); ?>
        <?php endif ?>

    </div>
<?php endif; ?>