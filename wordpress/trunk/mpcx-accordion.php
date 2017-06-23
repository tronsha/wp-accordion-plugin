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
 * Version:           1.2.6
 * Author:            Stefan Hüsges
 * Author URI:        http://www.mpcx.net/
 * Copyright:         Stefan Hüsges
 * Text Domain:       mpcx-accordion
 * Domain Path:       /languages/
 * License:           MIT
 * License URI:       https://raw.githubusercontent.com/tronsha/wp-accordion-plugin/master/LICENSE
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'MPCX_ACCORDION_VERSION', '1.2.6' );

load_plugin_textdomain( 'mpcx-accordion', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

register_activation_hook(
	__FILE__,
	function () {
		add_option( 'mpcx_accordion', array( 'version' => MPCX_ACCORDION_VERSION ) );
	}
);

if ( true === is_string( get_option( 'mpcx_accordion' ) ) ) {
	include plugin_dir_path( __FILE__ ) . 'fix.php';
}

if ( is_admin() ) {

	add_action(
		'upgrader_process_complete',
		function ( $object, $options ) {
			if ( 'update' === $options['action'] && 'plugin' === $options['type'] ) {
				if ( true === in_array( plugin_basename( __FILE__ ), $options['plugins'] ) ) {
					include plugin_dir_path( __FILE__ ) . 'update.php';
				}
			}
		},
		10,
		2
	);

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

add_action(
	'admin_enqueue_scripts',
	function ( $hook ) {
		if ( 'toplevel_page_accordion' !== $hook ) {
			return;
		}
		wp_register_style(
			'mpcx-accordion',
			plugin_dir_url( __FILE__ ) . 'admin/css/accordion.min.css',
			array(),
			MPCX_ACCORDION_VERSION
		);
		wp_register_script(
			'mpcx-accordion',
			plugin_dir_url( __FILE__ ) . 'admin/js/accordion.min.js',
			array( 'jquery' ),
			MPCX_ACCORDION_VERSION
		);
		wp_enqueue_style( 'mpcx-accordion' );
		wp_enqueue_script( 'mpcx-accordion' );
	}
);

if ( ! is_admin() ) {

	add_shortcode(
		'accordion',
		function ( $att = array(), $content = null ) {
			if ( true === isset( $att['id'] ) && $att['id'] > 0 ) {
				$accordion = get_option( 'mpcx_accordion' );
				$content   = '';
				$first     = true;
				foreach ( $accordion[ $att['id'] ]['data'] as $data ) {
					$content .= '<h3 data-hash="' . urlencode( $data['headline'] ) . '">' . preg_replace( '/&lt;\s*(\/?)\s*(sub|sup)\s*&gt;/is', '<$1$2>', esc_html( $data['headline'] ) ) . '</h3><div' . ( true === $first && '1' === $accordion[ $att['id'] ]['open'] ? ' class="open" style="height: auto;"' : '' ) . '>' . do_shortcode( $data['text'] ) . '</div>';
					$first = false;
				}
			} else {
				$content = do_shortcode( $content );
			}

			return '<div class="accordion scroll no-js"' . ( isset( $att['id'] ) && intval( $att['id'] ) > 0 ? ' id="accordion-' . $att['id'] . '"' : '' ) . '>' . $content . '</div>';
		}
	);

}

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_register_style(
			'mpcx-accordion',
			plugin_dir_url( __FILE__ ) . 'public/css/accordion.min.css',
			array( 'dashicons' ),
			MPCX_ACCORDION_VERSION
		);
		wp_register_script(
			'mpcx-accordion',
			plugin_dir_url( __FILE__ ) . 'public/js/accordion.min.js',
			array( 'jquery' ),
			MPCX_ACCORDION_VERSION
		);
		wp_enqueue_style( 'mpcx-accordion' );
		wp_enqueue_script( 'mpcx-accordion' );
	}
);
