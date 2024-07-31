<?php
/**
 * Default widget template.
 *
 * Copy this template to /simple-image-widget/widget.php in your theme or
 * child theme to make edits.
 *
 * @package   SimpleImageWidget
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   GPL-2.0+
 * @since     4.0.0
 */
?>

<?php if ( ! empty( $image_id ) ) : ?>
	<div class="simple-image">
		<?php
		echo $link_open;
		echo wp_get_attachment_image( $image_id, $image_size );
		echo '<div class="simple-image-text">';
		echo '<div class="container"><div class="row"><div class="col-md-12">';
		if ( ! empty( $title ) ) :
			echo $before_title . $title . $after_title;
		endif;

		if ( ! empty( $text ) ) :
			echo '<div class="inside-text">' . wpautop( $text ) . '</div>';
		endif;

		

		echo '</div></div><!--simple image-text-container--></div><!--row--></div><!--col-md-12-->';
		
		//echo '<div class="link-text"><div class="link-text-content"><i class="fa fa-angle-right"></i></div></div>';
		echo '<span class="link-text">' . $link_text . '</span>';
		echo $link_close;
		?>
	</div>
<?php endif; ?>
