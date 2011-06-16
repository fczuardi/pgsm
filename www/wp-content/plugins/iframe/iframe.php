<?php

/*
Plugin Name: Iframe
Plugin URI: http://web-profile.com.ua/wordpress/plugins/iframe/
Description: Plugin shows iframe with [iframe width="640" height="480" src="http://player.vimeo.com/video/3261363"] shortcode.
Version: 1.3.0
Author: webvitaly
Author Email: webvitaly(at)gmail.com
Author URI: http://web-profile.com.ua/
*/

if ( !function_exists( 'iframe_embed_shortcode' ) ) {
	function iframe_embed_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'width' => '640',
			'height' => '480',
			'src' => '',
			'frameborder' => '0',
			'scrolling' => 'no',
			'marginheight' => '0',
			'marginwidth' => '0',
			'allowtransparency' => 'true',
			'id' => 'iframe-id',
			'class' => 'iframe-class'
		), $atts));
		$src_cut = substr($src, 0, 35);
		if(strpos($src_cut, 'maps.google' )){
			$google_map_fix = '&output=embed';
		}else{
			$google_map_fix = '';
		}
		return '<iframe id="'.$id.'" class="'.$class.'" width="'.$width.'" height="'.$height.'" frameborder="'.$frameborder.'" scrolling="'.$scrolling.'" marginheight="'.$marginheight.'" marginwidth="'.$marginwidth.'" allowtransparency="'.$allowtransparency.'" src="'.$src.$google_map_fix.'"></iframe>';
		// &amp;output=embed
	}
	add_shortcode('iframe', 'iframe_embed_shortcode');
}
