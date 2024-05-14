<?php
/**
 * Template for AM Miusage plugin page table
 *
 * @package Miusage
 * @since   1.0.0
 */

$transient_timestamp = get_transient( 'timeout_amapi_data_loaded' );
$available_time      = ( false === $transient_timestamp ) ? 'false' : 'true';
$transient_timestamp = ( $transient_timestamp - time() ) < 0 ? 0 : $transient_timestamp;

?>
<div class="amapi-admin-page" id="amapi-admin-page">
	<div id="amapi-page-header" style="display:flex;align-items:center;justify-content:space-between">
		<h1><?php echo esc_attr( get_admin_page_title() ); ?></h1>
	</div>

	<div class="wrap" id="wp-mail-smtp">
		<div style="display: flex;align-items:center;justify-content:space-between">
			<div class="amapi-page-title"
				style="width:100%;display:flex;align-items:center;justify-content:space-between;">
				<div>
				<?php esc_attr_e( 'API Data Retrieval from ', 'am-miusage' ); ?> <a href="<?php echo esc_url( 'https://miusage.com/v1/challenge/1/' ); ?>" target="_blank" class="tab-nav"> <?php esc_attr_e( 'miusage.com', 'am-miusage' ); ?> </a>
				</div>
				<div id="refresh_button_parent" style="display:flex;align-items:center;gap:10px;">
					<div id="inline_notice" data-amapi="<?php echo esc_attr( $available_time ); ?>"
						data-transient-time="<?php echo esc_attr( $transient_timestamp ?? 0 ); ?>"></div>
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

		$transient_timeout    = 'amapi_timeout_by';
		$is_ajax_allowed      = (bool) get_transient( $transient_timeout );
		$miusage_data_timeout = get_option( '_transient_timeout_' . $transient_timeout );
		$miusage_option_data  = get_option( 'amapi_miusage_data' );

		$table_title = $miusage_option_data['title'];
		$table_time  = get_option( 'amapi_miusage_date' );
		$headers     = $miusage_option_data['data']['headers'];
		$rows        = $miusage_option_data['data']['rows'];

		if ( ! empty( $miusage_option_data ) ) {
			?>
			<div id="amapi-page-content">
				<div class="amapi-table-info">
					<h3><?php echo esc_html( $table_title ); ?></h3>
					<span>Data added at: <?php echo esc_html( $table_time ); ?></span>
				</div>
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
		} else {
			?>
			<div id="amapi-page-content" ajax_call></div>
			<?php
		}
		?>
	</div>
	<div id="amapi-toast-wrap"></div>
</div>
