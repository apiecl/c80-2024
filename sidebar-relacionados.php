
		<?php 
		$c80public = new c80_Public('c80', '1.0.0');
		$relacionados = $c80public->c80_relart($post->ID);
			if($relacionados) {
				echo '<aside class="navegador-relacionados" data-id="' . $post->ID . '">';
				echo '<h4><i class="fa fa-code-fork"></i> Contenidos Relacionados</h4>';
				echo '<a href="#" class="btn btn-primary btn-showrel" data-id="' . $post->ID . '" ><i class="fa fa-code-fork"></i> Ver contenidos relacionados</a>';
				echo '<ul class="lista-articulos-relacionados" data-id="' . $post->ID . '">';
				foreach( $relacionados as $relacionado ) {
					$ptype = get_post_type($relacionado);
					$ptypeobj = get_post_type_object( $ptype );

					echo '<li class="rel-mini-item" data-id="' . $relacionado . '">';

					if(has_post_thumbnail($relacionado)):
						$pthumb = get_post_thumbnail_id( $relacionado );
						$psrc = wp_get_attachment_image_src( $pthumb, 'mini-item' );
						echo '<a href="' . get_permalink($relacionado) . '"><img src="' . $psrc[0] . '" alt="' . get_the_title($relacionado) . '"></a>';
					endif;

					echo '<div class="text">';
						echo '<span>' . $ptypeobj->labels->name . '</span>';
						echo '<h5><a href="' . get_permalink($relacionado) . '">' . get_the_title($relacionado) . '</a></h5>';
						if($ptype == 'columnas'):
							$author = get_post_field('post_author', $relacionado);
							echo '<span class="mini-autor">' . get_the_author_meta( 'display_name', $author ) . '</span>';
						endif;
					echo '</div>';
					echo '</li>';
				}
				echo '</ul>';
				echo '</aside>';
			};
			?>
