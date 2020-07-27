<div class="card">
	<div class="card-header d-flex">
		<h3 class="mb-0 mr-auto">User</h3>
		<button class="btn btn-sm btn-primary waves-effect m-0" data-toggle="modal" data-target="#modal-form">Tambah</button>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped" id="datatable">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>No Telp</th>
						<th>Alamat</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<?php $this->load->view('user/form') ?>

<script>
	var srv = {
		roles: <?= json_encode($roles) ?>
	}
</script>