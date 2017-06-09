<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$id = (int) $_GET['edit'];

if ( $id === 0 ) {
	$id  = 1 + (int) $accordions['index'];
	$new = true;
}

if ( true === isset( $_POST['submit'] ) ) {
	if ( true === isset( $_POST['index'] ) ) {
		$accordions['index'] = $_POST['index'];
	}
	if ( true === isset( $_POST['headline'] ) && true === is_array( $_POST['text'] ) ) {
		foreach ( $_POST['headline'] as $key => $headline ) {
			$data[ $key ]['headline'] = stripslashes( $headline );
		}
	}
	if ( true === isset( $_POST['text'] ) && true === is_array( $_POST['text'] ) ) {
		foreach ( $_POST['text'] as $key => $text ) {
			$data[ $key ]['text'] = stripslashes( $text );
		}
	}
	$accordions[ $id ]['data']  = $data;
	$accordions[ $id ]['title'] = stripslashes( $_POST['title'] );
	$accordions[ $id ]['open']  = stripslashes( $_POST['open'] );
	update_option( 'mpcx_accordion', $accordions );
	echo '<div id="message" class="updated notice is-dismissible"><p>' . __( 'The changes are saved.', 'mpcx-accordion' ) . '</p></div>';
}

?>
<div class="wrap accordion-edit">
	<h1>
		Accordion
	</h1>
	<form method="post" action="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=' . $id ); ?>">
		<?php if ( true === $new ): ?>
			<input type="hidden" name="index" value="<?php echo $id; ?>">
		<?php endif; ?>
		<div id="titlediv">
			<div id="titlewrap">
				<label class="screen-reader-text" id="title-prompt-text" for="title"><?php _e( 'Title', 'mpcx-accordion' ); ?></label>
				<input type="text" id="title" name="title" size="30" value="<?php echo esc_attr( $accordions[ $id ]['title'] ? $accordions[ $id ]['title'] : 'Accordion ' . $id ); ?>" spellcheck="true" autocomplete="off">
			</div>
		</div>
		<table class="form-table">
			<tr>
				<th scope="row">
					<label for="first-entry-opened"><?php _e( 'First entry opened', 'mpcx-accordion' ); ?>:</label>
				</th>
				<td>
					<input type="checkbox" id="first-entry-opened" name="open" value="1"<?php checked( $accordions[ $id ]['open'], 1 ); ?>>
				</td>
			</tr>
		</table>
		<?php $i = 1; ?>
		<?php if ( true === isset( $accordions[ $id ]['data'] ) && true === is_array( $accordions[ $id ]['data'] ) ): ?>
			<?php foreach ( $accordions[ $id ]['data'] as $key => $data ): ?>
				<table class="form-table accordion-entry">
					<tr>
						<th colspan="2">
							<h2>
								<strong><?php echo $i; ?>.)</strong>
								<span class="button button-primary" data-button="delete"><span class="dashicons dashicons-trash"></span></span>
								<span class="button button-primary" data-button="up" style="display: none;"><span class="dashicons dashicons-arrow-up"></span></span>
								<span class="button button-primary" data-button="down" style="display: none;"><span class="dashicons dashicons-arrow-down"></span></span>
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
							<?php wp_editor( $data['text'], 'text_' . $i, array( 'tinymce' => false, 'textarea_name' => 'text[]', 'textarea_rows' => '12' ) ); ?>
						</td>
					</tr>
				</table>
				<?php $i ++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		<span class="button button-primary" data-button="add"><span class="dashicons dashicons-plus"></span></span>
		<?php submit_button(); ?>
	</form>
	<table class="form-table accordion-entry" style="display: none;">
		<tr>
			<th colspan="2">
				<h2>
					<strong></strong>
					<span class="button button-primary" data-button="delete"><span class="dashicons dashicons-trash"></span></span>
					<span class="button button-primary" data-button="up" style="display: none;"><span class="dashicons dashicons-arrow-up"></span></span>
					<span class="button button-primary" data-button="down" style="display: none;"><span class="dashicons dashicons-arrow-down"></span></span>
				</h2>
			</th>
		</tr>
		<tr class="form-field">
			<th scope="row">
				<label><?php _e( 'Headline', 'mpcx-accordion' ); ?></label>
			</th>
			<td>
				<input type="text" name="headline[]" data-type="headline" value=""/>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row">
				<label><?php _e( 'Text', 'mpcx-accordion' ); ?></label>
			</th>
			<td>
				<?php wp_editor( '', 'text_0', array( 'tinymce' => false, 'textarea_name' => 'text[]', 'textarea_rows' => '12' ) ); ?>
			</td>
		</tr>
	</table>
</div>
