<?php
/**
 *  Author: Christoph Purin
 *  WEB: www.purin.at
 *  E-Mail: christoph@purin.at
 *  Licence: MIT
 *  V: 1.0.0 ~ 18.10.2021
 *  Tested on WordPress 5.9 
 */

 /**
  * Readme
  * This script add your own Animation on the Animation DropDown in Elementor. You need two parts: PHP and CSS. 
  * The PHP part is stored under your function.php this register the Dropdown and also refer to your CSS. 
  * in your custom CSS you need to insert the wished CSS/Animation witch this Dropdown call.
  */

function my_entrance_animations() {
	return array(
	    'Custom Slide Animations' => [
            'customSlideDown' => 'Custom Slide Down', // 'customSlidedown' = CSS class for style.css
			'customSlideleft' => 'Custom Slide Left',
			'customSlideleft2' => 'Custom Slide small Left',
		],
	);
}
add_filter( 'elementor/controls/animations/additional_animations', 'my_entrance_animations' );
?>


/*
* style.css 
* Example CSS for Animation - look to Elementor keyframes (defualt things) to copy and overrid it.
* https://gist.github.com/stoffl6781/d28ed53e2e350e7b89e78c6e2f2471de
*/

/* Custom Slide Animations */
.customSlideDown{
	animation-name: customSlideDown;
}
@keyframes customSlideDown {
	0% {
    transform: translate3d(0,-100vh,0);
    visibility: visible;
}
	100% {
    transform: translate3d(0,0,0);
}
}

.customSlideleft{
	animation-name: customSlideLeft;
}
@keyframes customSlideLeft {
	0% {
    transform: translate3d(-100vh,0,0);
    visibility: visible;
}
	100% {
    transform: translate3d(0,0,0);
}
}
.customSlideleft2{
	animation-name: customSlideLeft2;
}

@keyframes customSlideLeft2 {
	0% {
    transform: translate3d(-80vh,0,0);
    visibility: visible;
}
	100% {
    transform: translate3d(0,0,0);
}
}