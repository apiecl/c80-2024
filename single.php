<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<article <?php post_class('articulo-estandar');?> >
			
			<div class="pad">
				<header>
					<div class="top-meta">
						<?php the_category( ', ' );?> |	<span itemprop="datePublished" content="<?php the_date('c'); ?>" pubdate><?php the_time( get_option( 'date_format' ) );?></span>
						<meta itemprop="dateModified" content="<?php echo get_the_modified_date( 'c' );?>">
					</div>
					
					<h1 itemprop="headline"><?php the_title();?></h1>

					<p class="autor" itemprop="author">
						<?php the_author();?>
					</p>


					<div class="img">

					<?php if(has_post_thumbnail()):?>	
						<div class="imgobj" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<?php the_post_thumbnail( 'single' );?>
						</div>
					<?php endif;?>

						<div class="in-img-meta">
							<p class="related">
								<?php echo c80t_relink($post->ID);?>
							</p>
												
							<p class="temas temas-escritorio">
								<?php echo c80_tags();?>
							</p>
						</div>
					
					</div>
					
					<?php get_template_part('partials/sharer');?>
						
				</header>
					
				<div class="contenido">
					
					
				<?php if(has_excerpt()):?>
					<div class="excerpt">

						<?php the_excerpt();?>	

					</div>	
				<?php endif;?>

					<div class="the-content" itemprop="articleBody">
						<?php the_content();?>
					</div>

					<p class="temas temas-movil">
								<?php c80_tags( );?>
					</p>
				</div>

				
			</div>
		
		</article>
		
			<?php endwhile; ?>

			<?php get_template_part('partials/aside', 'c80rel');?>

			

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