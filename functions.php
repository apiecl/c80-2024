<?php
//functions.php

define('FM_VERSION', '0.1.1');
define('FM_PATH', dirname(__FILE__));
define('FM_URI', home_url(str_replace(ABSPATH, '', FM_PATH)));
define('FM_HMR_HOST', 'http://localhost:5173');
define('FM_ASSETS_PATH', FM_PATH . '/dist');
define('FM_ASSETS_URI', FM_URI . '/dist');
define('FM_RESOURCES_PATH', FM_PATH . '/resources');
define('FM_RESOURCES_URI', FM_URI . '/resources');

define('C80_THEME_VERSION', '2.6.8');
define('C80_TWITTER', 'proyectoC80');
define('C80_FACEBOOK', 'https://www.facebook.com/proyectoC80/');
define('C80_INSTAGRAM', 'https://www.instagram.com/proyectoc80/');
define('C80_NOTFOUND', 1084);

//theme support
function c80t_theme_setup()
{
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');
	add_theme_support('html5');
}

add_action('after_setup_theme', 'c80t_theme_setup');

function c80t_menus()
{
	register_nav_menu('principal', 'Menú principal');
	register_nav_menu('portada', 'Control contenidos portada');
	register_nav_menu('columnas', 'Control Columnas');
}

add_action('after_setup_theme', 'c80t_menus');
add_post_type_support('page', 'excerpt');

//content width
if (!isset($content_width)) {
	$content_width = 754;
}

//includes
include(TEMPLATEPATH . '/includes/scripts.php');
include(TEMPLATEPATH . '/includes/metatags.php');
include(TEMPLATEPATH . '/includes/content.php');
include(TEMPLATEPATH . '/includes/content-archive.php');
include(TEMPLATEPATH . '/includes/breadcrumb.php');
include(TEMPLATEPATH . '/includes/ajax.php');
include(TEMPLATEPATH . '/includes/post-types.php');
include(TEMPLATEPATH . '/includes/bootstrap-menu.php');
include(TEMPLATEPATH . '/includes/author.php');
include(TEMPLATEPATH . '/includes/content-embeds.php');
include(TEMPLATEPATH . '/includes/json-microdata.php');
include(TEMPLATEPATH . '/includes/timeline-functions.php');


//widgets
/**
 * Add a sidebar.
 */
function c80t_theme_slug_widgets_init()
{
	register_sidebar(array(
		'name'          => __('Anuncios', 'c80'),
		'id'            => 'anuncios',
		'description'   => __('Widgets para la sección de anuncios en home.', 'c80'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget_title">',
		'after_title'   => '</h1>',
	));
	register_sidebar(array(
		'name'          => __('Anuncios / móvil', 'c80'),
		'id'            => 'anuncios-mobile',
		'description'   => __('Widgets para la sección de anuncios en home para dispositivos móviles.', 'c80'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget_title"></span>',
		'after_title'   => '</h1>',
	));
}
add_action('widgets_init', 'c80t_theme_slug_widgets_init');

//Image sizes
function c80t_imgsizes()
{
	add_image_size('main', 668, 0, false);
	add_image_size('secondary', 360, 231, true);
	add_image_size('single', 730, 0, false);
	add_image_size('featured', 360, 360, true);
	add_image_size('mini-item', 200, 60, true);
	add_image_size('alt-thumbnail', 150, 200, true);
}

add_action('after_setup_theme', 'c80t_imgsizes');

function c80_tags()
{
	global $post;
	$tags = get_the_terms($post->ID, 'post_tag');
	if (is_array($tags)) :
		$count = count($tags);

		if ($tags) {
			foreach ($tags as $key => $tag) {
				$ckey = ($key + 1 == $count) ? 'last' : $key;
				$taglist[] = '<a class="tagp-' . $ckey .  ' tag-' . $key . '" href="' . get_term_link($tag->term_id, 'post_tag') . '">' . $tag->name . '</a>';
			}

			return '<span class="nrel"><i class="fa fa-tags"></i> </span>' . implode(' ', $taglist);
		};
	else :
		return '';
	endif;
}

function c80_url($id)
{
	if (get_bloginfo('url') != 'https://c80.cl') {
		$url = str_replace(get_bloginfo('url'), 'https://c80.cl', get_permalink($id));
		return $url;
	} else {
		return get_permalink($id);
	}
}

function c80_checkYoutube($url)
{
	if (strpos($url, 'youtube') > 0) {
		return true;
	} else {
		return false;
	}
}

function c80_paginator($query = NULL)
{
	if (!$query) {
		global $wp_query;
	} else {
		$wp_query = $query;
	}

	$big = 999999999; // need an unlikely integer
	echo '<nav>';
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 3,
		'type' => 'list'
	));
	echo '</nav>';
}
