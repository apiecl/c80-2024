<?php

function c80t_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">';
}

add_action('wp_head', 'c80t_viewport');

function c80t_columnimg() {
	global $post;
	if(is_singular( 'columnas' ) && !has_post_thumbnail( $post->ID )) {
		$avatarsrc = get_wp_user_avatar_src( get_the_author_meta('ID'), 'large' );
		echo '<meta property="og:image" content="' . $avatarsrc . '">';
	} elseif(is_page( ) || is_home() ) {
		$defaultimg = get_bloginfo('template_url') . '/dist/img/placeholder-main_2017.png';
		echo '<meta property="og:image" content="' . $defaultimg . '">';
	}
}

add_action('wp_head', 'c80t_columnimg');