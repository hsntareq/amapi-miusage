console.log('ajax-action.js');

import { ajax_request, toast_message } from '../lib';


const amapiRefreshButton = document.getElementById('amapi_refresh_button');
const amapiPageContent = document.getElementById('amapi-page-content');
const ajaxLoader = document.getElementById('ajax_loader');

document.addEventListener('DOMContentLoaded', async () => {
	// Create img element with img src amapi_data.loading and append it to the amapiPageContent

	// loading_image(amapiPageContent);
	if (amapiPageContent) {
		handleRequestingData(amapiPageContent);
		// amapiPageContent.hasAttribute('ajax_call') && handleRequestingData(amapiPageContent);

		amapiRefreshButton && amapiRefreshButton.addEventListener('click', async () => {
			ajaxLoader.style.display = 'block';
			handleRequestingData(amapiPageContent);


			/* console.log(amapiPageContent.hasAttribute('ajax_call'));
			if (amapiPageContent.hasAttribute('ajax_call')) {
				// handleRequestingData(amapiPageContent);
				ajaxLoader.style.display = 'none';
			} else {
				inline_message('error', 'You are not allowed to refresh the data', 3000);
			} */
		});
	}

	document.addEventListener('click', (e) => {
		if (e.target.classList.contains('close')) {
			e.target.parentElement.remove();
		}
	});

	// Setintval 5 seconds to add ajax_call to the amapiPageContent element.
	setInterval(() => {
		amapiPageContent.setAttribute('ajax_call', 'true');
	}, 5000);

});

function handleRequestingData(amapiContent) {
	let dataLoaded = false;
	ajax_request('amapi_refresh_data', { name: 'John Doe' })
		.then(response => {
			if (!response.success) {
				inline_message('error', response.data.message, 3000);
				dataLoaded = true;
				// return;
			}

			if (response.success && !dataLoaded) {
				amapiContent.innerHTML = resposeTableHtml(response.data);
				handleRequestingData(amapiContent);
			}
			// return;
		});
}


function ajax_refresh_table_data(amapiContent) {
	// loading_image(amapiContent);
	ajax_request('amapi_refresh_data', { name: 'John Doe' })
		.then(response => {
			if (response.success) {
				amapiContent.innerHTML = resposeTableHtml(JSON.parse(response.data));
				return;
				// amapiPageContent.removeAttribute('ajax_call');
			}
			console.log(response.data.message);
			inline_message('error', response.data.message, 3000);
			return;

		});
}

function inline_message(type = 'success', message = 'Success', duration = 1000) {

	const inlineWrap = document.getElementById('viewTime');
	inlineWrap.innerHTML = '';
	inlineWrap.insertAdjacentHTML('beforeend', `<div class="amapi-toast amapi-toast-${type}"><span class="close">&times;</span>${message}</div>`);

	setTimeout(() => {
		inlineWrap.innerHTML = '';
		// ajaxLoader.style.display = 'none';
	}, duration);
}


function loading_image(element) {
	element.innerHTML = '';
	const loading = document.createElement('img');
	loading.src = amapi_data.loading_inline;
	loading.alt = 'Loading...';
	element.appendChild(loading);
}

const resposeTableHtml = (data) => {
	console.log(data.data);
	let html = ` <table class="wp-list-table widefat fixed striped table-view-list datas amapi-datatable">
			<caption>${data.title}</caption>
			<thead>
				<tr>
				${data && data.data.headers.map(header => `<th>${header}</th>`).join('')}
				</tr>
			</thead>
			<tbody>
				${Object.keys(data.data.rows).map(key => {
		const row = data.data.rows[key];
		return `<tr>
						<td>${row.id}</td>
						<td>${row.fname}</td>
						<td>${row.lname}</td>
						<td>${row.email}</td>
						<td>${row.date}</td>
					</tr>`;
	}).join('')}
			</tbody>
		</table>`;

	return html;
}
