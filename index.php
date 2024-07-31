<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php get_sidebar('articulos');?>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article class="articulo-constitucion">
		
			<header>
				
				<h1><?php the_title();?></h1>
		
			</header>
		
			<div class="main-content">
		
				<?php the_content();?>
		
			</div>
		
		</article>
		
			<?php endwhile; ?>
			<!-- post navigation -->

			<?php else: ?>
		
			<div class="error404">
			
				<p>No se encontró contenido</p>
			
			</div>
		
		<?php endif; ?>
		
		<?php get_sidebar('relaciondos');?>

	</section>
</div>

<?php
	get_footer();
?>