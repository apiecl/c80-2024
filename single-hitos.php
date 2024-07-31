<?php
$enddatefield =  get_post_meta($post->ID, 'c80_lt_end_date', true);

$fecha_start = DateTime::createFromFormat('Y-m-d', get_post_meta($post->ID, 'c80_lt_start_date', true));
$fecha_end = DateTime::createFromFormat('Y-m-d', $enddatefield);
//$date_processed = date_create_from_format("Y-m-d", $fecha_start);
?>
<?php
//single hitos
get_header();

?>

<div id="main" class="container">
	<section class="contenedor-estandar">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article <?php post_class('hitos'); ?>>

					<div class="pad">
						<header>

							<span class="fecha-hito">
								<?php if ($fecha_start) : ?>
									<?php echo date_i18n('d \d\e F Y', $fecha_start->format('U')); ?> <?php if ($enddatefield) : ?> - <?php echo date_i18n('d \d\e F Y', $fecha_end->format('U')); ?> <?php endif; ?>
								<?php else : ?>
									<?php echo get_post_meta($post->ID, 'c80_lt_start_date', true);

									if (get_post_meta($post->ID, 'c80_lt_end_date', true)) :
										echo ' - ' . get_post_meta($post->ID, 'c80_lt_end_date', true);
									endif; ?>
								<?php endif; ?>
							</span>
							<?php if (is_object_in_term($post->ID, 'tipo_hito', [240, 237, 252])) : ?>
								<h1 itemprop="headline"><span>Hito constitucional</span> <?php the_title(); ?></h1>
							<?php else : ?>
								<h1 itemprop="headline"><span>Hito de seguridad social</span> <?php the_title(); ?></h1>
							<?php endif; ?>


							<?php if (get_post_meta($post->ID, 'c80_lt_media', true) && c80_checkYoutube(get_post_meta($post->ID, 'c80_lt_media', true)) == true) : ?>

								<div class="video">
									<?php echo apply_filters('the_content', get_post_meta($post->ID, 'c80_lt_media', true)); ?>
								</div>

							<?php elseif (has_post_thumbnail()) : ?>
								<div class="img">
									<div class="imgobj" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
										<?php the_post_thumbnail('single'); ?>
									</div>

								</div>

							<?php endif ?>

							<span class="mediacaption"><?php echo get_post_meta($post->ID, 'c80_lt_media_caption', true); ?> -
								<span><?php echo get_post_meta($post->ID, 'c80_lt_media_credit', true); ?></span>
							</span>

							<div class="hito-info">



							</div>




							<div class="img">

								<div class="in-img-meta">
									<p class="related">
										<?php echo c80t_relink($post->ID); ?>
									</p>


								</div>

							</div>

							<?php get_template_part('partials/sharer'); ?>

						</header>

						<div class="contenido">


							<?php if (has_excerpt()) : ?>
								<div class="excerpt">

									<?php the_excerpt(); ?>

								</div>
							<?php endif; ?>

							<div class="the-content" itemprop="articleBody">
								<?php the_content(); ?>
							</div>

							<?php if (is_object_in_term($post->ID, 'tipo_hito', [240, 237, 252])) : ?>

								<a href="<?php echo bloginfo('url'); ?>/linea/#<?php echo $post->post_name; ?>" class="linkline">
									Este hito es parte de la <strong>Línea de tiempo constitucional</strong> <span><i class="fa fa-chevron-right"></i> Ver en su contexto</span></a>

							<?php else : ?>

								<a href="<?php echo get_permalink(2729); ?>/#<?php echo $post->post_name; ?>" class="linkline">Este hito es parte de la <strong>Línea de tiempo seguridad social</strong> <span><i class="fa fa-chevron-right"></i> Ver en su contexto</span></a>

							<?php endif; ?>

						</div>


					</div>

				</article>

			<?php endwhile; ?>

			<?php get_template_part('partials/aside', 'c80rel'); ?>




			<!-- post navigation -->

		<?php else : ?>

			<div class="error404">

				<p>No se encontró contenido</p>

			</div>

		<?php endif; ?>

	</section>
</div>

<?php
get_footer();
?>