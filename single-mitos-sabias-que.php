<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article <?php post_class('mitos-sabias-que');?> >
			
			<div class="pad">
				<header>
					
					
					<h1 itemprop="headline"><?php the_title();?></h1>

					
					<?php get_template_part('partials/sharer');?>
						
				</header>
					
				<div class="contenido">
					
					<div class="the-content" itemprop="articleBody">
						<?php the_content();?>
					</div>

					<div class="img">

					<?php if(has_post_thumbnail()):?>	
						<div class="imgobj" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<?php the_post_thumbnail( 'single' );?>
						</div>
					<?php endif;?>
					
					</div>

					<div class="in-img-meta">
							<p class="related">
								<?php echo c80t_relink($post->ID);?>
							</p>
												
							<p class="temas temas-escritorio">
								<?php echo c80_tags();?>
							</p>
						</div>

					<p class="temas temas-movil">
								<?php c80_tags( );?>
					</p>
				</div>

				
			</div>
		
		</article>
		
			<?php endwhile; ?>

			<?php get_template_part('partials/aside', 'c80-mitos');?>

			

			<?php else: ?>
		
			<div class="error404">
			
				<p>No se encontró contenido</p>
				
			</div>
		
		<?php endif; ?>

	</section>
</div>

<?php
	get_footer();
?>