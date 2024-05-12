console.log('ajax-action.js');

import { ajax_request } from '../lib';


const amapiRefreshButton = document.getElementById('amapi_refresh_button');
const amapiPageContent = document.getElementById('amapi-page-content');
const ajaxLoader = document.getElementById('ajax_loader');

document.addEventListener('DOMContentLoaded', async () => {
	// Create img element with img src amapi_data.loading and append it to the amapiPageContent

	// loading_image(amapiPageContent);
	if (amapiPageContent) {
		amapiPageContent.hasAttribute('ajax_call') && handleRequestingData(amapiPageContent);

		amapiRefreshButton && amapiRefreshButton.addEventListener('click', async () => {
			ajaxLoader.style.display = 'block';
			console.log(amapiPageContent.hasAttribute('ajax_call'));
			if (amapiPageContent.hasAttribute('ajax_call')) {
				handleRequestingData(amapiPageContent);
				ajaxLoader.style.display = 'none';
			} else {
				inline_message('error', 'You are not allowed to refresh the data', 3000);
			}
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
	ajax_request('amapi_refresh_data', { name: 'John Doe' })
		.then(response => {
			console.log(response);
			return;
		});
}


function ajax_refresh_table_data(amapiContent) {
	loading_image(amapiContent);
	ajax_request('amapi_refresh_data', { name: 'John Doe' })
		.then(response => {
			if (response.success) {
				amapiContent.innerHTML = resposeTableHtml(JSON.parse(response.data));
				amapiPageContent.removeAttribute('ajax_call');
			} else {
				inline_message('error', response.data, 3000);
			}

		});
}

function inline_message(type = 'success', message = 'Success', duration = 1000) {

	const inlineWrap = document.getElementById('viewTime');
	inlineWrap.innerHTML = '';
	inlineWrap.insertAdjacentHTML('beforeend', `<div class="amapi-toast amapi-toast-${type}"><span class="close">&times;</span>${message}</div>`);

	setTimeout(() => {
		inlineWrap.innerHTML = '';
		ajaxLoader.style.display = 'none';
	}, duration);
}


function toast_message(type = 'success', message = 'Success', duration = 1000) {

	const toast_wrap = document.getElementById('amapi-toast-wrap');

	toast_wrap.insertAdjacentHTML('beforeend', `<div class="amapi-toast amapi-toast-${type}"><span class="close">&times;</span>${message}</div>`);

	setInterval(() => {
		const toast = toast_wrap.firstElementChild;
		setTimeout(() => {
			toast && toast.remove();
			ajaxLoader.style.display = 'none';
		}, duration);
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
	console.log(data.data.rows);
	let html = ` <table class="wp-list-table widefat fixed striped table-view-list datas amapi-datatable">
			<caption>${data.title}</caption>
			<thead>
				<tr>
				${data.data.headers.map(header => `<th>${header}</th>`).join('')}
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

function formatUnixTimestamp(timestamp) {
	// Create a new Date object using the timestamp (in milliseconds)
	const date = new Date(timestamp * 1000);

	// Get the individual components of the date
	const year = date.getFullYear();
	const month = String(date.getMonth() + 1).padStart(2, '0'); // Adding 1 because getMonth() returns zero-based index
	const day = String(date.getDate()).padStart(2, '0');
	const hours = String(date.getHours()).padStart(2, '0');
	const minutes = String(date.getMinutes()).padStart(2, '0');

	// Construct the formatted date string
	const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}`;

	return formattedDate;
}
