<?php
/**
 * Template for AM Miusage plugin page table
 *
 * @package Miusage
 * @since   1.0.0
 */

?>
<div class="amapi-admin-page" id="amapi-admin-page">
	<div id="amapi-page-header" style="display:flex;align-items:center;justify-content:space-between">
		<h1><?php echo esc_attr( get_admin_page_title() ); ?></h1>
		<div id="toast_message" style="display:none">
			<div class="notice is-dismissible"></div>
		</div>
	</div>
	<div class="wrap" id="wp-mail-smtp">
		<div style="display: flex;align-items:center;justify-content:space-between">
			<div class="amapi-page-title"
				style="width:100%;display:flex;align-items:center;justify-content:space-between;">
				<div>
				<?php esc_attr_e( 'API Data Retrieval from ', 'am-miusage' ); ?> <a href="<?php echo esc_url( 'https://miusage.com/v1/challenge/1/' ); ?>" target="_blank" class="tab-nav"> <?php echo esc_attr( 'miusage.com' ); ?> </a>
				</div>
				<div id="refresh_button_parent" style="display:flex;align-items:center;gap:10px;">
					<div id="inline_notice"></div>
					<div style="width:22px;">
						<div id="ajax_loader" style="display:none;">
							<span class="spinner is-active" style="float:none;margin:0"></span>
						</div>
					</div>
					<button class="button button-primary" id="amapi_refresh_button">
						<?php esc_html_e( 'Refresh', 'am-miusage' ); ?>
					</button>
				</div>
			</div>
		</div>
		<?php
		if ( ! empty( $miusage_option_data ) ) {
			?>
			<div id="amapi-page-content">
				<h3 class="amapi-table-title"><?php echo esc_html( $table_title ); ?></h3>
				<table class="wp-list-table widefat fixed striped table-view-list datas amapi-datatable">
					<thead>
						<tr>
							<?php
							if ( ! empty( $headers ) ) {
								foreach ( $headers as $key => $value ) {
									echo '<th>' . esc_html( $value ) . '</th>';
								}
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						if ( ! empty( $rows ) ) {
							foreach ( $rows as $key => $value ) {
								?>
								<tr>
									<td><?php echo esc_html( $value['id'] ); ?></td>
									<td><?php echo esc_html( $value['fname'] ); ?></td>
									<td><?php echo esc_html( $value['lname'] ); ?></td>
									<td><?php echo esc_html( $value['email'] ); ?></td>
									<td><?php echo esc_html( $value['date'] ); ?></td>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
			<?php
		}
		?>
	</div>
</div>
