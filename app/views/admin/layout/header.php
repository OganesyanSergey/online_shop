<html>
	<head>
		<title> Online-Shop </title>
		<link rel = "stylesheet" href = "<?= URL_ROOT ?>/public/css/bootstrap.min.css">
		<link rel = "stylesheet" href = "<?= URL_ROOT ?>/public/css/all.css"/>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,300;1,400;1,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
		<style>
			#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
			#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
			#sortable li span { position: absolute; margin-left: -1.3em; }
			
			#sortable_1 { list-style-type: none; margin: 0; padding: 0; width: 90%; }
			#sortable_1 li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
			#sortable_1 li span { position: absolute; margin-left: -1.3em; }
		</style>
		<link rel = "stylesheet" href = "<?= URL_ROOT ?>/public/css/style_admin.css"/>
	</head>
	<body>
	
	<div class = "conteiner-fluid" style = "min-height: 70px;">
		<div class = "row">
			<div class = "col-lg-12">
				<div class = "position-fixed header_main">
					<div class="d-flex justify-content-between mt-3 mx-3">
						<div class = "d-flex">
							<h3> Hello </h3>
						</div>
						<div class = "d-flex">
							<h3> Admin </h3>
						</div>
						<div class = "d-flex">
							<a href = "<?= URL_ROOT.'/admin/logout' ?>">
								<button class="btn btn-outline-dark" type="button"> Log Out </button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>