<?php
	
	class Basket extends DataBase {
		// Properties
		
		// Methods
		public function __construct()
		{
			$this->table_name = 'basket';
			parent::__construct();
		}
	}
	
?>