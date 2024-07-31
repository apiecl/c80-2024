<?php 
/*
Template Name: Visualizaciones
*/

get_header();

?>

<div id="main" class="container container-visualizaciones">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article class="page">
		
			<div class="pad">
				<header>
					
					<h1><?php the_title();?></h1>

					<?php if(has_post_thumbnail()):?>
						<div class="img">
							<?php the_post_thumbnail( 'single' );?>
						</div>
					<?php endif;?>
						
				</header>
						
				<div class="contenido">
						
					<div class="the-content">
						<?php the_content();?>
					</div>
						
				</div>
			</div>
		
		</article>
		
			<?php endwhile; ?>
			<!-- post navigation -->

			<?php else: ?>
		
			<div class="error404">
			
				<p>No se encontró contenido</p>
			
			</div>
		
		<?php endif; ?>

		<?php 
			if(is_page( 516 )):

				get_template_part('partials/aside-opinion');

			endif;
		?>

	</section>
</div>

<?php
	get_footer();
?>