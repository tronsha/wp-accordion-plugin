<?php
$id = (int) $_GET['edit'];
if ( $id === 0 ) {
	$id = 1 + (int) $accordions[0]['index'];
	$update_index = true;
}
if ( isset( $_POST['submit'] ) === true ) {
	$count = count( $accordions[ $id ]['data'] );
	if ( isset( $_POST['index'] ) === true ) {
		$accordions[0]['index'] = $_POST['index'];
	}
	$data = [ ];
	for ( $i = 0; $i < $count; $i ++ ) {
		$data[ $i ]['headline'] = $_POST['headline'][ $i ];
		$data[ $i ]['text']     = $_POST['text'][ $i ];
	}
	if (strlen($_POST['headline'][-1]) > 0 ||  strlen($_POST['text'][-1]) > 0) {
		$data[ $i ]['headline'] = $_POST['headline'][-1];
		$data[ $i ]['text']     = $_POST['text'][-1];
	}
	$accordions[ $id ]['data'] = $data;
	$accordions[ $id ]['title'] = $_POST['title'];
	update_option( 'mpcx_accordion', json_encode( $accordions ) );
}
$count = count( $accordions[ $id ]['data'] );
?>
<div class="wrap">
	<h1>
		Accordion
	</h1>
	<form method="post" action="admin.php?page=accordion&amp;edit=<?php echo $id; ?>">
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
					<td style="width: 100px; vertical-align: top; font-weight: bold;">
						<h2><?php echo $i; ?>.)
						<?php if ( $count >= 2 ) : ?>
							<?php if ( $i !== $count ) : ?>
								<span class="dashicons dashicons-arrow-down"></span>
							<?php endif; ?>
							<?php if ( $i !== 1 ) : ?>
								<span class="dashicons dashicons-arrow-up"></span>
							<?php endif; ?>
						<?php endif; ?>
						</h2>
					</td>
					<td>
						<h3><?php _e( 'Headline', 'mpcx-accordion' ); ?></h3>
						<input type="text" id="headline_<?php echo $key; ?>" name="headline[<?php echo $key; ?>]" value="<?php echo esc_attr( $data['headline'] ); ?>" style="width: 100%;"/>
						<h3><?php _e( 'Text', 'mpcx-accordion' ); ?></h3>
						<textarea id="text_<?php echo $key; ?>" name="text[<?php echo $key; ?>]" rows="10" style="width: 100%;"><?php echo esc_textarea( $data['text'] ); ?></textarea>
					</td>
				</tr>
				<?php $i ++; ?>
			<?php endforeach; ?>
			<?php if ( $count === 0 || isset($_GET['add']) ) : ?>
				<tr>
					<td style="width: 100px; vertical-align: top; font-weight: bold;">
						<?php _e( 'New', 'mpcx-accordion' ); ?>:
					</td>
					<td>
						<h3><?php _e( 'Headline', 'mpcx-accordion' ); ?></h3>
						<input type="text" id="headline_new" name="headline[-1]" value="" style="width: 100%;"/>
						<h3><?php _e( 'Text', 'mpcx-accordion' ); ?></h3>
						<textarea id="text_new" name="text[-1]" rows="10" style="width: 100%;"></textarea>
					</td>
				</tr>
			<?php endif; ?>
		</table>
		<input type="hidden" name="count" value="<?php echo $count; ?>">
		<?php if ( $update_index ): ?>
			<input type="hidden" name="index" value="<?php echo $id; ?>">
		<?php endif; ?>
		<?php submit_button(); ?>
	</form>
</div>
