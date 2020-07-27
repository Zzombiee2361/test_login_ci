<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $page_title ?></title>

	<link rel="stylesheet" href="<?= base_url('assets/lib/fontawesome/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/lib/mdb/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/lib/mdb/css/mdb.min.css') ?>">
	<?= $page_css ?? '' ?>
</head>
<body>
	<div id="main-content" class="container">
		<?php $this->load->view($page_content) ?>
	</div>

	<script src="<?= base_url('assets/lib/jquery/jquery-3.5.1.min.js') ?>"></script>
	<script src="<?= base_url('assets/lib/popper/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/lib/mdb/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/lib/mdb/js/mdb.min.js') ?>"></script>
	<script src="<?= base_url('assets/lib/sweetalert2/sweetalert2.min.js') ?>"></script>
	<script>
		function base_url(url) {
			if(!(typeof url === 'string' || typeof url === 'number')) {
				url = '';
			}
			return '<?= base_url() ?>'+url;
		}
	</script>
	<?= $page_js ?? '' ?>
</body>
</html>