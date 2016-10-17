<?php
$post_type_object = get_post_type_object( 'page' );
?>
<div class="wrap">
	<h1>
		Accordion
		<a href="#" class="page-title-action"><?php echo esc_html( $post_type_object->labels->add_new ); ?></a>
	</h1>
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
						<a href="admin.php?page=accordion&amp;edit=<?php echo $key; ?>"><?php echo $accordion['title']; ?></a>
					</strong>
				</td>
				<td>
					[accordion id="<?php echo $key; ?>" /]
				</td>
				<td>
					<a href="admin.php?page=accordion&amp;edit=<?php echo $key; ?>">
						<span class="dashicons dashicons-edit"></span>
					</a>
					&#160;
					<a href="admin.php?page=accordion&amp;delete=<?php echo $key; ?>">
						<span class="dashicons dashicons-trash"></span>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
