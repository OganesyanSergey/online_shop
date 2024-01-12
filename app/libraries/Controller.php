<?php
	
	class Controller
	{
		// Properties
		
		// Methods
		public function view($view, $data = FALSE)
		{
			$array = explode('/', $view);

			if ($array[0] != 'admin') {
				require_once APP_ROOT . "/views/layout/header.php";
			}
			else if ($array[0] == 'admin' && $array[1] != 'index') {
				require_once APP_ROOT . "/views/admin/layout/header.php";
			}
			if (file_exists(APP_ROOT . '/views/' . $view . '.php')) {
				require_once APP_ROOT . '/views/' . $view . '.php';
			}
			if ($array[0] != 'admin') {
				require_once APP_ROOT . "/views/layout/footer.php";
			}
			else if ($array[0] == 'admin' && $array[1] != 'index') {
				require_once APP_ROOT . "/views/admin/layout/footer.php";
			}
		}
		
		public function model($model)
		{
			$model = ucwords($model);
			require_once APP_ROOT . '/models/' . $model . '.php';
			
			return $model = new $model;
		}
	}

?>