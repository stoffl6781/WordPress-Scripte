<?php

/**
 *  Author: Christoph Purin
 *  WEB: www.purin.at
 *  E-Mail: christoph@purin.at
 *  Licence: MIT
 *  V: 1.0.1 ~ 11.02.2022
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

    if ( 'tours' != get_post_type($post_id)) {  //Add your Custom Post Type here or use WordPress defaults 'posts' / 'pages'
        return;
    }

    if (get_post_status($post_id) == 'auto-draft') {
        return;
    }
    
    
    $get_last_name = get_field( "lastname" ); //Add your ACF name field here, example lastname
    $last_name = strtoupper($get_last_name);
    $firstCharacter = mb_substr($last_name, 0, 1);
    $term_title = $firstCharacter;
    $term_slug = $firstCharacter;
    $taxonomy = 'destinations'; // Hadd your Taxonomy here example: destinations
    
    $existing_terms = get_terms($taxonomy, array(
        'hide_empty' => false
        )
    );
    // Logic for duplicate taxonomy
    foreach($existing_terms as $term) {
        
        if ($term->term_name == $term_title) {
            $terms = $term->term_id;
            break;
        }             
        
    }
    // If Taxonomy not exist, add new according to ACF Field
    if (empty($terms)) {
        $tax_insert_id = wp_insert_term($term_title,$taxonomy );
        $terms = $tax_insert_id['term_id'];
    }
    wp_set_object_terms( $post_id ,$terms, $taxonomy );
}
// run on update post process
add_action('save_post', 'update_custom_terms');