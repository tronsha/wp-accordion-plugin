<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.3
 * @package wp-accordion-plugin
 */

$data = get_option( 'mpcx_accordion' );
if ( is_string( $data ) === true ) {
	$data = json_decode( $data, true );
}
if ( is_array( $data ) === false ) {
	$data = array( 'version' => MPCX_ACCORDION_VERSION );
}
if ( isset( $data[0]['index'] ) === true ) {
	$data['index'] = $data[0]['index'];
}
if ( isset( $data[0] ) === true ) {
	unset( $data[0] );
}
$data['version'] = MPCX_ACCORDION_VERSION;
update_option( 'mpcx_accordion', $data );
