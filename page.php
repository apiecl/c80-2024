<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article class="page">
		
			<div class="pad">
				<header>
					
					<h1><?php the_title();?></h1>

					<div class="img">
						<?php the_post_thumbnail( 'single' );?>
					</div>
						
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