/**
 * This file contains the helper functions that are used throughout the plugin.
 */



/**
 * Function to display an inline message on the screen.
 *
 * @param string type
 * @param string message
 * @param int duration
 *
 * @return void
 */
export function inline_message(type = 'success', message = 'Success', duration = 0) {

	const inlineNoticeWrap = document.getElementById('inline_notice');
	inlineNoticeWrap.innerHTML = '';
	inlineNoticeWrap.insertAdjacentHTML(
		'beforeend',
		`<div class="amapi-toast amapi-toast-${type}"><span class="close">&times;</span> <span>${message}</span></div>`
	);

	if (duration > 0) {
		setTimeout(() => {
			inlineNoticeWrap.innerHTML = '';
			ajaxLoader.style.display = 'none';
		}, duration);
	}
}


/**
 * Function to make an AJAX request to the server.
 */
export const ajax_request = async (action, data = null, method = "POST") => {
	// Add nonce to the data object
	const body = new FormData();
	body.append('action', action);
	body.append('nonce', amapi_data.nonce);
	body.append('data', JSON.stringify(data));

	const response = await fetch(amapi_data.ajaxurl, { method, body });

	if (!response.ok) {
		throw new Error('Network response was not ok');
	}

	return response.json();
}

/**
 * Function to get the name of the month from the month number.
 */
export const getMonthName = (monthNumber) => {
	// Array of month names
	var monthNames = [
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	];

	// Ensure the monthNumber is within valid range
	if (monthNumber < 1 || monthNumber > 12) {
		return "Invalid Month";
	}

	// Retrieve the month name corresponding to the monthNumber
	return monthNames[monthNumber - 1];
}




export function toast_message(type = 'success', message = 'Success', duration = 1000) {

	const toast_wrap = document.getElementById('amapi-toast-wrap');

	toast_wrap.insertAdjacentHTML(
		'beforeend',
		`<div class="amapi-toast amapi-toast-${type}"><span class="close">&times;</span> <span>${message}</span></div>`
	);

	setInterval(() => {
		const toast = toast_wrap.firstElementChild;
		setTimeout(() => {
			toast && toast.remove();
		}, duration);
	}, duration);

}


export function loading_image(element) {
	element.innerHTML = '';
	const loading = document.createElement('img');
	loading.src = amapi_data.loading_inline;
	loading.alt = 'Loading...';
	element.appendChild(loading);
}
