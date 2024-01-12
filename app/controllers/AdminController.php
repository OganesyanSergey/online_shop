<?php
	
	class AdminController extends Controller {
		
		// Properties
		
		// Methods
		
		//index
		public function index ()
		{
			$this->view('admin/index');
		}
		
		//login
		public function login()
		{
			$response['empty_keys'] = [];
			$response['error_msg'] = '';
			$response['request_url'] = '';
			if (empty($_POST['admin_user']) || empty($_POST['admin_pass'])) {
				foreach ($_POST as $key => $value) {
					(empty($value)) ? array_push($response['empty_keys'], $key) : null;
				}
				(count($response['empty_keys']) > 0) ? $response['error_msg'] = "Fill All Field's" : "";
			} else {
				$name = $_POST['admin_user'];
				$password = md5($_POST['admin_pass']);
				$num = $this->model('admin')->select()->where('name', '=', $name)->where('password', '=', $password)->execute()->numRows();
				if ($num == 0) {
					$response['error_msg'] = 'Invalid Username Or Password';
				} else {
					$fetch = $this->model('admin')->select()->execute()->fetch_row();
					set_session('admin', $fetch);
					$response['request_url'] = URL_ROOT . '/admin/home';
				}
			}
			echo json_encode($response);
		}
		
		public function home() 
		{
			protected_route(true);
			$this->view('admin/home');
		}
		
		//products show
		public function products() 
		{
			protected_route(true);
			$res = $this->model('products') -> select() -> order('order_by_num', 'ASC') -> execute() -> fetch_all();
			$this->view('admin/products', $res);
		}
		
		//product add
		public function product_add() 
		{
			protected_route(true);
			if (isset($_POST['submit'])){
				if (
					empty($_POST['name']) 			||
					empty($_POST['price']) 			||
					empty($_POST['serial_number']) 	||
					empty($_POST['available']) 		||
					empty($_POST['description']) 	||
					empty($_FILES['image']['name'])
				){
					set_session('admin_msg' , '<div class = "alert alert-danger text-center"> Fill All Fields </div>');
				} else {
					$num = $this->model('products')->select()->where('serial_number', '=', $_POST['serial_number'])->execute()->numRows();
					$name = $_POST['name'];
					$_POST['name'] = $this->model('products')->cleanPost($name);
					$serial_number = $_POST['serial_number'];
					$_POST['serial_number'] = $this->model('products')->cleanPost($serial_number);
					$description = $_POST['description'];
					$_POST['description'] = $this->model('products')->cleanPost($description);
					if ($num == 0) {
						$upload_file = upload_file($_FILES['image'], '/products');
						if ($upload_file['status'] == 'error') {
							set_session('admin_msg' , $upload_file['msg']);
						} else {
							$_POST['image'] = $upload_file['file_name'];
							unset($_POST['submit']);
							$num = $this->model('products') -> select() -> order('order_by_num', 'DESC') -> execute() -> fetch_row();
							if (empty($num)) {
								$num['order_by_num'] = 0;
							}
							$num = $num['order_by_num'];
							$num++;
							$_POST['order_by_num'] = $num;
							$insert = $this->model('products')->insert($_POST)->execute();
							set_session('admin_msg' , $upload_file['msg']);
						}
					} else {
						set_session('admin_msg' , '<div class = "alert alert-danger text-center"> This Serial Number has already been registered </div>');
					}	
				}
			}
			location('admin/products');
		}
		
		//setings
		public function setings() 
		{
			protected_route(true);
			$this->view('admin/setings');
		}
		
		//edit password
		public function edit_password() 
		{
			protected_route(true);
			if (isset($_POST['edit_password'])){
				if (
					empty($_POST['old_password']) ||
					empty($_POST['password']) 
				){
					set_session('admin_msg' , '<div class = "alert alert-danger text-center"> Fill All Fields </div>');
				} else {
					$_POST['old_password'] = md5($_POST['old_password']);
					$num = $this->model('admin')->select()->where('password', '=', $_POST['old_password'])->execute()->numRows();
					if ($num == 1) {
						unset($_POST['edit_password']);
						unset($_POST['old_password']);
						if (strlen($_POST['password']) <= '7'){
							set_session('admin_msg' , '<div class = "alert alert-danger text-center"> Your Password Must Contain At Least 8 Characters! </div>');
						} else {
							$_POST['password'] = md5($_POST['password']);
							$edit = $this->model('admin') -> update_row($_POST) -> execute(); 
							set_session('admin_msg' , '<div class = "alert alert-success text-center"> Password changed successfully </div>');
						}	
					} else {
						set_session('admin_msg' , '<div class = "alert alert-danger text-center"> password entered incorrectly </div>');
					}	
				}
			}
			location('admin/setings');
		}
		
		//delete row
		public function deleteRow()
		{
			protected_route(true);
			if (isset($_POST['row_del_id'])) {
				$row_del_id = $_POST['row_del_id'];
				$del_fetch = $this->model('products') -> select() -> where('id', '=', $row_del_id) -> execute() -> fetch_row();
				$dir_del = unlink(UPLOAD_ROOT . '/products/' . $del_fetch['image']);
				if ($dir_del) {
					$del_row = $this->model('products') -> delete_row() -> where('id', '=', $row_del_id) -> execute();
					if ($del_row->query) {
						echo 1;
					} else {
						echo 0;
					}
				} else {
					echo 0;
				}
			}
		}
		
		//Edite row
		public function editeRow() 
		{
			protected_route(true);
			if (isset($_POST['row_edite_id'])) {
				$row_edite_id = $_POST['row_edite_id'];
				$edite_fetch = $this->model('products') -> select() -> where('id', '=', $row_edite_id) -> execute() -> fetch_row();
				$edite_fetch['image'] = URL_ROOT . '/public/uploads/products/' . $edite_fetch['image'];
				echo json_encode($edite_fetch);
			}
		}
		
		//Edite click
		public function editeProduct()
		{
			protected_route(true);
			if (isset($_POST['submit_edit'])) {
				$file_edit = $_FILES['image']['name'];
				unset($_POST['submit_edit']);
				$id = $_POST['id'];
				unset($_POST['id']);
				if (!empty($file_edit)){
					$upload_file = upload_file($_FILES['image'], '/products');
					if ($upload_file['status'] == 'error') {
						set_session('admin_msg' , $upload_file['msg']);
					} else {
						$fetch = $this->model('products') -> select() -> where('id', '=', $id) -> execute() -> fetch_row();
						$dir_del = unlink(UPLOAD_ROOT . '/products/' . $fetch['image']);
						if ($dir_del) {
							$_POST['image'] = $upload_file['file_name'];
						} else {
							set_session('admin_msg' , '<div class = "alert alert-danger text-center"> File not edite');
						}
					}
				}
				$edit = $this->model('products') -> update_row($_POST) -> where('id', '=', $id) -> execute(); 
				location('admin/products');
			} else {
				location('error');
			}
		}
		
		//Edite num_id
		public function editeNum ()
		{
			if (isset($_POST['data'])) {
				$edit = $this->model('products') -> update_row($_POST['data']); 
			} else {
				location('error');
			}
		}
		
		//logout
		public function logout() 
		{
			del_session(true);
			location ('admin');
		}

	} 

?>