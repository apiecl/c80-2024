<?php
// Timeline related functions
// Custom ajax calls

function c80_get_main_timeline_events(WP_REST_Request $request)
{
	$json = [];
	$json['events'] = [];

	$args = array(
		'post_type' 	=> 'hitos',
		'numberposts' 	=> -1
	);

	$hitos = array();

	$options = get_option('c80_timeline_options');

	$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5');

	foreach ($fases as $fase) {
		$hito_start = $options['hito_inicial_' . $fase];
		$hito_end = $options['hito_final_' . $fase];

		$fecha_start = get_post_meta($hito_start, 'c80_lt_start_date', true);
		$fecha_end = get_post_meta($hito_end, 'c80_lt_start_date', true);

		$range = array(
			'post_type' => 'hitos',
			'numberposts' => -1,
			'tax_query'	  => array(
				array(
					'taxonomy' => 'tipo_hito',
					'field'	   => 'term_id',
					'terms'	   => array(240, 237, 252)
				)
			),
			'meta_query' => array(
				array(
					'key' 		=> 'c80_lt_start_date',
					'value' 	=> array($fecha_start, $fecha_end),
					'compare' 	=> 'BETWEEN'
				),
			)
		);

		$hitos_posts = get_posts($range);

		if ($hitos_posts) {

			$hitos[$fase]['lastevent'] = get_post_field('post_name', $hito_end);

			foreach ($hitos_posts as $hito_post) {

				$islast = false;

				if ($hito_post->ID == $hito_end) {
					$islast = true;
				}

				$hitos[$fase]['events'][] = c80_prepare_hito($hito_post->ID, $hito_post->post_title, $hito_post->post_content, $islast, $fase);
			}
		}
	}

	return $hitos;
}

function c80_prepare_hito($hitoid, $hitotitle, $hitocontent, $islast, $fase)
{

	$start_date_field 	= get_post_meta($hitoid, 'c80_lt_start_date', true);
	$end_date_field 	= get_post_meta($hitoid, 'c80_lt_end_date', true);
	$media_field		= get_the_post_thumbnail_url($hitoid, 'large');
	if (is_array($start_date_field)) {
		if (count($start_date_field) > 4) {
			$start_date 		= parse_field_date_for_json($start_date_field);
		} else {
			$start_date 		= parse_field_date_for_json($start_date_field, true);
		}
	} else {
		$start_date = parse_field_date_for_json($start_date_field);
	}

	$time_start_date 	= c80_parsehour(get_post_meta($hitoid, 'c80_lt_time_date', true));

	if ($time_start_date) {
		$start_date = array_merge($start_date, $time_start_date);
	}

	$grupo 				= get_the_terms($hitoid, 'tipo_hito');
	$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5');

	if ($grupo) {
		if (is_object_in_term($hitoid, 'tipo_hito', array(266, 267, 268))) {
			$grupoid = is_object_in_term($hitoid, 'tipo_hito', 267) ? 'Avances Sociales' : 'Político Social';
		} else {
			$grupoid = $grupo[0]->slug;
		}
	}

	if ($end_date_field) :
		$end_date 			= parse_field_date_for_json($end_date_field);
		if ($time_start_date) {
			$end_date = array_merge($end_date, $time_start_date);
		}
	endif;

	$mediatype = get_post_meta($hitoid, 'c80_lt_media_type', true);

	if ($mediatype == 'doc' || $mediatype == 'html') {
		$hitocontent .= '<p><a target="_blank" href="' . get_post_meta($hitoid, 'c80_lt_media', true) . '">[+ ver link]</a></p>';
	}



	// if($islast && $nextphase) {
	// 	$hitocontent .= '<p><a class="btn-nextphase" data-toggle="nextphase" href="#' . $nextphase . '"><i class="fa fa-angle-right"></i></a></p>';
	// }

	$event = array(
		'text' => array(
			'headline' 	=> $hitotitle,
			'text'		=> apply_filters('post_content', $hitocontent),
		),
		'start_date' 	=> $start_date,
		'group'			=> $grupo[0]->name,
		'evclass'		=> sanitize_title($grupoid),
		'unique_id'		=> get_post_field('post_name', $hitoid)
	);
	//Main fields


	//Optional fields

	if ($end_date_field) :
		$event['end_date'] = $end_date;
	endif;


	if ($mediatype == 'jpg') {
		if (has_post_thumbnail($hitoid)) :
			$event['media']['url'] = get_the_post_thumbnail_url($hitoid, 'large');
			$event['media']['caption'] = get_post_meta($hitoid, 'c80_lt_media_caption', true);
			$event['media']['credit'] = get_post_meta($hitoid, 'c80_lt_media_credit', true);
		endif;
	} elseif ($mediatype == 'video') {
		$event['media']['url'] = get_post_meta($hitoid, 'c80_lt_media', true);
		$event['media']['caption'] = get_post_meta($hitoid, 'c80_lt_media_caption', true);
		$event['media']['credit'] = get_post_meta($hitoid, 'c80_lt_media_credit', true);
	} elseif (has_post_thumbnail($hitoid)) {
		$imgid = get_post_thumbnail_id($hitoid);
		$event['media']['url'] = get_the_post_thumbnail_url($hitoid, 'large');
		$event['media']['caption'] = get_the_title($imgid);
		$event['media']['credit'] = get_the_excerpt($imgid);
	}




	return $event;
}

function parse_field_date_for_json($datestring, $yearonly = false)
{
	$date_processed = date_create_from_format("Y-m-d", $datestring);

	if ($date_processed !== false) {

		$date_sorted 	= array(
			'year' 	=> $date_processed->format('Y'),
			'month'	=> $date_processed->format('m'),
			'day'	=> $date_processed->format('d'),
			'format' => 'dd mmmm yyyy'
		);

		return $date_sorted;
	} elseif ($yearonly = true) {
		return array(
			'year' 	=> $datestring,
			'month'	=> null,
			'hour'	=> null,
			'minute' => null,
			'day'	=> null
		);
	}
}

function c80_timelinehitosfases()
{

	$args = array(
		'post_type' => 'hitos',
		'numberposts' => -1
	);

	$hitos = get_posts($args);
	$hitosinfo = [];

	foreach ($hitos as $hito) {
		$hitosinfo[$hito->post_name] = c80_checkfasehito($hito->ID);
	}

	return $hitosinfo;
}

function c80_checkfasehito($hitoID)
{
	$options = get_option('c80_timeline_options');
	$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5', 'pensiones');

	foreach ($fases as $fase) :
		$hito_start = $options['hito_inicial_' . $fase];
		$hito_end = $options['hito_final_' . $fase];
		$fecha_start = get_post_meta($hito_start, 'c80_lt_start_date', true);
		$fecha_end = get_post_meta($hito_end, 'c80_lt_start_date', true);

		$start_date_field = get_post_meta($hitoID, 'c80_lt_start_date', true);

		if ($start_date_field == $fecha_start || $start_date_field > $fecha_start && $start_date_field < $fecha_end || $start_date_field == $fecha_end) {
			return $fase;
		} elseif ($fase == 'pensiones') {
			return $fase;
		}

	endforeach;
}

add_action('rest_api_init', 'c80_timeline_endpoint');

function c80_timeline_endpoint()
{
	register_rest_route(
		'constitucion1980/v1/',
		'/linea-de-tiempo/',
		array(
			'methods' => 'GET',
			'callback' => 'c80_get_main_timeline_events'
		)
	);

	register_rest_route(
		'constitucion1980/v1/',
		'/ltseguridadsocial/',
		array(
			'methods' => 'GET',
			'callback' => 'c80_get_ss_timeline_events'
		)
	);

	register_rest_route(
		'constitucion1980/v1/',
		'/ltafp/',
		array(
			'methods' => 'GET',
			'callback' => 'c80_get_afp_timeline_events'
		)
	);
}

function c80_get_afp_timeline_events(WP_REST_Request $request)
{

	$ssocialargs = array(
		'numberposts' => -1,
		'post_type'	  => 'hitos',
		'tax_query'	  => array(
			array(
				'taxonomy' => 'tipo_hito',
				'field'	   => 'term_id',
				'terms'	   => array(270)
			)
		)
	);

	$socialhitos = get_posts($ssocialargs);
	$jsonhitos = [];

	foreach ($socialhitos as $socialhito) {
		$jsonhitos['afp']['events'][] = c80_prepare_hito($socialhito->ID, $socialhito->post_title, $socialhito->post_content, false, false);
	}

	return $jsonhitos;
}

function c80_get_ss_timeline_events(WP_REST_Request $request)
{

	$ssocialargs = array(
		'numberposts' => -1,
		'post_type'	  => 'hitos',
		'tax_query'	  => array(
			array(
				'taxonomy' => 'tipo_hito',
				'field'	   => 'term_id',
				'terms'	   => array(266, 267, 268)
			)
		)
	);

	$socialhitos = get_posts($ssocialargs);
	$jsonhitos = [];

	foreach ($socialhitos as $socialhito) {
		$jsonhitos['pensiones']['events'][] = c80_prepare_hito($socialhito->ID, $socialhito->post_title, $socialhito->post_content, false, false);
	}

	return $jsonhitos;
}

function c80_parsehour($hour)
{
	$hourarr = explode(':', $hour);
	$hourformat['hour'] = $hourarr[0];
	$hourformat['minute'] = $hourarr[1];

	return $hourformat;
}

/**
 * Hook in and register a submenu options page for the Page post-type menu.
 */
function c80_register_options_submenu_for_page_post_type()
{



	/**
	 * Registers options page menu item and form.
	 */
	$cmb = new_cmb2_box(array(
		'id'           => 'c80_options_submenu_page',
		'title'        => esc_html__('Opciones línea de tiempo', 'cmb2'),
		'object_types' => array('options-page'),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'c80_timeline_options', // The option key and admin menu page slug.
		// 'icon_url'        => '', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
		'parent_slug'     => 'edit.php?post_type=hitos', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
		// 'message_cb'      => 'c80_options_page_message_callback',
	));

	$args = array(
		'post_type' => 'hitos',
		'numberposts' => -1
	);

	$hitos = get_posts($args);
	$hitos_options = array();

	foreach ($hitos as $hito) {
		$fecha = get_post_meta($hito->ID, 'c80_lt_start_date', true);
		$hitos_options[$hito->ID] = '[' . $fecha . '] ' . $hito->post_title;
	}

	$fases = array(
		'fase_1' => 'Fase 1',
		'fase_2' => 'Fase 2',
		'fase_3' => 'Fase 3',
		'fase_4' => 'Fase 4',
		'fase_5' => 'Fase 5'
	);

	foreach ($fases as $key => $fase) {
		$cmb->add_field(array(
			'name' => __('Título ' . $fase, 'c80'),
			'id' => 'titulo_' . $key,
			'type' => 'text'
		));

		$cmb->add_field(array(
			'name' => __('Texto introducción ' . $fase, 'c80'),
			'id' => 'intro_' . $key,
			'type' => 'textarea'
		));

		$cmb->add_field(array(
			'name' => __('Imagen ' . $fase, 'c80'),
			'id' => 'imagen_' . $key,
			'type' => 'file'
		));

		$cmb->add_field(array(
			'name' => __('Hito inicial ' . $fase, 'c80'),
			'id' => 'hito_inicial_' . $key,
			'type' => 'select',
			'options' => $hitos_options,
		));

		$cmb->add_field(array(
			'name' => __('Hito final ' . $fase, 'c80'),
			'id' => 'hito_final_' . $key,
			'type' => 'select',
			'options' => $hitos_options,
		));
	}

	$args = array(
		'post_type'	=> 'visualizaciones',
		'numberposts'	=> -1
	);
	$visualizaciones = get_posts($args);

	$visoptions = array();

	foreach ($visualizaciones as $visualizacion) {
		$visoptions[$visualizacion->ID] = $visualizacion->post_title;
	}

	$argspages = array(
		'post_type' 	=> 'page',
		'numberposts'	=> -1
	);

	$pages = get_posts($argspages);

	$pages_options = array();

	foreach ($pages as $page) {
		$pages_options[$page->ID] = $page->post_title;
	}


	$cmb->add_field(array(
		'name'		=> 'Post de visualización',
		'id'		=> 'c80_vispost',
		'type'		=> 'select',
		'show_option_none' => true,
		'options'	=> $visoptions
	));

	$cmb->add_field(array(
		'name'		=> 'Info pensiones',
		'id'		=> 'c80_vispostpensiones',
		'type'		=> 'select',
		'show_option_none' => true,
		'options'	=> $pages_options
	));
}


add_action('cmb2_admin_init', 'c80_register_options_submenu_for_page_post_type');

/**
 * Hook in and register a submenu options page for the Appearance menu.
 */
function c80_register_options_submenu_appearance_menu()
{

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box(array(
		'id'           => 'c80_options_submenu_appearance_menu',
		'title'        => esc_html__('Appearance Options', 'cmb2'),
		'object_types' => array('options-page'),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'c80_theme_appearance_options', // The option key and admin menu page slug.
		// 'icon_url'        => '', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
		'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
		// 'message_cb'      => 'c80_options_page_message_callback',
	));

	/**
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field(array(
		'name'    => esc_html__('Site Background Color', 'cmb2'),
		'desc'    => esc_html__('field description (optional)', 'cmb2'),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	));
}
add_action('cmb2_admin_init', 'c80_register_options_submenu_appearance_menu');


function c80_presentacion_fase($fase, $nextfase)
{
	global $post;
	$timeline_options = get_option('c80_timeline_options');
	$imagenfase = $timeline_options['imagen_' . $fase . '_id'];
	$imagenurl = wp_get_attachment_image_src($imagenfase, 'full', false);
	if (function_exists('jetpack_photon_url')) {
		$wpthumbnail = jetpack_photon_url($imagenurl[0]);
	} else {
		$wpthumbnail = $imagenurl[0];
	}

	$fasestart = parse_field_date_for_json(get_post_meta($timeline_options['hito_inicial_' . $fase], 'c80_lt_start_date', true));
	$faseend = parse_field_date_for_json(get_post_meta($timeline_options['hito_final_' . $fase], 'c80_lt_start_date', true));
?>

<section data-fase="<?php echo $fase; ?>" id="<?php echo c80_faselink($fase, false); ?>" class="presentacion-fase"
    style="background-image: url(<?php echo $wpthumbnail; ?>);" data-nextfase="<?php echo $nextfase; ?>">
    <div class="content-wrap">
        <div class="presentacion-fase-text-content">

            <div class="header-presentacion-fase" data-nextfase="<?php echo $nextfase; ?>"
                data-fase="<?php echo $fase; ?>">
                <div>
                    <h2>Período <?php //echo $timeline_options['titulo_' . $fase];
									?></h2>
                    <h3><?php echo $fasestart['year'] . '-' . $faseend['year']; ?></h3>
                </div>
                <a class="gotophase-mobile visible-xs" data-nextfase="<?php echo $nextfase; ?>"
                    data-fase="<?php echo $fase; ?>"><i class="fa fa-angle-right"></i></a>
            </div>

            <div class="fase-intro">
                <?php echo apply_filters('the_content', $timeline_options['intro_' . $fase]); ?>
            </div>
            <!--<p><span class="btn btn-enter-timeline toggle-timeline" data-fase="<?php echo $fase; ?>">Entrar</span></p>-->
        </div>
    </div>
    <a class="gotophase" data-nextfase="<?php echo $nextfase; ?>" data-fase="<?php echo $fase; ?>"><i
            class="fa fa-angle-right"></i>
        <p>Ver hitos</p>
    </a>
</section>
<?php
}

add_action('cmb2_init', 'c80_tlfields');
function c80_tlfields()
{



	$prefix = 'c80_lt_';

	$cmb = new_cmb2_box(array(
		'id'           => $prefix . 'tlfields',
		'title'        => __('Campos línea de tiempo', 'c80'),
		'object_types' => array('hitos'),
		'context'      => 'normal',
		'priority'     => 'high',
	));

	$cmb->add_field(array(
		'name' => __('Fecha Inicio', 'c80'),
		'id' => $prefix . 'start_date',
		'type' => 'text',
		'desc'	=> 'Formato: AAAA-MM-DD'
	));

	$cmb->add_field(array(
		'name' => __('Fecha Fin', 'c80'),
		'id' => $prefix . 'end_date',
		'type' => 'text',
		'desc'	=> 'Formato: AAAA-MM-DD'
	));

	$cmb->add_field(array(
		'name' => __('Hora hito', 'c80'),
		'id' => $prefix . 'time_date',
		'type' => 'text_time',
		'time_format' => 'H:i',
		'desc'	=> 'Solo si es necesario para reordenar eventos que ocurren el mismo día'
	));

	$cmb->add_field(array(
		'name' => __('Tipo de media', 'c80'),
		'id' => $prefix . 'media_type',
		'type' => 'text',
	));

	$cmb->add_field(array(
		'name' => __('Media URL', 'c80'),
		'id' => $prefix . 'media',
		'type' => 'text',
		'desc' => 'Se utiliza para videos o enlaces. En caso de imagen utilizar imagen destacada.'
	));

	$cmb->add_field(array(
		'name' => __('Pie de foto o video', 'c80'),
		'id' => $prefix . 'media_caption',
		'type' => 'text',
	));

	$cmb->add_field(array(
		'name' => __('Crédito de foto o video', 'c80'),
		'id' => $prefix . 'media_credit',
		'type' => 'text',
	));

	$cmb->add_field(array(
		'name' => __('Leyes u otros', 'c80'),
		'id' => $prefix . 'leyes',
		'type' => 'text',
	));

	$cmb->add_field(array(
		'name' => __('Presidente', 'c80'),
		'id' => $prefix . 'presidente',
		'type' => 'text',
	));
}

function c80_faselink($fase, $withlink = true)
{
	global $post;
	$timeline_options = get_option('c80_timeline_options');
	$fasestart = parse_field_date_for_json(get_post_meta($timeline_options['hito_inicial_' . $fase], 'c80_lt_start_date', true));
	$faseend = parse_field_date_for_json(get_post_meta($timeline_options['hito_final_' . $fase], 'c80_lt_start_date', true));

	if ($withlink) :
		$link = get_permalink($post->ID) . '#' . $fasestart['year'] . '-' . $faseend['year'];
	else :
		$link = $fasestart['year'] . '-' . $faseend['year'];
	endif;

	return $link;
}

/**
 * Register the /wp-json/acf/v3/posts endpoint so it will be cached.
 */
function wprc_add_acf_posts_endpoint($allowed_endpoints)
{
	if (!isset($allowed_endpoints['constitucion1980/v1'])) {
		$allowed_endpoints['constitucion1980/v1'][] = 'linea-de-tiempo';
		$allowed_endpoints['constitucion1980/v1'][] = 'ltseguridadsocial';
	}
	return $allowed_endpoints;
}
add_filter('wp_rest_cache/allowed_endpoints', 'wprc_add_acf_posts_endpoint', 10, 1);