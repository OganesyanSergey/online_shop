		<div class = "conteiner-fluid">
			<div class = "row">
				<div class = "col-lg-2">
					<div class = "position-fixed footer_main">
						<ul class="list-group list-group-flush text-center mt-5">
							<li>
								<a href="<?= URL_ROOT.'/admin/home'?>" class="list-group-item list-group-item-action my-2"> Admin Home </a>
							</li>
							<li>
								<a href="<?= URL_ROOT.'/admin/products'?>" class="list-group-item list-group-item-action my-2"> Products </a>
							</li>
							<li>
								<a href="<?= URL_ROOT.'/admin/setings'?>" class="list-group-item list-group-item-action my-2"> Setings </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Row Delite Modal -->
		<div class="modal fade" id="row_del_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel"> Remove row </h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
				<button type="button" class="btn btn-danger" id = "yes_del" data-bs-dismiss="modal"> Delete </button>
			  </div>
			</div>
		  </div>
		</div>
		<!-- -->
		
		<!-- Row Edite Modal -->
		<div class="modal fade" id="row_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel"> Edite row </h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  <div class="modal-footer">
				<div class = "mx-auto">
					<form action="<?= URL_ROOT.'/admin/editeProduct'?>" method="post" enctype="multipart/form-data" class = "edit_form">
						<div class="row mt-2">
						  <div class="col">
							<div class="form-floating">
							  <input type="hidden" name="id" class = "edit_id" />
							  <input type="text" class="form-control" name="name" id="floatingText" placeholder="Text">
							  <label for="floatingText"> Name </label>
							</div>
						  </div>
						  <div class="col">
							<div class="form-floating">
							  <input type="number" class="form-control" name="price" id="floatingText" placeholder="Number">
							  <label for="floatingText"> Price </label>
							</div>
						  </div>
						</div>
						<div class="row mt-2">
						   <div class="col">
							<div class="form-floating">
							  <input type="text" class="form-control" name="serial_number" id="floatingText" placeholder="Text">
							  <label for="floatingText"> Serial Number </label>
							</div>
						  </div>
						  <div class="col">
							<div class="form-floating">
							  <input type="number" class="form-control" name="available" id="floatingText" placeholder="Number">
							  <label for="floatingText"> Available </label>
							</div>
						  </div>
						</div>
						<div class="row mt-2">
						  <div class="col">
							<div class="form-floating">
							  <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
							  <label for="floatingTextarea"> Description </label>
							</div>
						  </div>
						</div>
						<div class = "row mt-2">
							<div style = "width: 400px;" class = "mx-auto">
								<img src="<?= URL_ROOT . '/public/uploads/products/'?>" class="img_main_modal" alt="...">
							</div>
							<div class = "mt-2">
								<input class="form-control form-control-lg" name="image" type="file">
							</div>
						</div>
						<div class = "mt-5 position-relative">
							<div>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
								<button type="submit" name = "submit_edit" class="btn btn-warning" id = "yes_edit" data-bs-dismiss="modal"> Edit  </button>
							</div>
						</div>
					</form>
				</div>
				
			  </div>
			</div>
		  </div>
		</div>
		<!-- -->
		
		<?php del_session(); ?>
		<script src="<?= URL_ROOT ?>/public/js/jquery.js"></script>
		<script src = "<?= URL_ROOT ?>/public/js/bootstrap.bundle.min.js"></script>
		<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
		<script src = "<?= URL_ROOT ?>/public/js/main_admin.js"></script>
	</body>
</html>