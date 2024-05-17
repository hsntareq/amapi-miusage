/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { addQueryArgs } from '@wordpress/url';
import { useEffect, useState } from '@wordpress/element';
import { PanelBody, ToggleControl, Button } from '@wordpress/components';
import { ajax_request } from './assets-src/js/lib';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const [apiData, setApiData] = useState([]);

	const {
		showIdColumn,
		showFirstNameColumn,
		showLastNameColumn,
		showEmailColumn,
		showDateColumn,
	} = attributes;

	const fetchData = async () => {
		try {
			const response = await ajax_request('amapi_retrive_data');
			return response.data.data.rows;
		} catch (error) {
			console.error(error);
			return [];
		}
	};

	const handleToggleChange = (column) => {
		setAttributes({ [column]: !attributes[column] });
	};

	const renderTable = () => {
		return <div>
			{apiData.length !== 0 &&
				<table>
					<thead>
						<tr>
							{showIdColumn && <th>{__('ID', 'amapi')}</th>}
							{showFirstNameColumn && <th>{__('First Name', 'amapi')}</th>}
							{showLastNameColumn && <th>{__('Last Name', 'amapi')}</th>}
							{showEmailColumn && <th>{__('Email', 'amapi')}</th>}
							{showDateColumn && <th>{__('Date', 'amapi')}</th>}
						</tr>
					</thead>
					<tbody>
						{Object.values(apiData).map((dataItem, index) => (
							<tr key={index}>
								{showIdColumn && <td>{dataItem.id}</td>}
								{showFirstNameColumn && <td>{dataItem.fname}</td>}
								{showLastNameColumn && <td>{dataItem.lname}</td>}
								{showEmailColumn && <td>{dataItem.email}</td>}
								{showDateColumn && <td>{dataItem.date}</td>}
							</tr>
						))}
					</tbody>
				</table>
			}
		</div>
	};


	useEffect(async () => {
		// Fetch data from the API
		const data = await fetchData();
		setTimeout(() => {
			setApiData(data);
		}, 2000);
	}, []);

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody title={__('Table Columns', 'amapi')} initialOpen={true}>
					<ToggleControl
						label="ID"
						checked={showIdColumn}
						onChange={() => handleToggleChange('showIdColumn')}
					/>
					<ToggleControl
						label={__('First Name', 'amapi')}
						checked={showFirstNameColumn}
						onChange={() => handleToggleChange('showFirstNameColumn')}
					/>
					<ToggleControl
						label={__('Last Name', 'amapi')}
						checked={showLastNameColumn}
						onChange={() => handleToggleChange('showLastNameColumn')}
					/>
					<ToggleControl
						label={__('Email', 'amapi')}
						checked={showEmailColumn}
						onChange={() => handleToggleChange('showEmailColumn')}
					/>
					<ToggleControl
						label={__('Date', 'amapi')}
						checked={showDateColumn}
						onChange={() => handleToggleChange('showDateColumn')}
					/>
				</PanelBody>
			</InspectorControls>
			<div id="amapi-page-content">
				<h3 className="amapi-table-title">This amazing table</h3>

				{(!apiData || apiData.length === 0) && <div className='loading-image'> <img src={`${amapi_data.loading}`} alt="loading" /> </div>}

				{renderTable()}

			</div>
		</div>
	);
}
