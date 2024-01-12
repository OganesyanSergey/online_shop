<html>
	<head>
		<title> Online-Shop </title>
		<link rel = "stylesheet" href = "<?= URL_ROOT ?>/public/css/bootstrap.min.css">
		<link rel = "stylesheet" href = "<?= URL_ROOT ?>/public/css/all.css"/>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,300;1,400;1,700&display=swap" rel="stylesheet">
		<link rel = "stylesheet" href = "<?= URL_ROOT ?>/public/css/style.css"/>
	</head>
	<body>
		<div class="w-25 mx-auto border p-2 mt-5  rounded">
			<h2 class="text-center"> Admin Login </h2>
			<form>
				<!-- Name input -->
				<div class="form-outline mb-4">
					<input type="text" id="form2Example1" class="form-control admin_user" />
					<label class="form-label" for="form2Example1">Name</label>
				</div>

				<!-- Password input -->
				<div class="form-outline mb-4">
					<input type="password" id="form2Example2" class="form-control admin_pass" />
					<label class="form-label" for="form2Example2">Password</label>
				</div>

				<!-- Submit button -->
				<div class="text-center">
					<button type="button" class="btn btn-primary btn-block mb-4 admin_login">Sign in</button>
				</div>

				<div class="error_msg w-100"></div>
				
			</form>
		</div>
		
	<script src="<?= URL_ROOT ?>/public/js/jquery.js"></script>
	<script src = "<?= URL_ROOT ?>/public/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src = "<?= URL_ROOT ?>/public/js/main_admin.js"></script>
	</body>
</html>