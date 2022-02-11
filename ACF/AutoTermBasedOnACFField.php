<?php

/**
 *  Author: Christoph Purin
 *  WEB: www.purin.at
 *  E-Mail: christoph@purin.at
 *  Licence: MIT
 *  V: 1.0.0 ~ 11.02.2022
 */

function update_custom_terms($post_id) {

    if ( 'tours' != get_post_type($post_id)) {
        return;
    }

    if (get_post_status($post_id) == 'auto-draft') {
        return;
    }
    
    
    $get_last_name = get_field( "nachname" ); //Hier das abzugreifende ACF Feld einstetzen Beispiel: nachname
    $last_name = strtoupper($get_last_name);
    $firstCharacter = mb_substr($last_name, 0, 1);
    $term_title = $firstCharacter;
    $term_slug = $firstCharacter;
    $taxonomy = 'destinations'; // Hier deine Taxonomy einsetzen Beispiel: destinations
    
    $existing_terms = get_terms($taxonomy, array(
        'hide_empty' => false
        )
    );

    foreach($existing_terms as $term) {
        
        if ($term->term_name == $term_title) {
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

add_action('save_post', 'update_custom_terms');