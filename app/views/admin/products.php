	
	<div class = "conteiner-fluid">
		<div class = "row row_cont">
			<div class = "col-lg-2">	
			</div>
			
			<div class = "col-lg-10">
				<div class = "mx-auto mt-5 w-50 text-center">
					<h1> Products </h1>
					<form action="<?= URL_ROOT.'/admin/product_add'?>" method="post" enctype="multipart/form-data">
						
						<div class="row mt-2">
						  <div class="col">
							<div class="form-floating">
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
						<div class = "row mt-2">
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
						<div class = "row mt-2">
							<div class="form-floating">
							  <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
							  <label for="floatingTextarea"> Description </label>
							</div>
						</div>
						<div class = "row mt-2">
							<div>
								<input class="form-control form-control-lg" name="image" type="file">
							</div>
						</div>
						<div class = "row mt-2">
							<div>
							  <button type="submit" class="btn btn-primary btn-lg" name="submit"> ADD </button>
							</div>
							<div class = "mt-2">
								<?= (get_session('admin_msg')) ? get_session('admin_msg') : ''; ?>
							</div>
						</div>
					</form>
				</div>
				<?php
					if (!empty($data)) {	
				?>	
					<div class = "row row_cont">
						<table id="sortable" class="table mx-auto" style = "width:95%;">
						  <thead>
							<tr>
							  <th scope="col"> id </th>
							  <th scope="col"> Name </th>
							  <th scope="col"> Price </th>
							  <th scope="col"> Serial Number </th>
							  <th scope="col"> Available </th>
							  <th scope="col"> Description </th>
							  <th scope="col"> Image </th>
							  <th scope="col"> Edit </th>
							  <th scope="col"> Delete </th>
							</tr>
						  </thead>
					<?php
					foreach($data as $key => $value){ 
					?>
						  <tbody class = "table_product">
							<tr class="ui-state-default sort" data-id="<?=$value['id']?>">
								<th scope="row" class = "num_id"><?= $value['order_by_num'] ?></th>
								<td> <?= $value['name'] ?> </td>
								<td> <?= $value['price'] ?> $ </td>
								<td> <?= $value['serial_number'] ?> </td>
								<td> <?= $value['available'] ?> </td>
								<td> <?= $value['description'] ?> </td>
								<td> <div class = "td_image">
									<img src="<?= URL_ROOT . '/public/uploads/products/' . $value['image'] ?>" class="img_main" alt="...">
									</div>
								</td>
								<td><button type="button" class="btn row_edit" data-id="<?=$value['id']?>"><i class="fa-solid fa-pencil text-warning" data-bs-toggle="modal" data-bs-target="#row_edit_modal" ></i></button></td>
								<td><button type="button" class = "btn row_del" data-id="<?=$value['id']?>"><i class="fa-solid fa-trash-can text-danger" data-bs-toggle="modal" data-bs-target="#row_del_modal"></i></button></td>
							</tr>
						  </tbody>
				<?php } ?>
					</table>
				</div>
					<?php } 
					else {
						echo '<div class = "alert alert-primary text-center col-2 mx-auto"> No Products Added </div>';
					} ?>
			</div>
		</div>
	</div>


