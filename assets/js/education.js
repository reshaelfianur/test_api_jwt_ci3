const modCode = 'module_reference'
const sideMenu = $(`#sidebarnav #${modCode}`)

education = {
	__construct() {
		sideMenu.addClass('active')
	},
	index: {
		init() {
			let route = $('body').data('route')
			let pageName = $('body').data('title')
			let rights = JSON.parse($('input[name="rights"]').val())
			let addDefs = []

			if ($.inArray("3", rights) !== -1 || $.inArray("4", rights) !== -1) {
				addDefs = [{
					className: 'text-center',
					targets: [3]
				}]
			}
			FUNC._dataTable('#education-list', `${route}fetch`, 10, addDefs)

			this._create(route, pageName)
			this._update(route, pageName)
			this._delete(pageName)
		},
		_validation(route) {
			let t = this

			FUNC._formValidation('#education-form', {
				education_code: {
					required: true,
					maxlength: 10
				},
				education_desc: {
					required: true,
					maxlength: 50
				}
			}, {},
				(form) => {
					t._submitHandler(form, route)
				}
			)
		},
		_submitHandler(form, route) {
			let t = this

			let args = {
				education_id: $('input[name="education_id"]').val(),
				education_code: $('input[name="education_code"]').val(),
				education_desc: $('input[name="education_desc"]').val()
			}

			FUNC._ajaxPost(`${route}is-duplicate`, FUNC._jsonToQueryString(args)).done(res => {
				if (res.success) {
					FUNC._toastr(res.message, 'warning')
					return false
				} else {
					t._submitForm(form)
				}
			})
		},
		_create(route, pageName) {
			let t = this

			$('.btn-add').on('click', function (e) {
				e.preventDefault()
				let el = $(this)

				FUNC._modal('open', {
					title: `Add ${pageName}`,
					body: {
						url: el.attr('href')
					},
					btnAction: {
						cssClass: 'btn-outline-custom',
						text: 'Save',
						onPress: () => {
							$('#education-form').submit()
						}
					},
					doSomething: () => {
						t._validation(route)
					}
				})
			})
		},
		_update(route, pageName) {
			let t = this

			$('#education-list tbody').on('click', '.update-control', function (e) {
				e.preventDefault()
				let el = $(this)

				FUNC._modal('open', {
					title: `Edit ${pageName}`,
					body: {
						url: el.attr('href')
					},
					btnAction: {
						cssClass: 'btn-outline-custom',
						text: 'Save Changes',
						onPress: () => {
							$('#education-form').submit()
						}
					},
					doSomething: () => {
						t._validation(route)
					}
				})
			})
		},
		_delete(pageName) {
			$('#education-list tbody').on('click', '.delete-control', function (e) {
				e.preventDefault()
				let el = $(this)

				alertify.confirm('Do you really want to delete this record?', () => {
					FUNC._ajaxGet(el.attr('href')).done(res => {
						if (res.success) {
							FUNC._toastr(res.message)
							table.ajax.reload(null, false)
						} else {
							FUNC._toastr(res.message, 'error')
						}
					})
				}).set({
					title: `Delete ${pageName}`
				})
			})
		},
		_submitForm(form) {
			FUNC._ajaxPost($(form).attr('action'), $(form).serialize()).done(res => {
				if (res.success === true) {
					FUNC._toastr(res.message)
					table.ajax.reload(null, false)

					$('#global-modal').modal('hide')
				} else {
					FUNC._toastr(res.message, 'error')
				}
			})
		}
	}

}