<?php
/**
 * Render the block.
 *
 * @param array $attributes Block attributes.
 * @return string
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @package wordpress-plugin
 */

$api_data = get_option( 'amapi_miusage_data' );

$table_title = $api_data['title'];
$table_data  = $api_data['data']['rows'];
?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<?php if ( $attributes['blockTitle'] ) : ?>
		<h3 class="amapi-table-title"><?php echo esc_attr( $table_title ); ?></h3>
	<?php endif; ?>

	<table>
		<thead>
			<tr>
				<?php if ( $attributes['showIdColumn'] ) : ?>
					<th><?php esc_attr_e( 'ID', 'am-miusage' ); ?></th>
				<?php endif; ?>
				<?php if ( $attributes['showFirstNameColumn'] ) : ?>
					<th><?php esc_attr_e( 'First Name', 'am-miusage' ); ?></th>
				<?php endif; ?>
				<?php if ( $attributes['showLastNameColumn'] ) : ?>
					<th><?php esc_attr_e( 'Last Name', 'am-miusage' ); ?></th>
				<?php endif; ?>
				<?php if ( $attributes['showEmailColumn'] ) : ?>
					<th><?php esc_attr_e( 'Email', 'am-miusage' ); ?></th>
				<?php endif; ?>
				<?php if ( $attributes['showDateColumn'] ) : ?>
					<th><?php esc_attr_e( 'Date', 'am-miusage' ); ?></th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $api_data['data']['rows'] as $row ) : ?>
				<tr>
					<?php if ( $attributes['showIdColumn'] ) : ?>
						<td><?php echo esc_attr( $row['id'] ); ?></td>
					<?php endif; ?>
					<?php if ( $attributes['showFirstNameColumn'] ) : ?>
						<td><?php echo esc_attr( $row['fname'] ); ?></td>
					<?php endif; ?>
					<?php if ( $attributes['showLastNameColumn'] ) : ?>
						<td><?php echo esc_attr( $row['lname'] ); ?></td>
					<?php endif; ?>
					<?php if ( $attributes['showEmailColumn'] ) : ?>
						<td><?php echo esc_attr( $row['email'] ); ?></td>
					<?php endif; ?>
					<?php if ( $attributes['showDateColumn'] ) : ?>
						<td><?php echo esc_attr( $row['date'] ); ?></td>
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
