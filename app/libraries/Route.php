<?php

	class Link {
		// Properties
		public $current_controller = 'IndexPageController';
		public $current_method = 'index';
		
		// Methods
		public function __construct()
		{
			$link = $this->newlink();
			
			// Controller
			if (isset($link[0])) {
				if (file_exists('app/controllers/'.ucfirst($link[0]).'Controller.php')) {
					$this->current_controller = ucfirst($link[0] . 'Controller');
				} else {
					$this->current_controller = 'ErrorController';
				}
			}
			
			require_once 'app/controllers/'. $this->current_controller . '.php';
			$this->current_controller = new $this->current_controller;
			
			// Method
			if (isset($link[1])) {
				if (method_exists($this->current_controller, $link[1])) {
					$this->current_method = $link[1];
				} else {
					$this->current_controller = 'ErrorController';
					$current_method = 'index';
					
					require_once 'app/controllers/'. $this->current_controller . '.php';
					$this->current_controller = new $this->current_controller;
				}
			}
			$par = (isset($link[2])) ? $link[2] : null;
			call_user_func([$this->current_controller, $this->current_method], $par , []); 
		}
		
		
		public function newlink()
		{	
			$actual_link = rtrim($_SERVER['REQUEST_URI'], '/');
			$actual_link = filter_var($actual_link, FILTER_SANITIZE_URL);
			$actual_link = explode ('/', $actual_link);
			unset($actual_link[0]);
			$actual_link = array_values($actual_link);
			return $actual_link;
		}
	}
	
?>

