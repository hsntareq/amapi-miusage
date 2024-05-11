/**
 * This file contains the helper functions that are used throughout the plugin.
 */

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
