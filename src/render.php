<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

 $miusage_option_data  = get_option( 'amapi_miusage_data' );
pr( $miusage_option_data );

?>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Amapi Block – hello from a dynamic block!', 'amapi-block' ); ?>
</p>
