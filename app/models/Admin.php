<?php
	
	class Admin extends DataBase {
		// Properties
		
		// Methods
		public function __construct()
		{
			$this->table_name = 'admin';
			parent::__construct();
		}
	}

?>