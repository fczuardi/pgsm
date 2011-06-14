=== Iframe ===
Contributors: webvitaly
Plugin URI: http://web-profile.com.ua/wordpress/plugins/iframe/
Tags: iframe, embed
Author URI: http://web-profile.com.ua/wordpress/
Requires at least: 3.0
Tested up to: 3.2
Stable tag: 1.2.0

You can embed iframe with [iframe width="640" height="480" src="http://vimeo.com/123"] shortcode.

== Description ==

Iframes are needed to embed video from youtube or to embed Google Map or just to embed content from external page.
WordPress removes iframe when you switch from "HTML" to "Visual" tab because of the security reasons.
So you can embed iframe code using this shortcode `[iframe width="640" height="480" src="http://player.vimeo.com/video/3261363"]`.

= Usage (allowed parameters) =
* width - width of the iframe in pixels `[iframe width="640" src="http://player.vimeo.com/video/3261363"]` (by default width="640");
* height - height of the iframe in pixels `[iframe height="480" src="http://player.vimeo.com/video/3261363"]` (by default height="480");
* src - source of the iframe `[iframe src="http://player.vimeo.com/video/3261363"]` (by default src="");
* frameborder - frameborder parameter of the iframe `[iframe frameborder="0" src="http://player.vimeo.com/video/3261363"]` (by default frameborder="0");
* scrolling - scrolling parameter of the iframe `[iframe scrolling="no" src="http://player.vimeo.com/video/3261363"]` (by default scrolling="no");
* marginheight - marginheight parameter of the iframe `[iframe marginheight="0" src="http://player.vimeo.com/video/3261363"]` (by default marginheight="0");
* marginwidth - marginwidth parameter of the iframe `[iframe marginwidth="0" src="http://player.vimeo.com/video/3261363"]` (by default marginwidth="0");
* allowtransparency - allowing transparency of the iframe `[iframe allowtransparency="true" src="http://player.vimeo.com/video/3261363"]` (by default allowtransparency="true");

[Iframe plugin page](http://web-profile.com.ua/wordpress/plugins/iframe/)

[WordPress stuff](http://web-profile.com.ua/wordpress/)

== Changelog ==

= 1.2.0 =
* Adding "output=embed" to Google Map;

= 1.1.0 =
* Parameter allowtransparency added (thanks to Kent);

= 1.0.0 =
* Initial release;

== Installation ==

1. Install plugin and activate it on the Plugins page;
2. Add shortcode `[iframe width="640" height="480" src="http://player.vimeo.com/video/3261363"]` to page content;