<?php
/**
 * WPDB CRUD layout.
 *
 * @package wordpress-plugin
 */

?>
<div class="wrap am-miusage-wrap">
	<div class="ec-row">
		<div class="left">
			<h1 class="wp-heading-inline"><?php esc_attr_e( 'AM Miusage', 'am-miusage' ); ?></h1>
			<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=event' ) ); ?>" class="page-title-action">
				<?php esc_attr_e( 'Add New Event', 'am-miusage' ); ?>
			</a>
		</div>
		<div class="right ec-row">
			<button class="button button-secondary ec-prev"
				id="previous-button"><?php esc_attr_e( 'Prev', 'am-miusage' ); ?></button>
			<h2 id="calendar-heading">
				<?php echo esc_attr( wp_date( 'M' ) . ', ' . wp_date( 'Y' ) ); ?>
			</h2>
			<button class="button button-secondary ec-next"
				id="next-button"><?php esc_attr_e( 'Next', 'am-miusage' ); ?></button>
		</div>
	</div>
	<hr class="wp-header-end">
	<div class="am-miusage-body">
		<table>
			<thead>
				<tr>
					<th><?php esc_attr_e( 'Sun', 'am-miusage' ); ?></th>
					<th><?php esc_attr_e( 'Mon', 'am-miusage' ); ?></th>
					<th><?php esc_attr_e( 'Tue', 'am-miusage' ); ?></th>
					<th><?php esc_attr_e( 'Wed', 'am-miusage' ); ?></th>
					<th><?php esc_attr_e( 'Thu', 'am-miusage' ); ?></th>
					<th><?php esc_attr_e( 'Fri', 'am-miusage' ); ?></th>
					<th><?php esc_attr_e( 'Sat', 'am-miusage' ); ?></th>
				</tr>
			</thead>
			<!-- $this->generate_monthly_calendar( wp_date( 'Y' ), wp_date( 'm' ) ); -->
			<tbody id="calendar-body"></tbody>
		</table>
	</div>
</div>
