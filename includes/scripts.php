<?php
//scripts loader

// Async load
function c80_async_scripts($url)
{
	if (strpos($url, '#asyncload') === false)
		return $url;
	else if (is_admin())
		return str_replace('#asyncload', '', $url);
	else
		return str_replace('#asyncload', '', $url) . "' async='async";
}
add_filter('clean_url', 'c80_async_scripts', 11, 1);

function c80t_scripts()
{
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '3.2.1', false);
		if (is_page_template('c80-timeline.php')) :
			wp_enqueue_script('timelinejs', get_bloginfo('template_url') . '/dist/c80-timeline-bundle.js', array('zingtouch', 'c80js'), '3.6.6?mod=c80', false);
			wp_enqueue_script('zingtouch', 'https://cdnjs.cloudflare.com/ajax/libs/zingtouch/1.0.6/zingtouch.min.js#asyncload', array(), '1.0.6', false);
		endif;
		if (is_page_template('c80-timeline-pensiones.php')) :
			wp_enqueue_script('timelinejspensiones', get_bloginfo('template_url') . '/dist/c80-timeline-pensiones-bundle.js', array('zingtouch', 'c80js'), '3.6.6?mod=c80', false);
			wp_enqueue_script('zingtouch', 'https://cdnjs.cloudflare.com/ajax/libs/zingtouch/1.0.6/zingtouch.min.js#asyncload', array(), '1.0.6', false);
		endif;

		$c80script = 'c80-bundle.js';


		wp_register_script('c80js', get_bloginfo('template_url') . '/dist/' . $c80script, array('jquery'), C80_THEME_VERSION, false);

		wp_enqueue_script('jquery');
		wp_enqueue_script('c80js');
		wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/269614ad84.js#asyncload', array(), '4.7.0', true);
		wp_localize_script('c80js', 'c80', array(
			'timelineurl' 			=> get_bloginfo('url') . '/wp-json/constitucion1980/v1/linea-de-tiempo',
			'timelinepensionesurl'	=> get_bloginfo('url') . '/wp-json/constitucion1980/v1/ltseguridadsocial',
			'timelineafpurl'		=> get_bloginfo('url') . '/wp-json/constitucion1980/v1/ltafp',
			'timelinehitosfases' 	=> c80_timelinehitosfases()
		));

		wp_enqueue_script('c80js_extra', get_bloginfo('template_url') . '/dist/c80-extra.js', array('jquery', 'c80js'), C80_THEME_VERSION, false);
	}
}


function c80_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
}

add_action('wp_enqueue_scripts', 'c80_remove_wp_block_library_css');

function c80t_styles()
{
	//wp_enqueue_style( 'bootstrap', get_bloginfo('template_url') . '/dist/vendor/bootstrap/dist/css/bootstrap.css', array(), C80_THEME_VERSION, 'screen' );
	//wp_enqueue_style( 'c80-theme', get_bloginfo('template_url') . '/dist/c80-style.css', array(), C80_THEME_VERSION, 'screen' );

	// //tipografías
	//wp_enqueue_style( 'c80-tipografias', 'https://fonts.googleapis.com/css?family=Merriweather:400,400i,700|Lato:ital,wght@0,400;0,900;1,400&display=swap', array(), false, 'screen' );

	//iconos
	//wp_enqueue_style( 'c80-iconos', get_bloginfo('template_url') . '/dist/vendor/font-awesome/css/font-awesome.min.css', C80_THEME_VERSION, 'screen' );
	// if(is_page_template('c80-timeline.php')):
	// 	wp_enqueue_style( 'timelinecss', 'https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css', array( ), false, 'screen' );
	// endif;
}

//actions
add_action('wp_enqueue_scripts', 'c80t_scripts');
add_action('wp_enqueue_scripts', 'c80t_styles');
//remove jetpack stuff
add_filter('jetpack_sharing_counts', '__return_false', 99);
add_filter('jetpack_implode_frontend_css', '__return_false', 99);

function c80t_speedcss()
{
	global $post;
	$mainstyleurl 	= get_bloginfo('template_url') . '/dist/c80-style.css?' . C80_THEME_VERSION;
	$extraurl 		= get_bloginfo('template_url') . '/dist/c80-extra.css?' . C80_THEME_VERSION;
	$page_template  = get_post_meta($post->ID, '_wp_page_template') ? get_post_meta($post->ID, '_wp_page_template') : [];
?>

	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
	<link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Merriweather:400,400i,700|Lato:ital,wght@0,400;0,900;1,400&display=swap">
	<link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="https://fonts.googleapis.com/css?family=Merriweather:400,400i,700|Lato:ital,wght@0,400;0,900;1,400&display=swap">

	<?php if (!in_array('c80_afp-pensiones.php', $page_template)) : ?>
		<!-- main style -->
		<link rel="preload" as="style" href="<?php echo $mainstyleurl; ?>">
		<link rel="stylesheet" href="<?php echo $mainstyleurl; ?>" media="print" onload="this.onload=null;this.removeAttribute('media');">
		<link rel="stylesheet" href="<?php echo $extraurl; ?>" media="screen">
	<?php endif; ?>
	<noscript>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,400i,700|Lato:ital,wght@0,400;0,900;1,400&display=swap">
		<link rel="stylesheet" href="<?php echo $mainstyleurl; ?>">
	</noscript>


<?php
}

add_action('wp_head', 'c80t_speedcss', 10, 0);
