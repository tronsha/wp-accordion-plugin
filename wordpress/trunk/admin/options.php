<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$accordions = get_option( 'mpcx_accordion' );

if ( null === $accordions ) {
	$accordions = array( 'version' => MPCX_ACCORDION_VERSION );
}

if ( true === isset( $_GET['edit'] ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'edit.php';
} elseif ( true === isset( $_GET['delete'] ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'delete.php';
} else {
	include_once plugin_dir_path( __FILE__ ) . 'list.php';
}
