/**
 * Global JS
 */
document.addEventListener('click', function (e) {
	if (e.target.classList.contains('close') || e.target.classList.contains('notice-dismiss')) {
		e.target.parentElement.remove();
	}
});
