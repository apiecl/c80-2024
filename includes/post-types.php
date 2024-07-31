<?php
// Register Custom Post Type
function c80t_columnas()
{

	$labels = array(
		'name'                => _x('Columnas', 'Post Type General Name', 'c80t'),
		'singular_name'       => _x('Columna', 'Post Type Singular Name', 'c80t'),
		'menu_name'           => __('Columnas', 'c80t'),
		'name_admin_bar'      => __('Columnas', 'c80t'),
		'parent_item_colon'   => __('Columna superior', 'c80t'),
		'all_items'           => __('Todas las columnas', 'c80t'),
		'add_new_item'        => __('Añadir nueva columna', 'c80t'),
		'add_new'             => __('Añadir nueva', 'c80t'),
		'new_item'            => __('Nueva columna', 'c80t'),
		'edit_item'           => __('Editar columna', 'c80t'),
		'update_item'         => __('Actualizar columna', 'c80t'),
		'view_item'           => __('Ver columna', 'c80t'),
		'search_items'        => __('Buscar columna', 'c80t'),
		'not_found'           => __('No encontrado', 'c80t'),
		'not_found_in_trash'  => __('No encontrado en papelera', 'c80t'),
	);
	$args = array(
		'label'               => __('Columna', 'c80t'),
		'description'         => __('Columnas', 'c80t'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields',),
		'taxonomies'          => array('category', 'post_tag'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type('columnas', $args);
}
add_action('init', 'c80t_columnas', 0);

// Register Custom Post Type
function c80t_mitos_sabias_que()
{

	$labels = array(
		'name'                => _x('Mitos / Sabías que', 'Post Type General Name', 'c80t'),
		'singular_name'       => _x('Mito / Sabías que', 'Post Type Singular Name', 'c80t'),
		'menu_name'           => __('Mitos / Sabías que', 'c80t'),
		'name_admin_bar'      => __('Mitos / Sabías que', 'c80t'),
		'parent_item_colon'   => __('Mito / Sabías que superior', 'c80t'),
		'all_items'           => __('Todos los mitos / sabías que', 'c80t'),
		'add_new_item'        => __('Añadir nuevo mito / sabías que', 'c80t'),
		'add_new'             => __('Añadir nueva', 'c80t'),
		'new_item'            => __('Nuevo mito / sabías que', 'c80t'),
		'edit_item'           => __('Editar mito / sabías que', 'c80t'),
		'update_item'         => __('Actualizar mito / sabías que', 'c80t'),
		'view_item'           => __('Ver mito / sabías que', 'c80t'),
		'search_items'        => __('Buscar mito / sabías que', 'c80t'),
		'not_found'           => __('No encontrado', 'c80t'),
		'not_found_in_trash'  => __('No encontrado en papelera', 'c80t'),
	);
	$args = array(
		'label'               => __('mito-sabias-que', 'c80t'),
		'description'         => __('mitos-sabias-que', 'c80t'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields',),
		'taxonomies'          => array('category', 'post_tag'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'			  => array('slug' => 'sabias-que')
	);
	register_post_type('mitos-sabias-que', $args);
}
add_action('init', 'c80t_mitos_sabias_que', 0);

// Register Custom Post Type
function c80t_hitos()
{

	$labels = array(
		'name'                => _x('Hitos', 'Post Type General Name', 'c80t'),
		'singular_name'       => _x('Hito', 'Post Type Singular Name', 'c80t'),
		'menu_name'           => __('Hitos', 'c80t'),
		'name_admin_bar'      => __('Hitos', 'c80t'),
		'parent_item_colon'   => __('Hito superior', 'c80t'),
		'all_items'           => __('Todos los hitos', 'c80t'),
		'add_new_item'        => __('Añadir nuevo hito', 'c80t'),
		'add_new'             => __('Añadir nueva', 'c80t'),
		'new_item'            => __('Nuevo hito', 'c80t'),
		'edit_item'           => __('Editar hito', 'c80t'),
		'update_item'         => __('Actualizar hito', 'c80t'),
		'view_item'           => __('Ver hito', 'c80t'),
		'search_items'        => __('Buscar hito', 'c80t'),
		'not_found'           => __('No encontrado', 'c80t'),
		'not_found_in_trash'  => __('No encontrado en papelera', 'c80t'),
	);
	$args = array(
		'label'               => __('hito', 'c80t'),
		'description'         => __('hitos', 'c80t'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields',),
		'taxonomies'          => array('category', 'post_tag'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'			  => array('slug' => 'hito')
	);
	register_post_type('hitos', $args);
}
add_action('init', 'c80t_hitos', 0);

// Register Custom Taxonomy
function c80_tipohitos()
{

	$labels = array(
		'name'                       => _x('Tipos de hito', 'Taxonomy General Name', 'text_domain'),
		'singular_name'              => _x('Tipo de hito', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __('Tipos de hito', 'text_domain'),
		'all_items'                  => __('Todos', 'text_domain'),
		'parent_item'                => __('Parent Item', 'text_domain'),
		'parent_item_colon'          => __('Parent Item:', 'text_domain'),
		'new_item_name'              => __('Nuevo tipo de hito', 'text_domain'),
		'add_new_item'               => __('Añadir nuevo tipo de hito', 'text_domain'),
		'edit_item'                  => __('Editar tipo de hito', 'text_domain'),
		'update_item'                => __('Actualizar tipo de hito', 'text_domain'),
		'view_item'                  => __('Ver tipo de hito', 'text_domain'),
		'separate_items_with_commas' => __('', 'text_domain'),
		'add_or_remove_items'        => __('Añadir o quitar tipos de hito', 'text_domain'),
		'choose_from_most_used'      => __('Escoger entre los más usados', 'text_domain'),
		'popular_items'              => __('Popular Items', 'text_domain'),
		'search_items'               => __('Search Items', 'text_domain'),
		'not_found'                  => __('Not Found', 'text_domain'),
		'no_terms'                   => __('No items', 'text_domain'),
		'items_list'                 => __('Items list', 'text_domain'),
		'items_list_navigation'      => __('Items list navigation', 'text_domain'),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy('tipo_hito', array('hitos'), $args);
}
add_action('init', 'c80_tipohitos', 0);

// Register Custom Taxonomy
function c80_presidente_hito()
{

	$labels = array(
		'name'                       => _x('Presidentes', 'Taxonomy General Name', 'text_domain'),
		'singular_name'              => _x('Presidente', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __('Presidentes', 'text_domain'),
		'all_items'                  => __('Todos', 'text_domain'),
		'parent_item'                => __('Parent Item', 'text_domain'),
		'parent_item_colon'          => __('Parent Item:', 'text_domain'),
		'new_item_name'              => __('Nuevo Presidente', 'text_domain'),
		'add_new_item'               => __('Añadir nuevo Presidente', 'text_domain'),
		'edit_item'                  => __('Editar Presidente', 'text_domain'),
		'update_item'                => __('Actualizar Presidente', 'text_domain'),
		'view_item'                  => __('Ver Presidente', 'text_domain'),
		'separate_items_with_commas' => __('', 'text_domain'),
		'add_or_remove_items'        => __('Añadir o quitar Presidentes', 'text_domain'),
		'choose_from_most_used'      => __('Escoger entre los más usados', 'text_domain'),
		'popular_items'              => __('Popular Items', 'text_domain'),
		'search_items'               => __('Search Items', 'text_domain'),
		'not_found'                  => __('Not Found', 'text_domain'),
		'no_terms'                   => __('No items', 'text_domain'),
		'items_list'                 => __('Items list', 'text_domain'),
		'items_list_navigation'      => __('Items list navigation', 'text_domain'),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy('presidente', array('hitos'), $args);
}
add_action('init', 'c80_presidente_hito', 0);

// Register Custom Post Type
function c80t_visualizaciones()
{

	$labels = array(
		'name'                  => _x('Visualizaciones', 'Post Type General Name', 'c80'),
		'singular_name'         => _x('Visualización', 'Post Type Singular Name', 'c80'),
		'menu_name'             => __('Visualizaciones', 'c80'),
		'name_admin_bar'        => __('Visualizaciones', 'c80'),
		'archives'              => __('Archivo de visualizaciones', 'c80'),
		'attributes'            => __('Item Attributes', 'c80'),
		'parent_item_colon'     => __('Parent Item:', 'c80'),
		'all_items'             => __('All Items', 'c80'),
		'add_new_item'          => __('Add New Item', 'c80'),
		'add_new'               => __('Nueva', 'c80'),
		'new_item'              => __('Nueva Visualización', 'c80'),
		'edit_item'             => __('Editar Visualización', 'c80'),
		'update_item'           => __('Actualizar Visualización', 'c80'),
		'view_item'             => __('Ver Visualización', 'c80'),
		'view_items'            => __('Ver Visualizaciones', 'c80'),
		'search_items'          => __('Buscar Visualizaciones', 'c80'),
		'not_found'             => __('Not found', 'c80'),
		'not_found_in_trash'    => __('Not found in Trash', 'c80'),
		'featured_image'        => __('Featured Image', 'c80'),
		'set_featured_image'    => __('Set featured image', 'c80'),
		'remove_featured_image' => __('Remove featured image', 'c80'),
		'use_featured_image'    => __('Use as featured image', 'c80'),
		'insert_into_item'      => __('Insert into item', 'c80'),
		'uploaded_to_this_item' => __('Uploaded to this item', 'c80'),
		'items_list'            => __('Items list', 'c80'),
		'items_list_navigation' => __('Items list navigation', 'c80'),
		'filter_items_list'     => __('Filter items list', 'c80'),
	);
	$args = array(
		'label'                 => __('Visualización', 'c80'),
		'description'           => __('Visualizaciones', 'c80'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
		'taxonomies'            => array('category', 'post_tag'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type('visualizaciones', $args);
}
add_action('init', 'c80t_visualizaciones', 0);
