var userjs = (function() {
	var datatable = $('#datatable').DataTable({
		processing: true,
		ajax: {
			url: base_url('user/table'),
		},
		columns: [
			{
				render: function(data, type, row, meta) {
					return meta.row + 1;
				}
			},
			{ data: 'nama' },
			{ data: 'email' },
			{ data: 'no_telepon' },
			{ data: 'alamat' },
			{
				data: 'role_id',
				render: function(data, type) {
					if(type !== 'display') return data;
					return srv.roles[data];
				}
			}, {
				render: function(data, type, row, meta) {
					function btn(type, title, icon, onclick) {
						return ''+
						'<button class="btn btn-sm m-0 btn-'+type+' waves-effect" title="'+title+'" onclick="'+onclick+'">'+
							'<i class="'+icon+'"></i>'+
						'</button>';
					}

					return ''+
					'<div class="btn-group">'+
						btn('info', 'Edit', 'fas fa-edit', 'userjs.rowEdit('+meta.row+')')+
						btn('danger', 'Delete', 'fas fa-trash', 'userjs.rowDelete('+row.id+')')+
					'</div>';
				}
			}
		]
	});

	$('.modal form').on('form-ajax.success', function() {
		datatable.ajax.reload();
		$(this).closest('.modal').modal('hide');
	});

	$('.modal').on('hidden.bs.modal', function() {
		$(this).find('form')[0].reset();
		$(this).find('label.active').removeClass('active');
	});

	function rowEdit(index) {
		var data = datatable.ajax.json().data[index];
		var form = $('#modal-form');
		Object.keys(data).forEach(function(name) {
			var value = data[name];
			var input = form.find('[name="'+name+'"]:not([type=file]):not([type=hidden])')
			input.val(value);
			$('label[for="'+input.prop('id')+'"]').addClass('active');
		});
		form.modal('show');
	}

	function rowDelete(id) {
		Swal.fire({
			title: 'Hapus?',
			text: "Hapus user ini?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal',
			confirmButtonColor: '#dc3545',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: base_url('user/destroy'),
					data: { id: id },
					method: 'POST',
					dataType: 'json',
					error: function(data) {
						if(typeof data.responseJSON !== 'object') {
							toast(data.responseText, 'error');
							return;
						}
						var response = data.responseJSON;
						alert(response.message);
					},
					complete: function() {
						datatable.ajax.reload(null, false);
					}
				});
			}
		});
	}

	return {
		rowEdit: rowEdit,
		rowDelete: rowDelete,
	};
})();