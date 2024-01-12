
<section>
	<div class = "content_roduct">
		<div class="container px-4 py-5" id="featured-3">
			<h2 class="pb-2 border-bottom"> Products </h2>
			<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
			
			<?php
				if (!empty($data)) {	
				foreach($data as $key => $value){ 
			?>
				 <div class="feature col mb-4">
				  <div class="mx-3 border">
					<div class="feature-icon">
					  <div class = "m-2">
						<img src="<?= URL_ROOT . '/public/uploads/products/' . $value['image'] ?>" class="img-fluid" alt="...">
					  </div>
					</div>
					<div class="m-2">
						<h3> Name : <?= $value['name'] ?> </h3>
						<div class="row">
							<div class="col">
								<h4 style="color:red;"> Price : <?= $value['price'] ?> $ </h4>
								<p> Serial Number : <?= $value['serial_number'] ?> <p>
							</div>
						</div>
					</div>
					<div class="m-2">
						<p> <?= $value['description'] ?> </p>
					</div>
					<div class="m-2 button_div">
						<?= (get_session('user')) ? 
						'<button type="button" class="btn btn-outline-warning add_basket" data-id_product="'. $value['id'] .'"> ADD Basket </button>'
						: 
						'<button type="button" class="btn btn-outline-primary add_basket"> <a href="'.URL_ROOT.'/users'.'"> Please Log In </a></button>' ?>
					</div>
				</div>
			  </div>

			<?php } ?>
				
				<?php } 
				else {
					echo '<div class = "alert alert-primary text-center col-2 mx-auto"> No Products Added </div>';
				} ?>
			
			</div>
		</div>
	</div>
</section>

