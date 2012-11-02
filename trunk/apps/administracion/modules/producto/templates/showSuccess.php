<?php use_helper('Date') ?>
<style type="text/css">

/*Make sure your page contains a valid doctype at the top*/
#simplegallery1{ 
position: relative; /*keep this intact*/
visibility: hidden; /*keep this intact*/
border: 10px solid #3399ff;
margin-left: 200px;
}

#simplegallery1 .gallerydesctext{ 
text-align: left;
padding: 2px 5px;
}

</style>
<?php $imagenes=$producto->getFotografiaProducto(); ?>
<script type="text/javascript">
<?php if(count($imagenes)>0){ ?>
var mygallery=new simpleGallery({
	wrapperid: "simplegallery1", //ID of main gallery container,
	dimensions: [550, 500], //width/height of gallery in pixels. Should reflect dimensions of the images exactly
	
        

        imagearray: [
            <?php foreach ($imagenes as $imagen) { ?>
		["<?php echo '/uploads/'.$imagen->getFotografia() ?>", "<?php echo '/uploads/'.$imagen->getFotografia() ?>", "_new", "<?php echo $imagen->getDescripcion(); ?>"],
            <?php  } ?>
	],
	autoplay: [true, 3000, 2], //[auto_play_boolean, delay_btw_slide_millisec, cycles_before_stopping_int]
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 500, //transition duration (milliseconds)
	oninit:function(){ //event that fires when gallery has initialized/ ready to run
		//Keyword "this": references current gallery instance (ie: try this.navigate("play/pause"))
	},
	onslide:function(curslide, i){ //event that fires after each slide is shown
		//Keyword "this": references current gallery instance
		//curslide: returns DOM reference to current slide's DIV (ie: try alert(curslide.innerHTML)
		//i: integer reflecting current image within collection being shown (0=1st image, 1=2nd etc)
	}
})
<?php } ?>
</script>
<div>
    <h1><?php echo $producto->getNombre(); ?></h1>
    <div style="background-color: greenyellow;">
    <?php echo "Creado en: ". format_date($producto->getCreatedAt(), 'p') ?></br>
    <?php echo "Última modificación: ". format_date($producto->getUpdatedAt(), 'p') ?>    </br>   
    
    <label>Solo acceso premium: </label>    <?php echo $producto->getSoloAccesoPremium() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Solo acceso logado: </label>    <?php echo $producto->getSoloAccesoLogado() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>
    <label>Activa: </label>    <?php echo $producto->getActivo() ? image_tag('iconos/tick.png') : image_tag('iconos/cross.png') ?>

    </div>
    <div>

       <?php echo nl2br(html_entity_decode($producto->getDescripcion(), ENT_COMPAT , 'UTF-8')); ?>

    </div>
    
    
    
</div>

<br></br>
<?php if(count($imagenes)>0){ ?>
<label>Imágenes</label>
<div id="simplegallery1" style="margin-left: 62px;"></div>
<br></br>
<?php } ?>


<div class="enlaces-centro">
&nbsp;<a href="<?php echo url_for('producto/index') ?>">Volver a la lista</a>                
<a href="<?php echo url_for('producto/edit?id='.$producto->getId()) ?>">Editar</a>
</div>