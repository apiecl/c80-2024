<?php 
/*
Template Name: Noticias
*/

	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		<h1 class="archive-title">Archivo de Noticias</h1>

		<div class="archive-items">
		<?php 
		$paged = get_query_var( 'paged' );
		$args = array(
				'post_type' => array('post', 'mitos-sabias-que'),
				'posts_per_page' => 10,
				'paged' => $paged
			);
			$noticias = new WP_Query($args);
		?>

		<?php if ( $noticias->have_posts() ) : while ( $noticias->have_posts() ) : $noticias->the_post(); ?>
			<?php 
				$ptype = get_post_type( );
				$ptypeobj = get_post_type_object( $ptype );
				$ptypename = $ptypeobj->labels->name;
			?>
			<article class="articulo-archivo">
			<div class="in-img-archive hidden-xs">				
				<?php if(has_post_thumbnail( ) && $ptype == 'post' || has_post_thumbnail() && $ptype == 'mitos-sabias-que'):?>
					<?php the_post_thumbnail( 'featured' );?>
				<?php else:?>
					<?php echo c80t_avatar(160);?>
				<?php endif;?>
			</div>	
        <div class="mobile-img-archive visible-xs">
            <?php if(has_post_thumbnail() && $ptype == 'post' || has_post_thumbnail() && $ptype == 'mitos-sabias-que'):?>
                <?php the_post_thumbnail( 'single');?>
            <?php endif;?>
        </div>
			<div class="in-txt-archive">			
				
				<p class="top-meta">
					<?php echo $ptypename;?> | <?php the_time(get_option('date_format'));?>
				</p>

				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				
				<p class="autor">
					<?php the_author();?>
				</p>
			
				<p class="related">
					<?php echo c80t_relink($post->ID);?>
				</p>	
					
			</div>

			</article>
			
				<?php endwhile; ?>
				<!-- post navigation -->

				
				<?php c80_paginator($noticias);?>
				


				<?php else: ?>
			
				<div class="error404">
				
					<p>No se encontró contenido</p>
				
				</div>
			
			<?php endif; ?>
		</div>

	</section>
</div>

<?php
	get_footer();
?>
