<aside class="standard">
	<div>
		<h2>Más noticias</h2>
		<!--Contenedor estándar-->
		<ul>
		<?php 
			$args = array(
				'post_type' => array('post'),
				'numberposts' => 6,
				'exclude' => $post->ID
				);
			$asides = get_posts($args);
			foreach($asides as $aside) { ?>
				
				<li class="aside-item">
		
					<a href="<?php echo get_permalink($aside->ID);?>">
				
					<p class="fecha"><?php echo get_the_time( get_option('date_format'), $aside->ID );?></p>
		
					<h3><?php echo $aside->post_title;?></h3>	
		
					<p class="author">Por <?php echo get_the_author_meta( 'display_name', $aside->post_author );?></p>
					
					</a>
				</li>
		
		
			<?php }
				?>
		</ul>
	</div>
</aside>