<?php

/*
 * Change Widget H Tag any other TAG what you wish. Add this code to your function.php - also adjust to your needings. In this example, you change from h2 (default) to h4 
 */


function my_custom_widget_title_tag( $params ) {

$params[0]['before_title'] = '<h4 class="widget-title widgettitle">' ;

$params[0]['after_title']  = '</h4>' ;

return $params;

}
add_filter( 'dynamic_sidebar_params' , 'my_custom_widget_title_tag' );