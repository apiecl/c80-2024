<aside class="c80-mitos">
		<!-- <header>
			<h2><i class="fa fa-book"></i>  Más mitos</h2>
		</header> -->
		
		<?php 
			$args = array(
				'post_type'=> 'mitos-sabias-que',
				'numberposts' => 3,
				'posts__not_in' => $post->ID
			);
			$mitos = get_posts($args);
			foreach($mitos as $mito) {

				//echo c80_smallmito($mito->ID);

			}
		?>
			
</aside>