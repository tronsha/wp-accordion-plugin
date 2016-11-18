<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$post_type_object = get_post_type_object( 'page' );

?>
<div class="wrap accordion-list">
	<h1>
		Accordion
		<a href="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=0' ); ?>" class="page-title-action"><?php _e( 'Add New', 'mpcx-accordion' ); ?></a>
	</h1>
	<table class="wp-list-table widefat fixed striped">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-title column-primary">
					<strong><?php _e( 'Title', 'mpcx-accordion' ); ?></strong>
				</th>
				<th scope="col" class="manage-column column-shortcode">
					<strong><?php _e( 'Shortcode', 'mpcx-accordion' ); ?></strong>
				</th>
				<th scope="col" class="manage-column column-edit">
					&nbsp;
				</th>
				<th scope="col" class="manage-column column-delete">
					&nbsp;
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $accordions as $key => $accordion ): ?>
			<?php if ( $key === 0 ) {
				continue;
			} ?>
			<tr>
				<td class="title column-title column-primary">
					<strong>
						<a class="row-title" href="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=' . $key ); ?>"><?php echo $accordion['title']; ?></a>
					</strong>
					<button type="button" class="toggle-row"></button>
				</td>
				<td class="shortcode column-shortcode" data-colname="<?php _e( 'Shortcode', 'mpcx-accordion' ); ?>">
					[accordion id="<?php echo $key; ?>" /]
				</td>
				<td class="options column-edit" data-colname="<?php _e( 'Edit', 'mpcx-accordion' ); ?>">
					<a href="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=' . $key ); ?>" title="<?php _e( 'Edit', 'mpcx-accordion' ); ?>">
						<span class="dashicons dashicons-edit"></span>
					</a>
				</td>
				<td class="options column-delete" data-colname="<?php _e( 'Delete', 'mpcx-accordion' ); ?>">
					<a href="<?php echo admin_url( 'admin.php?page=accordion&amp;delete=' . $key ); ?>" title="<?php _e( 'Delete', 'mpcx-accordion' ); ?>" onclick="return confirm('<?php printf( __( 'Are you sure you want to delete %s?', 'mpcx-accordion' ), $accordion['title'] ); ?>');">
						<span class="dashicons dashicons-trash"></span>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
