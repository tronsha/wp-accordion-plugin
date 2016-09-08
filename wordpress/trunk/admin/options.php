<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$accordions = json_decode( get_option( 'mpcx_accordion' ), true );

?>

<?php if ( isset( $_GET['id'] ) === true ) : ?>

	<div class="wrap">
		<h1>Accordion</h1>
		<form method="post" action="admin.php?page=accordion&amp;id=<?php echo $_GET['id']; ?>">
			<?php submit_button(); ?>
			<?php
			$count = count( $accordions[ $_GET['id'] ]['data'] );
			if ( isset( $_POST['submit'] ) === true ) {
				$data = [ ];
				for ( $i = 0; $i < $count; $i ++ ) {
					$data[ $i ]['headline'] = $_POST['headline'][ $i ];
					$data[ $i ]['text']     = $_POST['text'][ $i ];
				}
				$accordions[ $_GET['id'] ]['data'] = $data;
				update_option( 'mpcx_accordion', json_encode( $accordions ) );
			}
			$i = 1;
			?>
			<table class="form-table">
				<?php $i = 1; ?>
				<?php foreach ( $accordions[ $_GET['id'] ]['data'] as $key => $data ): ?>
					<tr>
						<td style="vertical-align: top; font-weight: bold;">
							<h2><?php echo $i; ?>.)</h2>
						</td>
						<td>
							<h3>Headline</h3>
							<input type="text" id="headline_<?php echo $key; ?>" name="headline[<?php echo $key; ?>]" value="<?php echo esc_attr( $data['headline'] ); ?>" style="width: 100%;"/>
							<h3>Text</h3>
							<textarea id="text_<?php echo $key; ?>" name="text[<?php echo $key; ?>]" rows="10" style="width: 100%;"><?php echo esc_textarea( $data['text'] ); ?></textarea>
						</td>
					</tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			</table>
			<input type="hidden" name="count" value="<?php echo $count; ?>">
			<?php submit_button(); ?>
		</form>
	</div>

<?php elseif ( isset( $_GET['delete'] ) === true ) : ?>


<?php else: ?>

	<div class="wrap">
		<h1>Accordion</h1>
		<table class="wp-list-table widefat fixed striped posts">
			<thead>
			<tr>
				<th>
					<strong>Title</strong>
				</th>
				<th>
					<strong>Shortcode</strong>
				</th>
				<th style="width: 60px;">

				</th>
			</tr>
			</thead>
			<tbody id="the-list" data-wp-lists="list:post">
			<?php foreach ( $accordions as $key => $accordion ): ?>
				<?php if ( $key === 0 ) {
					continue;
				} ?>
				<tr>
					<td>
						<strong>
							<a href="admin.php?page=accordion&amp;id=<?php echo $key; ?>"><?php echo $accordion['title']; ?></a>
						</strong>
					</td>
					<td>
						[accordion id="<?php echo $key; ?>" /]
					</td>
					<td>
						<a href="admin.php?page=accordion&amp;id=<?php echo $key; ?>"><span class="dashicons dashicons-edit"></span></a>
						&#160;
						<a href="admin.php?page=accordion&amp;delete=<?php echo $key; ?>"><span class="dashicons dashicons-trash"></span></a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

<?php endif; ?>
