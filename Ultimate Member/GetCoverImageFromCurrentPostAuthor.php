<?php

/**
 *  Author: Christoph Purin
 *  WEB: www.purin.at
 *  E-Mail: christoph@purin.at
 *  Licence: MIT
 *  V: 1.0.0 ~ 29.07.2021
 *  Tested on WordPress 5.9 
 */

 /**
  * Readme
  * This script add a new Shortcode to get the CoverImage from Author on the actually post loop. Add the code under your function.php
  * [um_user user_id="123" meta_key="cover_photo" ] user_id can be blank it will be grep fromt he open post loop. Meta key is required.
  */
  
  
  // [um_user user_id="123" meta_key="cover_photo" ]
add_filter( 'um_profile_query_make_posts', 'custom_um_profile_query_make_posts', 12, 1 );

add_filter("um_user_shortcode_filter__cover_photo","um_user_shortcode_filter__cover_photo", 10, 3);
function um_user_shortcode_filter__cover_photo( $meta_value,  $raw_meta_value, $user_id ){
    
   return  UM()->uploader()->get_upload_user_base_url( $user_id )."/".$meta_value; 
}

add_filter("um_user_shortcode_filter__profile_photo","um_user_shortcode_filter__profile_photo", 10, 3);
function um_user_shortcode_filter__profile_photo( $meta_value,  $raw_meta_value, $user_id ){
    
   return  UM()->uploader()->get_upload_user_base_url( $user_id )."/".$meta_value; 
}

add_action('template_redirect','sc_init_um_user_shortcode');
add_action('init','sc_init_um_user_shortcode');
function sc_init_um_user_shortcode(){
	add_shortcode( 'um_user', 'sc_um_user_shortcode' );
}

function sc_um_user_shortcode( $atts ) {
    $my_post = get_post( $id ); // $id - Post ID
    $id = $my_post->post_author; // print post author ID
	$atts = shortcode_atts( array(
		'user_id' => $id,
		'meta_key' => ''
	), $atts );
	extract( $atts );
	if ( ! $user_id || empty( $meta_key ) ) return;
    
    $raw_meta_value  = get_user_meta( $user_id, $meta_key, true );
    
    if( is_serialized( $raw_meta_value ) ){
       $meta_value = unserialize( $raw_meta_value );
    }else if( is_array( $raw_meta_value ) ){
         $meta_value = implode(",",$raw_meta_value);
    }else{
    	$meta_value = $raw_meta_value;
    } 
	$url = apply_filters("um_user_shortcode_filter__{$meta_key}", $meta_value,  $raw_meta_value, $user_id );
	$img = '<img src="'. $url .'" class="user-cover" alt="">';

    return $img;
 
}