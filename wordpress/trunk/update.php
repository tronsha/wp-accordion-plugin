<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @package wp-accordion-plugin
 */

define( 'MPCX_ACCORDION_UPDATE_VERSION', '1.2.4' );
$data = get_option( 'mpcx_accordion' );
if ( version_compare( $data['version'], MPCX_ACCORDION_UPDATE_VERSION, '<' ) ) {
//	if ( version_compare( $data['version'], '#.#.#', '<' ) ) {
//	}
	$data['version'] = MPCX_ACCORDION_UPDATE_VERSION;
	update_option( 'mpcx_accordion', $data );
}
