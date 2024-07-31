<?php 
/*
Template Name: Linea de tiempo
*/
?>

<?php 
get_header('timeline');
$timeline = get_query_var('timeline');
$fase = get_query_var('fase');
$imageid = get_post_thumbnail_id( $post->ID );
$image = wp_get_attachment_image_src( $imageid, 'full', false );

if(function_exists( 'jetpack_photon_url')) {
	$wpthumbnail = jetpack_photon_url($image[0]);
} else {	
	$wpthumbnail = $image[0];	
}



$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5');
$fasedata = array();
$timeline_options = get_option('c80_timeline_options');
$timeline_info_content = get_post($timeline_options['c80_vispost']);
?>

<div class="fixedtoplogo hidden-xs">
	<a title="<?php bloginfo('name');?>" href="<?php bloginfo('url');?>" onClick="closeTimeline();"><img src="<?php bloginfo('template_url');?>/dist/img/c80_logo_blanco.svg" alt="<?php bloginfo('name');?>"></a>
</div>

<div class="desktop-sharer visible-lg">
	<a class="sharer-display">
			<i class="fa fa-share-alt"></i>
	</a>
	<div class="sharers" data-title="<?php echo get_the_title($post->ID);?>">
			<a class="share-link facebook" data-base="https://facebook.com/sharer.php?u="><i class="fa fa-facebook"></i></a>
			<a class="share-link twitter" data-base="https://twitter.com/share?url=" data-additional="&via=proyectoC80"><i class="fa fa-twitter"></i></a>
			<a class="share-link linkedin" data-base="http://www.linkedin.com/sharing/share-offsite/?url="><i class="fa fa-linkedin"></i></a>
	</div>
</div>

<div class="timeline-mobile-header visible-xs">
	<a class="gotohome" href="<?php bloginfo('url');?>" onClick="closeTimeline();"><img src="<?php bloginfo('template_url');?>/dist/img/c80_logo_blanco.svg" alt="<?php bloginfo('name');?>"></a>

	<nav class="timeline-nav-mobile visible-xs">
		<div class="navwrap">
			<!-- <img src="<?php bloginfo('template_url');?>/dist/img/c80_logo_blanco.svg" alt="<?php bloginfo('name');?>"> -->
			<span class="toggle-timeline-nav"><i class="fa fa-bars"></i></span>
		</div>
	</nav>

	<div class="mobile-share">
		<a class="sharer-display">
			<i class="fa fa-share-alt"></i>
		</a>

		<?php get_template_part('partials/timeline-sharer');?>
	</div>

	<div class="mobile-interaction">
		<span class="closetimeline"><i class="fa fa-times"></i></span>
	</div>

</div>

<div id="main-timeline" class="container-fluid">

	<section class="timeline-presentation" id="inicio" style="background-image: url(<?php echo $wpthumbnail;?>);">
		<div class="content-wrap">
			<div class="intro-stuff">
				<div class="text-header">
					<h1><?php the_title();?></h1>

				</div>
				<div class="text-content">
					<div class="content">
						<?php the_content();?>
						<img class="logofondartlinea" src="<?php bloginfo('template_url');?>/dist/img/fondartlt_d.png" alt="Fondart 2019">
					</div>

				</div>
			</div>

		</div>

		<div class="intro-indicator">

			<a href="#<?php echo c80_faselink($fases[0], false);?>" class="intro-arrow" title="Comenzar">

				<i class="fa fa-angle-down"></i>
				<p>comenzar</p>
			</a>
		</div>




	</section>

	<?php foreach($fases as $key=>$curfase) {
		$next = (isset($fases[$key+1]))? $fases[$key+1] : false;
		c80_presentacion_fase($curfase, $next);
	}?>

</div>

<div id="timeline-active">
	
	

	
	<div id="timeline-js-container">
		<!-- here goes the timeline lol -->
	</div>
	
	<?php 
	$id = 'inside-timeline-nav';
	include( locate_template( 'partials/timeline-nav.php', false, false ) );
	?>

</div>

<?php 
$id = 'timeline-nav';
include( locate_template( 'partials/timeline-nav.php', false, false ) );
?>

<div class="nextphase-mobile">
	<a class="btn-nextphase" data-toggle="nextphase">próximo período <span class="range"></span><i class="fa fa-angle-right"></i></a>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="infolinea">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $timeline_info_content->post_title;?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<?php echo apply_filters('the_content', $post->post_excerpt);?>

			</div>
		</div>
	</div>
</div>

<?php
get_footer('timeline');
?>