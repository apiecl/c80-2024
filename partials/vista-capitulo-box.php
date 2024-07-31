<article class="capitulo-constitucion-box" id="capbox-<?php echo $post->post_name;?>">
	<a href="<?php the_permalink();?>">
	<div class="wrap">
	<header class="header-capitulo">
		<h1>
			<span class="txt">
				<span class="titlename"><?php the_title();?></span>
				<br> 
				<span class="capsubt"><?php echo c80t_captitle($post->ID);?></span>
			</span>
		</h1>
	</header>
		<?php 
			$args = array(
				'post_type' => 'c80_cpt',
				'numberposts' => -1,
				'post_parent' => $post->ID,
				'orderby'	=> 'menu_order',
				'order'		=> 'ASC'
			);
			$subs = get_posts($args);
			$first = $subs[0];
			$last = $subs[count($subs) -1];
			

			$argsfirst = array(
				'post_type' 	=> 'c80_cpt',
				'numberposts' 	=> -1,
				'post_parent'	=> $first->ID,
				'orderby'		=> 'menu_order',
				'order'			=> 'ASC'
			);

			$childfirst = get_posts($argsfirst);


			$argslast = array(
				'post_type' 	=> 'c80_cpt',
				'numberposts' 	=> -1,
				'post_parent'	=> $last->ID,
				'orderby'		=> 'menu_order',
				'order'			=> 'ASC'
			);
				
			$childlast = get_posts($argslast);

			if($childfirst) {
				$first = $childfirst[0];
			}

			if($childlast) {
				$last = $childlast[count($childlast) - 1];
			}



			echo '<span class="article-range">' . $first->post_title . ' <i class="fa fa-angle-right"></i> ' . $last->post_title . '</span>'; 
		?>	
		</div>
	</a>
</article>