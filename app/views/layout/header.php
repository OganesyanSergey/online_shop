
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
	<header>
		<div class = "container position-fixed container_menu">
			<div class = "row">
				<div class = "col-lg-4 mx-auto menu text-center">
					
						<a href="<?=URL_ROOT?>" class = "menus border border-white rounded-pill"> Home </a>
						<div class="btn-group dropdown">
						  <button type="button" class="btn btn-outline-white dropdown-toggle menus basket basket-dropdown-toggle" aria-expanded="false">
							Basket
						  </button>
						  <ul class="dropdown-menu" id="basket-dropdown">
							<?= (get_session('user')) ? '<div class="container_basket" style="width:600px;"></div>' : '<li> <div class = "alert alert-danger text-center mx-2"> Basket empty </div></li>' ?> 
						  </ul>
						</div>
						<?= (get_session('user')) ? '<a href="'.URL_ROOT.'/users/logout'.'" class = "menus"> Logout </a>' : '<a href="'.URL_ROOT.'/users'.'" class = "menus"> Login </a>' ?>
				</div>
			</div>
		</div>
	</header>
	