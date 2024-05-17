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
	const toast_message = document.getElementById('toast_message');

	toast_message.innerHTML = `<div class="notice notice-${type} notice-alt is-dismissible"><p>${message}</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>`;
	toast_message.style.display = 'block';
	/* toast_wrap.insertAdjacentHTML(
		'beforeend',
		`<div class="amapi-toast amapi-toast-${type}"><span class="close">&times;</span> <span>${message}</span></div>`
	); */

	setTimeout(() => {
		toast_message.innerHTML = '';
	}, duration);

}

// Function to format time to HH:MM:SS format
function formatTime(hours, minutes, seconds) {
	// Add leading zeros if needed
	hours = String(hours).padStart(2, '0');
	minutes = String(minutes).padStart(2, '0');
	seconds = String(seconds).padStart(2, '0');

	return hours + ':' + minutes + ':' + seconds;
}


// Function to start the countdown timer
export function amapi_countdown(timeString) {
	// Parse the time string to extract hours, minutes, and seconds
	let countElement = document.getElementById('inline_notice');

	let [hours, minutes, seconds] = timeString.split(':').map(Number);

	// Calculate total seconds
	let totalSeconds = hours * 3600 + minutes * 60 + seconds;

	// Update countdown every second
	let countdownInterval = setInterval(function () {
		// Calculate remaining hours, minutes, and seconds
		let remainingHours = Math.floor(totalSeconds / 3600);
		let remainingMinutes = Math.floor((totalSeconds % 3600) / 60);
		let remainingSeconds = totalSeconds % 60;

		// Format remaining time
		let formattedTime = formatTime(remainingHours, remainingMinutes, remainingSeconds);

		// Display formatted time
		// console.log(formattedTime);
		countElement.textContent = `Countdown: ${formattedTime}`;

		// Decrease total seconds by 1
		totalSeconds--;

		// Stop countdown when time reaches zero
		if (totalSeconds < 0) {
			clearInterval(countdownInterval);
			countElement.textContent = 'Countdown over! Refresh data with a click here →';
		}
	}, 1000); // Update every second
}


export function loading_image(element) {
	element.innerHTML = '';
	const loading = document.createElement('img');
	loading.src = amapi_data.loading_inline;
	loading.alt = 'Loading...';
	element.appendChild(loading);
}
