<?php
/*
Plugin Name: planetcalc
Plugin URI: http://planetcalc.com/wordpress/
Description: Planetcalc calculator widget
Version: 2.2
Author: planetcalc.com
Author URI: http://planetcalc.com/
Text Domain: planetcalc
Domain Path: /languages
*/

define('PLANETCALC_DEFAULT_WIDTH',728);
define('PLANETCALC_DEFAULT_HEIGHT',500);


function planetcalc_embed( $attrs ) {
	$domain = 'https://planetcalc.com/';
	$embed_domain = 'https://embed.planetcalc.com/';
	$defaults = array( 'code'=>'','cid'=>0,'language' => 'en', 'label'=>str_replace('%s','PLANETCALC',__('Created on %s','planetcalc'))
		, 'colors'=>'','width' => PLANETCALC_DEFAULT_WIDTH, 'height'=>PLANETCALC_DEFAULT_HEIGHT,'v'=>0,'sid'=>0 );
	$a= shortcode_atts( $defaults, $attrs );
	if (  $a['cid'] ) {
		return '<div><a href="' . $domain . $a['cid'] . '/" data-lang="' . $a['language'] . '" data-code="' . $a['code'] 
			. '" data-colors="' . $a['colors'] . '" data-v="' . $a['v'] . '">' . $a['label']
			. '</a><script src="' . $embed_domain . 'widget.js?v=' . $a['v'] . ' "></script></div>';
	} else if ( $a['sid'] ) {
		return '<iframe src="' . $embed_domain . 'embed/?id=' . $a['sid'] . "&language_select=" . $a['language']
			. '" scrolling="no" frameborder="0" height="' . $a['height'] . '" width="' . $a['width'] . '">PLANETCALC</iframe>';
	} else {
		return str_replace('%s','<a href="https://planetcalc.com">planetcalc.com</a>'
			, __('Wrong PLANETCALC shortcut. Please visit %s, to obtain a correct wordpress shortcut.','planetcalc'));
	}
}

add_shortcode('planetcalc','planetcalc_embed');

function planetcalc_load_plugin_textdomain() {
    load_plugin_textdomain( 'planetcalc', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'planetcalc_load_plugin_textdomain' );

?>
