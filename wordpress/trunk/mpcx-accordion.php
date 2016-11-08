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
 * Version:           1.2.0-beta
 * Author:            Stefan Hüsges
 * Author URI:        http://www.mpcx.net/
 * Copyright:         Stefan Hüsges
 * License:           MIT
 * License URI:       https://raw.githubusercontent.com/tronsha/wp-accordion-plugin/master/LICENSE
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

load_plugin_textdomain( 'mpcx-accordion', false, dirname( plugin_basename( __FILE__ ) ) . '/localization' );

register_activation_hook(
	__FILE__,
	function () {
		add_option( 'mpcx_accordion', json_encode([0 => ['version' => '1.2.0']]) );
	}
);

if ( is_admin() ) {

	add_action(
		'admin_menu',
		function () {
			add_menu_page(
				'Accordion',
				'Accordion',
				'manage_options',
				'accordion',
				function () {
					include plugin_dir_path( __FILE__ ) . 'admin/options.php';
				},
				'dashicons-clipboard',
				20
			);
		}
	);

}

if ( ! is_admin() ) {

	add_shortcode(
		'accordion',
		function ( $att = array(), $content = null ) {
			if ( isset( $att['id'] ) === true && $att['id'] > 0 ) {
				$accordion = json_decode( get_option( 'mpcx_accordion' ), true );
				$content   = '';
				foreach ( $accordion[ $att['id'] ]['data'] as $data ) {
					$content .= '<h3>' . $data['headline'] . '</h3><div>' . $data['text'] . '</div>';
				}
			} else {
				$content = do_shortcode( $content );
			}

			return '<div class="accordion">' . $content . '</div>';
		}
	);

}

add_action(
	'init',
	function () {
		wp_register_style(
			'mpcx-accordion',
			plugin_dir_url( __FILE__ ) . (is_admin() ? 'admin' : 'public') . '/css/accordion.min.css',
			array(),
			'1.2.0'
		);
		wp_register_script(
			'mpcx-accordion',
			plugin_dir_url( __FILE__ ) . (is_admin() ? 'admin' : 'public') . '/js/accordion.min.js',
			array( 'jquery' ),
			'1.2.0'
		);
		wp_enqueue_style( 'mpcx-accordion' );
		wp_enqueue_script( 'mpcx-accordion' );
	}
);
