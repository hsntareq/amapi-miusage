import { registerBlockType } from '@wordpress/blocks';
import Edit from './block/edit';

import './block.scss';

registerBlockType('am-miusage/datatable', {
	title: 'AM API Block', // Block title displayed in the editor
	icon: 'smiley', // Dashicon icon for the block
	category: 'common', // Category in which the block will be displayed

	attributes: {
		title: {
			type: 'string', // Attribute type
			default: 'Hello Gutenberg!' // Default value
		}
	},
	edit: Edit,
	save: () => null,
});
