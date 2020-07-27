<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
	<div class="row justify-content-center pt-5">
		<div class="col-12 col-sm-8 col-md-6 col-lg-4">
			<div class="card">
				<h5 class="card-header info-color white-text text-center py-4">
					<strong>Login</strong>
				</h5>
				<div class="card-body">
					<form action="<?= base_url('login/auth') ?>" id="login-form" class="text-center needs-validation form-ajax" method="post" novalidate>
						<div class="md-form">
							<input type="email" class="form-control" id="email" name="email" required>
							<label for="email">Email</label>
						</div>
						<div class="md-form">
							<input type="password" class="form-control" id="password" name="password" required>
							<label for="password">Password</label>
							<small class="form-text text-muted"></small>
						</div>
						<button class="btn btn-outline-info btn-block my-4 waves-effect z-depth-0" type="submit">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>