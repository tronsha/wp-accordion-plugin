<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$id = (int) $_GET['edit'];

if ( $id === 0 ) {
	$id           = 1 + (int) $accordions[0]['index'];
	$update_index = true;
}

if ( isset( $_POST['submit'] ) === true ) {
	foreach ( $_POST['headline'] as $key => $headline ) {
		$data[ $key ]['headline'] = $headline;
	}
	foreach ( $_POST['text'] as $key => $text ) {
		$data[ $key ]['text'] = $text;
	}
	$accordions[ $id ]['data']  = $data;
	$accordions[ $id ]['title'] = $_POST['title'];
	update_option( 'mpcx_accordion', json_encode( $accordions ) );
	echo '<div id="message" class="updated notice is-dismissible"><p>' . __( 'The changes are saved.', 'mpcx-accordion' ) . '</p></div>';
}

$count = count( $accordions[ $id ]['data'] );

?>
<div class="wrap accordion-edit">
	<h1>
		Accordion
	</h1>
	<form method="post" action="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=' . $id ); ?>">
		<?php if ( $update_index ): ?>
			<input type="hidden" name="index" value="<?php echo $id; ?>">
		<?php endif; ?>
		<div id="titlediv">
			<div id="titlewrap">
				<label class="screen-reader-text" id="title-prompt-text" for="title"><?php _e( 'Title', 'mpcx-accordion' ); ?></label>
				<input type="text" id="title" name="title" size="30" value="<?php echo esc_attr( $accordions[ $id ]['title'] ? $accordions[ $id ]['title'] : 'Accordion ' . $id ); ?>" spellcheck="true" autocomplete="off">
			</div>
		</div>
		<?php $i = 1; ?>
		<?php foreach ( $accordions[ $id ]['data'] as $key => $data ): ?>
			<table class="form-table">
				<tr>
					<th colspan="2">
						<h2>
							<strong><?php echo $i; ?>.)</strong>
							<span class="dashicons dashicons-trash button button-primary" data-button="delete"></span>
							<span class="dashicons dashicons-arrow-up button button-primary" data-button="up" style="display: none;"></span>
							<span class="dashicons dashicons-arrow-down button button-primary" data-button="down" style="display: none;"></span>
						</h2>
					</th>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="headline_<?php echo $i; ?>"><?php _e( 'Headline', 'mpcx-accordion' ); ?></label>
					</th>
					<td>
						<input type="text" id="headline_<?php echo $i; ?>" name="headline[]" data-type="headline" value="<?php echo esc_attr( $data['headline'] ); ?>"/>
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="text_<?php echo $i; ?>"><?php _e( 'Text', 'mpcx-accordion' ); ?></label>
					</th>
					<td>
						<textarea  id="text_<?php echo $i; ?>" name="text[]" rows="10" data-type="text"><?php echo esc_textarea( $data['text'] ); ?></textarea>
					</td>
				</tr>
			</table>
			<?php $i ++; ?>
		<?php endforeach; ?>
		<span class="dashicons dashicons-plus button button-primary" data-button="add"></span>
		<?php submit_button(); ?>
	</form>
	<table class="form-table" style="display: none;">
		<tr>
			<th colspan="2">
				<h2>
					<strong></strong>
					<span class="dashicons dashicons-trash button button-primary" data-button="delete"></span>
					<span class="dashicons dashicons-arrow-up button button-primary" data-button="up" style="display: none;"></span>
					<span class="dashicons dashicons-arrow-down button button-primary" data-button="down" style="display: none;"></span>
				</h2>
			</th>
		</tr>
		<tr class="form-field">
			<th scope="row">
				<label for="headline_dummy"><?php _e( 'Headline', 'mpcx-accordion' ); ?></label>
			</th>
			<td>
				<input type="text" id="headline_dummy" name="headline[]" data-type="headline" value=""/>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row">
				<label for="text_dummy"><?php _e( 'Text', 'mpcx-accordion' ); ?></label>
			</th>
			<td>
				<textarea  id="text_dummy" name="text[]" rows="10" data-type="text"></textarea>
			</td>
		</tr>
	</table>
</div>
