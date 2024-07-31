<?php
//content stuff

function c80t_articulos() {
	//Devuelve un listado de los artículos del tipo de post de constitución
	global $post;
	//Primer nivel
	$args = array(
		'post_type' => 'c80_cpt',
		'numberposts' => 100,
		'post_parent' => 0,
		'orderby' => 'menu_order',
		'order' => 'ASC'
		);

	$capitulos = get_posts($args);
	
	$items = '';
	

	foreach($capitulos as $capitulo) {
		$capitems = '';		
		$capitems .= '<a class="capitulo-lista ' . ($capitulo->ID == $post->ID || $capitulo->ID == c80t_top_parentid($post->ID)? 'active' : '') . '" href="'.get_permalink($capitulo->ID).'">' . get_the_title($capitulo->ID) . ': ' .  c80t_captitle($capitulo->ID) .'</a>';

		//Segundo nivel
		$args = array(
			'post_type' => 'c80_cpt',
			'numberposts' => 100,
			'post_parent' => $capitulo->ID,
			'orderby' => 'menu_order',
			'order' => 'ASC'
			);
		
		$articulos = get_posts($args);
		
		$artitems = '';
		
		foreach($articulos as $articulo) {
			//Tercer nivel, si es que hay tercer nivel se desactiva el link en el segundo nivel.
			$args = array(
				'post_type' => 'c80_cpt',
				'numberposts' => 100,
				'post_parent' => $articulo->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC'
				);
			$children = get_posts($args);
			if($children) {
				$artitems .= '<li class="art-section">' . $articulo->post_title;

				$artitems .= '<ul class="articulos">';
				foreach($children as $child):
					$artitems .= '<li class="subart"><a href="' . get_permalink($child->ID) . '" class="articulo-lista">' . $child->post_title . '</a></li>';
				endforeach;
				$artitems .= '</ul></li>';

			} else {
				$artitems .= '<li><a href="' . get_permalink($articulo->ID) . '" class="articulo-lista">' . $articulo->post_title . '</a></li>';	
			}
			

		}

		$items .= '<li>' . $capitems .  '<ul class="articulos">' . $artitems . '</ul></li>';
	
	}

	$output = '<ul class="items-constitucion">' . $items . '</ul>';

	return $output;
}

function c80t_getarticulos() {
	//Devuelve todos los articulos en un objeto para usar luego
	$args = array(
				'post_type' => 'c80_cpt',
				'numberposts' => -1,
				'post_parent' => $post->ID,
				'orderby'	=> 'menu_order',
				'order'		=> 'ASC'
	);

	$articulos = get_posts($args);
	$artarray = [];

	foreach($articulos as $articulo) {
		$childargs = array(
			'post_parent' 	=> $articulo->ID,
			'numberposts'	=> -1,
			'post_type'		=> 'c80_cpt',
			'orderby'		=> 'menu_order',
			'order'			=> 'ASC'	
		);

		$subarts = get_posts($childargs);

		if(!$subarts) {
			$artarray[$articulo->ID] = $articulo->post_title;	
		} else {
			$artarray['top-' . $articulo->ID] = $articulo->post_title;
		}
		
		
	}

	return $artarray;
}

function c80t_capitulos() {

}


function c80t_change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Noticias';
    $submenu['edit.php'][5][0] = 'Noticias';
    $submenu['edit.php'][10][0] = 'Añadir Noticias';
    echo '';
}

function c80t_postlabels() {
	global $wp_post_types;
		
		$labels = &$wp_post_types['post']->labels;
        $labels->name = 'Noticias';
        $labels->singular_name = 'Noticia';
        $labels->add_new = 'Añadir Noticia';
        $labels->add_new_item = 'Añadir Noticia';
        $labels->edit_item = 'Editar Noticia';
        $labels->new_item = 'Nueva Noticia';
        $labels->view_item = 'Ver Noticia';
        $labels->search_items = 'Buscar Noticias';
        $labels->not_found = 'No se encontraron Noticias';
        $labels->not_found_in_trash = 'No se encontraron noticias en papelera';
}

add_action( 'init', 'c80t_postlabels' );
add_action( 'admin_menu', 'c80t_change_post_menu_label' );

function c80t_parentname($postid, $en_capitulo = false) {
	$ancestors = get_post_ancestors( $postid );
	if($ancestors && !$en_capitulo) {
		$name = get_the_title($ancestors[0]);
		$subname = c80t_captitle($postid);

		if($subname):
			return $name . ': '. $subname;
		else:
			return $name;
		endif;
	}	
}

function c80t_top_parentid($postid, $en_capitulo = false) {
	/**
	 * Devuelve el ID del parent CAPITULO de un artículo C80
	 */
	//Hay que chequear que el post sea una modificacion
	$ismod = get_post_type($postid);

	if($ismod == 'c80_cptrev') {
		$baseid = get_post_meta( $postid, 'c80_artselect', true);
	} else {
		$baseid = $postid;
	}

	$ancestors = get_post_ancestors( $baseid );
	if($ancestors && !$en_capitulo) {
		$root = count($ancestors)-1;
		return $ancestors[$root];
	}
}

function c80t_captitle($postid) {
	/**
	 * Devuelve el nombre del capítulo desde un capítulo o desde un artículo
	 */
	$ancestors = get_post_ancestors( $postid );

	if($ancestors) {
		$checkmod = c80_Public::c80_checkmod($ancestors[0]);
		$itemid = ($checkmod)? $checkmod[0] : $ancestors[0];
	} else {
		//es de nivel superior o sea está en un capítulo...
		$checkmod = c80_Public::c80_checkmod($postid);
		$itemid = ($checkmod)? $checkmod[0] : $postid;
	}

	$subt = get_post_meta($itemid, 'c80_subtartcap', true);

	return $subt;
}

function c80t_template_loader($template, $data) {
	/**
	 * Cargador de plantillas incluyendo variables
	 */

	ob_start();
	
	extract($data);
	
	include( locate_template( sprintf('%s.php', $template) ) );

	return ob_get_clean();

}

function c80t_run_featured() {
	/**
	 * Devuelve el primer item del menú
	 */
	$items = c80t_getmenus('portada');
	
	//Saco el primero y lo guardo
	$first_item = array_shift($items);

	if($first_item) {
		
		
		$ids[] = $first_item->object_id;
		

		$args = array(
			'post__in' => $ids
			);
		$query = new WP_Query($args);
		return $query;
	}
}

function c80t_run_frontpage() {
	/**
	 * Crea un loop para los menús y excluyo el primero
	 */
	$items = c80t_getmenus('portada');
	
	//Saco el primero
	array_shift($items);

	//si tengo items creo un arreglo con los ids
	if($items) {
		foreach($items as $item) {
			$ids[] = $item->object_id;
		}
	
	$args = array(
		'post__in' => $ids,
		'orderby' => 'post__in',
		'post_type' => 'any'
		);
	$query = new WP_Query($args);
	return $query;
	}
}

function c80t_get_columnas($numberposts = 3) {
	/**
	 * Devuelve las últimas columnas
	 */
	$args = array(
		'post_type' => 'columnas',
		'posts_per_page' => $numberposts
		);
	$query = new WP_Query($args);
	return $query;
}

function c80t_run_columnas($numberposts = 6) {
	/**
	 * Crea un loop para las columnas
	 */
	$items = c80t_getmenus('columnas');
	//si tengo items creo un arreglo con los ids
	if($items) {
		foreach($items as $item) {
			$ids[] = $item->object_id;
		}
	
	$args = array(
		'post_type' => 'columnas',
		'post__in' => $ids,
		'orderby' => 'post__in',
		'posts_per_page' => $numberposts
		);
	$query = new WP_Query($args);
	return $query;
	}
}

function c80t_getmenus($menu) {
	/**
	 * Obtiene items de un objeto de menú
	 */
		$menuobject = c80t_getmenuobject($menu);
		if($menuobject) {
		//Si tengo un objeto menú me devuelve el objeto y empiezo a recolectar items
			$items = wp_get_nav_menu_items( $menuobject->term_id );
			return $items;
		} else {
			//Si no hay hago un llamado independiente por sección
			return false;
		}
}

function c80t_getmenuobject($location) {
	/**
	 * Obtiene el menú desde una ubicación escogida
	 */
	if( ( $locations = get_nav_menu_locations() ) && isset($locations[$location]) ){
		$menu = wp_get_nav_menu_object( $locations[$location] );
		return $menu;
	} else {
		return false;
	}
}



function c80t_comments_fields( $fields ) {
	$fields['url'] = '';
	return $fields;
}

add_filter('comment_form_default_fields', 'c80t_comments_fields');


function c80t_default_post_thumbnail($html, $post_id, $post_thumbnail_id, $size, $attr) {
	/**
	 * Añade imagen por defecto en caso de que no haya
	 */

	$id = get_post_thumbnail_id(); // gets the id of the current post_thumbnail (in the loop)
    $src = wp_get_attachment_image_src($id, $size); // gets the image url specific to the passed in size (aka. custom image size)
    $alt = get_the_title($id); // gets the post thumbnail title
    if(is_array($attr) && isset($attr['class'])) {
    	$class = $attr['class']; // gets classes passed to the post thumbnail, defined here 	
    } else {
    	$class = 'post-image';
    }
    
    $defaultsrc = get_bloginfo('template_url') . '/dist/img/placeholder-' . $size . '.png';

    if(has_post_thumbnail( $post_id )) {
    	$html = '<img src="' . $src[0] . '" alt="' . $alt . '" class="' . $class . '" />';
    } else {
    	$html = '<img src="' . $defaultsrc . '" alt="' . get_the_title($post_id) . '" class="placeholder">';
    }

    return $html;
}

add_filter('post_thumbnail_html', 'c80t_default_post_thumbnail', 99, 5);

function c80t_temas() {
	$args = array(
		'hide_empty' 	=> 1,
		'exclude' 		=> 1,
		'orderby' 		=> 'count',
		'order' 		=> 'DESC'
		);
	$temas = get_categories( $args );
	$output = '';
	$dropdown = '';
	foreach($temas as $key => $tema) {
		if($key < 5):
			
			$output .= '<li><a class="cats" href="' . get_category_link($tema->term_id) .'">' . $tema->name . '</a></li>';

		else:

			$dropdown .= '<li><a class="cats" href="' . get_category_link($tema->term_id) .'">' . $tema->name . '</a></li>';

		endif;
	}

		$output .= '<ul class="dropdown-temas">' . $dropdown . '</ul>';
		$output .= '</li>';

		$toggletemas = '<a href="#" class="toggletemas">Ver más temas <i class="fa fa-chevron-circle-down"></i></a>';

	$html = '<div class="temas-header">
		<ul>' . $output . '</ul>' . $toggletemas . '
	</div>';

	return $html;
}

function c80t_temas_mobile($maxitems) {
	$args = array(
		'hide_empty' 	=> 1,
		'exclude' 		=> 1,
		'orderby' 		=> 'count',
		'order' 		=> 'DESC'
		);
	$temas = get_categories( $args );
	$output = '';
	$dropdown = '';
	foreach($temas as $key => $tema) {
		if($key < $maxitems):
			
			$output .= '<li><a class="cats" href="' . get_category_link($tema->term_id) .'">' . $tema->name . '</a></li>';

		else:

			$dropdown .= '<li><a class="cats" href="' . get_category_link($tema->term_id) .'">' . $tema->name . '</a></li>';

		endif;
	}

		$output .= '<ul class="dropdown-temas">' . $dropdown . '</ul>';
		$output .= '</li>';

		$toggletemas = '<a href="#" class="toggletemas">Ver más temas <i class="fa fa-chevron-circle-down"></i></a>';

	$html = '<div class="temas-header">
		<ul>' . $output . '</ul>' . $toggletemas . '
	</div>';

	return $html;
}

function c80t_twitter() {
	$baseurl = 'https://twitter.com/' . C80_TWITTER;
	return $baseurl;
}

function c80t_analytics() {
	if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false):
		echo "<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-68598243-1', 'auto');
		ga('send', 'pageview');

		</script>";
	endif;
}

add_action('wp_head', 'c80t_analytics');