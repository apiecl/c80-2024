<?php 

function c80t_jsonmicrodata() {
	/**
	 * Devuelve un Json con el marcado de datos para google y similares
	 */
	global $post;
	$jsonid = get_permalink($post->ID);
	if(get_post_type($post->ID) == 'post'):
		$type = 'NewsArticle';
		$pthid = get_post_thumbnail_id( $post->ID );
		$imageurl = wp_get_attachment_image_src( $pthid, 'single' );
		$imagesrc = $imageurl[0];
		$imagewidth = $imageurl[1];
		$imageheight = $imageurl[2];
	elseif(get_post_type($post->ID) == 'columnas'):
		$type = 'Article';
		if(function_exists('get_wp_user_avatar_src')) {
			$imagesrc = get_wp_user_avatar_src($post->post_author, 120);
		} else {
			$imagesrc = get_avatar_url($post->post_author);
		}
		
		$imagewidth = 120;
		$imageheight = 120;
	endif;

		$authorid = $post->post_author;
		$author = get_userdata($authorid);
		$authorname = $author->display_name;

	if(is_single( ) && (get_post_type($post->ID) == 'columnas' || get_post_type($post->ID) == 'post')  ) {
		

		?>
		<script type="application/ld+json">
			{
			  "@context": "http://schema.org",
			  "@type": "<?php echo $type;?>",
			  "mainEntityOfPage":{
			    "@type":"WebPage",
			    "@id":"<?php echo $jsonid;?>"
			  },
			  "headline": "<?php echo addslashes($post->post_title);?>",
			  <?php if($imagesrc):?>
			  "image": {
			    "@type": "ImageObject",
			    "url": "<?php echo $imagesrc;?>",
			    "height": "<?php echo $imageheight;?>",
			    "width": "<?php echo $imagewidth;?>"
			  },
			  <?php endif;?>
			  "datePublished": "<?php echo get_the_date('c', $post->ID);?>",
			  "dateModified": "<?php echo get_the_modified_date( 'c', $post->ID );?>",
			  "author": {
			    "@type": "Person",
			    "name": "<?php echo $authorname;?>"
			  },
			   "publisher": {
			    "@type": "Organization",
			    "name": "<?php bloginfo('name');?>",
			    "logo": {
			      "@type": "ImageObject",
			      "url": "<?php bloginfo('template_url');?>/dist/img/logo-c80-3.png",
			      "width": "70",
			      "height": "80"
			    }
			  },
			  "description": "<?php echo addslashes($post->post_excerpt);?>"
			}
		</script>
		<?php
	}
}

add_action( 'wp_head', 'c80t_jsonmicrodata' );