<?php 
	$imageid = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $imageid, 'full', false );
	$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5');
	$fasedata = array();
	$timeline_options = get_option('c80_timeline_options');
?>

	
	<nav id="<?php echo $id;?>" class="navbar fases-nav-home in-home timeline-pensiones-nav">
		<ul class="fases-main nav">
			<li class="fase-arrow nav-item nav-item-home" id="navfase-inicio">
				<a href="#inicio" class="faselink nav-link"><i class="fa fa-home"></i> Línea de tiempo seguridad social</a>
			</li>
			
			

			<li class="fase-arrow nav-item nav-item-info" id="navfase-info">
				<a href="#" class="nav-link plusc80timeline hidden-xs"><i class="fa fa-plus"></i></a>
				<div class="extra-info">
					<a href="<?php bloginfo('url');?>" class="backtoc80 hidden-xs"><img src="<?php bloginfo('template_url');?>/dist/img/c80_logo_negro.svg" alt="<?php bloginfo('title');?>"> visitar c80.cl</a>
					<a title="Sobre esta linea de tiempo" href="#" data-toggle="modal" data-target="#infolinea" class="nav-link"><i class="fa fa-info-circle"></i></a>
					<a href="<?php bloginfo('url');?>" class="backtoc80 visible-xs"><img src="<?php bloginfo('template_url');?>/dist/img/c80_logo_negro.svg" alt="<?php bloginfo('title');?>"> visitar c80.cl</a>
				</div>
			</li>
		</ul>
	</nav>