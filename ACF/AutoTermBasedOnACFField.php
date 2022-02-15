<?php

/**
 *  Author: Christoph Purin
 *  WEB: www.purin.at
 *  E-Mail: christoph@purin.at
 *  Licence: MIT
 *  V: 1.0.2 ~ 15.02.2022
 *  Tested on WordPress 5.9 
 */

 /**
  * Readme
  * This script automatically creates terms coming from an advanced custom field.
  * The content is taken from a freely definable ACF field, converted to uppercase and shortened to the first character.
  * The new term is created using this abbreviated character.
  * The script can handle special characters and umlauts.
  * A little logic avoids duplicates.
  * The slug and the description could be optionally extended, I didn't consider these fields here - but they can be left out. 
  */

function update_custom_terms($post_id) {

    if ( 'tours' != get_post_type($post_id)) {
        return;
    }

    if (get_post_status($post_id) == 'auto-draft') {
        return;
    }
	$get_last_name = get_field( "nachname" );
	
    if (!empty($get_last_name)) {
		$get_last_name = preg_replace("/\s+/", "", $get_last_name);
		$get_last_name = preg_replace('/[^\p{L}\p{N} ]/u',"",$get_last_name);
		$firstCharacter = mb_strtoupper($get_last_name, 'UTF-8');
		$firstCharacter = mb_substr(ucfirst($firstCharacter), 0, 1);
       
		$term_title = $firstCharacter;
		$term_slug = $firstCharacter;
		$taxonomy = 'destinations';

		$existing_terms = get_terms($taxonomy, array(
			'hide_empty' => false
			)
		);

		foreach($existing_terms as $term) {
			if ($term->name == $term_title) {
				$terms = $term->term_id;
				break;
			}
		}

		if (empty($terms)) {
			$tax_insert_id = wp_insert_term($term_title,$taxonomy );
			$terms = $tax_insert_id['term_id'];
		}
		wp_set_object_terms( $post_id ,$terms, $taxonomy );
	}
}

add_action('save_post', 'update_custom_terms');