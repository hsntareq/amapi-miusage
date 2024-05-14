
document.addEventListener('click', (e) => {
	if (e.target.classList.contains('close')) {
		e.target.parentElement.remove();
	}
});
