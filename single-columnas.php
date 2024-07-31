<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
		<article class="columna-estandar">
			<div class="pad">
				<header>

					<div class="info-columna">
						<div class="top-meta">
							<?php the_category( ', ' );?> |	<span itemprop="datePublished" content="<?php the_date('c'); ?>" pubdate><?php the_time( get_option( 'date_format' ) );?></span>
							
						</div>
						<h1 itemprop="headline"><?php the_title();?></h1>
						<div class="autor-card">
							<?php echo c80t_avatar(70);?>
							<p class="autor" itemprop="author">
								<?php the_author( );?>
							</p>
							<p class="autormeta">
								<?php the_author_meta( 'description' );?>
							</p>
							<p>

							<?php if(get_the_author_meta('author_orgurl')):?>
							<a href="<?php the_author_meta('author_orgurl');?>" target="_blank" title="<?php the_author_meta('author_org');?>">
								<i class="fa fa-external-link"></i>	<?php the_author_meta('author_org');?>
							</a>
							<?php else:?>
								<?php the_author_meta('author_org');?>								
							<?php endif;?>

							</p>
						</div>

					</div>

					<?php if(has_post_thumbnail()):
						
						$imgid = get_post_thumbnail_id( $post->ID );
						$pthsrc = wp_get_attachment_image_src( $imgid, 'main' );


						?>	
						<div class="imgobj img" itemprop="image">
							<?php the_post_thumbnail( 'main' );?>
						</div>
					<?php else:?>
						<div class="imgobj hidden">
							<img src="<?php echo get_bloginfo('template_url');?>/dist/img/placeholder-main_2017.png">
						</div>
					<?php endif;?>
					
				</header>
					
				<div class="contenido">
					
					<div class="excerpt">
						<?php the_excerpt();?>
					</div>	

					<p class="related">
						<?php echo c80t_relink($post->ID);?>
					</p>	
					<p class="temas temas-escritorio">
						<?php c80_tags();?>
					</p>	

					<?php get_template_part('partials/sharer');?>

					<div class="the-content" itemprop="articleBody">
						<?php the_content();?>
						
						<p class="temas temas-movil">
								<?php c80_tags();?>
						</p>


					</div>
						
				</div>
			</div>
			
		</article>
		
			<?php endwhile; ?>

			<?php get_template_part('partials/aside', 'c80rel');?>

			<!-- comments -->
				<?php comments_template();?>

			<!-- post navigation -->

			<?php else: ?>
		
			<div class="error404">
			
				<p>No se encontró contenido</p>
			
			</div>
		
		<?php endif; ?>
          <div class="opinion-footer clearfix col-md-8">			     
           <?php get_template_part('partials/colabora');?>
						
           </div>
	</section>
</div>

<?php
	get_footer();
?>
