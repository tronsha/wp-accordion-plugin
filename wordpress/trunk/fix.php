<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @package wp-accordion-plugin
 */

$data = get_option( 'mpcx_accordion' );
if ( true === is_string( $data ) ) {
	$data = json_decode( $data, true );
}
if ( false === is_array( $data ) ) {
	$data = array();
}
if ( true === isset( $data[0]['version'] ) ) {
	$data['version'] = $data[0]['version'];
}
if ( true === isset( $data[0]['index'] ) ) {
	$data['index'] = $data[0]['index'];
}
if ( true === isset( $data[0] ) ) {
	unset( $data[0] );
}
$data['version'] = '1.2.4';
update_option( 'mpcx_accordion', $data );
