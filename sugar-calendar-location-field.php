<?php
/**
 * Plugin Name: Sugar Events Calendar Location Field
 * Plugin URI: https://growdevelopment.com
 * Description: Add a Location field to the Sugar Events Calendar
 * Author: Daniel Espinoza
 * Author URI: https://growdevelopment.com
 * Version: 1.0.0
 */



function sugar_add_location_field() {
	global $post;

	$meta = get_post_custom( $post->ID );

	echo '<tr class="sc_meta_box_row">';

	echo '<td class="sc_meta_box_td" colspan="2"><label for="sc_event_location">' . __('Location', 'pippin_sc') . '</label></td>';

	echo '<td class="sc_meta_box_td" colspan="4">';
	$location = isset($meta['sc_event_location'][0]) ? $meta['sc_event_location'][0] : '';
	echo '<input type="text" class="sc_text" name="sc_event_location" id="sc_event_location" value="' . $location . '" />';
	echo '</td>';

	echo '</tr>';

}
add_action( 'sc_event_meta_box_after', 'sugar_add_location_field' );



function sc_meta_box_location_field_save($post_id) {
	global $post;

	// verify nonce
	if ( ! isset( $_POST['sc_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['sc_meta_box_nonce'], 'meta-boxes.php') ) {
		return $post_id;
	}

	// check autosave
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || isset( $_REQUEST['bulk_edit'] ) ) {
		return $post_id;
	}

	//don't save if only a revision
	if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
		return $post_id;
	}

	// check permissions
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	$location = isset( $_POST['sc_event_location'] ) ? sanitize_text_field( $_POST['sc_event_location'] ) : '';
	update_post_meta($post_id, 'sc_event_location', $location );

}
add_action('save_post', 'sc_meta_box_location_field_save');