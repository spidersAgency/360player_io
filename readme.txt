=== Wordpress integration for 360player.io ===
Contributors: palmiak
Tags: 360, 360 images, oembed, shortcode, 360 photos, photos, 360 degree panorama
Requires at least: 4.4
Tested up to: 4.8.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Embed 360 images from http://360player.io into Wordpress via oembed or shortcode.

== Description ==

You can embed [360player.io](http://360player.io) player into Wordpress via **oembed**:
- https://360player.io/player/k6f7rb/

or with **shortcode**:
- `[360player movie_id="k6f7rb"]` - default usage
- `[360player movie_id="k6f7rb" width="500" height="250"]` - change width and height
- `[360player movie_id="k6f7rb" class="custom_class"]` - add custom class to iframe

Also you can set default width, height or css class via filters:
- `360player_embed_width`
- `360player_embed_height`
- `360player_embed_class`

== Installation ==

1. Upload `360player` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use Oembed or Shortcode

== Changelog ==

= 1.0 =
* Initial release
