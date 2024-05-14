/**
 * Block Edit Component
 */

import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

const Edit = ({ attributes, setAttributes }) => {
	const { title } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Data Table Settings')}>
					<TextControl
						label={__('Title')}
						value={title}
						onChange={(value) => setAttributes({ title: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<div className="wp-block-am-miusage-datatable">
				<h2>{title}</h2>
			</div>
		</>
	);
}

export default Edit;
