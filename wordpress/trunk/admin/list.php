<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$post_type_object = get_post_type_object( 'page' );

?>
<div class="wrap accordion">
	<h1>
		Accordion
		<a href="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=0' ); ?>" class="page-title-action"><?php echo esc_html( $post_type_object->labels->add_new ); ?></a>
	</h1>
	<table class="wp-list-table widefat fixed">
		<thead>
		<tr>
			<td>
				<strong><?php _e( 'Title', 'mpcx-accordion' ); ?></strong>
			</td>
			<td>
				<strong><?php _e( 'Shortcode', 'mpcx-accordion' ); ?></strong>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		</thead>
		<tbody>
		<?php foreach ( $accordions as $key => $accordion ): ?>
			<?php if ( $key === 0 ) {
				continue;
			} ?>
			<tr>
				<td>
					<strong>
						<a href="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=' . $key ); ?>"><?php echo $accordion['title']; ?></a>
					</strong>
				</td>
				<td>
					[accordion id="<?php echo $key; ?>" /]
				</td>
				<td>
					<a href="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=' . $key ); ?>">
						<span class="dashicons dashicons-edit"></span>
					</a>
					&#160;
					<a href="<?php echo admin_url( 'admin.php?page=accordion&amp;delete=' . $key ); ?>" onclick="return confirm('<?php printf( __( 'Are you sure you want to delete %s?', 'mpcx-accordion' ), $accordion['title'] ); ?>');">
						<span class="dashicons dashicons-trash"></span>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
