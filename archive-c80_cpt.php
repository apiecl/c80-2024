<?php 
//standard archive para constitución
$timeline = get_query_var('timeline');
if($timeline == true) {

	include( TEMPLATEPATH . '/c80-timeline.php');
	
} else {

	get_header(); 

	//ultimas modificaciones

	$args = array(
				'post_type' 	=> 'c80_cptrev',
				'numberposts'	=> 1,
				'orderby'		=> 'date',
				'order'			=> 'DESC'
				);

	$lastpost 	= get_posts($args)[0];
	$date 		= mysql2date( 'j \d\e F, Y', $lastpost->post_date, $translate = true );

	?>

	<div id="main" class="container">

		<div class="row-constitucion">
			
			<h1 class="mainc80title">
				<i class="fa fa-book"></i> Constitución Política de la República de Chile (1980)
				<p style="color: #555; font-size: 16px; font-family: sans-serif; margin-left: 44px; margin-bottom: 24px;">Última actualización <strong><?php echo $date;?></strong></p>
			</h1>

			
			<section class="contenedor-constitucion-box">
				
				
				<?php 
				$args = array(
					'posts_per_page' => -1,
					'post_type' => 'c80_cpt',
					'post_parent' => 0,
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
				$articles = array();
				$archivequery = new WP_Query($args);
				while($archivequery->have_posts()): $archivequery->the_post();

					get_template_part( 'partials/vista', 'capitulo-box' );

					$articulosoptions = c80t_getarticulos();
					//var_dump($articulos);

					?>

				<?php endwhile;?>
			</section>
		</div>

		<div class="article-select">
			<h3>Ir a artículo</h3>
			<select name="gotoarticle" id="gotoarticle">
				<option value="" disabled>Escoge un artículo</option>
				<?php foreach($articulosoptions as $key=>$articulooption) { 
					if(substr($key, 0, 3) == 'top') { ?>

						<option value="" disabled>-- <?php echo $articulooption;?></option>

						<?php 
					} else { ?>

						<option value="<?php echo get_permalink($key);?>"><?php echo $articulooption;?></option>

					<?php }?>

				<?php }?>
			</select>
		</div>
		
		<?php get_template_part( 'partials/fuente' );?>
		<?php get_template_part( 'partials/modal-c80link' );?>
	</div>

	<?php
	get_footer();
	?>

	<?php 
}


?>



