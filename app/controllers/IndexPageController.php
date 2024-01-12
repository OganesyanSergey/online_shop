<?php

	class IndexPageController extends Controller
	{
		// Properties
		
		// Methods
		public function index ()
		{
			$res = $this->model('products') -> select() -> order('order_by_num', 'ASC') -> execute() -> fetch_all();
			
			$this->view('index', $res);
		}
	}

?>