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
}

$count = count( $accordions[ $id ]['data'] );

?>
<div class="wrap accordion">
	<h1>
		Accordion
	</h1>
	<form method="post" action="<?php echo admin_url( 'admin.php?page=accordion&amp;edit=' . $id ); ?>">
		<?php submit_button(); ?>
		<div id="titlediv">
			<div id="titlewrap">
				<label class="screen-reader-text" id="title-prompt-text" for="title"><?php _e( 'Title', 'mpcx-accordion' ); ?></label>
				<input type="text" name="title" size="30" value="<?php echo esc_attr( $accordions[ $id ]['title'] ? $accordions[ $id ]['title'] : 'Accordion ' . $id ); ?>" id="title" spellcheck="true" autocomplete="off">
			</div>
		</div>
		<table class="form-table">
			<?php $i = 1; ?>
			<?php foreach ( $accordions[ $id ]['data'] as $key => $data ): ?>
				<tr>
					<td>
						<h2>
							<?php echo $i; ?>.)
							<?php if ( $count >= 2 ) : ?>
								<?php if ( $i !== 1 ) : ?>
									<span class="dashicons dashicons-arrow-up pointer" data-move="up" data-position="<?php echo $key; ?>"></span>
								<?php endif; ?>
								<?php if ( $i !== $count ) : ?>
									<span class="dashicons dashicons-arrow-down pointer" data-move="down" data-position="<?php echo $key; ?>"></span>
								<?php endif; ?>
							<?php endif; ?>
						</h2>
					</td>
					<td>
						<h3><?php _e( 'Headline', 'mpcx-accordion' ); ?></h3>
						<input type="text" name="headline[]" data-type="headline" data-position="<?php echo $key; ?>" value="<?php echo esc_attr( $data['headline'] ); ?>"/>
						<h3><?php _e( 'Text', 'mpcx-accordion' ); ?></h3>
						<textarea name="text[]" rows="10" data-type="text" data-position="<?php echo $key; ?>"><?php echo esc_textarea( $data['text'] ); ?></textarea>
					</td>
				</tr>
				<?php $i ++; ?>
			<?php endforeach; ?>
			<?php if ( $count === 0 ) : ?>
				<tr>
					<td>
						<h2>
							<?php _e( 'New', 'mpcx-accordion' ); ?>:
						</h2>
					</td>
					<td>
						<h3><?php _e( 'Headline', 'mpcx-accordion' ); ?></h3>
						<input type="text" name="headline[]" value=""/>
						<h3><?php _e( 'Text', 'mpcx-accordion' ); ?></h3>
						<textarea name="text[]" rows="10"></textarea>
					</td>
				</tr>
			<?php endif; ?>
		</table>
		<?php if ( $update_index ): ?>
			<input type="hidden" name="index" value="<?php echo $id; ?>">
		<?php endif; ?>
		<?php submit_button(); ?>
	</form>
</div>
