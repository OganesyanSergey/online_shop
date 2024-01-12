<?php 
	$user_sess = get_session('user');
	
?>

	<div class = "conteiner-fluid" style = "min-height: 70px;">
		<div class = "row bg-secondary bg-gradient text-white">
			<div class = "col-lg-12">
				<div class = "">
					<div class="d-flex justify-content-between mt-3 mb-2 mx-3">
						<div class = "d-flex">
							<h3> Welcome To The Page Basket </h3>
						</div>
						<div class = "d-flex">
							<h3> <?= $user_sess['name']; ?> </h3>
						</div>
						<div class = "d-flex">
							<a href = "<?= URL_ROOT.'/users/logout' ?>">
								<button class="btn btn-outline-light" type="button"> Log Out </button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class = "container">
		<div class = "row">
			<h1> To start the quiz click on the start button. </h1>
			<div class="col-lg-1 mx-auto mt-5">
				<?= (get_session('btn_quize')) ? get_session('btn_quize') : null; ?>
			</div>
		</div>
	</div>

