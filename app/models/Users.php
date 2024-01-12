<?php
	
	class Users extends DataBase {
		// Properties
		
		// Methods
		public function __construct()
		{
			$this->table_name = 'users';
			parent::__construct();
		}
	}
	
?>