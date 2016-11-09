<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$id = (int) $_GET['delete'];

if ( $id !== 0 ) {
	unset( $accordions[ $id ] );
	update_option( 'mpcx_accordion', json_encode( $accordions ) );
}

echo '<script>window.location=\'' . admin_url( 'admin.php?page=accordion' ) . '\'</script>';
