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
  * This script change the Tab name from Ultimate Member - add the code under your function.php
  */

function custom_um_profile_query_make_posts( $args = array() ) {

// Change the post type to our liking.

$args['post_type'] = 'jobs';

return $args;

}