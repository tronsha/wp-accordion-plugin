<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$accordions = json_decode( get_option( 'mpcx_accordion' ), true );

if ( $accordions === null ) {
	$accordions = array( 0 => array( 'version' => '1.2.0' ) );
}

if ( isset( $_GET['edit'] ) === true ) {
	include_once plugin_dir_path( __FILE__ ) . 'edit.php';
} elseif ( isset( $_GET['delete'] ) === true ) {
	include_once plugin_dir_path( __FILE__ ) . 'delete.php';
} else {
	include_once plugin_dir_path( __FILE__ ) . 'list.php';
}
