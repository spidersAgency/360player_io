<?php
/**
 * Plugin Name:     Wordpress Integration for 360player.io
 * Plugin URI:      https://spiders.agency
 * Description:     Adds oembed and shortcode for 360player.io onto your website.
 * Author:          Maciej Palmowski
 * Author URI:      https://spiders.agency
 * Text Domain:     360player
 * Version:         1.0.0
 *
 * @package         360player
 */

/**
 * Creating oembed handler for 360player.io
 */

if ( !class_exists( 'Player_360io' ) ) {
    Class Player_360io {
        function __construct() {
            $this->width = 560;
            $this->height = 315;
            $this->class = '';
            $this->pattern = '#(?:http|https)://360player\.io/(?:player|p)/(.*)/#i';
        }

        /**
         * Loads scripts when loading shortcode
         */
        function load_scripts() {
            wp_enqueue_script( '360player_js', 'https://360player.io/static/dist/scripts/embed.js', '', '' , true );
        }

        /**
         * Creating iframe and appling filters
         */
        function prepare_iframe( $movie_id='', $atts = '' ) {
            self::load_scripts();

            $this->width = apply_filters( '360player_embed_width', $this->width );
            $this->height = apply_filters( '360player_embed_height', $this->height );
            $this->class = apply_filters( '360player_embed_class', $this->class );

            if ( $atts ) {
                extract( shortcode_atts( [
                    'width' => $this->width ,
                    'height' => $this->height,
                    'class' => $this->class,
                    'movie_id' => ''
                ], $atts, '360player' ) );
            }

            $embed = '<iframe src="https://360player.io/p/'. $movie_id .'/" frameborder="0" width="'.$this->width.'" height="'. $this->height.'" allowfullscreen data-token="'.$movie_id.'" class="'.$this->class.'"></iframe>';

            return $embed;
        }

        /**
         * Embed handler
         */
        function wp_embed_handler( $matches, $attr, $url, $rawattr ) {
            return self::prepare_iframe( $matches[1] );
        }


        /**
         * Creates shortcode
         */
        function shortcode( $atts ) {
            return self::prepare_iframe( '', $atts );
        }
    }

    $player_io = new Player_360io();
    wp_embed_register_handler( '360player', $player_io->pattern, [ $player_io, 'wp_embed_handler' ] );
    add_shortcode( '360player', [ $player_io, 'shortcode' ] );

}
