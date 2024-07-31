<?php
//frontpage
get_header();
?>

<div id="main" class="container">

	<div class="home-presentation">
		<img class="logo-presentation" src="<?php echo get_bloginfo('template_url'); ?>/dist/img/logoc80_2017_2.svg" alt="<?php bloginfo('name'); ?>">
		<h2><?php echo get_bloginfo('description'); ?></h2>
		<h3>Indagamos y visualizamos temas constitucionales para personas no expertas</h3>

		<div class="temas-home hidden-xs">
			<span>Temas:</span> <?php echo c80t_temas_mobile(4); ?>
		</div>

		<div class="temas-home visible-xs">
			<span>Temas:</span> <?php echo c80t_temas_mobile(2); ?>
		</div>
	</div>





	<div class="visualizaciones-recursos">
		<h2 class="visualizaciones-title">Visualizaciones y recursos</h2>
		<div class="visualizaciones-widgets">
			<?php dynamic_sidebar('anuncios'); ?>
		</div>
	</div>

	<div class="contenedor-home">

		<div class="featured-section">
			<?php
			$featured = c80t_run_featured();
			while ($featured->have_posts()) : $featured->the_post();
				//Imagen destacada
				$pthid = get_post_thumbnail_id(get_the_ID());
				$pthsrc = wp_get_attachment_image_src($pthid, 'main');
				$iswide = 'wide';
				$rels = rwmb_meta('c80_artrel', 'multiple=true', get_the_ID());
			?>

				<article class="featured <?php echo $iswide; ?>">
					<a href="<?php the_permalink(); ?>">
						<div class="pad" style="background-image:url(<?php echo $pthsrc[0]; ?>);">
							<div class="overlay">
								<div class="center-wrapper">
									<div class="top-info">
										<!-- <div class="over-title">
										<?php the_time(get_option('date_format')); ?>
									</div> -->
										<h1>
											<?php the_title(); ?>
										</h1>


									</div>

									<div class="excerpt">
										<div class="excerptcontent">
											<?php the_excerpt(); ?>
										</div>
										<?php if ($rels) : ?>
											<div class="minirels">
												<h5>Leer <?= count($rels); ?> artículos de la constitución relacionados:</h5>
												<?php echo c80t_relplain($post->ID); ?>

											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div><!--pad-->
					</a>
				</article>

				<?php if ($iswide != 'wide') : ?>

					<div class="related-featured">
						<?php get_template_part('partials/aside', 'c80rel-front'); ?>
					</div>

				<?php endif; ?>

			<?php
				wp_reset_postdata();
			endwhile;
			?>
		</div>


		<section class="noticias">
			<h2 class="opsect">Más noticias</h2>
			<div class="rm">

				<?php
				$homeitems = c80t_run_frontpage();
				$key = 0;
				while ($homeitems->have_posts()) : $homeitems->the_post();
					$key++;

					if (get_post_type($post->ID) == 'mitos-sabias-que') {
						$size = 'main';
					} else {
						$size = 'secondary';
					}


					$hs = '<h2>';
					$he = '</h2>';


				?>

					<article <?php post_class('item-' . $key); ?>>

						<div class="pad">
							<div class="img">

								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail($size); ?>
								</a>

								<div class="top-info">
									<!-- <div class="over-title">
										<span class="date"><?php the_time(get_option('date_format')); ?></span>
									</div> -->
									<?php echo $hs; ?>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php echo $he; ?>


								</div>
							</div>

							<div class="bottom-meta">

								<p class="related">
									<?php echo c80t_relink($post->ID); ?>
								</p>

							</div>
						</div>

					</article>


				<?php
					wp_reset_postdata();
				endwhile;
				?>

			</div>


		</section>

		<?php get_template_part('partials/aside-opinion'); ?>

	</div>

	<div class="ancho-home">
		<section class="map">
			<?php get_template_part('partials/colabora'); ?>
		</section>
	</div>
</div>

<?php
get_footer();
?>