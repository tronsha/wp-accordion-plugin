<?php
$id = (int) $_GET['delete'];
if ( $id !== 0 ) {
	unset( $accordions[ $id ] );
	update_option( 'mpcx_accordion', json_encode( $accordions ) );
}

include_once plugin_dir_path( __FILE__ ) . 'list.php';
