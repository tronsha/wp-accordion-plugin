<?php
/**
 * @link    https://github.com/tronsha/wp-accordion-plugin
 * @since   1.2.0
 * @package wp-accordion-plugin
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$accordions = json_decode( get_option( 'mpcx-accordion' ), true );

?>

<?php if ( isset( $_GET['id'] ) === false ) : ?>

	<div class="wrap">
		<h1>Accordion</h1>
		<table class="wp-list-table widefat fixed striped posts">
			<tbody id="the-list" data-wp-lists="list:post">
			<tr>
				<th>
					<strong>Title</strong>
				</th>
				<th>
					<strong>Shortcode</strong>
				</th>
			</tr>
			<?php foreach ( $accordions as $key => $accordion ): ?>
				<tr>
					<td>
						<strong>
							<a href="admin.php?page=accordion&amp;id=<?php echo $key; ?>"><?php echo $accordion['title']; ?></a>
						</strong>
					</td>
					<td>
						[accordion id="<?php echo $key; ?>" /]
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

<?php else: ?>

	<div class="wrap">
		<h1>Accordion</h1>
		<form method="post" action="admin.php?page=accordion&amp;id=<?php echo $_GET['id']; ?>">
			<table class="form-table">
				<?php foreach ( $accordions[ $_GET['id'] ]['data'] as $key => $data ): ?>
					<tr>
						<th>Headline</th>
						<td>
							<input type="text" id="headline_<?php echo $key; ?>" name="headline_<?php echo $key; ?>" value="<?php echo htmlentities( $data['headline'] ); ?>" style="width: 100%;"/>
						</td>
					</tr>
					<tr>
						<th>Text</th>
						<td>
							<textarea id="text_<?php echo $key; ?>" name="text_<?php echo $key; ?>" rows="10" style="width: 100%;"><?php echo htmlentities( $data['text'] ); ?></textarea>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>

<?php endif; ?>
