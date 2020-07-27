(function(){

/**
 * Set Form control status
 * @param {jQuery} el Form control to change
 * @param {string} status Status
 */
function setStatus(el, status, msg) {
	var isError = status === 'error';
	el.addClass(isError ? 'is-invalid' : 'is-valid');
	el.parent().find('.invalid-feedback, .valid-feedback').remove();
	el.after('<div class="'+(isError ? 'invalid' : 'valid')+'-feedback">'+msg+'</div>');
}

function resetStatus(el) {
	el.removeClass('is-invalid is-valid');
	el.parent().find('.invalid-feedback, .valid-feedback').remove();
}

$('form.form-ajax').on('submit', function(event) {
	event.preventDefault();
	var form = $(this);
	var fileUpload = form.attr('enctype') === 'multipart/form-data';
	var formData = (fileUpload ? new FormData(form[0]) : form.serialize());
	Swal.fire({
		title: 'Mohon tunggu',
		html: 'Sedang memproses data',
		allowOutsideClick: false,
		allowEscapeKey: false,
		onBeforeOpen: function() {
			Swal.showLoading();
		}
	});
	$.ajax({
		url: form[0].action,
		method: form[0].method,
		data: formData,
		processData: !fileUpload,
		contentType: (fileUpload ? false : 'application/x-www-form-urlencoded; charset=UTF-8'),
		dataType: 'json',
		success: function(data) {
			Swal.close();
			form.trigger('form-ajax.success', [data]);
			var redirectDelay = data.redirectDelay || 2000;
			form.find('.form-control:not(div)').each(function() {
				resetStatus($(this));
			});
			if(data.redirect) {
				setTimeout(function() {
					window.location.assign(data.redirect);
				}, redirectDelay);
			}
		},
		error: function(data) {
			Swal.close();
			form.trigger('form-ajax.error', [data]);
			if(typeof data.responseJSON !== 'object') {
				return;
			}
			var response = data.responseJSON;
			form.find('.form-control:not(div)').each(function() {
				resetStatus($(this));
			});
			if(typeof response.errors === 'object') {
				var errors = response.errors;
				Object.keys(errors).forEach(function(name) {
					setStatus($('[name="'+name+'"'), 'error', errors[name]);
				});
			}
		}
	});
});

})();