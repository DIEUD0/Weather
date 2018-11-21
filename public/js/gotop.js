var Gotop = {
	myId: $('#go-top'),
	offset: 128,
	duration: 256,

	/**
	 * init Method,
	 * check the page top offset to fadeIn/fadeOut the 'Scroll to top' button
	 */
	init: function () {
		$(window).scroll(function () {
			if ($(window).scrollTop() > this.offset) {
				this.myId.fadeIn(this.duration);
			} else {
				this.myId.fadeOut(this.duration);
			}
		}.bind(this));
		this.event();
	},

	/**
	 * event Method,
	 * handle the button click and scroll to top animation
	 */
	event: function () {
		this.myId.click(function () {
			$('html, body').animate({
				scrollTop: 0
			}, this.duration);
			return false;
		}.bind(this))
	}
};
