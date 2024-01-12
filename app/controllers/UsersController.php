<?php

	class UsersController extends Controller {
		// Properties
		
		// Methods
		
		// index
		public function index ()
		{
			$this->view('users/index');
		}
		
		// user login
		public function login ()
		{
			$response['empty_keys'] = [];
			$response['error_msg'] = '';
			$response['request_url'] = '';
			
			if (empty($_POST['login_email']) || empty($_POST['login_password'])) {
				foreach ($_POST as $key => $value) {
					(empty($value)) ? array_push($response['empty_keys'], $key) : null;
				}
				(count($response['empty_keys']) > 0) ? $response['error_msg'] = "Fill All Field's" : "";
			} else {
				$_POST['login_password'] = md5($_POST['login_password']);
				$num = $this->model('users')->select()->where('email', '=', $_POST['login_email'])->where('password', '=', $_POST['login_password'])->execute()->numRows();
				if ($num == 0) {
					$response['error_msg'] = 'Invalid Username Or Password';
				} else {
					$fetch = $this->model('users')->select()->where('email', '=', $_POST['login_email'])->execute()->fetch_row();
					set_session('user', $fetch);
					$response['request_url'] = URL_ROOT;
				}
			}
			echo json_encode($response);
		}
		
		// user registration
		public function registration ()
		{
			$response['empty_keys'] = [];
			$response['error_msg'] = '';
			$response['error_pas'] = '';
			$response['success_msg'] = '';
			if (
				empty($_POST['name']) ||
				empty($_POST['email']) ||
				empty($_POST['phone']) ||
				empty($_POST['password']) 
			) {
				foreach ($_POST as $key => $value) {
					(empty($value)) ? array_push($response['empty_keys'], $key) : null;
				}
				(count($response['empty_keys']) > 0) ? $response['error_msg'] = "Fill All Field's" : "";
			} else {
				$num = $this->model('users')->select()->where('email', '=', $_POST['email'])->execute()->numRows();
				$name = $_POST['name'];
				$_POST['name'] = $this->model('users')->cleanPost($name);
				if ($num == 0) {
					if (strlen($_POST['password']) <= '5'){
						$response['error_pas'] = 'Your Password Must Contain At Least 6 Characters!';
					} else {
						$_POST['password'] = md5($_POST['password']);
						$insert = $this->model('users')->insert($_POST)->execute();
						if ($insert) {
							$response['success_msg'] = 'Are You Registered';
						} else {
							$response['error_msg'] = 'An Error Occurred During Registration';
						}
					}
				} else {
					$response['error_msg'] = 'This User Is Already Registered';
				}
			}
			echo json_encode($response);
		}
		
		// add basket
		public function add_basket ()
		{
			$user = get_session('user');
			$array = [
				'product_id' => $_POST['id_product'],
				'user_id' => $user['id'],
				'quantity' => 1,
			];
			$basket = $this->model('basket')
						   ->select()
						   ->where('user_id', '=', $array['user_id'])
						   ->where('product_id', '=', $array['product_id'])
						   ->order('id', 'DESC')
						   ->execute()
						   ->numRows();
			if ($basket == 0 ) {
				$insert = $this->model('basket')->insert($array)->execute();
				if ($insert) {
					$product = $this->model('products') -> select() -> where('id', '=', $array['product_id']) -> execute() -> fetch_row();
					$i = 1;
					$cont = '
						<table class="table mx-auto" style = "width:95%;">
							  <thead>
								<tr>
								  <th scope="col"> id </th>
								  <th scope="col"> Image </th>
								  <th scope="col"> Name </th>
								  <th scope="col"> Quantity </th>
								  <th scope="col"> Price </th>
								  <th scope="col"> Delete </th>
								</tr>
							  </thead>
							  <tbody class = "basket_product">
								<tr>
									<th scope="row" class = "num_id">'. $i .'</th>
									<td> <div class = "td_image">
										<img src="public/uploads/products/'. $product['image']. '" class="img_main" alt="...">
										</div>
									</td>
									<td>'. $product['name'] .'</td>
									<td>'. $i .'</td>
									<td>'. $product['price'] .'$ </td>
									<td><button type="button" class = "btn row_del_basket" data-id_product="'. $product['id'] .'"><i class="fa-solid fa-trash-can text-danger"></i></button></td>
								</tr>
							  </tbody>
						</table> ';
				}
			} 
			echo json_encode($cont);
		}
		
		// basket show
		public function basket_show ()
		{
			$user = get_session('user');
			$basket = $this->model('basket')
						   ->select()
						   ->join('products')
						   ->where('user_id', '=', $user['id'])
						   ->execute()
					   	   ->fetch_all();
			$product_list = '';
			$total_price = 0;
			foreach ($basket as $i => $product) {
				$total_price += $product['quantity'] * $product['price'];
				$product_list .= '
					<tr class = "basket_product">
						<th scope="row" class = "num_id">'. $i + 1 .'</th>
						<td> <div class = "td_image">
							<img src="public/uploads/products/'. $product['image']. '" class="img_main" alt="...">
							</div>
						</td>
						<td>'. $product['name'] .'</td>
						<td>
							<div> 
								<i style="color:red;" class="fa-solid fa-circle-minus minus" data-product_id="'. $product['product_id'] .'"></i> 
								<span class="fs-5 mx-1 count_product"> '. $product['quantity'] .' </span> 
								<i style="color:green;" class="fa-solid fa-circle-plus plus" data-product_id="'. $product['product_id'] .'"></i>
							</div>
						</td>
						<td>'. $product['price'] .'$ </td>
						<td><button type="button" class = "btn row_del_basket" data-id_product="'. $product['id'] .'"><i class="fa-solid fa-trash-can text-danger"></i></button></td>
					</tr>
				';
			}
			$content = '
				<table class="table mx-auto" style = "width:95%;">
				  <thead>
					<tr>
					  <th scope="col"> id </th>
					  <th scope="col"> Image </th>
					  <th scope="col"> Name </th>
					  <th scope="col"> Quantity </th>
					  <th scope="col"> Price </th>
					  <th scope="col"> Delete </th>
					</tr>
				  </thead>
				  <tbody>'.$product_list.'</tbody>
				</table>
				<div class="float-end text-center d-flex">
					<div class="my-auto me-3">
						<h5 style="color:red;"> Total : '.$total_price.' $ </h5>
					</div>
					<div class="me-5">
						<a class="btn btn-outline-warning" href="'.URL_ROOT.'/users/card'.'" role="button"> Buy </a>
					</div>
				</div> 
			';
			
			set_session('total_price',$total_price);
			echo json_encode($content);
		}
		
		//row_del_basket
		public function row_del_basket()
		{
			if (isset($_POST['id_product'])) {
				$user = get_session('user');
				$user_id = $user['id'];
				$id_product = $_POST['id_product'];
				$fetch_product_basket = $this->model('basket')
											  ->select()
										      ->where('user_id', '=', $user_id)
										      ->where('product_id', '=', $id_product)
										      ->execute()
											  ->fetch_row();
				$product = $this->model('products') -> select() -> where('id', '=', $fetch_product_basket['product_id']) -> execute() -> fetch_row();
				$del_row_basket = $this->model('basket') -> delete_row() -> where('id', '=', $fetch_product_basket['id']) -> execute();
				if ($del_row_basket->query) {
					$res['true'] = 1;
					$total_price = get_session('total_price') - ($fetch_product_basket['quantity'] * $product['price']);
					set_session('total_price',$total_price);
				} else {
					$res['false'] = 0;
				}
				echo json_encode($res);
			}
		}
		
		//count plus
		public function count_plus()
		{
			if (isset($_POST['product_id'])) {
				$user = get_session('user');
				$user_id = $user['id'];
				$product_id = $_POST['product_id'];
				$fetch_product_basket = $this->model('basket')
											  ->select()
										      ->where('user_id', '=', $user_id)
										      ->where('product_id', '=', $product_id)
										      ->execute()
											  ->fetch_row();
				$count['quantity'] = $fetch_product_basket['quantity'] + 1;
				$product = $this->model('products') 
								-> select() 
								-> where('id', '=', $fetch_product_basket['product_id']) 
								-> execute() 
								-> fetch_row();
				if ($count['quantity'] <= $product['available']) {
					$edit = $this->model('basket') 
								 -> update_row($count) 
								 -> where('user_id', '=', $user_id)
								 ->where('product_id', '=', $product_id)
								 -> execute();
					$fetch_product_basket = $this->model('basket')
												  ->select()
												  ->where('user_id', '=', $user_id)
												  ->where('product_id', '=', $product_id)
												  ->execute()
												  ->fetch_row();
					$par['count'] = $fetch_product_basket['quantity'];
					$par['price'] = $product['price'];
					set_session('total_price', get_session('total_price') + $par['price']);
				} else {
					$par['count'] = $product['available'];
					$par['price'] = $product['price'];
				}
				echo json_encode($par);
			}
		}
		
		//count minus
		public function count_minus()
		{
			if (isset($_POST['product_id'])) {
				$user = get_session('user');
				$user_id = $user['id'];
				$product_id = $_POST['product_id'];
				$fetch_product_basket = $this->model('basket')
											  ->select()
										      ->where('user_id', '=', $user_id)
										      ->where('product_id', '=', $product_id)
										      ->execute()
											  ->fetch_row();
				$count['quantity'] = $fetch_product_basket['quantity'] - 1;
				if ($count['quantity'] < 0) {
					$par['count'] = 0;
					$par['price'] = 0;
				} else {
					$product = $this->model('products') 
									-> select() 
									-> where('id', '=', $fetch_product_basket['product_id']) 
									-> execute() 
									-> fetch_row();
					$edit = $this->model('basket') 
								 -> update_row($count) 
								 -> where('user_id', '=', $user_id)
								 -> where('product_id', '=', $product_id)
								 -> execute();
					$fetch_product_basket = $this->model('basket')
												  ->select()
												  ->where('user_id', '=', $user_id)
												  ->where('product_id', '=', $product_id)
												  ->execute()
												  ->fetch_row();
					$par['count'] = $fetch_product_basket['quantity'];
					$par['price'] = $product['price'];
					set_session('total_price', get_session('total_price') + $par['price']);
				}
				echo json_encode($par);
			}
		}
		
		// card
		public function card ()
		{
			protected_route();
			$this->view('users/card');
		}
		
		// payment card
		public function payment_card ()
		{	
			$user = get_session('user');
			$user_id = $user['id'];
			if (
				empty($_POST['name']) ||
				empty($_POST['number']) ||
				empty($_POST['date_card']) ||
				empty($_POST['cvv'])
			) {
				set_session('msg_card', '<div class = "alert alert-danger text-center"> Fill All Fields </div>');
			} else {
					$_POST['price'] = get_session('total_price');
					$_POST['date'] = date('Y-m-d H:i:s.u');
					$insert = $this->model('card')->insert($_POST)->execute();
					if ($insert) {
						set_session('msg_card', '<div class = "alert alert-success text-center"> successfully </div>');
						$basket = $this->model('basket')
									   ->select()
									   ->join('products')
									   ->where('user_id', '=', $user_id)
									   ->execute()
									   ->fetch_all();
						foreach($basket as $key => $value){
							$del_row = $this->model('basket') 
											-> delete_row() 
											-> where('user_id', '=', $value['user_id']) 
											-> execute();
							$count['available'] = $value['available'] - $value['quantity'];
							$edit = $this->model('products') 
										 -> update_row($count) 
										 -> where('id', '=', $value['product_id'])
										 -> execute();
						}
					} else {
						set_session('msg_card', '<div class = "alert alert-danger text-center"> Error </div>');
					}
				}
				set_session('total_price', 0);
				location('users/card');	
			}
		
		//logout
		public function logout() 
		{
			del_session(true);
			header('Location:' . URL_ROOT);
		}
		
	}

?>