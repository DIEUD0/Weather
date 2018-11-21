var Theme = {
	/**
	 * init Method,
	 * check if localStorage.theme exist or not
	 */
	init: function () {
		if (localStorage.theme) {
			this.toggleTheme();
		}
		this.event();
	},

	/**
	 * event Method
	 * Handle the button click and add/delete the localStorage.item
	 */
	event: function () {
		$('#toggle').click(function () {
			if (!localStorage.theme) {
				this.toggleTheme();
				localStorage.theme = 'dark';
			} else {
				this.toggleTheme();
				localStorage.removeItem('theme');
			}
			return false;
		}.bind(this))
	},

	/**
	 * Method to toggle the theme-dark CSS class
	 */
	toggleTheme: function () {
		$(document.body).toggleClass('theme-dark');
	}
};
