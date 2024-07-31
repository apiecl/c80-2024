<?php

function c80t_avatar($size) {
	global $post;
	$authorid = get_the_author_meta( 'ID' );
	$avatar = get_avatar($authorid, $size, '', get_the_author_meta('display_name'));
	return $avatar;
}

function c80t_add_custom_user_profile_fields( $user ) {
	$output = '<h3>Información adicional</h3>';
	$output .= '<table class="form-table"><tr>';
	$output .= '<th><label for="author_bio">Biografía</label></th>';
	$output .= '<td><textarea rows="7" name="author_bio" id="author_bio" class="regular-text"/>' . esc_textarea( get_the_author_meta('author_bio', $user->ID )) . '</textarea> <br> </td>';
	$output .= '<span class="description">Escribe una biografía o reseña del autor / usuario más extendida.</span></td>';
	$output .= '</tr><tr>';
	$output .= '<th><label for="author_org">Organización</label></th>';
	$output .= '<td><input type="text" name="author_org" id="author_org" class="regular-text" value="' . esc_attr(get_the_author_meta( 'author_org', $user->ID) ) . '"/> <br> </td>';
	$output .= '<span class="description">La organización a la que pertenece el autor / usuario.</span></td>';
	$output .= '</tr><tr>';
	$output .= '<th><label for="author_orgurl">URL Organización</label></th>';
	$output .= '<td><input type="text" name="author_orgurl" id="author_orgurl" class="regular-text" value="' . esc_attr(get_the_author_meta( 'author_orgurl', $user->ID) ) . '"/> <br> </td>';
	$output .= '<span class="description">URL de la organización a la que pertenece el autor / usuario (con http://).</span></td>';
	$output .= '</tr></table>';

	echo $output;
}

function c80t_save_custom_user_profile_fields( $user_id ) {
	if (!current_user_can('edit_user', $user_id ) )
			return FALSE;
	$info = $_POST['author_bio'];
	$author_org = $_POST['author_org'];
	$author_orgurl = $_POST['author_orgurl'];
	$cleaninfo = sanitize_text_field( $info );
	$cleanorg = sanitize_text_field( $author_org );
	$cleanorgurl = sanitize_text_field( $author_orgurl );
	
	update_user_meta( $user_id, 'author_bio', $cleaninfo );
	update_user_meta( $user_id, 'author_org', $cleanorg );
	update_user_meta( $user_id, 'author_orgurl', $cleanorgurl);
}

add_action('show_user_profile', 'c80t_add_custom_user_profile_fields');
add_action('edit_user_profile', 'c80t_add_custom_user_profile_fields');
add_action('personal_options_update', 'c80t_save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'c80t_save_custom_user_profile_fields');