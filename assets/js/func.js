var ignitedTable;
var table;

FUNC = {
	_setCurrentRoute(controller, method = 'index') {
		$('#data-current-root')
			.removeData('class')
			.removeData('method')
			.data('class', controller)
			.data('method', method)
	},
	_urlExists(url) {
		var http = new XMLHttpRequest();
		http.open('HEAD', url, false);
		http.send();
		return http.status == 200;
	},
	_getMultiCss(files, callback) {
		let progress = 0
		files.forEach(file => {
			if ($(`link[href*="${file}"]`).length == 0) {
				$.get(file, () => {
					let top = $('#currentCss')
					top.before(`<link rel="stylesheet" type="text/css" href="${file}">`)

					if (++progress == files.length) callback()
				})
			}
		})
	},
	_getCurrentCss(file, callback) {
		if ($(`link[href*="${file}"]`).length == 0) {
			$.get(file, () => {
				$('#currentCss').attr({
					href: file
				})
			})
		}
	},
	_getMultiJs(arr, path) {
		let _arr = $.map(arr, scr => {
			if ($(`script[src*="${path}${scr}"]`).length == 0) {
				let bottom = $('#currentJs')
				bottom.before(`<script src="${path}${scr}"></script>`)

				return $.getScript((path || "") + scr);
			}
		})
		_arr.push($.Deferred(deferred => {
			$(deferred.resolve);
		}))

		return $.when.apply($, _arr);
	},
	_getCurrentJs(arr, path) {
		let _arr = $.map(arr, scr => {
			if ($(`script[src*="${path}${scr}"]`).length == 0) {
				$('#currentJs').attr({
					src: path + scr
				})
				return $.getScript((path || "") + scr);
			}
		})
		_arr.push($.Deferred(deferred => {
			$(deferred.resolve);
		}))

		return $.when.apply($, _arr);
	},
	_confirmDelete(url, letTable = table) {
		Swal.fire({
			title: 'Are you sure?',
			text: 'You will not be able to recover this record!',
			type: 'warning',
			confirmButtonColor: '#DD6B55',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, keep it'
		}).then((result) => {
			if (result.value) {
				this._ajaxGet(url).done(res => {
					if (res.success) {
						Swal.fire({
							title: 'Deleted!',
							text: res.message,
							type: 'success',
							timer: 2000,
							showConfirmButton: false
						})
						letTable.ajax.reload(null, false)
					} else {
						Swal.fire("Cancelled!", res.message, "error")
					}
				})
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				Swal.fire({
					title: 'Cancelled',
					text: 'this record is safe :)',
					type: 'error',
					timer: 2000,
					showConfirmButton: false
				})
			}
		})
	},
	_ajaxGet(toUrl, toData) {
		let finalUrl = (!/^(f|ht)tps?:\/\//i.test(toUrl) ? (baseUrl() + toUrl) : toUrl);
		return $.ajax({
			type: 'GET',
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'R32h@71Nd4',
				'Content-Type': 'application/json'
			},
			url: finalUrl,
			data: toData,
		});
	},
	_ajaxPost(toUrl, toData) {
		let finalUrl = (!/^(f|ht)tps?:\/\//i.test(toUrl) ? (baseUrl() + toUrl) : toUrl);
		return $.ajax({
			type: 'post',
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'R32h@71Nd4',
			},
			url: finalUrl,
			dataType: 'json',
			data: toData,
		});
	},
	_ajaxPostFile(toUrl, toData) {
		let finalUrl = (!/^(f|ht)tps?:\/\//i.test(toUrl) ? (baseUrl() + toUrl) : toUrl);
		return $.ajax({
			url: finalUrl,
			type: 'post',
			data: toData,
			success(msg) {
				console.log(msg)
			},
			cache: false,
			contentType: false,
			processData: false
		});
	},
	_formValidation(el, rules, message, submitHandler, unhighlight = true) {
		$(el).validate({
			errorElement: 'span',
			errorClass: 'invalid-feedback d-block',
			focusInvalid: true,
			rules: rules,
			message: message,
			highlight: (e) => {
				if ($(e).is('select')) {
					$(e).closest('.bootstrap-select').addClass('is-invalid').removeClass('is-valid')
				}
				$(e).addClass('is-invalid').removeClass('is-valid')
				$(e).closest('.form-group').addClass('invalid').removeClass('valid')
			},
			unhighlight: (e) => {
				$(e).removeClass('is-invalid').closest('.form-group').removeClass('invalid')

				if ($(e).is('select')) {
					$(e).closest('.bootstrap-select').removeClass('is-invalid')
				}
				if (unhighlight) {
					if ($(e).is('select')) {
						$(e).closest('.bootstrap-select').addClass('is-valid')
					}
					$(e).addClass('is-valid').closest('.form-group').addClass('valid')
				}
			},
			errorPlacement: function (error, element) {
				if (element.hasClass('date-picker')) {
					element.closest('.input-group').append(error)
				} else if (element.is('select')) {
					element.closest('.bootstrap-select').append(error)
				} else if (element.is('input[type=radio]')) {
					element.closest('div').append(error)
				} else {
					error.insertAfter(element)
				}
			},
			submitHandler: (form) => {
				submitHandler(form)
			}
		})
	},
	_modal(type, args, modalType) {
		let e = modalType == 'child' ? 'global-child-modal' : 'global-modal';
		let el = $(`#${e}`);

		if (type == 'close') {
			el.modal('hide')
		} else {
			this._ajaxGet(args.body.url, args.body.params).done(res => {
				el.find('.modal-title').html(args.title)
				el.find('.modal-body').html(res)

				el.find('.btn-action')
					.removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-light btn-dark btn-megna')
					.addClass(args.btnAction.cssClass)
					.html(args.btnAction.text)

				if (typeof args.btnAction.onPress !== 'undefined') {
					el.find('.btn-action').off().on('click', () => {
						args.btnAction.onPress()
					})
				}

				if (typeof args.doSomething !== 'undefined') {
					args.doSomething()
				}

				el.modal('show')
			})
		}
	},
	_dateColumnOrder() {
		jQuery.extend(jQuery.fn.dataTableExt.oSort, {
			"date-uk-pre": (a) => {
				if (a == null || a == "") {
					return 0;
				}
				let ukDatea = a.split('/');
				return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
			},

			"date-uk-asc": (a, b) => {
				return ((a < b) ? -1 : ((a > b) ? 1 : 0));
			},

			"date-uk-desc": (a, b) => {
				return ((a < b) ? 1 : ((a > b) ? -1 : 0));
			}
		});
	},
	_dataTable(el, url = null, perPage = 10, addDefs = 0, isDateOrder = false, keySearch = '.key-search') {
		if (isDateOrder) {
			this._dateColumnOrder()
		}

		let defaultDefs = [{
			targets: 'no-sort',
			orderable: false
		}]
		let finalDefs = typeof addDefs == 'object' ? defaultDefs.concat(addDefs) : defaultDefs;

		let ajaxUrl = {
			ajax: {
				url: baseUrl(url),
				type: 'post',
				headers: {
					'Authorization': localStorage.getItem("Token"),
					'X_CSRF_TOKEN': 'R32h@71Nd4',
					'Content-Type': 'application/json'
				}
			}
		}

		let args = {
			lengthChange: true,
			aaSorting: [],
			pageLength: perPage,
			fixedHeader: true,
			responsive: true,
			sDom: 'rtip',
			columnDefs: finalDefs,
			order: []
		}
		let finalArgs = typeof url == 'string' ? Object.assign(args, ajaxUrl) : args;

		table = $(el).DataTable(finalArgs);

		// $('#global-modal').on('shown.bs.modal', function () {
		// 	table.columns.adjust();
		// })

		$(keySearch).each(function () {
			$(this).on('keyup', function () {
				table.search(this.value).draw()
			})
		})

		$(el).closest('.table-responsive').prevAll('.d-inline-block').find('select')
			.val(table.page.len())
			.on('change', function () {
				table.page.len(this.value).draw()
			})
	},
	_dataTableServerSide(id, url, columnsParam, columnDefsParam, params, rowCreated = null) {
		let table = $(id).DataTable({
			processing: true,
			serverSide: true,
			aaSorting: [],
			order: [
				[0, 'asc']
			],
			pageLength: 10,
			sDom: 'rtip',
			stateSave: true,
			stateDuration: -1,
			stateLoadParams: (settings, data) => {
				$('.key-search').val(data.search.search)
				$('#length-change').val(data.length).selectpicker('refresh')
			},
			ajax: {
				url: baseUrl(url),
				data: {
					param: params
				},
				type: 'post',
				headers: {
					'Authorization': localStorage.getItem("Token"),
					'X_CSRF_TOKEN': 'R32h@71Nd4',
				},
				error: (err) => {
					console.log(err)
				}
			},
			columns: columnsParam,
			columnDefs: columnDefsParam,
			createdRow: (tr, row, dataIndex) => {
				if (rowCreated != null) {
					rowCreated(id, tr, row, dataIndex)
				}
			},

		})
		let typingTimer
		let doneTypingInterval = 500

		$('.key-search').each(function () {
			$(this).off().on('keyup', function () {
				let val = this.value
				clearTimeout(typingTimer)

				typingTimer = setTimeout(
					() => {
						table.search(val).draw()
					},
					doneTypingInterval
				)
			})
		})

		$(id).closest('.table-responsive').prevAll().eq(1).find('select').on('change', function () {
			table.page.len(this.value).draw()
		})
	},
	_jsonToQueryString(obj) {
		let str = []
		for (let p in obj) {
			if (obj.hasOwnProperty(p)) {
				str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]))
			}
		}

		return str.join("&");
	},
	_clearDate() {
		$('.clear-date').on('click', function () {
			$(this).closest('.input-group').find('input').val('')
		})
	},
	_clearForm(formId) {
		formId.find('.form-control').val('')
	},
	_datePicker() {
		$('.date-picker').each(function () {
			$(this).datepicker({
				format: 'd MM yyyy',
				todayBtn: 'linked',
				keyboardNavigation: false,
				forceParse: false,
				calendarWeeks: true,
				autoclose: true
			}).on('changeDate', function (e) {
				$(this).parent('.input-group').find('input[type="hidden"]').val(e.format('yyyy-mm-dd'))
			}).on('blur', function (e) {
				if ($(this).val() == '') {
					$(this).parent('.input-group').find('input[type="hidden"]').val('')
				}
			})
		})
	},
	_customFile() {
		$('input[type="file"]').change((e) => {
			let fileName = e.target.files[0].name
			$('.custom-file-label').html(fileName)
		});
	},
	_numberFormat(strNumber, prefix = '') {
		let resultNumber = '';
		let strNumberRev = strNumber.toString().split('').reverse().join('')

		for (let i = 0; i < strNumberRev.length; i++)
			if (i % 3 == 0) resultNumber += strNumberRev.substr(i, 3) + '.';
		return prefix + resultNumber.split('', resultNumber.length - 1).reverse().join('');
	},
	_numbFormat(numb, decimal = 2) {
		return parseFloat(numb.replace('.', null)).toFixed(decimal).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,");
	},
	_formValidationCustom(el, message, success = true, delay = false, header = false) {
		if (header)
			this._notif(message, success, delay)

		if (!success) {
			$(`#${el}`).closest('.form-group').removeClass('is-invalid').removeClass('is-valid').addClass('is-invalid')
			$(`#${el}`).addClass('invalid')
		}

		if (!header && $(`#${el}`).closest('.form-group').find('.invalid-feedback-custom').length == 0)
			$(`#${el}`).after('<div class="invalid-feedback-custom">' + message + '</div>')
		else if (!header)
			$(`#${el}`).closest('.form-group')
				.find('.invalid-feedback-custom').css('display', 'block')
	},
	_notif(message, success, delay = true) {
		if (success) {
			$("#message").html('<div class="alert alert-success alert-rounded" role="alert">' +
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
				'<strong> <span class="fas fa-check-circle"></span> </strong>' + message +
				'</div>')

			if (delay) {
				$(".alert-success").delay(500).show(10, function () {
					$(this).delay(7000).hide(10, function () {
						$(this).remove()
					})
				})
			}
		} else {
			$("#message").html('<div class="alert alert-danger alert-rounded" role="alert">' +
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
				'<strong> <span class="fas fa-check-circle"></span> </strong>' + message +
				'</div>')

			if (delay) {
				$(".alert-danger").delay(500).show(10, function () {
					$(this).delay(7000).hide(10, function () {
						$(this).remove()
					})
				})
			}
		}
	},
	_functionSubmitGet(url, pesan = "Data will be process!", loadData) {
		let result
		let message
		swal({
			title: "Do you really want to manage this record?",
			text: pesan,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Do it",
			closeOnConfirm: false
		}, () => {
			$.ajax({
				url: url,
				headers: {
					'Authorization': localStorage.getItem("Token"),
					'X_CSRF_TOKEN': 'R32h@71Nd4',
					'Content-Type': 'application/json'
				},
				dataType: 'json',
				type: 'get',
				contentType: 'application/json',
				processData: false,
				success: (data, textStatus, jQxhr) => {
					result = data.result
					message = data.message
					if (result == "success") {
						this._toastr(message, 'success', 'Success')
						loadData()
					} else {
						this._toastr(message)
					}
				},
				error: (jqXhr, textStatus, errorThrown) => {
					this._toastr(message)
				}
			});
			swal("Success!", "Processing.", "success")
		});
	},
	_number(e, value) {
		let unicode = e.charCode ? e.charCode : e.keyCode
		if (value.indexOf(".") != -1)
			if (unicode == 46) return false;
		if (unicode != 8)
			if ((unicode < 48 || unicode > 57) && unicode != 46) return false;
	},
	_getOptions(id, url) {
		$(id).children().remove()
		$(id).append('<option value="" selected="selected">-- Choose --</option>')

		$.ajax({
			type: "GET",
			url: url,
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'R32h@71Nd4',
				'Content-Type': 'application/json'
			},
			dataType: "json",
			success: (e) => {
				for (let i = 0; i < e.result.length; i++) {
					$(id).append('<option value="' + e.result[i].value + '" >' + e.result[i].label + '</option>')
				}

				$(id).trigger("chosen:updated")
			}
		})
	},
	_getOptionsEdit(id, url, value) {
		$(id).children().remove()
		$(id).append('<option value="" selected="selected">-- Choose --</option>')

		$.ajax({
			type: "GET",
			url: url,
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'R32h@71Nd4',
				'Content-Type': 'application/json'
			},
			dataType: "json",
			success: (e) => {
				for (let i = 0; i < e.result.length; i++) {
					$(id).append('<option value="' + e.result[i].value + '" >' + e.result[i].label + '</option>')
				}

				$(id).val(value)
				$(id).trigger("chosen:updated")
			}
		});
	},
	_getInputTypeOptions(id, url) {
		$.ajax({
			type: "GET",
			url: url,
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'R32h@71Nd4',
				'Content-Type': 'application/json'
			},
			dataType: "json",
			success: (e) => {
				let htmlinput = '';

				for (let i = 0; i < e.result.length; i++) {
					htmlinput += '<input id="f_' + id + '" class="f_' + id + i + '" name="f_' + id + '" value="' + e.result[i].value + '" type="radio"> ' + e.result[i].label + '<br>';
				}

				$(id).html(htmlinput)
			}
		});
	},
	_getInputTypeOptionsEdit(id, url, value) {
		$.ajax({
			type: "GET",
			url: url,
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'R32h@71Nd4',
				'Content-Type': 'application/json'
			},
			dataType: "json",
			success: (e) => {
				let htmlinput = '';
				for (let i = 0; i < e.result.length; i++) {
					if (value === e.result[i].value) {
						htmlinput += '<input id="f_' + id + '" class="f_' + id + i + '" name="f_' + id + '" value="' + e.result[i].value + '" type="radio" checked> ' + e.result[i].label + ' <br>';
					} else {
						htmlinput += '<input id="f_' + id + '" class="f_' + id + i + '" name="f_' + id + '" value="' + e.result[i].value + '" type="radio"> ' + e.result[i].label + '<br>';
					}
				}
				$(id).html(htmlinput);
			}
		});
	},
	_getToSub(a, inputx, url) {
		this._getOptions(inputx, baseUrl() + url + a);
	},
	_getFormData(data) {
		let unindexed_array = data;
		let indexed_array = {};

		$.map(unindexed_array, (n, i) => {
			indexed_array[n['name']] = n['value'];
		});

		return indexed_array;
	},
	_formJson(formName) {
		let data = $("#" + formName).serializeArray();
		return JSON.stringify(this._getFormData(data))
	},
	_openFilePdf(urlpdf) {
		let isPDF = urlpdf.substr(-3);
		if (isPDF !== 'pdf') {
			window.open(urlpdf);
		} else {
			window.open(baseUrl() + urlpdf, '_blank');
		}
	},
	_empty(str) {
		return !str || !/[^\s]+/.test(str);
	},
	_getJson(callback, url) {
		$.ajax({
			url: url,
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'R32h@71Nd4',
				'Content-Type': 'application/json'
			},
			dataType: 'json',
			type: 'get',
			contentType: 'application/json',
			processData: false,
			async: false,

			success: callback,
			error: (jqXhr, textStatus, errorThrown) => {
				alert('error');
			}
		});
	},
	_postForm(formName, url, loadData) {
		let data = this._formJson(formName); //$("#form-upload").serializeArray();
		$.ajax({
			url: url,
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'R32h@71Nd4',
				'Content-Type': 'application/json'
			},
			dataType: 'json',
			type: 'post',
			contentType: 'application/json',
			processData: false,
			data: data,
			success: (data, textStatus, jQxhr) => {
				result = data.result;
				message = data.message;
				if (result == "success") {
					swal("Good job!", "Thanks!", "success");
					$("#f_id_edit").val(data.id);
					loadData();
					$('.modal').modal('hide');
				} else {
					this._toastr(message)
					return false;
				}
			},
			error: (jqXhr, textStatus, errorThrown) => {
				this._toastr(message)
			}
		});
	},
	_toastr(message, type = 'success', title = null) {
		options = {
			closeButton: true,
			debug: false,
			newestOnTop: false,
			progressBar: true,
			positionClass: 'toast-top-right',
			preventDuplicates: false,
			onclick: null,
			showDuration: '300',
			hideDuration: '1000',
			timeOut: '5000',
			extendedTimeOut: '1000',
			showEasing: 'swing',
			hideEasing: 'linear',
			showMethod: 'fadeIn',
			hideMethod: 'fadeOut'
		}
		// toastr[type](message);
		if (title == null) {
			title = type.charAt(0).toUpperCase() + type.slice(1)
		}

		if (type == 'success') {
			toastr.success(message, title, options);
		} else if (type == 'info') {
			toastr.info(message, title, options);
		} else if (type == 'warning') {
			toastr.warning(message, title, options);
		} else if (type == 'error') {
			toastr.error(message, title, options);
		}
	}

}