/**
 *  Author: Christoph Purin
 *  WEB: www.purin.at
 *  E-Mail: christoph@purin.at
 *  Licence: MIT
 *  V: 1.0.0 ~ 08.01.2021
 *  Tested on WordPress 5.9 
 */

 /**
  * Readme
  * Simply replace over DB old URL to a NEW URL. Usage oldsiteurl and newsiteurl like https://mydomain.tld to https://newdomain.tld. 
  * Be careful with this script. -> no backup no pity
  * On a default WordPress installation there three SQL tables wehere you need to change the URL. wp_posts, wp_postmeda and wp_options.
  */

UPDATE `wp_posts` SET guid = REPLACE(guid, 'oldsiteurl', 'newsiteurl') WHERE guid LIKE 'oldsiteurl%';
UPDATE `wp_postmeta` SET meta_value = REPLACE(meta_value, 'oldsiteurl', 'newsiteurl') WHERE meta_value LIKE 'oldsiteurl%';
UPDATE `wp_options` SET option_value = REPLACE(option_value, 'oldsiteurl', 'newsiteurl') WHERE option_value LIKE 'oldsiteurl%';