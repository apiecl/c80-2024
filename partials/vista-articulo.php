<?php 

//Necesario por el modo de inclusión
global $post;

							echo c80t_template_loader('partials/articulo-content', array('en_capitulo' => $en_capitulo));
							
							/**
							 * Subcapítulos
							 */
							$args = array(
								'post_type' => 'c80_cpt',
								'numberposts' => 100,
								'post_parent' => $post->ID,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'posts_per_page' => -1,
								'numberposts' 	=> -1
								);
							$subcap = new WP_Query($args);
							if($subcap->have_posts()):
								//ancestro para el nombre del capítulo
								$ancestor = get_post_ancestors( $subcap->ID );
								$ancestor_title = get_the_title($ancestor[0]) . ': ' . c80t_captitle($ancestor[0]);

								while($subcap->have_posts()):
									$subcap->the_post();
									$checkmod = c80_Public::c80_checkmod($post->ID);
									$checknew = c80_Public::c80_checknew($post->ID);									
										echo c80t_template_loader('partials/articulo-content', array('en_capitulo' => $en_capitulo));
									
								endwhile;
								wp_reset_postdata();
							endif;