console.log('ajax-action.js');

import { ajax_request } from '../lib';


document.addEventListener('DOMContentLoaded', async () => {
	const amapiRefreshButton = document.getElementById('amapi_refresh_button');
	const amapiPageContent = document.getElementById('amapi-page-content');
	// Create img element with img src amapi_data.loading and append it to the amapiPageContent

	// loading_image(amapiPageContent);
	handleRequestingData(amapiPageContent);

	amapiRefreshButton && amapiRefreshButton.addEventListener('click', async () => {

		handleRequestingData(amapiPageContent)
	});
});

function handleRequestingData(amapiContent) {
	loading_image(amapiContent);
	ajax_request('amapi_refresh_data', { name: 'John Doe' })
		.then(response => {
			amapiContent.innerHTML = resposeTableHtml(JSON.parse(response.data));
		});
		// rest_ensure_response
}


function loading_image(element) {
	element.innerHTML = '';
	const loading = document.createElement('img');
	loading.src = amapi_data.loading_inline;
	loading.alt = 'Loading...';
	element.appendChild(loading);
}
/*
{
	"title":"This amazing table",
	"data":{
		"headers":["ID","First Name","Last Name","Email","Date"],
		"rows":{
			"1":{"id":21,"fname":"Chris","lname":"Test","email":"chris@test.com","date":1715347630},
			"2":{"id":67,"fname":"Bob","lname":"Test","email":"bob@test.com","date":1715174830},
			"3":{"id":94,"fname":"Bill","lname":"Test","email":"bill@test.com","date":1715088430},
			"4":{"id":67,"fname":"Jack","lname":"Test","email":"jack@test.com","date":1714915630},
			"5":{"id":80,"fname":"Joe","lname":"Test","email":"joe@test.com","date":1714742830}
		}
	}
}
 */
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
						<td>${new Date(row.date * 1000).toLocaleDateString()}</td>
					</tr>`;
	}).join('')}
			</tbody>
		</table>`;

	return html;
}
