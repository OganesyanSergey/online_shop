
	<div class = "conteiner-fluid">
		<div class = "row">
			<div class = "col-lg-2">
			</div>
			
			<div class = "col-lg-10">
				<div class = "mx-auto mt-5 w-50 text-center">
					<h1> Edit Password </h1>
					<form action="<?= URL_ROOT.'/admin/edit_password'?>" method="post">
						
						<div class="row mt-2">
						  <div class="col">
							<div class="form-floating">
							  <input type="password" class="form-control" name="old_password" id="floatingText" placeholder="Old Password">
							  <label for="floatingText"> Old Password </label>
							</div>
						  </div>
						 
						</div>
						
						<div class = "row mt-2">
							 <div class="col">
							<div class="form-floating">
							  <input type="password" class="form-control" name="password" id="floatingText" placeholder="New Password">
							  <label for="floatingText"> New Password </label>
							</div>
						  </div>
						</div>
						
						<div class = "row mt-2">
							<div>
							  <button type="submit" class="btn btn-primary btn-lg" name="edit_password"> Edit </button>
							</div>
							<div class = "mt-2">
								<?= (get_session('admin_msg')) ? get_session('admin_msg') : ''; ?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>