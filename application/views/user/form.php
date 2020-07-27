<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="user/store" method="post" class="form-ajax">
				<input type="text" class="d-none" name="id">
			
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">User Form</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body mx-3">
					<div class="md-form mb-5">
						<i class="fas fa-user prefix grey-text"></i>
						<input type="text" id="nama" name="nama" class="form-control validate">
						<label for="nama">Nama</label>
					</div>

					<div class="md-form mb-5">
						<i class="fas fa-envelope prefix grey-text"></i>
						<input type="email" id="email" name="email" class="form-control validate">
						<label for="email">Email</label>
					</div>

					<div class="md-form mb-5">
						<i class="fas fa-key prefix grey-text"></i>
						<input type="text" id="password" name="password" class="form-control validate">
						<label for="password">Password</label>
					</div>

					<div class="md-form mb-5">
						<i class="fas fa-phone prefix grey-text"></i>
						<input type="text" id="no_telp" name="no_telepon" class="form-control validate">
						<label for="no_telp">No Telp</label>
					</div>

					<div class="md-form">
						<i class="fas fa-map-marker prefix grey-text"></i>
						<textarea type="text" id="alamat" name="alamat" class="md-textarea form-control" rows="4"></textarea>
						<label for="alamat">Alamat</label>
					</div>

					<div class="d-flex mb-5">
						<div style="width: 2.5rem">
							<i class="fas fa-tag prefix grey-text" style="font-size: 1.75rem"></i>
						</div>
						<div class="w-100">
							<select name="role_id" id="role_id" class="browser-default custom-select">
								<option value="">Role</option>
								<?php foreach($roles as $id => $role) { ?>
									<option value="<?= $id ?>"><?= $role ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

				</div>
				<div class="modal-footer d-flex justify-content-center">
					<button class="btn btn-unique">Send <i class="fas fa-paper-plane-o ml-1"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
