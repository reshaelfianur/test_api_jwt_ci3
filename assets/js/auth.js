auth = {
	init() {
		this._imageSlide()
		this._loginForm()
		// this._registerForm()
		this._refreshCaptcha()
		this._showNotification()
	},
	_imageSlide() {
		$.backstretch([
			baseUrl('assets/images/background/img1.jpg'),
			baseUrl('assets/images/background/img2.jpg'),
			baseUrl('assets/images/background/img3.jpg'),
			baseUrl('assets/images/background/img4.jpg'),
			baseUrl('assets/images/background/img5.jpg')
		], {
			fade: 750,
			duration: 4000
		})
	},
	_formValidation(el, rules, submitHandler) {
		$(el).validate({
			errorClass: 'invalid-feedback d-block',
			focusInvalid: true,
			rules: rules,
			highlight: (e) => {
				$(e).addClass('invalid').removeClass('valid')
				$(e).closest('.form-group')
					.find('.invalid-feedback-custom').css('display', 'none')
			},
			unhighlight: (e) => {
				$(e).addClass('valid').removeClass('invalid')
				$(e).closest('.form-group')
					.find('.invalid-feedback-custom').css('display', 'none')
			},
			submitHandler: (form) => {
				submitHandler(form)
			}
		})
	},
	_loginForm() {
		let t = this

		t._formValidation('#login-form', {
				username: {
					required: true
				},
				password: {
					required: true
				},
				captcha: {
					required: true
				}
			},
			(form) => {
				t._submitLoginForm(form)
			}
		)
	},
	_submitLoginForm(form) {
		let lf = $(form)

		lf.find('#btn-submit-login')
			.html('<span class="spinner-grow spinner-grow-lg" role="status" aria-hidden="true"></span> Loading...')
			.attr('disabled', true)


		FUNC._ajaxPost(lf.attr('action'), lf.serialize()).done((res) => {

			if (res.success) {
				FUNC._toastr(res.message)
				localStorage.setItem('Token', res.token)

				setTimeout(() => {
					location.assign(baseUrl('dashboard'))
				}, 900)
			} else {
				FUNC._clearForm(lf)
				FUNC._formValidationCustom(res.element, res.message, res.success)

				$('#captchaImage').html(res.captcha);

				lf.find('#btn-submit-login')
					.html('Sign In')
					.attr('disabled', false)
			}
		})
	},
	_refreshCaptcha() {
		$('.loadCaptcha').on('click', function () {
			$.get(baseUrl('auth/captcha_refresh'), function (data) {
				$('#captchaImage').html(data);
			});
		});
	},
	_showNotification() {
		let flashType = $('body').data('flash-type')

		if (flashType != '') {
			FUNC._toastr($('body').data('flash-message'), flashType)
		}
	},
}

$(auth.init())