<?php
	
	//--------- Upload Image ------------//
	
	function upload_file ($file, $dir) {
		
		$response = [];
		$file_name = $file['name'];
		$exp = explode('.', $file_name);
		$ext = end($exp);
		$allowed_formats = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
		if (in_array($ext, $allowed_formats)) {
			if ($file['size'] < 2000000) {
				$time = strtotime(date('Y-m-d H:i:s.u'));
				$file_name = md5($time).'.'.$ext;
				$upload = move_uploaded_file($file['tmp_name'], UPLOAD_ROOT . $dir .'/'. $file_name);
				if ($upload) {
					$response['msg'] = '<div class = "alert alert-success text-center">
												Upload Has Done!!!
											</div>';
					$response['status'] = 'success';
					$response['file_name'] = $file_name;
					$response['upload'] = $upload;
				} else {
					$response['status'] = 'error';
					$response['msg'] = '<div class = "alert alert-danger text-center">
												Something went wrong!!!
											</div>';
				}
			} else {
				$response['status'] = 'error';
				$response['msg'] = '<div class = "alert alert-danger text-center">
											File Size is Big!!!
										</div>';
			}
		} else {
			$response['status'] = 'error';
			$response['msg'] = '<div class = "alert alert-danger text-center">
										File Type is Incorrect!!!
									</div>';
		}
		return $response;
	}

	//--------- Set Session ------------//

	function set_session ($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	
	//--------- Get Session ------------//
	
	function get_session ($key)
	{
		if (isset($_SESSION[$key]) ){
			return $_SESSION[$key];
		} else {
			return null;
		}
	}
	
	//--------- Delete Session ------------//
	
	function del_session ($delete_all = false) 
	{
		if (!$delete_all) {
			foreach (array_keys($_SESSION) as $key) {
				if (!in_array($key, ['user', 'admin', 'total_price'])) {
					unset($_SESSION[$key]);
				}
			}
		} else {
			session_unset();
		}
	}
	
	//--------- Protected Route ------------//
	
	function protected_route ($is_admin = false) {
		//var_dump();
		if (!get_session($is_admin ? 'admin' : 'user')) {
			location($is_admin ? 'admin' : '');
		}
	}
	
	//--------- Location ------------//
	
	function location ($url) 
	{
		header('Location:' . URL_ROOT . '/' . $url);
	}
	
?>