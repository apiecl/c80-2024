<?php 
function c80t_archivetitle() {
	$prefix = 'Archivo de ';
	if(is_category()) {
		$title = single_cat_title( $prefix, 'false' );
	} elseif(is_tag()) {
		$title = single_tag_title( $prefix, 'false' );
	} elseif(is_post_type_archive( )) {
		$ptype = get_post_type( );
		$ptypeobj = get_post_type_object( $ptype );
		$title = $prefix . $ptypeobj->labels->name; 
	} elseif(is_tax()) {
		$title = single_term_title( $prefix, 'false' );
	}
	return $title;
}

function c80t_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'columnas', 'c80_cpt'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'c80t_add_custom_types' );