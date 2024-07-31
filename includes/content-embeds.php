<?php
/**
 * Funciones para los embeds en sitios externos
 */



/**
 * Estilos y acciones para cabecera de los embeds
 */

add_action( 'embed_head', 'c80t_embedstyles');

function c80t_embedstyles() {

	wp_dequeue_style( 'open-sans' );

	?>
	<style>
		<?php include(TEMPLATEPATH . '/dist/css/c80-embeds.css');?>
	</style>	
	<?php
}


/**
 * Título para el Footer del Embed
 */

add_filter('embed_site_title_html', 'c80t_sitetitle');

function c80t_sitetitle($site_title) {
	global $post;
	$site_title = '<a class="embed-footer-title" href="'.get_bloginfo('url') .'">';
	$site_title .= '<img src="' . get_bloginfo('template_url') . '/dist/img/logo-c80-3.png' . '" alt="' . get_bloginfo('name') . '">';
	$site_title .= get_bloginfo('name') . ' - ' . get_bloginfo('description');
	$site_title .= '</a>';
	return $site_title;
}

/**
 * Reemplazar ícono para compartir
 * Sacar acción por defecto primero
 */

remove_action( 'embed_content_meta', 'print_embed_sharing_button' );

add_action( 'embed_content_meta', 'c80t_print_embed_sharing_button' );

function c80t_print_embed_sharing_button() {
	if ( is_404() ) {
		return;
	}
	?>
	<div class="wp-embed-share">
		<button type="button" class="wp-embed-share-dialog-open" aria-label="<?php esc_attr_e( 'Open sharing dialog' ); ?>">
			<i class="fa fa-share"></i>	<?php esc_attr_e( 'Compartir / Insertar ');?>
		</button>
	</div>
	<?php
}

/**
 * Añadir relacionados después del excerpt
 */
function c80t_afterexcerpt($excerpt) {
	global $post;
	if(get_post_type() != 'c80_cpt') {
		$relinks = c80t_relink($post->ID);	
		echo $relinks;
	}
}

add_action('embed_content', 'c80t_afterexcerpt');

/**
 * Filtrar excerpt de artículos de la constitución
 */

add_filter('the_excerpt_embed', 'c80t_artexcerpt');

function c80t_artexcerpt($excerpt) {
	global $post;
	if(get_post_type($post) == 'c80_cpt') {
		$content = new c80_Public('c80', '1.0');
		$parsecont = $content->c80_content($post->ID, 10, false);

		$output = '<p class="c80-embedcap">' . c80t_parentname($post->ID) . '</p>';
		$output .= '<div class="embed-c80">' . $parsecont . '</div>';
	} else {
		$output = get_the_excerpt();
	}

	return $output;
}

function c80_embed_html( $width, $height, $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return false;
	}

	$embed_url = get_post_embed_url( $post );

	$output = '<blockquote class="wp-embedded-content"><a href="' . esc_url( get_permalink( $post ) ) . '">' . get_the_title( $post ) . "</a></blockquote>\n";

	$output .= "<script type='text/javascript'>\n";
	$output .= "<!--//--><![CDATA[//><!--\n";
	if ( SCRIPT_DEBUG ) {
		$output .= file_get_contents( ABSPATH . WPINC . '/js/wp-embed.js' );
	} else {
		/*
		 * If you're looking at a src version of this file, you'll see an "include"
		 * statement below. This is used by the `grunt build` process to directly
		 * include a minified version of wp-embed.js, instead of using the
		 * file_get_contents() method from above.
		 *
		 * If you're looking at a build version of this file, you'll see a string of
		 * minified JavaScript. If you need to debug it, please turn on SCRIPT_DEBUG
		 * and edit wp-embed.js directly.
		 */
		$output .=<<<JS
		!function(a,b){"use strict";function c(){if(!e){e=!0;var a,c,d,f,g=-1!==navigator.appVersion.indexOf("MSIE 10"),h=!!navigator.userAgent.match(/Trident.*rv:11\./),i=b.querySelectorAll("iframe.wp-embedded-content"),j=b.querySelectorAll("blockquote.wp-embedded-content");for(c=0;c<j.length;c++)j[c].style.display="none";for(c=0;c<i.length;c++)if(d=i[c],d.style.display="",!d.getAttribute("data-secret")){if(f=Math.random().toString(36).substr(2,10),d.src+="#?secret="+f,d.setAttribute("data-secret",f),g||h)a=d.cloneNode(!0),a.removeAttribute("security"),d.parentNode.replaceChild(a,d)}else;}}var d=!1,e=!1;if(b.querySelector)if(a.addEventListener)d=!0;if(a.wp=a.wp||{},!a.wp.receiveEmbedMessage)if(a.wp.receiveEmbedMessage=function(c){var d=c.data;if(d.secret||d.message||d.value)if(!/[^a-zA-Z0-9]/.test(d.secret)){var e,f,g,h,i,j=b.querySelectorAll('iframe[data-secret="'+d.secret+'"]'),k=b.querySelectorAll('blockquote[data-secret="'+d.secret+'"]');for(e=0;e<k.length;e++)k[e].style.display="none";for(e=0;e<j.length;e++)if(f=j[e],c.source===f.contentWindow){if(f.style.display="","height"===d.message){if(g=parseInt(d.value,10),g>1e3)g=1e3;else if(200>~~g)g=200;f.height=g}if("link"===d.message)if(h=b.createElement("a"),i=b.createElement("a"),h.href=f.getAttribute("src"),i.href=d.value,i.host===h.host)if(b.activeElement===f)a.top.location.href=d.value}else;}},d)a.addEventListener("message",a.wp.receiveEmbedMessage,!1),b.addEventListener("DOMContentLoaded",c,!1),a.addEventListener("load",c,!1)}(window,document);
JS;
	}
	$output .= "\n//--><!]]>";
	$output .= "\n</script>";

	$output .= sprintf(
		'<div class="c80t_embed"><iframe sandbox="allow-scripts" security="restricted" src="%1$s" width="%2$d" height="%3$d" title="%4$s" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="wp-embedded-content"></iframe></div>',
		esc_url( $embed_url ),
		absint( $width ),
		absint( $height ),
		esc_attr__( 'Custom Embedded WordPress Post' )
	);

	return $output;
}

//add_action('embed_html', 'c80_embed_html', 10, 4);