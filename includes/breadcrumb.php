<?php 
/**
 * Breadcrumb
 */
function c80t_breadcrumb() {
	global $post;
	/**
	 * Devuelve el breadcrumb
	 */
	$html = '<div class="breadcrumb">';
	$html .= '<div class="container">';
	$html .= '<div class="c80-breadcrumb">';
    $html .= '<a href="' . get_bloginfo('url') . '">' . '<i class="fa fa-home"></i> Inicio' . '</a>';

    if(is_post_type_archive( )):
        $ptype = get_post_type_object( get_post_type( $post->ID ) );
        $html .= ' <i class="fa fa-angle-right"></i> ' . $ptype->labels->name;
    endif;

    if(is_category() ):
        $cat = single_cat_title('Categoría: ', false );
        $html .= ' <i class="fa fa-angle-right"></i> ' . $cat;
    endif;

    if(is_single() ):
    	$ptype = get_post_type_object( get_post_type( $post->ID ) );
    	$ptypelink = get_post_type_archive_link( $ptype->name );
    	$parents = get_post_ancestors( $post->ID );

        if(get_post_type($post->ID) == 'hitos') {
            if(is_object_in_term( $post->ID, 'tipo_hito', array(266, 267, 268) )) {
                $html .= ' <i class="fa fa-angle-right"></i> <a href="' . get_permalink(2729) . '"> Línea de tiempo Seguridad Social</a>';
            } else {
                $html .= ' <i class="fa fa-angle-right"></i> <a href="' . get_bloginfo('url') . '/linea"> Línea de tiempo Constitucional</a>';    
            }
            
        } else {
            $html .= ' <i class="fa fa-angle-right"></i> <a href="' . $ptypelink . '"> ' . $ptype->labels->name . ' </a>';    
        }
    	
    	
    	if($parents) {
    		$parents = array_reverse($parents);
    		foreach($parents as $parent) {
    			$parentlink = get_permalink($parent);
    			$html .= ' <i class="fa fa-angle-right"></i> ';
                if(c80_Public::c80_hascontent($parent)):
                    $html .= '<a href="' . $parentlink . '"> ' . get_the_title($parent) . ' </a>';
                else:
                    $html .= get_the_title($parent);
                endif;
    		}
    	};

    	$html .= ' <i class="fa fa-angle-right"></i> ' . $post->post_title;

    endif;

    if(is_page() ):
        $parents = get_post_ancestors( $post->ID );
        
        if($parents) {
            $parents = array_reverse($parents);
            foreach($parents as $parent) {
                $parentlink = get_permalink($parent);
                $html .= ' <i class="fa fa-angle-right"></i> <a href="' . $parentlink . '"> ' . get_the_title($parent) . ' </a>';
            }
        };

        $html .= ' <i class="fa fa-angle-right"></i> ' . $post->post_title;
    endif;
    

    $html .= '</div>';
	$html .= '</div>';
    $html .= '</div>';

    return $html;
}