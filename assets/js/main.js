main = {

	init: function () {
		alertify.defaults.transition = "slide";
		alertify.defaults.theme.ok = "btn btn-outline-danger";
		alertify.defaults.theme.cancel = "btn btn-outline-light";

		this._logout();
		this._ajaxAnimation();
		this._showNotification();
		// this._fixedSidebar();
	},
	_logout: function () {
		$('.logout-route').on('click', function (e) {
			e.preventDefault();
			let url = this.href
			alertify.confirm('Do you really want to logout?', function () {
				localStorage.clear();
				document.location.assign(url);
			});
		});
	},
	_ajaxAnimation: function () {
		$(document).on({
			ajaxStart: function () { $('.preloader').fadeIn(200); },
			ajaxStop: function () { $('.preloader').fadeOut(200); }
		});
	},
	_showNotification: function () {
		let flashType = $('body').data('flash-type');
		if (flashType != '') {
			FUNC._toastr($('body').data('flash-message'), flashType)
		}
	},
	_fixedSidebar: function () {
		$('body').addClass('fixed-layout');
		$('#sidebar-collapse').slimScroll({
			height: '100%',
			railOpacity: '0.9'
		});
	}

};

$(main.init());