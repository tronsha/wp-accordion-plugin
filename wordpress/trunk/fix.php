<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @package wp-accordion-plugin
 */

$data = get_option( 'mpcx_accordion' );
if ( is_string( $data ) === true ) {
	$data = json_decode( $data, true );
}
if ( is_array( $data ) === false ) {
	$data = array();
}
if ( isset( $data[0]['version'] ) === true ) {
	$data['version'] = $data[0]['version'];
}
if ( isset( $data[0]['index'] ) === true ) {
	$data['index'] = $data[0]['index'];
}
if ( isset( $data[0] ) === true ) {
	unset( $data[0] );
}
$data['version'] = '1.2.4';
update_option( 'mpcx_accordion', $data );
