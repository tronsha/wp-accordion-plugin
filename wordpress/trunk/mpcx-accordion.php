<?php
/**
 * @link              https://github.com/tronsha/wp-accordion-plugin
 * @since             1.0.0
 * @package           wp-accordion-plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Accordion
 * Plugin URI:        https://github.com/tronsha/wp-accordion-plugin
 * Description:       Just an Accordion Plugin.
 * Version:           1.1.6
 * Author:            Stefan Hüsges
 * Author URI:        http://www.mpcx.net/
 * Copyright:         Stefan Hüsges
 * License:           MIT
 * License URI:       https://raw.githubusercontent.com/tronsha/wp-accordion-plugin/master/LICENSE
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! is_admin() ) {

	add_action(
		'init',
		function () {
			wp_register_style(
				'mpcx-accordion',
				plugin_dir_url( __FILE__ ) . 'public/css/accordion.min.css',
				array(),
				'1.1.6'
			);
			wp_register_script(
				'mpcx-accordion',
				plugin_dir_url( __FILE__ ) . 'public/js/accordion.min.js',
				array( 'jquery' ),
				'1.1.6'
			);
			wp_enqueue_style( 'mpcx-accordion' );
			wp_enqueue_script( 'mpcx-accordion' );
		}
	);

	add_shortcode(
		'accordion',
		function ( $att = array(), $content = null ) {
			$content = do_shortcode( $content );
			return '<div class="accordion">' . $content . '</div>';
		}
	);

}
