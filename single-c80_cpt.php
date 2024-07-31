<?php 
//standard index para vista de artículos y capitulos
	get_header();
?>

<div id="main" class="container">

	<section class="contenedor-estandar">
		
		<div class="navegador-c80 col-md-2">
			<?php echo c80t_articulos();?>	
		</div>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<div class="col-md-10">
		<?php 
			if($post->post_parent == 0) {
				//es capitulo
				get_template_part( 'partials/vista', 'capitulo' );
			} else {
				//es articulo
				echo c80t_template_loader( 'partials/vista-articulo', array('en_capitulo' => false) );
			}?>
		
			<?php endwhile; ?>
			<!-- post navigation -->

			<?php else: ?>
		
			<div class="error404">
			
				<p>No se encontró contenido</p>
			
			</div>
		
		<?php endif; ?>

		</div>
	
		<div class="navegador-c80-movil">
			<?php echo c80t_articulos();?>	
		</div>

	</section>
	<?php get_template_part( 'partials/fuente' );?>
	<?php get_template_part( 'partials/modal-c80link' );?>
</div>

<?php
	get_footer();
?>