<?php
	
	class Products extends DataBase {
		// Properties
		
		// Methods
		public function __construct()
		{
			$this->table_name = 'products';
			parent::__construct();
		}
	}

?>